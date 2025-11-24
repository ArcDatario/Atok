<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Voyage | Modern Travel Experiences</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <style>
        :root {
            --primary: #2c3e50;
            --accent: #3498db;
            --light: #ecf0f1;
            --dark: #1a252f;
            --olive: #7f8c8d;
        }
        
        body {
            font-family: 'Inter', -apple-system, BlinkMacSystemFont, sans-serif;
            color: var(--primary);
            line-height: 1.6;
            overflow-x: hidden;
        }
        
        /* Hero Section */
        .hero {
            height: 100vh;
            background: linear-gradient(rgba(0,0,0,0.5), rgba(0,0,0,0.3)), 
                        url('https://images.unsplash.com/photo-1469474968028-56623f02e42e?ixlib=rb-1.2.1&auto=format&fit=crop&w=1950&q=80');
            background-size: cover;
            background-position: center;
            display: flex;
            align-items: center;
            position: relative;
            color: white;
        }
        
        .hero-content {
            max-width: 800px;
            margin: 0 auto;
            text-align: center;
            padding: 0 20px;
        }
        
        .hero h1 {
            font-size: 4rem;
            font-weight: 700;
            margin-bottom: 1.5rem;
            letter-spacing: -1px;
        }
        
        .hero p {
            font-size: 1.2rem;
            margin-bottom: 2rem;
            opacity: 0.9;
        }
        
        .btn-hero {
            background-color: var(--accent);
            border: none;
            padding: 12px 30px;
            border-radius: 30px;
            font-weight: 600;
            transition: all 0.3s ease;
        }
        
        .btn-hero:hover {
            background-color: #2980b9;
            transform: translateY(-3px);
            box-shadow: 0 10px 20px rgba(0,0,0,0.2);
        }
        
        /* Navigation */
        .navbar {
            background-color: transparent !important;
            transition: all 0.3s ease;
            padding: 20px 0;
        }
        
        .navbar.scrolled {
            background-color: white !important;
            box-shadow: 0 2px 10px rgba(0,0,0,0.1);
            padding: 10px 0;
        }
        
        .navbar.scrolled .navbar-brand,
        .navbar.scrolled .nav-link {
            color: var(--primary) !important;
        }
        
        .navbar-brand {
            font-weight: 700;
            font-size: 1.5rem;
        }
        
        .nav-link {
            font-weight: 500;
            margin: 0 10px;
            transition: color 0.3s ease;
        }
        
        .nav-link:hover {
            color: var(--accent) !important;
        }
        
        /* Section Styles */
        .section-title {
            font-size: 2.5rem;
            font-weight: 700;
            margin-bottom: 3rem;
            text-align: center;
        }
        
        .section-subtitle {
            font-size: 1rem;
            text-align: center;
            max-width: 600px;
            margin: 0 auto 4rem;
            color: #7f8c8d;
        }
        
        section {
            padding: 100px 0;
        }
        
        /* Destination Cards */
        .destination-card {
            border: none;
            border-radius: 10px;
            overflow: hidden;
            transition: all 0.3s ease;
            margin-bottom: 30px;
            box-shadow: 0 5px 15px rgba(0,0,0,0.08);
        }
        
        .destination-card:hover {
            transform: translateY(-10px);
            box-shadow: 0 15px 30px rgba(0,0,0,0.15);
        }
        
        .destination-img {
            height: 250px;
            object-fit: cover;
        }
        
        .card-body {
            padding: 1.5rem;
        }
        
        .card-title {
            font-size: 1.3rem;
            font-weight: 600;
            margin-bottom: 0.5rem;
        }
        
        .card-text {
            font-size: 0.9rem;
            color: #7f8c8d;
            margin-bottom: 1rem;
        }
        
        .price {
            font-size: 1.1rem;
            font-weight: 600;
            color: var(--accent);
        }
        
        /* Features Section */
        .feature-icon {
            font-size: 2.5rem;
            color: var(--accent);
            margin-bottom: 1.5rem;
        }
        
        .feature-title {
            font-size: 1.3rem;
            font-weight: 600;
            margin-bottom: 1rem;
        }
        
        .feature-text {
            font-size: 0.9rem;
            color: #7f8c8d;
        }
        
        /* Testimonials */
        .testimonial-card {
            background-color: white;
            border-radius: 10px;
            padding: 2rem;
            box-shadow: 0 5px 15px rgba(0,0,0,0.08);
            margin-bottom: 30px;
        }
        
        .testimonial-text {
            font-style: italic;
            margin-bottom: 1.5rem;
        }
        
        .testimonial-author {
            font-weight: 600;
        }
        
        .testimonial-role {
            font-size: 0.9rem;
            color: #7f8c8d;
        }
        
        /* Newsletter */
        .newsletter {
            background-color: var(--primary);
            color: white;
            padding: 80px 0;
        }
        
        .newsletter h2 {
            font-size: 2.2rem;
            margin-bottom: 1rem;
        }
        
        .newsletter p {
            font-size: 1rem;
            opacity: 0.8;
            margin-bottom: 2rem;
        }
        
        .newsletter-form {
            max-width: 500px;
            margin: 0 auto;
        }
        
        .form-control {
            padding: 12px 20px;
            border-radius: 30px;
            border: none;
        }
        
        .btn-newsletter {
            background-color: var(--accent);
            border: none;
            padding: 12px 30px;
            border-radius: 30px;
            font-weight: 600;
            margin-left: 10px;
        }
        
        /* Footer */
        footer {
            background-color: var(--dark);
            color: white;
            padding: 60px 0 30px;
        }
        
        .footer-heading {
            font-size: 1.1rem;
            font-weight: 600;
            margin-bottom: 1.5rem;
        }
        
        .footer-link {
            color: #bdc3c7;
            text-decoration: none;
            display: block;
            margin-bottom: 0.8rem;
            transition: color 0.3s ease;
            font-size: 0.9rem;
        }
        
        .footer-link:hover {
            color: white;
        }
        
        .social-icons a {
            color: white;
            font-size: 1.2rem;
            margin-right: 15px;
            transition: color 0.3s ease;
        }
        
        .social-icons a:hover {
            color: var(--accent);
        }
        
        .copyright {
            font-size: 0.8rem;
            color: #7f8c8d;
            margin-top: 40px;
        }
        
        /* Responsive Adjustments */
        @media (max-width: 768px) {
            .hero h1 {
                font-size: 2.5rem;
            }
            
            .hero p {
                font-size: 1rem;
            }
            
            .section-title {
                font-size: 2rem;
            }
        }
    </style>
