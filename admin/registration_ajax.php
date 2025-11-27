<?php
// registration_ajax.php - Backend API Handler
header('Content-Type: application/json');

// Include database connection
require_once '../db.php';

// Get action from POST
$action = isset($_POST['action']) ? $_POST['action'] : '';

// Route to appropriate function
switch ($action) {
    case 'get_all_registrations':
        getAllRegistrations($conn);
        break;
    
    case 'get_registration_details':
        getRegistrationDetails($conn);
        break;
    
    case 'get_available_tourguides':
        getAvailableTourGuides($conn);
        break;
    
    case 'update_tourguides':
        updateTourGuides($conn);
        break;
    
    case 'get_available_parking':
        getAvailableParking($conn);
        break;
    
    case 'update_parking':
        updateParking($conn);
        break;
    
    case 'update_status':
        updateStatus($conn);
        break;
    
    case 'update_registration':
        updateRegistration($conn);
        break;
    
    default:
        echo json_encode([
            'success' => false,
            'message' => 'Invalid action'
        ]);
        break;
}

// Close database connection
$conn->close();

// ============================================
// FUNCTIONS
// ============================================

function getAllRegistrations($conn) {
    $search = isset($_POST['search']) ? $conn->real_escape_string($_POST['search']) : '';
    $status = isset($_POST['status']) ? $conn->real_escape_string($_POST['status']) : '';
    
    $sql = "SELECT r.id, r.reference, r.full_name, r.visit_date, r.pax, 
                   r.num_vehicles, r.status, r.total
            FROM registration r
            WHERE 1=1";
    
    if (!empty($search)) {
        $sql .= " AND (r.reference LIKE '%$search%' OR r.full_name LIKE '%$search%' OR r.email LIKE '%$search%')";
    }
    
    if (!empty($status)) {
        $sql .= " AND r.status = '$status'";
    }
    
    $sql .= " ORDER BY r.created_at DESC";
    
    $result = $conn->query($sql);
    
    if ($result) {
        $registrations = [];
        while ($row = $result->fetch_assoc()) {
            $registrations[] = $row;
        }
        
        echo json_encode([
            'success' => true,
            'data' => $registrations
        ]);
    } else {
        echo json_encode([
            'success' => false,
            'message' => 'Error fetching registrations: ' . $conn->error
        ]);
    }
}

// Get registration details
function getRegistrationDetails($conn) {
    $registration_id = intval($_POST['registration_id']);
    
    $sql = "SELECT r.*, 
                   GROUP_CONCAT(DISTINCT tg.id) as tourguide_ids,
                   GROUP_CONCAT(DISTINCT tg.full_name) as tourguide_names,
                   GROUP_CONCAT(DISTINCT p.id) as parking_ids,
                   GROUP_CONCAT(DISTINCT p.parking_name) as parking_names
            FROM registration r
            LEFT JOIN registration_tourguides rt ON r.id = rt.registration_id
            LEFT JOIN tourguide tg ON rt.tourguide_id = tg.id
            LEFT JOIN parking_occupancy po ON r.id = po.registration_id
            LEFT JOIN parking p ON po.parking_id = p.id
            WHERE r.id = ?
            GROUP BY r.id";
    
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $registration_id);
    $stmt->execute();
    $result = $stmt->get_result();
    
    if ($row = $result->fetch_assoc()) {
        echo json_encode([
            'success' => true,
            'data' => $row
        ]);
    } else {
        echo json_encode([
            'success' => false,
            'message' => 'Registration not found'
        ]);
    }
    
    $stmt->close();
}

// Get available tour guides
function getAvailableTourGuides($conn) {
    $registration_id = intval($_POST['registration_id']);
    $visit_date = $conn->real_escape_string($_POST['visit_date']);
    
    // Get registration details
    $reg_sql = "SELECT pax, 
                       GROUP_CONCAT(DISTINCT rt.tourguide_id) as current_tourguides
                FROM registration r
                LEFT JOIN registration_tourguides rt ON r.id = rt.registration_id
                WHERE r.id = ?
                GROUP BY r.id";
    
    $reg_stmt = $conn->prepare($reg_sql);
    $reg_stmt->bind_param("i", $registration_id);
    $reg_stmt->execute();
    $reg_result = $reg_stmt->get_result();
    $registration = $reg_result->fetch_assoc();
    
    $pax = $registration['pax'];
    $guides_needed = ceil($pax / 10);
    $current_guides = $registration['current_tourguides'] ? explode(',', $registration['current_tourguides']) : [];
    
    // Get daily limit from config
    $limit_sql = "SELECT config_value FROM config WHERE config_key = 'daily_tourguide_limit'";
    $limit_result = $conn->query($limit_sql);
    $limit_row = $limit_result->fetch_assoc();
    $daily_limit = $limit_row ? intval($limit_row['config_value']) : 5;
    
    // Find available tour guides (excluding those on day off)
    $sql = "SELECT tg.id, tg.full_name, 
                   COALESCE(COUNT(DISTINCT rt.registration_id), 0) as current_count
            FROM tourguide tg
            LEFT JOIN tourguide_dayoff tdo ON tg.id = tdo.tourguide_id AND tdo.dayoff_date = ?
            LEFT JOIN registration_tourguides rt ON tg.id = rt.tourguide_id
            LEFT JOIN registration r ON rt.registration_id = r.id AND r.visit_date = ?
            WHERE tg.status = 'active' 
            AND tdo.id IS NULL
            GROUP BY tg.id
            HAVING current_count < ?
            ORDER BY current_count ASC, tg.full_name ASC";
    
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("ssi", $visit_date, $visit_date, $daily_limit);
    $stmt->execute();
    $result = $stmt->get_result();
    
    $tourguides = [];
    while ($row = $result->fetch_assoc()) {
        $tourguides[] = $row;
    }
    
    echo json_encode([
        'success' => true,
        'tourguides' => $tourguides,
        'current_guides' => $current_guides,
        'guides_needed' => $guides_needed,
        'pax' => $pax
    ]);
    
    $reg_stmt->close();
    $stmt->close();
}

