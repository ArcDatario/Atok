<?php
// Include auth_check at the top - it will handle the redirect automatically
require_once 'auth_check.php';

// Additional immediate check for login page when already logged in

if (isset($_SESSION['admin_logged_in']) && $_SESSION['admin_logged_in'] === true) {
    header('Location: dashboard');
    exit;
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Modern Login Form</title>
    <link rel="shortcut icon" href="../icon/pin.png" type="image/x-icon">
    <link rel="stylesheet" href="assets/css/login.css">
    <!-- ADD JQUERY -->
    <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
</head>
<body>
    <div class="loading-overlay" id="loadingOverlay">
        <div class="loading-spinner"></div>
    </div>

    <div class="login-container" id="loginContainer">
        <div class="logo">
            <h1>Welcome Back</h1>
        </div>
        
        <div class="message" id="message"></div>
        
        <form id="loginForm">
            <div class="form-group" id="usernameGroup">
                <label for="username">Username</label>
                <input type="text" id="username" name="username" required>
            </div>
            <div class="form-group" id="passwordGroup">
                <label for="password">Password</label>
                <input type="password" id="password" name="password" required>
            </div>
            <button type="submit" class="submit-btn" id="submitBtn">
                <span class="btn-text">Sign In</span>
                <div class="spinner"></div>
            </button>
            
        </form>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const loginContainer = document.getElementById('loginContainer');
            const usernameGroup = document.getElementById('usernameGroup');
            const passwordGroup = document.getElementById('passwordGroup');
            const submitBtn = document.getElementById('submitBtn');
            const forgotPassword = document.querySelector('.forgot-password');
            const loginForm = document.getElementById('loginForm');
            const messageDiv = document.getElementById('message');
            const loadingOverlay = document.getElementById('loadingOverlay');
            
            // Show main container with delay
            setTimeout(() => {
                loginContainer.classList.add('visible');
            }, 100);
            
            // Show form elements with delay after container is visible
            setTimeout(() => {
                usernameGroup.classList.add('visible');
            }, 300);
            
            setTimeout(() => {
                passwordGroup.classList.add('visible');
            }, 500);
            
            setTimeout(() => {
                submitBtn.classList.add('visible');
            }, 700);
            
            setTimeout(() => {
                forgotPassword.classList.add('visible');
            }, 900);
            
            // Form submission with AJAX
            loginForm.addEventListener('submit', function(e) {
                e.preventDefault();
                
                const username = document.getElementById('username').value;
                const password = document.getElementById('password').value;
                
                // Hide any existing messages
                hideMessage();
                
                // Show loading state on button
                submitBtn.classList.add('loading');
                
                // Use jQuery AJAX for better handling
                $.ajax({
                    url: 'login_process.php',
                    type: 'POST',
                    data: {
                        username: username,
                        password: password
                    },
                    dataType: 'json',
                    success: function(data) {
                        submitBtn.classList.remove('loading');
                        
                        if (data.success) {
                            showMessage(data.message, 'success');
                            
                            // Show loading overlay for 2 seconds
                            setTimeout(() => {
                                loadingOverlay.classList.add('visible');
                            }, 500);
                            
                            // Fade out all elements after 2 seconds
                            setTimeout(() => {
                                loginContainer.style.transition = 'all 0.8s ease';
                                loginContainer.style.opacity = '0';
                                loginContainer.style.transform = 'translateY(-30px)';
                                
                                // Redirect after fade out completes
                                setTimeout(() => {
                                    window.location.href = data.redirect_url || 'dashboard';
                                }, 800);
                            }, 2000);
                        } else {
                            showMessage(data.message, 'error');
                        }
                    },
                    error: function(xhr, status, error) {
    submitBtn.classList.remove('loading');
    console.error('AJAX Error:', status, error);
    console.log('Response:', xhr.responseText);
    
    // Check if it's a JSON parse error but the login actually worked
    if (status === 'parsererror') {
        // Sometimes session is set even with parse error, check if we're logged in
        setTimeout(function() {
            window.location.href = 'dashboard';
        }, 1000);
    } else {
        showMessage('An error occurred. Please try again.', 'error');
    }
}
                });
            });
            
            function showMessage(text, type) {
                messageDiv.textContent = text;
                messageDiv.className = `message ${type} visible`;
                
                // Auto hide error messages after 5 seconds
                if (type === 'error') {
                    setTimeout(hideMessage, 5000);
                }
            }
            
            function hideMessage() {
                messageDiv.classList.remove('visible');
                setTimeout(() => {
                    messageDiv.textContent = '';
                    messageDiv.className = 'message';
                }, 300);
            }
        });
    </script>
</body>
</html>