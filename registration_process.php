<?php
header('Content-Type: application/json');

// Include database connection
include 'db.php';

// Check if it's a POST request
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['action']) && $_POST['action'] === 'register') {
    
    // Get form data
    $fullName = $conn->real_escape_string(trim($_POST['fullName']));
    $contact = $conn->real_escape_string(trim($_POST['contact']));
    $email = $conn->real_escape_string(trim($_POST['email']));
    $pax = intval($_POST['pax']);
    $visitDate = date('Y-m-d', strtotime($_POST['visitDate']));
    $hasCar = $conn->real_escape_string($_POST['hasCar']);
    $numVehicles = isset($_POST['numVehicles']) ? intval($_POST['numVehicles']) : 0;
    
    // Basic validation
    if (empty($fullName) || empty($contact) || empty($email) || empty($visitDate)) {
        echo json_encode(['success' => false, 'message' => 'Please fill in all required fields.']);
        exit;
    }
    
    if (strlen($contact) !== 10 || !is_numeric($contact)) {
        echo json_encode(['success' => false, 'message' => 'Please enter a valid 10-digit contact number.']);
        exit;
    }
    
    if ($pax < 1 || $pax > 50) {
        echo json_encode(['success' => false, 'message' => 'Please enter a valid number of pax (1-50).']);
        exit;
    }
    
    if ($hasCar === 'yes' && ($numVehicles < 1 || $numVehicles > 5)) {
        echo json_encode(['success' => false, 'message' => 'Please enter a valid number of vehicles (1-5).']);
        exit;
    }
    
    // Start transaction
    $conn->begin_transaction();
    
    try {
        // Generate unique reference number (8 digits)
        $reference = generateUniqueReference($conn);
        
        // Calculate number of tour guides needed
        $guidesNeeded = calculateTourGuidesNeeded($pax);
        
        // Assign tour guides with all logic
        $tourguideIds = assignTourGuides($conn, $visitDate, $guidesNeeded);
        if (count($tourguideIds) !== $guidesNeeded) {
            throw new Exception('Not enough available tour guides for the selected date. Please try another date.');
        }
        
        // Assign parking with all logic
        $parkingIds = [];
        if ($hasCar === 'yes') {
            $parkingIds = assignParking($conn, $visitDate, $numVehicles);
            if (count($parkingIds) !== $numVehicles) {
                throw new Exception('Not enough available parking slots for the selected date. Please try another date or reduce number of vehicles.');
            }
        }
        
        // Calculate total
        $total = calculateTotal($conn, $hasCar, $pax, $numVehicles);
        
        // Insert registration
        $stmt = $conn->prepare("
            INSERT INTO registration (reference, full_name, contact_number, email, visit_date, pax, car, num_vehicles, total, status) 
            VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, 'pending')
        ");
        
        $stmt->bind_param("sssssisid", $reference, $fullName, $contact, $email, $visitDate, $pax, $hasCar, $numVehicles, $total);
        
        if (!$stmt->execute()) {
            throw new Exception('Registration failed: ' . $stmt->error);
        }
        
        $registrationId = $stmt->insert_id;
        $stmt->close();
        
        // Assign tour guides to registration
        foreach ($tourguideIds as $tourguideId) {
            $stmt = $conn->prepare("
                INSERT INTO registration_tourguides (registration_id, tourguide_id) 
                VALUES (?, ?)
            ");
            
            $stmt->bind_param("ii", $registrationId, $tourguideId);
            
            if (!$stmt->execute()) {
                throw new Exception('Failed to assign tour guide: ' . $stmt->error);
            }
            $stmt->close();
            
            // Update tour guide daily count
            updateTourGuideDailyCount($conn, $tourguideId, $visitDate);
        }
        
        // Create parking occupancy records if parking is assigned
        foreach ($parkingIds as $parkingId) {
            $stmt = $conn->prepare("
                INSERT INTO parking_occupancy (parking_id, registration_id, occupancy_date, vehicles_count) 
                VALUES (?, ?, ?, ?)
            ");
            
            $vehiclesPerSlot = 1; // Each parking slot holds 1 vehicle
            $stmt->bind_param("iisi", $parkingId, $registrationId, $visitDate, $vehiclesPerSlot);
            
            if (!$stmt->execute()) {
                throw new Exception('Failed to create parking occupancy: ' . $stmt->error);
            }
            $stmt->close();
        }
        
        // Log transaction
        $stmt = $conn->prepare("
            INSERT INTO transactions (registration_id, registration_reference, content) 
            VALUES (?, ?, ?)
        ");
        
        $logContent = "New registration created: $fullName for $visitDate with $pax pax" . 
                     ($hasCar === 'yes' ? " (with $numVehicles vehicles)" : "") . 
                     " - $guidesNeeded tour guide(s) assigned";
        $stmt->bind_param("iss", $registrationId, $reference, $logContent);
        
        if (!$stmt->execute()) {
            throw new Exception('Failed to log transaction: ' . $stmt->error);
        }
        $stmt->close();
        
        // Commit transaction
        $conn->commit();
        
        echo json_encode([
            'success' => true, 
            'message' => 'Registration completed successfully',
            'reference' => $reference,
            'guides_assigned' => count($tourguideIds),
            'parking_slots' => count($parkingIds)
        ]);
        
    } catch (Exception $e) {
        // Rollback transaction on error
        $conn->rollback();
        echo json_encode(['success' => false, 'message' => $e->getMessage()]);
    }
    
    $conn->close();
} else {
    echo json_encode(['success' => false, 'message' => 'Invalid request.']);
}

function generateUniqueReference($conn) {
    do {
        $reference = 'ATOK' . str_pad(mt_rand(1, 99999999), 8, '0', STR_PAD_LEFT);
        // Check if reference already exists
        $stmt = $conn->prepare("SELECT id FROM registration WHERE reference = ?");
        $stmt->bind_param("s", $reference);
        $stmt->execute();
        $result = $stmt->get_result();
        $exists = $result->num_rows > 0;
        $stmt->close();
    } while ($exists);
    
    return $reference;
}

function calculateTourGuidesNeeded($pax) {
    if ($pax <= 10) return 1;
    if ($pax <= 20) return 2;
    if ($pax <= 30) return 3;
    if ($pax <= 40) return 4;
    return 5; // Maximum 5 guides for 41-50 pax
}

function assignTourGuides($conn, $visitDate, $guidesNeeded) {
    // Get daily limit from config
    $result = $conn->query("SELECT config_value FROM config WHERE config_key = 'daily_tourguide_limit'");
    $dailyLimit = 5; // default
    if ($result) {
        $row = $result->fetch_assoc();
        $dailyLimit = $row ? $row['config_value'] : 5;
    }
    
    $assignedGuides = [];
    
    for ($i = 0; $i < $guidesNeeded; $i++) {
        // Find available tour guides (not on dayoff and under daily limit)
        $stmt = $conn->prepare("
            SELECT tg.id, 
                   COALESCE(tdc.registration_count, 0) as today_count
            FROM tourguide tg
            LEFT JOIN tourguide_dayoff tdo ON tg.id = tdo.tourguide_id AND tdo.dayoff_date = ?
            LEFT JOIN tourguide_daily_count tdc ON tg.id = tdc.tourguide_id AND tdc.date = ?
            WHERE tg.status = 'active' 
            AND tdo.id IS NULL
            AND tg.id NOT IN (" . (empty($assignedGuides) ? "0" : implode(",", $assignedGuides)) . ")
            HAVING today_count < ?
            ORDER BY today_count ASC, RAND()
            LIMIT 1
        ");
        
        if ($stmt) {
            $stmt->bind_param("ssi", $visitDate, $visitDate, $dailyLimit);
            $stmt->execute();
            $result = $stmt->get_result();
            $tourguide = $result->fetch_assoc();
            $stmt->close();
            
            if ($tourguide) {
                $assignedGuides[] = $tourguide['id'];
            } else {
                // Fallback: get any random active guide not already assigned
                $fallbackGuide = getRandomTourGuide($conn, $assignedGuides);
                if ($fallbackGuide) {
                    $assignedGuides[] = $fallbackGuide;
                }
            }
        } else {
            // Fallback if prepared statement fails
            $fallbackGuide = getRandomTourGuide($conn, $assignedGuides);
            if ($fallbackGuide) {
                $assignedGuides[] = $fallbackGuide;
            }
        }
    }
    
    return $assignedGuides;
}

function getRandomTourGuide($conn, $excludeIds = []) {
    $excludeClause = empty($excludeIds) ? "" : "AND id NOT IN (" . implode(",", $excludeIds) . ")";
    $result = $conn->query("SELECT id FROM tourguide WHERE status = 'active' $excludeClause ORDER BY RAND() LIMIT 1");
    $tourguide = $result->fetch_assoc();
    return $tourguide ? $tourguide['id'] : null;
}

function assignParking($conn, $visitDate, $numVehicles) {
    $assignedParking = [];
    
    for ($i = 0; $i < $numVehicles; $i++) {
        $stmt = $conn->prepare("
            SELECT p.id 
            FROM parking p
            LEFT JOIN parking_occupancy po ON p.id = po.parking_id AND po.occupancy_date = ?
            WHERE p.status = 'available' 
            AND po.id IS NULL
            AND p.id NOT IN (" . (empty($assignedParking) ? "0" : implode(",", $assignedParking)) . ")
            ORDER BY RAND()
            LIMIT 1
        ");
        
        if ($stmt) {
            $stmt->bind_param("s", $visitDate);
            $stmt->execute();
            $result = $stmt->get_result();
            $parking = $result->fetch_assoc();
            $stmt->close();
            
            if ($parking) {
                $assignedParking[] = $parking['id'];
            }
        }
    }
    
    return $assignedParking;
}

function calculateTotal($conn, $hasCar, $pax, $numVehicles) {
    $total = 0;
    
    // Calculate tour guide fee (per pax)
    $result = $conn->query("SELECT config_value FROM config WHERE config_key = 'tourguide_fee_per_pax'");
    $tourguideFeePerPax = 50; // default
    if ($result) {
        $row = $result->fetch_assoc();
        $tourguideFeePerPax = $row ? $row['config_value'] : 50;
    }
    $total += $pax * $tourguideFeePerPax;
    
    // Calculate parking fee
    if ($hasCar === 'yes') {
        $result = $conn->query("SELECT config_value FROM config WHERE config_key = 'parking_fee'");
        $parkingFee = 200; // default
        if ($result) {
            $row = $result->fetch_assoc();
            $parkingFee = $row ? $row['config_value'] : 200;
        }
        $total += $numVehicles * $parkingFee;
    }
    
    return $total;
}

function updateTourGuideDailyCount($conn, $tourguideId, $date) {
    $stmt = $conn->prepare("
        UPDATE tourguide_daily_count 
        SET registration_count = registration_count + 1,
            updated_at = NOW()
        WHERE tourguide_id = ? AND date = ?
    ");
    
    if ($stmt) {
        $stmt->bind_param("is", $tourguideId, $date);
        $stmt->execute();
        
        if ($stmt->affected_rows === 0) {
            $stmt = $conn->prepare("
                INSERT INTO tourguide_daily_count (tourguide_id, date, registration_count) 
                VALUES (?, ?, 1)
            ");
            
            if ($stmt) {
                $stmt->bind_param("is", $tourguideId, $date);
                $stmt->execute();
                $stmt->close();
            }
        } else {
            $stmt->close();
        }
    }
}
?>