</head>
<body>
    <!-- Navigation -->
    <nav class="navbar navbar-expand-lg navbar-dark fixed-top">
        <div class="container">
            <a class="navbar-brand" href="#">Atok</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ms-auto">
                    <li class="nav-item">
                        <a class="nav-link" href="#destinations">Destinations</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#features">Features</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#testimonials">Testimonials</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#contact">Contact</a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>

    <!-- Hero Section -->
    <section class="hero">
        <div class="container">
            <div class="hero-content">
                <h1>Adventure</h1>
                <p>Explore breathtaking destinations and create unforgettable memories with our curated travel experiences.</p>
                <button class="btn btn-hero">Explore Destinations</button>
            </div>
        </div>
    </section>

<!-- Destinations Section -->
<section id="destinations" class="bg-light">
    <div class="container">
        <h2 class="section-title">Popular Destinations</h2>
        <p class="section-subtitle">From tropical beaches to historic cities, discover the world's most captivating places.</p>
        
        <!-- Destination 1 - Right Side -->
        <div class="destination-row">
            <div class="row align-items-center destination-item">
                <div class="col-md-6">
                    <div class="destination-content">
                        <h3>Baguio, Benguet</h3>
                        <p>Discover the City of Pines, a cool mountain haven nestled in the heart of Benguet. With its fresh mountain breeze, scenic pine forests, and vibrant cultural attractions, Baguio offers the perfect escape from the tropical heat.</p>
                        <button class="btn btn-outline-primary">Explore Baguio</button>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="destination-image">
                        <img src="https://images.unsplash.com/photo-1536152470836-b943b246224c?ixlib=rb-1.2.1&auto=format&fit=crop&w=800&q=80" alt="Baguio, Benguet">
                    </div>
                </div>
            </div>
            <div class="curve-separator">
                <svg viewBox="0 0 1200 120" preserveAspectRatio="none">
                    <path d="M0,0V6c0,21.6,291,111.46,741,110.26,445.39,3.6,459-88.3,459-110.26V0Z" class="shape-fill"></path>
                </svg>
            </div>
        </div>
        
        <!-- Destination 2 - Left Side -->
        <div class="destination-row">
            <div class="row align-items-center destination-item">
                <div class="col-md-6 order-md-2">
                    <div class="destination-content">
                        <h3>Strawberry Farm, La Trinidad</h3>
                        <p>Experience the charming strawberry farms of La Trinidad where you can pick fresh strawberries directly from the fields. Surrounded by rolling hills and cool mountain air, this destination offers a unique agricultural tourism experience with stunning views.</p>
                        <button class="btn btn-outline-primary">Visit Strawberry Farm</button>
                    </div>
                </div>
                <div class="col-md-6 order-md-1">
                    <div class="destination-image">
                        <img src="https://images.unsplash.com/photo-1520250497591-112f2f40a3f4?ixlib=rb-1.2.1&auto=format&fit=crop&w=800&q=80" alt="Strawberry Farm, La Trinidad">
                    </div>
                </div>
            </div>
            <div class="curve-separator curve-reverse">
                <svg viewBox="0 0 1200 120" preserveAspectRatio="none">
                    <path d="M0,0V6c0,21.6,291,111.46,741,110.26,445.39,3.6,459-88.3,459-110.26V0Z" class="shape-fill"></path>
                </svg>
            </div>
        </div>
        
        <!-- Destination 3 - Right Side -->
        <div class="destination-row">
            <div class="row align-items-center destination-item">
                <div class="col-md-6">
                    <div class="destination-content">
                        <h3>Mines View Park, Itogon</h3>
                        <p>Witness breathtaking panoramic views of Itogon's famous gold mines at this scenic overlook. The expansive vista showcases the dramatic landscape with terraced mining operations set against majestic mountain peaks and morning mist.</p>
                        <button class="btn btn-outline-primary">Explore Mines View Park</button>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="destination-image">
                        <img src="https://images.unsplash.com/photo-1516483638261-f4dbaf036963?ixlib=rb-1.2.1&auto=format&fit=crop&w=800&q=80" alt="Mines View Park, Itogon">
                    </div>
                </div>
            </div>
        </div>
        
        <!-- Destination 4 - Left Side -->
        <div class="destination-row">
            <div class="row align-items-center destination-item">
                <div class="col-md-6 order-md-2">
                    <div class="destination-content">
                        <h3>Kabayan, Benguet</h3>
                        <p>Discover the breathtaking Kabayan Hanging Coffins, an ancient burial practice carved into the cliffs. This mystical destination offers fascinating cultural heritage, stunning mountain vistas, and a glimpse into the region's rich history and traditions.</p>
                        <button class="btn btn-outline-primary">Explore Kabayan</button>
                    </div>
                </div>
                <div class="col-md-6 order-md-1">
                    <div class="destination-image">
                        <img src="https://images.unsplash.com/photo-1536152470836-b943b246224c?ixlib=rb-1.2.1&auto=format&fit=crop&w=800&q=80" alt="Kabayan, Benguet">
                    </div>
                </div>
            </div>
            <div class="curve-separator curve-reverse">
                <svg viewBox="0 0 1200 120" preserveAspectRatio="none">
                    <path d="M0,0V6c0,21.6,291,111.46,741,110.26,445.39,3.6,459-88.3,459-110.26V0Z" class="shape-fill"></path>
                </svg>
            </div>
        </div>
        
        <!-- Destination 5 - Right Side -->
        <div class="destination-row">
            <div class="row align-items-center destination-item">
                <div class="col-md-6">
                    <div class="destination-content">
                        <h3>Sagano Flower Farm, Atok</h3>
                        <p>Experience the vibrant Sagano Flower Farm where thousands of colorful blooms paint the hillside in brilliant hues. Perfect for nature lovers and photographers, this flower garden offers stunning views and fresh flowers in a picturesque mountain setting.</p>
                        <button class="btn btn-outline-primary">Visit Flower Farm</button>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="destination-image">
                        <img src="https://images.unsplash.com/photo-1520250497591-112f2f40a3f4?ixlib=rb-1.2.1&auto=format&fit=crop&w=800&q=80" alt="Sagano Flower Farm, Atok">
                    </div>
                </div>
            </div>
            <div class="curve-separator">
                <svg viewBox="0 0 1200 120" preserveAspectRatio="none">
                    <path d="M0,0V6c0,21.6,291,111.46,741,110.26,445.39,3.6,459-88.3,459-110.26V0Z" class="shape-fill"></path>
                </svg>
            </div>
        </div>
        
        <!-- Destination 6 - Left Side -->
        <div class="destination-row">
            <div class="row align-items-center destination-item">
                <div class="col-md-6 order-md-2">
                    <div class="destination-content">
                        <h3>Eco-Garden, Baguio</h3>
                        <p>Immerse yourself in the natural beauty of Eco-Garden, a serene sanctuary showcasing sustainable agriculture and organic farming. Surrounded by lush vegetation and mountain tranquility, it's an ideal destination for eco-conscious travelers and nature enthusiasts.</p>
                        <button class="btn btn-outline-primary">Discover Eco-Garden</button>
                    </div>
                </div>
                <div class="col-md-6 order-md-1">
                    <div class="destination-image">
                        <img src="https://images.unsplash.com/photo-1516483638261-f4dbaf036963?ixlib=rb-1.2.1&auto=format&fit=crop&w=800&q=80" alt="Eco-Garden, Baguio">
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<style>
    .destination-row {
        position: relative;
        margin-bottom: 0;
    }
    
    .destination-item {
        padding: 80px 0;
    }
    
    .destination-content {
        padding: 0 30px;
    }
    
    .destination-content h3 {
        font-size: 2rem;
        font-weight: 700;
        margin-bottom: 1.5rem;
        color: var(--primary);
    }
    
    .destination-content p {
        font-size: 1rem;
        color: #7f8c8d;
        margin-bottom: 2rem;
        line-height: 1.7;
    }
    
    .destination-image {
        border-radius: 10px;
        overflow: hidden;
        box-shadow: 0 15px 30px rgba(0,0,0,0.1);
        transition: transform 0.3s ease;
    }
    
    .destination-image:hover {
        transform: translateY(-10px);
    }
    
    .destination-image img {
        width: 100%;
        height: 400px;
        object-fit: cover;
    }
    
    .curve-separator {
        position: absolute;
        bottom: 0;
        left: 0;
        width: 100%;
        overflow: hidden;
        line-height: 0;
        transform: translateY(1px);
    }
    
    .curve-separator svg {
        position: relative;
        display: block;
        width: calc(100% + 1.3px);
        height: 60px;
    }
    
    .curve-separator .shape-fill {
        fill: #FFFFFF;
    }
    
    .curve-reverse {
        transform: rotate(180deg) translateY(1px);
    }
    
    /* Responsive adjustments */
    @media (max-width: 768px) {
        .destination-item {
            padding: 60px 0;
        }
        
        .destination-content {
            padding: 0 15px;
            margin-bottom: 30px;
            text-align: center;
        }
        
        .destination-content h3 {
            font-size: 1.7rem;
        }
        
        .curve-separator {
            display: none;
        }
    }
