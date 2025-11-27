<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Page Not Found | Ed-Atok Travel</title>
    <link rel="shortcut icon" href="icon/pin.png" type="image/x-icon">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <style>
        :root {
            --primary-color: #63A361;
            --primary-light: #8BC184;
            --primary-dark: #4A7C4A;
            --text-color: #333333;
            --light-bg: #f8f9fa;
            --white: #ffffff;
        }
        
        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background-color: var(--light-bg);
            color: var(--text-color);
            min-height: 100vh;
            display: flex;
            flex-direction: column;
            overflow-x: hidden;
            margin: 0;
            padding: 0;
        }
        
        .error-container {
            flex: 1;
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 2rem;
            position: relative;
        }
        
        .error-content {
            text-align: center;
            max-width: 600px;
            padding: 3rem 2rem;
            background-color: var(--white);
            border-radius: 16px;
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.08);
            position: relative;
            z-index: 2;
        }
        
        .error-code {
            font-size: 8rem;
            font-weight: 800;
            color: var(--primary-color);
            margin-bottom: 0;
            line-height: 1;
            text-shadow: 3px 3px 0 var(--primary-light);
            animation: pulse 2s infinite;
        }
        
        .error-title {
            font-size: 1.8rem;
            font-weight: 600;
            margin-bottom: 1rem;
            color: var(--primary-dark);
        }
        
        .error-message {
            font-size: 1.1rem;
            margin-bottom: 2rem;
            line-height: 1.6;
            color: #666;
        }
        
        .btn-primary-custom {
            background-color: var(--primary-color);
            border-color: var(--primary-color);
            color: white;
            padding: 0.75rem 2rem;
            border-radius: 50px;
            font-weight: 600;
            transition: all 0.3s ease;
            text-decoration: none;
            display: inline-block;
            border: none;
            cursor: pointer;
        }
        
        .btn-primary-custom:hover {
            background-color: var(--primary-dark);
            border-color: var(--primary-dark);
            transform: translateY(-3px);
            box-shadow: 0 5px 15px rgba(99, 163, 97, 0.3);
        }
        
        .travel-elements {
            position: absolute;
            width: 100%;
            height: 100%;
            top: 0;
            left: 0;
            pointer-events: none;
            z-index: 1;
        }
        
        .travel-element {
            position: absolute;
            opacity: 0.7;
        }
        
        .compass {
            top: 10%;
            right: 10%;
            animation: rotate 20s linear infinite;
            color: var(--primary-light);
            font-size: 3rem;
        }
        
        .map-pin {
            bottom: 20%;
            left: 10%;
            animation: bounce 3s ease-in-out infinite;
            color: var(--primary-color);
            font-size: 2.5rem;
        }
        
        .plane {
            top: 30%;
            left: 5%;
            animation: fly 15s linear infinite;
            color: var(--primary-dark);
            font-size: 2rem;
        }
        
        .suitcase {
            bottom: 30%;
            right: 15%;
            animation: bounce 4s ease-in-out infinite;
            color: var(--primary-light);
            font-size: 2.2rem;
        }
        
        .mountain {
            bottom: 10%;
            right: 5%;
            animation: float 8s ease-in-out infinite;
            color: var(--primary-color);
            font-size: 3rem;
        }
        
        @keyframes pulse {
            0% { transform: scale(1); }
            50% { transform: scale(1.05); }
            100% { transform: scale(1); }
        }
        
        @keyframes rotate {
            from { transform: rotate(0deg); }
            to { transform: rotate(360deg); }
        }
        
        @keyframes bounce {
            0%, 100% { transform: translateY(0); }
            50% { transform: translateY(-15px); }
        }
        
        @keyframes fly {
            0% { transform: translateX(-100px) rotate(0deg); }
            100% { transform: translateX(calc(100vw + 100px)) rotate(5deg); }
        }
        
        @keyframes float {
            0%, 100% { transform: translateY(0) rotate(0deg); }
            50% { transform: translateY(-10px) rotate(2deg); }
        }
        
        .search-box {
            margin: 2rem 0;
            position: relative;
        }
        
        .search-input {
            width: 100%;
            padding: 0.75rem 1rem 0.75rem 3rem;
            border: 1px solid #ddd;
            border-radius: 50px;
            font-size: 1rem;
            transition: all 0.3s ease;
        }
        
        .search-input:focus {
            outline: none;
            border-color: var(--primary-color);
            box-shadow: 0 0 0 3px rgba(99, 163, 97, 0.2);
        }
        
        .search-icon {
            position: absolute;
            left: 1rem;
            top: 50%;
            transform: translateY(-50%);
            color: #999;
        }
        
        @media (max-width: 768px) {
            .error-code {
                font-size: 6rem;
            }
            
            .error-title {
                font-size: 1.5rem;
            }
            
            .travel-element {
                font-size: 1.5rem !important;
            }
        }
    </style>
</head>
<body>
    <!-- 404 Error Content -->
    <div class="error-container">
        <!-- Animated Travel Elements -->
        <div class="travel-elements">
            <i class="fas fa-compass travel-element compass"></i>
            <i class="fas fa-map-marker-alt travel-element map-pin"></i>
            <i class="fas fa-plane travel-element plane"></i>
            <i class="fas fa-suitcase travel-element suitcase"></i>
            <i class="fas fa-mountain travel-element mountain"></i>
        </div>
        
        <div class="error-content">
            <h1 class="error-code">404</h1>
            <h2 class="error-title">Lost in the Journey</h2>
            <p class="error-message">
                It seems you've ventured off the path. The page you're looking for might have been moved, deleted, or perhaps it's still waiting to be discovered.
            </p>
            
            <!-- Search Box -->
            <div class="search-box">
                <i class="fas fa-search search-icon"></i>
                <input type="text" class="search-input" placeholder="Search for destinations, guides, or travel tips...">
            </div>
            
            <!-- Action Button -->
            <div class="mt-4">
                <a href="home" class="btn btn-primary-custom">
                    <i class="fas fa-home me-2"></i>Back to Home
                </a>
            </div>
        </div>
    </div>
    
    <!-- JavaScript Libraries -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
    
    <script>
        // Add interactive elements
        document.addEventListener('DOMContentLoaded', function() {
            // Add hover effect to error code
            const errorCode = document.querySelector('.error-code');
            errorCode.addEventListener('mouseover', function() {
                this.style.transform = 'scale(1.1)';
                this.style.transition = 'transform 0.3s ease';
            });
            
            errorCode.addEventListener('mouseout', function() {
                this.style.transform = 'scale(1)';
            });
            
            // Add click effect to travel elements
            const travelElements = document.querySelectorAll('.travel-element');
            travelElements.forEach(element => {
                element.addEventListener('click', function() {
                    this.style.animation = 'none';
                    setTimeout(() => {
                        this.style.animation = '';
                    }, 10);
                });
            });
            
            // Search functionality
            const searchInput = document.querySelector('.search-input');
            searchInput.addEventListener('focus', function() {
                this.parentElement.style.transform = 'scale(1.02)';
            });
            
            searchInput.addEventListener('blur', function() {
                this.parentElement.style.transform = 'scale(1)';
            });
            
            searchInput.addEventListener('keypress', function(e) {
                if(e.key === 'Enter') {
                    alert('Searching for: ' + this.value);
                    // In a real implementation, you would redirect to search results
                }
            });
        });
    </script>
</body>
</html>