<?php
// Set longer session lifetime
ini_set('session.gc_maxlifetime', 86400);
ini_set('session.cookie_lifetime', 86400);

// Set session cookie parameters for longer life
session_set_cookie_params([
    'lifetime' => 86400,
    'path' => '/',
    'domain' => $_SERVER['HTTP_HOST'] ?? '',
    'secure' => isset($_SERVER['HTTPS']),
    'httponly' => true,
    'samesite' => 'Strict'
]);

session_start();

function isAdminLoggedIn() {
    // Check if all required session variables are present and valid
    if (isset($_SESSION['admin_logged_in']) && 
        $_SESSION['admin_logged_in'] === true &&
        isset($_SESSION['admin_id']) &&
        isset($_SESSION['admin_username']) &&
        isset($_SESSION['login_time'])) {
        
        // Check if session is too old (24 hours)
        $max_session_duration = 86400;
        if ((time() - $_SESSION['login_time']) > $max_session_duration) {
            // Session expired, logout user
            session_unset();
            session_destroy();
            return false;
        }
        
        // Optional: Refresh login time to extend session (uncomment if needed)
        // $_SESSION['login_time'] = time();
        
        return true;
    }
    
    // If any required session variable is missing
    return false;
}

// If this is called via AJAX to check auth status
if (isset($_GET['check_auth'])) {
    header('Content-Type: application/json');
    echo json_encode([
        'logged_in' => isAdminLoggedIn(),
        'admin_id' => $_SESSION['admin_id'] ?? null,
        'username' => $_SESSION['admin_username'] ?? null
    ]);
    exit;
}

// Get current page with better detection
$current_script = $_SERVER['SCRIPT_NAME'];
$current_page = basename($current_script);
$request_uri = $_SERVER['REQUEST_URI'];

// Detect if we're on a login page
$is_login_page = (strpos($current_page, 'login.php') !== false) || 
                 (strpos($request_uri, 'login') !== false && 
                  strpos($request_uri, 'login_process') === false);

// If user is NOT logged in and trying to access protected page, redirect to login
if (!isAdminLoggedIn() && !$is_login_page) {
    header('Location: login');
    exit;
}

// If user IS logged in and trying to access login page, redirect to dashboard
if (isAdminLoggedIn() && $is_login_page) {
    header('Location: dashboard');
    exit;
}

// Function to get admin info (can be used in other pages)
function getAdminInfo() {
    if (isAdminLoggedIn()) {
        return [
            'id' => $_SESSION['admin_id'],
            'username' => $_SESSION['admin_username'],
            'last_login' => $_SESSION['last_login'] ?? null
        ];
    }
    return null;
}
?>