// Update tour guides
function updateTourGuides($conn) {
    $registration_id = intval($_POST['registration_id']);
    $tourguide_ids = isset($_POST['tourguide_ids']) ? $_POST['tourguide_ids'] : [];
    
    // Start transaction
    $conn->begin_transaction();
    
    try {
        // Remove existing tour guide assignments
        $delete_sql = "DELETE FROM registration_tourguides WHERE registration_id = ?";
        $delete_stmt = $conn->prepare($delete_sql);
        $delete_stmt->bind_param("i", $registration_id);
        $delete_stmt->execute();
        $delete_stmt->close();
        
        // Add new tour guide assignments
        if (!empty($tourguide_ids)) {
            $insert_sql = "INSERT INTO registration_tourguides (registration_id, tourguide_id) VALUES (?, ?)";
            $insert_stmt = $conn->prepare($insert_sql);
            
            foreach ($tourguide_ids as $tourguide_id) {
                $tg_id = intval($tourguide_id);
                $insert_stmt->bind_param("ii", $registration_id, $tg_id);
                $insert_stmt->execute();
            }
            $insert_stmt->close();
        }
        
        // Commit transaction
        $conn->commit();
        
        // Log the transaction
        logTransaction($conn, $registration_id, "Tour guides updated - " . count($tourguide_ids) . " guide(s) assigned");
        
        echo json_encode([
            'success' => true,
            'message' => 'Tour guides updated successfully'
        ]);
        
    } catch (Exception $e) {
        $conn->rollback();
        echo json_encode([
            'success' => false,
            'message' => 'Error updating tour guides: ' . $e->getMessage()
        ]);
    }
}

// Get available parking
function getAvailableParking($conn) {
    $registration_id = intval($_POST['registration_id']);
    $visit_date = $conn->real_escape_string($_POST['visit_date']);
    
    // Get current vehicle count and parking
    $veh_sql = "SELECT num_vehicles,
                       GROUP_CONCAT(DISTINCT po.parking_id) as current_parking
                FROM registration r
                LEFT JOIN parking_occupancy po ON r.id = po.registration_id
                WHERE r.id = ?
                GROUP BY r.id";
    
    $veh_stmt = $conn->prepare($veh_sql);
    $veh_stmt->bind_param("i", $registration_id);
    $veh_stmt->execute();
    $veh_result = $veh_stmt->get_result();
    $registration = $veh_result->fetch_assoc();
    
    $num_vehicles = $registration['num_vehicles'];
    $current_parking = $registration['current_parking'] ? explode(',', $registration['current_parking']) : [];
    
    // Find available parking (not occupied on this date)
    $sql = "SELECT p.id, p.parking_name
            FROM parking p
            WHERE p.status = 'available' 
            AND p.id NOT IN (
                SELECT po.parking_id 
                FROM parking_occupancy po 
                WHERE po.occupancy_date = ? 
                AND po.registration_id != ?
            )
            ORDER BY p.parking_name ASC";
    
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("si", $visit_date, $registration_id);
    $stmt->execute();
    $result = $stmt->get_result();
    
    $parking = [];
    while ($row = $result->fetch_assoc()) {
        $parking[] = $row;
    }
    
    echo json_encode([
        'success' => true,
        'parking' => $parking,
        'current_parking' => $current_parking,
        'num_vehicles' => $num_vehicles
    ]);
    
    $veh_stmt->close();
    $stmt->close();
}