</style>

    <!-- Features Section -->
    <section id="features">
        <div class="container">
            <h2 class="section-title">Why Travel With Us</h2>
            <p class="section-subtitle">We provide exceptional experiences that go beyond ordinary tourism.</p>
            
            <div class="row">
                <div class="col-md-4 text-center mb-5">
                    <div class="feature-icon">
                        <i class="fas fa-map-marked-alt"></i>
                    </div>
                    <h3 class="feature-title">Curated Itineraries</h3>
                    <p class="feature-text">Our travel experts design unique experiences that showcase the authentic beauty of each destination.</p>
                </div>
                
                <div class="col-md-4 text-center mb-5">
                    <div class="feature-icon">
                        <i class="fas fa-hands-helping"></i>
                    </div>
                    <h3 class="feature-title">Local Guides</h3>
                    <p class="feature-text">Connect with knowledgeable locals who provide insider perspectives and hidden gems.</p>
                </div>
                
                <div class="col-md-4 text-center mb-5">
                    <div class="feature-icon">
                        <i class="fas fa-leaf"></i>
                    </div>
                    <h3 class="feature-title">Sustainable Travel</h3>
                    <p class="feature-text">We prioritize eco-friendly practices and support local communities in all our destinations.</p>
                </div>
            </div>
        </div>
    </section>

    <!-- Testimonials Section -->
    <section id="testimonials" class="bg-light">
        <div class="container">
            <h2 class="section-title">Traveler Stories</h2>
            <p class="section-subtitle">Hear from those who have explored the world with us.</p>
            
            <div class="row">
                <div class="col-md-4">
                    <div class="testimonial-card">
                        <p class="testimonial-text">"Ang Baguio ay tunay na paraiso! Ang malamig na hangin at magagandang puno ay nagbigay sa amin ng perpektong bakasyon. Hindi kami makakalimutan ang karanasang ito."</p>
                        <div>
                            <p class="testimonial-author">Maria Santos</p>
                            <p class="testimonial-role">Baguio Traveler</p>
                        </div>
                    </div>
                </div>
                
                <div class="col-md-4">
                    <div class="testimonial-card">
                        <p class="testimonial-text">"Napakasaya ng karanasan sa Strawberry Farm! Ang pamimili ng sariwang strawberry mula sa sakahan ay isang natatanging karanasan na hindi namin makakalimutan."</p>
                        <div>
                            <p class="testimonial-author">Juan Dela Cruz</p>
                            <p class="testimonial-role">La Trinidad Traveler</p>
                        </div>
                    </div>
                </div>
                
                <div class="col-md-4">
                    <div class="testimonial-card">
                        <p class="testimonial-text">"Ang Mines View Park ay nag-aalok ng kahanga-hangang tanawin na hindi ko kailanman naranasan dati. Talagang sulit ang bawat oras na aming ginugol doon."</p>
                        <div>
                            <p class="testimonial-author">Rosa Garcia</p>
                            <p class="testimonial-role">Itogon Traveler</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Newsletter Section -->
    <section class="newsletter" id="contact">
        <div class="container text-center">
            <h2>Stay Inspired</h2>
            <p>Subscribe to our newsletter for travel tips, exclusive deals, and destination inspiration.</p>
            
            <div class="newsletter-form">
                <div class="input-group">
                    <input type="email" class="form-control" placeholder="Your email address">
                    <button class="btn btn-newsletter">Subscribe</button>
                </div>
            </div>
        </div>
    </section>

    <!-- Footer -->
    <footer>
        <div class="container">
            <div class="row">
                <div class="col-md-4 mb-4">
                    <h4 class="footer-heading">VOYAGE</h4>
                    <p style="color: #bdc3c7; font-size: 0.9rem;">Creating extraordinary travel experiences that connect you with the world's beauty and cultures.</p>
                    <div class="social-icons mt-4">
                        <a href="#"><i class="fab fa-facebook-f"></i></a>
                        <a href="#"><i class="fab fa-instagram"></i></a>
                        <a href="#"><i class="fab fa-twitter"></i></a>
                        <a href="#"><i class="fab fa-pinterest"></i></a>
                    </div>
                </div>
                
                <div class="col-md-2 mb-4">
                    <h4 class="footer-heading">Destinations</h4>
                    <a href="#" class="footer-link">Europe</a>
                    <a href="#" class="footer-link">Asia</a>
                    <a href="#" class="footer-link">Americas</a>
                    <a href="#" class="footer-link">Africa</a>
                    <a href="#" class="footer-link">Oceania</a>
                </div>
                
                <div class="col-md-2 mb-4">
                    <h4 class="footer-heading">Company</h4>
                    <a href="#" class="footer-link">About Us</a>
                    <a href="#" class="footer-link">Careers</a>
                    <a href="#" class="footer-link">Blog</a>
                    <a href="#" class="footer-link">Press</a>
                    <a href="#" class="footer-link">Contact</a>
                </div>
                
                <div class="col-md-2 mb-4">
                    <h4 class="footer-heading">Support</h4>
                    <a href="#" class="footer-link">FAQ</a>
                    <a href="#" class="footer-link">Booking Info</a>
                    <a href="#" class="footer-link">Terms & Conditions</a>
                    <a href="#" class="footer-link">Privacy Policy</a>
                </div>
                
                <div class="col-md-2 mb-4">
                    <h4 class="footer-heading">Contact</h4>
                    <p style="color: #bdc3c7; font-size: 0.9rem;">
                        <i class="fas fa-map-marker-alt me-2"></i> 123 Travel Street<br>
                        <span style="margin-left: 22px;">New York, NY 10001</span><br>
                        <i class="fas fa-phone me-2"></i> +1 (555) 123-4567<br>
                        <i class="fas fa-envelope me-2"></i> hello@voyage.com
                    </p>
                </div>
            </div>
            
            <div class="text-center copyright">
                <p>&copy; 2023 Voyage Travel. All rights reserved.</p>
            </div>
        </div>
    </footer>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        // Navbar scroll effect
        window.addEventListener('scroll', function() {
            const navbar = document.querySelector('.navbar');
            if (window.scrollY > 50) {
                navbar.classList.add('scrolled');
            } else {
                navbar.classList.remove('scrolled');
            }
        });
        
        // Smooth scrolling for navigation links
        document.querySelectorAll('a[href^="#"]').forEach(anchor => {
            anchor.addEventListener('click', function (e) {
                e.preventDefault();
                
                const targetId = this.getAttribute('href');
                if(targetId === '#') return;
                
                const targetElement = document.querySelector(targetId);
                if(targetElement) {
                    window.scrollTo({
                        top: targetElement.offsetTop - 80,
                        behavior: 'smooth'
                    });
                }
            });
        });
        
        // Simple animation for destination cards on scroll
        const observerOptions = {
            root: null,
            rootMargin: '0px',
            threshold: 0.1
        };
        
        const observer = new IntersectionObserver((entries) => {
            entries.forEach(entry => {
                if (entry.isIntersecting) {
                    entry.target.style.opacity = '1';
                    entry.target.style.transform = 'translateY(0)';
                }
            });
        }, observerOptions);
        
        document.querySelectorAll('.destination-card').forEach(card => {
            card.style.opacity = '0';
            card.style.transform = 'translateY(20px)';
            card.style.transition = 'opacity 0.5s ease, transform 0.5s ease';
            observer.observe(card);
        });
    </script>
</body>
</html>