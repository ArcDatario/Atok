<?php
session_start();

// Turn off error display to prevent HTML in JSON response
error_reporting(0);
ini_set('display_errors', 0);

// Set longer session lifetime (24 hours)
ini_set('session.gc_maxlifetime', 86400);
ini_set('session.cookie_lifetime', 86400);

// Set header FIRST to ensure JSON response
header('Content-Type: application/json');

try {
    // Include database connection
    require_once '../db.php';
    
    if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
        throw new Exception('Invalid request method');
    }

    // Get POST data
    $username = trim($_POST['username'] ?? '');
    $password = $_POST['password'] ?? '';

    // Validate input
    if (empty($username) || empty($password)) {
        throw new Exception('Please fill in all fields');
    }

    // Prepare SQL statement to prevent SQL injection
    $stmt = $conn->prepare("SELECT id, username, password, last_login FROM admin WHERE username = ?");
    if (!$stmt) {
        throw new Exception('Database preparation failed: ' . $conn->error);
    }
    
    $stmt->bind_param("s", $username);
    $stmt->execute();
    $result = $stmt->get_result();
    
    if ($result->num_rows === 1) {
        $user = $result->fetch_assoc();
        
        // Verify password
        if (password_verify($password, $user['password'])) {
            // Password is correct, set session variables
            $_SESSION['admin_id'] = $user['id'];
            $_SESSION['admin_username'] = $user['username'];
            $_SESSION['admin_logged_in'] = true;
            $_SESSION['last_login'] = $user['last_login'];
            $_SESSION['login_time'] = time();
            
            // Regenerate session ID to prevent fixation attacks
            session_regenerate_id(true);
            
            // Update last login time
            $update_stmt = $conn->prepare("UPDATE admin SET last_login = NOW() WHERE id = ?");
            $update_stmt->bind_param("i", $user['id']);
            $update_stmt->execute();
            $update_stmt->close();
            
            // Clear any output buffer to ensure clean JSON
            if (ob_get_length()) {
                ob_clean();
            }
            
            echo json_encode([
                'success' => true, 
                'message' => 'Login successful! Redirecting...',
                'redirect_url' => 'dashboard'
            ]);
            
        } else {
            throw new Exception('Invalid username or password');
        }
    } else {
        throw new Exception('Invalid username or password');
    }
    
    $stmt->close();
    
} catch (Exception $e) {
    // Clear any output buffer to ensure clean JSON
    if (ob_get_length()) {
        ob_clean();
    }
    
    error_log("Login error: " . $e->getMessage());
    echo json_encode(['success' => false, 'message' => $e->getMessage()]);
}

// Ensure no extra output
if (isset($conn)) {
    $conn->close();
}
exit;
?>