// Update parking
function updateParking($conn) {
    $registration_id = intval($_POST['registration_id']);
    $parking_ids = isset($_POST['parking_ids']) ? $_POST['parking_ids'] : [];
    
    // Start transaction
    $conn->begin_transaction();
    
    try {
        // Get visit date
        $date_sql = "SELECT visit_date FROM registration WHERE id = ?";
        $date_stmt = $conn->prepare($date_sql);
        $date_stmt->bind_param("i", $registration_id);
        $date_stmt->execute();
        $date_result = $date_stmt->get_result();
        $registration = $date_result->fetch_assoc();
        $visit_date = $registration['visit_date'];
        $date_stmt->close();
        
        // Remove existing parking assignments
        $delete_sql = "DELETE FROM parking_occupancy WHERE registration_id = ?";
        $delete_stmt = $conn->prepare($delete_sql);
        $delete_stmt->bind_param("i", $registration_id);
        $delete_stmt->execute();
        $delete_stmt->close();
        
        // Add new parking assignments
        if (!empty($parking_ids)) {
            $insert_sql = "INSERT INTO parking_occupancy (parking_id, registration_id, occupancy_date) VALUES (?, ?, ?)";
            $insert_stmt = $conn->prepare($insert_sql);
            
            foreach ($parking_ids as $parking_id) {
                $p_id = intval($parking_id);
                $insert_stmt->bind_param("iis", $p_id, $registration_id, $visit_date);
                $insert_stmt->execute();
            }
            $insert_stmt->close();
        }
        
        // Commit transaction
        $conn->commit();
        
        // Log the transaction
        logTransaction($conn, $registration_id, "Parking assignments updated - " . count($parking_ids) . " slot(s) assigned");
        
        echo json_encode([
            'success' => true,
            'message' => 'Parking assignments updated successfully'
        ]);
        
    } catch (Exception $e) {
        $conn->rollback();
        echo json_encode([
            'success' => false,
            'message' => 'Error updating parking: ' . $e->getMessage()
        ]);
    }
}

// Update status
function updateStatus($conn) {
    $registration_id = intval($_POST['registration_id']);
    $status = $conn->real_escape_string($_POST['status']);
    
    // Validate status
    $valid_statuses = ['pending', 'approved', 'cancelled'];
    if (!in_array($status, $valid_statuses)) {
        echo json_encode([
            'success' => false,
            'message' => 'Invalid status'
        ]);
        return;
    }
    
    $sql = "UPDATE registration SET status = ? WHERE id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("si", $status, $registration_id);
    
    if ($stmt->execute()) {
        // Log the transaction
        logTransaction($conn, $registration_id, "Status updated to: " . $status);
        
        echo json_encode([
            'success' => true,
            'message' => 'Status updated successfully'
        ]);
    } else {
        echo json_encode([
            'success' => false,
            'message' => 'Error updating status: ' . $conn->error
        ]);
    }
    
    $stmt->close();
}

// Update registration details
function updateRegistration($conn) {
    $registration_id = intval($_POST['registration_id']);
    $pax = intval($_POST['pax']);
    $num_vehicles = intval($_POST['num_vehicles']);
    
    // Get current registration details
    $current_sql = "SELECT car, visit_date FROM registration WHERE id = ?";
    $current_stmt = $conn->prepare($current_sql);
    $current_stmt->bind_param("i", $registration_id);
    $current_stmt->execute();
    $current_result = $current_stmt->get_result();
    $current_reg = $current_result->fetch_assoc();
    $current_stmt->close();
    
    $has_car = $current_reg['car'];
    $visit_date = $current_reg['visit_date'];
    
    // Calculate new total
    $total = calculateTotal($conn, $has_car, $pax, $num_vehicles);
    
    // Update registration
    $sql = "UPDATE registration SET pax = ?, num_vehicles = ?, total = ? WHERE id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("iidi", $pax, $num_vehicles, $total, $registration_id);
    
    if ($stmt->execute()) {
        // Log the transaction
        logTransaction($conn, $registration_id, "Registration updated - Pax: $pax, Vehicles: $num_vehicles, Total: ₱$total");
        
        echo json_encode([
            'success' => true,
            'message' => 'Registration updated successfully',
            'total' => $total
        ]);
    } else {
        echo json_encode([
            'success' => false,
            'message' => 'Error updating registration: ' . $conn->error
        ]);
    }
    
    $stmt->close();
}

// Calculate total based on pricing logic
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

// Log transaction
function logTransaction($conn, $registration_id, $content) {
    // Get registration reference
    $ref_sql = "SELECT reference FROM registration WHERE id = ?";
    $ref_stmt = $conn->prepare($ref_sql);
    $ref_stmt->bind_param("i", $registration_id);
    $ref_stmt->execute();
    $ref_result = $ref_stmt->get_result();
    $registration = $ref_result->fetch_assoc();
    $ref_stmt->close();
    
    if ($registration) {
        $reference = $registration['reference'];
        
        $sql = "INSERT INTO transactions (registration_id, registration_reference, content, created_at) 
                VALUES (?, ?, ?, NOW())";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("iss", $registration_id, $reference, $content);
        $stmt->execute();
        $stmt->close();
    }
}
?>