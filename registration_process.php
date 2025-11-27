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
    
    // Basic validation
    if (empty($fullName) || empty($contact) || empty($email) || empty($visitDate)) {
        echo json_encode(['success' => false, 'message' => 'Please fill in all required fields.']);
        exit;
    }
    
    if (strlen($contact) !== 10 || !is_numeric($contact)) {
        echo json_encode(['success' => false, 'message' => 'Please enter a valid 10-digit contact number.']);
        exit;
    }
    
    if ($pax < 1 || $pax > 20) {
        echo json_encode(['success' => false, 'message' => 'Please enter a valid number of pax (1-20).']);
        exit;
    }
    
    // Start transaction
    $conn->begin_transaction();
    
    try {
        // Generate unique reference number (8 digits)
        $reference = generateUniqueReference($conn);
        
        // Assign tour guide with all logic
        $tourguideId = assignTourGuide($conn, $visitDate);
        if (!$tourguideId) {
            throw new Exception('No available tour guides for the selected date. Please try another date.');
        }
        
        // Assign parking with all logic
        $parkingId = null;
        if ($hasCar === 'yes') {
            $parkingId = assignParking($conn, $visitDate);
            if (!$parkingId) {
                throw new Exception('No available parking slots for the selected date. Please try another date or consider not bringing a car.');
            }
        }
        
        // Calculate total
        $total = calculateTotal($conn, $hasCar);
        
        // Insert registration
        $stmt = $conn->prepare("
            INSERT INTO registration (reference, tourguide_id, parking_id, full_name, contact_number, email, visit_date, pax, car, total, status) 
            VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, 'pending')
        ");
        
        $stmt->bind_param("siissssisd", $reference, $tourguideId, $parkingId, $fullName, $contact, $email, $visitDate, $pax, $hasCar, $total);
        
        if (!$stmt->execute()) {
            throw new Exception('Registration failed: ' . $stmt->error);
        }
        
        $registrationId = $stmt->insert_id;
        $stmt->close();
        
        // Update tour guide daily count
        updateTourGuideDailyCount($conn, $tourguideId, $visitDate);
        
        // Create parking occupancy record if parking is assigned
        if ($parkingId) {
            $stmt = $conn->prepare("
                INSERT INTO parking_occupancy (parking_id, registration_id, occupancy_date) 
                VALUES (?, ?, ?)
            ");
            
            $stmt->bind_param("iis", $parkingId, $registrationId, $visitDate);
            
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
        
        $logContent = "New registration created: $fullName for $visitDate with $pax pax" . ($hasCar === 'yes' ? ' (with car)' : '');
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
            'reference' => $reference
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

function assignTourGuide($conn, $visitDate) {
    // Get daily limit from config
    $result = $conn->query("SELECT config_value FROM config WHERE config_key = 'daily_tourguide_limit'");
    if (!$result) {
        return getRandomTourGuide($conn);
    }
    
    $row = $result->fetch_assoc();
    $dailyLimit = $row ? $row['config_value'] : 5;
    
    // Find available tour guides (not on dayoff and under daily limit)
    $stmt = $conn->prepare("
        SELECT tg.id, 
               COALESCE(tdc.registration_count, 0) as today_count
        FROM tourguide tg
        LEFT JOIN tourguide_dayoff tdo ON tg.id = tdo.tourguide_id AND tdo.dayoff_date = ?
        LEFT JOIN tourguide_daily_count tdc ON tg.id = tdc.tourguide_id AND tdc.date = ?
        WHERE tg.status = 'active' 
        AND tdo.id IS NULL
        HAVING today_count < ?
        ORDER BY today_count ASC, RAND()
        LIMIT 1
    ");
    
    if (!$stmt) {
        return getRandomTourGuide($conn);
    }
    
    $stmt->bind_param("ssi", $visitDate, $visitDate, $dailyLimit);
    
    if (!$stmt->execute()) {
        return getRandomTourGuide($conn);
    }
    
    $result = $stmt->get_result();
    $tourguide = $result->fetch_assoc();
    $stmt->close();
    
    if ($tourguide) {
        return $tourguide['id'];
    }
    
    return getRandomTourGuide($conn);
}

function getRandomTourGuide($conn) {
    $result = $conn->query("SELECT id FROM tourguide WHERE status = 'active' ORDER BY RAND() LIMIT 1");
    $tourguide = $result->fetch_assoc();
    return $tourguide ? $tourguide['id'] : null;
}

function assignParking($conn, $visitDate) {
    $stmt = $conn->prepare("
        SELECT p.id 
        FROM parking p
        LEFT JOIN parking_occupancy po ON p.id = po.parking_id AND po.occupancy_date = ?
        WHERE p.status = 'available' 
        AND po.id IS NULL
        ORDER BY RAND()
        LIMIT 1
    ");
    
    if (!$stmt) {
        return getRandomAvailableParking($conn);
    }
    
    $stmt->bind_param("s", $visitDate);
    
    if (!$stmt->execute()) {
        return getRandomAvailableParking($conn);
    }
    
    $result = $stmt->get_result();
    $parking = $result->fetch_assoc();
    $stmt->close();
    
    if ($parking) {
        return $parking['id'];
    }
    
    return null;
}

function getRandomAvailableParking($conn) {
    $result = $conn->query("SELECT id FROM parking WHERE status = 'available' ORDER BY RAND() LIMIT 1");
    $parking = $result->fetch_assoc();
    return $parking ? $parking['id'] : null;
}

function calculateTotal($conn, $hasCar) {
    $total = 0;
    
    if ($hasCar === 'yes') {
        $result = $conn->query("SELECT config_value FROM config WHERE config_key = 'parking_fee'");
        if ($result) {
            $row = $result->fetch_assoc();
            $parkingFee = $row ? $row['config_value'] : 200;
            $total += $parkingFee;
        } else {
            $total += 200;
        }
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
    
    if (!$stmt) {
        return;
    }
    
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
?>