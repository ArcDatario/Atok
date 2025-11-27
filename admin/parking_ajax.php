<?php
// parking_ajax.php - Parking AJAX Handler
header('Content-Type: application/json');

// Include database connection
require_once '../db.php';

// Get action from POST
$action = isset($_POST['action']) ? $_POST['action'] : '';

// Route to appropriate function
switch ($action) {
    case 'get_all_parking':
        getAllParking($conn);
        break;
    
    case 'get_parking_details':
        getParkingDetails($conn);
        break;
    
    case 'add_parking':
        addParking($conn);
        break;
    
    case 'update_parking':
        updateParking($conn);
        break;
    
    case 'delete_parking':
        deleteParking($conn);
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

function getAllParking($conn) {
    $search = isset($_POST['search']) ? $conn->real_escape_string($_POST['search']) : '';
    
    $sql = "SELECT id, parking_name, status 
            FROM parking 
            WHERE 1=1";
    
    if (!empty($search)) {
        $sql .= " AND parking_name LIKE '%$search%'";
    }
    
    $sql .= " ORDER BY parking_name ASC";
    
    $result = $conn->query($sql);
    
    if ($result) {
        $parking = [];
        while ($row = $result->fetch_assoc()) {
            $parking[] = $row;
        }
        
        echo json_encode([
            'success' => true,
            'data' => $parking
        ]);
    } else {
        echo json_encode([
            'success' => false,
            'message' => 'Error fetching parking slots: ' . $conn->error
        ]);
    }
}

function getParkingDetails($conn) {
    $parking_id = intval($_POST['parking_id']);
    
    $sql = "SELECT id, parking_name, status 
            FROM parking 
            WHERE id = ?";
    
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $parking_id);
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
            'message' => 'Parking slot not found'
        ]);
    }
    
    $stmt->close();
}

function addParking($conn) {
    $parking_name = trim($conn->real_escape_string($_POST['parking_name']));
    $status = $conn->real_escape_string($_POST['status']);
    
    // Validate input
    if (empty($parking_name)) {
        echo json_encode([
            'success' => false,
            'message' => 'Parking name is required'
        ]);
        return;
    }
    
    // Check if parking slot already exists
    $check_sql = "SELECT id FROM parking WHERE parking_name = ?";
    $check_stmt = $conn->prepare($check_sql);
    $check_stmt->bind_param("s", $parking_name);
    $check_stmt->execute();
    $check_result = $check_stmt->get_result();
    
    if ($check_result->num_rows > 0) {
        echo json_encode([
            'success' => false,
            'message' => 'Parking slot with this name already exists'
        ]);
        $check_stmt->close();
        return;
    }
    $check_stmt->close();
    
    // Insert new parking slot
    $sql = "INSERT INTO parking (parking_name, status) VALUES (?, ?)";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("ss", $parking_name, $status);
    
    if ($stmt->execute()) {
        echo json_encode([
            'success' => true,
            'message' => 'Parking slot added successfully'
        ]);
    } else {
        echo json_encode([
            'success' => false,
            'message' => 'Error adding parking slot: ' . $conn->error
        ]);
    }
    
    $stmt->close();
}

function updateParking($conn) {
    $parking_id = intval($_POST['parking_id']);
    $parking_name = trim($conn->real_escape_string($_POST['parking_name']));
    $status = $conn->real_escape_string($_POST['status']);
    
    // Validate input
    if (empty($parking_name)) {
        echo json_encode([
            'success' => false,
            'message' => 'Parking name is required'
        ]);
        return;
    }
    
    // Check if parking slot already exists (excluding current one)
    $check_sql = "SELECT id FROM parking WHERE parking_name = ? AND id != ?";
    $check_stmt = $conn->prepare($check_sql);
    $check_stmt->bind_param("si", $parking_name, $parking_id);
    $check_stmt->execute();
    $check_result = $check_stmt->get_result();
    
    if ($check_result->num_rows > 0) {
        echo json_encode([
            'success' => false,
            'message' => 'Another parking slot with this name already exists'
        ]);
        $check_stmt->close();
        return;
    }
    $check_stmt->close();
    
    // Update parking slot
    $sql = "UPDATE parking SET parking_name = ?, status = ? WHERE id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("ssi", $parking_name, $status, $parking_id);
    
    if ($stmt->execute()) {
        echo json_encode([
            'success' => true,
            'message' => 'Parking slot updated successfully'
        ]);
    } else {
        echo json_encode([
            'success' => false,
            'message' => 'Error updating parking slot: ' . $conn->error
        ]);
    }
    
    $stmt->close();
}

function deleteParking($conn) {
    $parking_id = intval($_POST['parking_id']);
    
    // Check if parking slot is assigned to any registrations
    $check_sql = "SELECT COUNT(*) as assignment_count 
                  FROM parking_occupancy 
                  WHERE parking_id = ?";
    $check_stmt = $conn->prepare($check_sql);
    $check_stmt->bind_param("i", $parking_id);
    $check_stmt->execute();
    $check_result = $check_stmt->get_result();
    $assignment = $check_result->fetch_assoc();
    $check_stmt->close();
    
    if ($assignment['assignment_count'] > 0) {
        echo json_encode([
            'success' => false,
            'message' => 'Cannot delete parking slot. It is currently assigned to registrations.'
        ]);
        return;
    }
    
    // Delete parking slot
    $sql = "DELETE FROM parking WHERE id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $parking_id);
    
    if ($stmt->execute()) {
        echo json_encode([
            'success' => true,
            'message' => 'Parking slot deleted successfully'
        ]);
    } else {
        echo json_encode([
            'success' => false,
            'message' => 'Error deleting parking slot: ' . $conn->error
        ]);
    }
    
    $stmt->close();
}
?>