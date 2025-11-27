<?php
// tourguide_ajax.php - Tour Guide AJAX Handler
header('Content-Type: application/json');

// Include database connection
require_once '../db.php';

// Get action from POST
$action = isset($_POST['action']) ? $_POST['action'] : '';

// Route to appropriate function
switch ($action) {
    case 'get_all_tourguides':
        getAllTourGuides($conn);
        break;
    
    case 'get_tourguide_details':
        getTourGuideDetails($conn);
        break;
    
    case 'add_tourguide':
        addTourGuide($conn);
        break;
    
    case 'update_tourguide':
        updateTourGuide($conn);
        break;
    
    case 'delete_tourguide':
        deleteTourGuide($conn);
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

function getAllTourGuides($conn) {
    $search = isset($_POST['search']) ? $conn->real_escape_string($_POST['search']) : '';
    
    $sql = "SELECT id, full_name, status, created_at 
            FROM tourguide 
            WHERE 1=1";
    
    if (!empty($search)) {
        $sql .= " AND full_name LIKE '%$search%'";
    }
    
    $sql .= " ORDER BY full_name ASC";
    
    $result = $conn->query($sql);
    
    if ($result) {
        $tourguides = [];
        while ($row = $result->fetch_assoc()) {
            $tourguides[] = $row;
        }
        
        echo json_encode([
            'success' => true,
            'data' => $tourguides
        ]);
    } else {
        echo json_encode([
            'success' => false,
            'message' => 'Error fetching tour guides: ' . $conn->error
        ]);
    }
}

function getTourGuideDetails($conn) {
    $tourguide_id = intval($_POST['tourguide_id']);
    
    $sql = "SELECT id, full_name, status, created_at 
            FROM tourguide 
            WHERE id = ?";
    
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $tourguide_id);
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
            'message' => 'Tour guide not found'
        ]);
    }
    
    $stmt->close();
}

function addTourGuide($conn) {
    $full_name = trim($conn->real_escape_string($_POST['full_name']));
    $status = $conn->real_escape_string($_POST['status']);
    
    // Validate input
    if (empty($full_name)) {
        echo json_encode([
            'success' => false,
            'message' => 'Full name is required'
        ]);
        return;
    }
    
    // Check if tour guide already exists
    $check_sql = "SELECT id FROM tourguide WHERE full_name = ?";
    $check_stmt = $conn->prepare($check_sql);
    $check_stmt->bind_param("s", $full_name);
    $check_stmt->execute();
    $check_result = $check_stmt->get_result();
    
    if ($check_result->num_rows > 0) {
        echo json_encode([
            'success' => false,
            'message' => 'Tour guide with this name already exists'
        ]);
        $check_stmt->close();
        return;
    }
    $check_stmt->close();
    
    // Insert new tour guide
    $sql = "INSERT INTO tourguide (full_name, status) VALUES (?, ?)";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("ss", $full_name, $status);
    
    if ($stmt->execute()) {
        echo json_encode([
            'success' => true,
            'message' => 'Tour guide added successfully'
        ]);
    } else {
        echo json_encode([
            'success' => false,
            'message' => 'Error adding tour guide: ' . $conn->error
        ]);
    }
    
    $stmt->close();
}

function updateTourGuide($conn) {
    $tourguide_id = intval($_POST['tourguide_id']);
    $full_name = trim($conn->real_escape_string($_POST['full_name']));
    $status = $conn->real_escape_string($_POST['status']);
    
    // Validate input
    if (empty($full_name)) {
        echo json_encode([
            'success' => false,
            'message' => 'Full name is required'
        ]);
        return;
    }
    
    // Check if tour guide already exists (excluding current one)
    $check_sql = "SELECT id FROM tourguide WHERE full_name = ? AND id != ?";
    $check_stmt = $conn->prepare($check_sql);
    $check_stmt->bind_param("si", $full_name, $tourguide_id);
    $check_stmt->execute();
    $check_result = $check_stmt->get_result();
    
    if ($check_result->num_rows > 0) {
        echo json_encode([
            'success' => false,
            'message' => 'Another tour guide with this name already exists'
        ]);
        $check_stmt->close();
        return;
    }
    $check_stmt->close();
    
    // Update tour guide
    $sql = "UPDATE tourguide SET full_name = ?, status = ? WHERE id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("ssi", $full_name, $status, $tourguide_id);
    
    if ($stmt->execute()) {
        echo json_encode([
            'success' => true,
            'message' => 'Tour guide updated successfully'
        ]);
    } else {
        echo json_encode([
            'success' => false,
            'message' => 'Error updating tour guide: ' . $conn->error
        ]);
    }
    
    $stmt->close();
}

function deleteTourGuide($conn) {
    $tourguide_id = intval($_POST['tourguide_id']);
    
    // Check if tour guide is assigned to any registrations
    $check_sql = "SELECT COUNT(*) as assignment_count 
                  FROM registration_tourguides 
                  WHERE tourguide_id = ?";
    $check_stmt = $conn->prepare($check_sql);
    $check_stmt->bind_param("i", $tourguide_id);
    $check_stmt->execute();
    $check_result = $check_stmt->get_result();
    $assignment = $check_result->fetch_assoc();
    $check_stmt->close();
    
    if ($assignment['assignment_count'] > 0) {
        echo json_encode([
            'success' => false,
            'message' => 'Cannot delete tour guide. They are currently assigned to registrations.'
        ]);
        return;
    }
    
    // Delete tour guide
    $sql = "DELETE FROM tourguide WHERE id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $tourguide_id);
    
    if ($stmt->execute()) {
        echo json_encode([
            'success' => true,
            'message' => 'Tour guide deleted successfully'
        ]);
    } else {
        echo json_encode([
            'success' => false,
            'message' => 'Error deleting tour guide: ' . $conn->error
        ]);
    }
    
    $stmt->close();
}
?>