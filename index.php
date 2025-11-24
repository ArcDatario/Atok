<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Voyage | Modern Travel Experiences</title>
    <link rel="stylesheet" href="https://unpkg.com/aos@2.3.1/dist/aos.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
<link rel="stylesheet" href="assets/css/style.css">
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
<!-- Hero Section -->
<section class="hero">
    <div class="container">
        <div class="hero-content">
            <h1>Ed-Atok</h1>
            <p>Explore breathtaking destinations and create unforgettable memories with our curated travel experiences.</p>
            <button class="btn btn-hero">Register</button>
        </div>
    </div>
</section>

<!-- Destinations Section -->
<section id="destinations" class="bg-light">
    <div class="container">
        <h2 class="section-title" data-aos="fade-up">Popular Destinations</h2>
        <p class="section-subtitle" data-aos="fade-up" data-aos-delay="100">Discover some of the most breathtaking spots in Atok, Benguet.</p>
        
        <!-- Destination 1 - Right Side -->
        <div class="destination-row">
            <div class="row align-items-center destination-item">
                <div class="col-md-6" data-aos="fade-right">
                    <div class="destination-content">
                        <h3>Northern Blossom Flower Farm</h3>
                        <p>A scenic flower farm in Atok, Benguet known for its vibrant rows of ornamental blooms, cool climate, and stunning views of nearby mountains. Perfect for photography and relaxation.</p>
                        <button class="btn btn-outline-primary">Explore Northern Blossom</button>
                    </div>
                </div>
                <div class="col-md-6" data-aos="fade-left" data-aos-delay="200">
                    <div class="destination-image">
                        <div class="image-carousel">
                            <div class="carousel-images">
                                <img src="destinations/northern-blossom.jpg" alt="Northern Blossom Flower Farm" class="carousel-image active">
                                <img src="destinations/mt-timbac.jpg" alt="Northern Blossom Flower Farm" class="carousel-image">
                                <img src="destinations/sakura.jpg" alt="Northern Blossom Flower Farm" class="carousel-image">
                            </div>
                            <button class="carousel-btn prev">
                                <i class="fas fa-chevron-left"></i>
                            </button>
                            <button class="carousel-btn next">
                                <i class="fas fa-chevron-right"></i>
                            </button>
                            <div class="carousel-indicators">
                                <button class="carousel-indicator active"></button>
                                <button class="carousel-indicator"></button>
                                <button class="carousel-indicator"></button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            
        </div>

        <!-- Destination 2 – Left Side -->
        <div class="destination-row">
            <div class="row align-items-center destination-item">
                <div class="col-md-6 order-md-2" data-aos="fade-left">
                    <div class="destination-content">
                        <h3>Sakura Park (Haight's Place / Paoay)</h3>
                        <p>A peaceful cherry blossom park in Atok where sakura trees bloom during the cold season. Visitors enjoy the cool air, serene atmosphere, and unique mountain scenery.</p>
                        <button class="btn btn-outline-primary">Visit Sakura Park</button>
                    </div>
                </div>
                <div class="col-md-6 order-md-1" data-aos="fade-right" data-aos-delay="200">
                    <div class="destination-image">
                        <div class="image-carousel">
                            <div class="carousel-images">
                                <img src="destinations/sakura.jpg" alt="Sakura Park Atok" class="carousel-image active">
                               <img src="destinations/mt-timbac.jpg" alt="Northern Blossom Flower Farm" class="carousel-image">
                                <img src="destinations/sakura.jpg" alt="Northern Blossom Flower Farm" class="carousel-image">
                            </div>
                            <button class="carousel-btn prev">
                                <i class="fas fa-chevron-left"></i>
                            </button>
                            <button class="carousel-btn next">
                                <i class="fas fa-chevron-right"></i>
                            </button>
                            <div class="carousel-indicators">
                                <button class="carousel-indicator active"></button>
                                <button class="carousel-indicator"></button>
                                <button class="carousel-indicator"></button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- Destination 3 - Right Side -->
        <div class="destination-row">
            <div class="row align-items-center destination-item">
                <div class="col-md-6" data-aos="fade-right">
                    <div class="destination-content">
                        <h3>Mt. Timbac / Mt. Timbak</h3>
                        <p>One of Benguet’s highest peaks offering an easy hike with beautiful panoramic mountain views and access to cultural sites like the Ibaloi mummy caves.</p>
                        <button class="btn btn-outline-primary">Explore Mt. Timbac</button>
                    </div>
                </div>
                <div class="col-md-6" data-aos="fade-left" data-aos-delay="200">
                    <div class="destination-image">
                        <div class="image-carousel">
                            <div class="carousel-images">
                                <img src="destinations/mt-timbac.jpg" alt="Mt. Timbac" class="carousel-image active">
                                <img src="destinations/mt-timbac.jpg" alt="Northern Blossom Flower Farm" class="carousel-image">
                                <img src="destinations/sakura.jpg" alt="Northern Blossom Flower Farm" class="carousel-image">
                            </div>
                            <button class="carousel-btn prev">
                                <i class="fas fa-chevron-left"></i>
                            </button>
                            <button class="carousel-btn next">
                                <i class="fas fa-chevron-right"></i>
                            </button>
                            <div class="carousel-indicators">
                                <button class="carousel-indicator active"></button>
                                <button class="carousel-indicator"></button>
                                <button class="carousel-indicator"></button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- Destination 4 – Left Side -->
        <div class="destination-row">
            <div class="row align-items-center destination-item">
                <div class="col-md-6 order-md-2" data-aos="fade-left">
                    <div class="destination-content">
                        <h3>2nd Highest Point (Halsema Highway)</h3>
                        <p>A famous viewpoint along Halsema Highway offering breathtaking views of the Cordilleras. One of the highest accessible spots by road in the Philippines.</p>
                        <button class="btn btn-outline-primary">View 2nd Highest Point</button>
                    </div>
                </div>
                <div class="col-md-6 order-md-1" data-aos="fade-right" data-aos-delay="200">
                    <div class="destination-image">
                        <div class="image-carousel">
                            <div class="carousel-images">
                                <img src="destinations/second-highest-point.jpg" alt="2nd Highest Point" class="carousel-image active">
                                <img src="destinations/mt-timbac.jpg" alt="Northern Blossom Flower Farm" class="carousel-image">
                                        <img src="destinations/sakura.jpg" alt="Northern Blossom Flower Farm" class="carousel-image">
                            </div>
                            <button class="carousel-btn prev">
                                <i class="fas fa-chevron-left"></i>
                            </button>
                            <button class="carousel-btn next">
                                <i class="fas fa-chevron-right"></i>
                            </button>
                            <div class="carousel-indicators">
                                <button class="carousel-indicator active"></button>
                                <button class="carousel-indicator"></button>
                                <button class="carousel-indicator"></button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div>
</section>


    
<!-- Features Section -->
<section id="features">
    <div class="container">
        <h2 class="section-title" data-aos="fade-up">Why Travel With Us</h2>
        <p class="section-subtitle" data-aos="fade-up" data-aos-delay="100">We provide exceptional experiences that go beyond ordinary tourism.</p>
        
        <div class="row">
            <div class="col-md-4 text-center mb-5" data-aos="fade-up" data-aos-delay="200">
                <div class="feature-icon">
                    <i class="fas fa-map-marked-alt"></i>
                </div>
                <h3 class="feature-title">Curated Itineraries</h3>
                <p class="feature-text">Our travel experts design unique experiences that showcase the authentic beauty of each destination.</p>
            </div>
            
            <div class="col-md-4 text-center mb-5" data-aos="fade-up" data-aos-delay="300">
                <div class="feature-icon">
                    <i class="fas fa-hands-helping"></i>
                </div>
                <h3 class="feature-title">Local Guides</h3>
                <p class="feature-text">Connect with knowledgeable locals who provide insider perspectives and hidden gems.</p>
            </div>
            
            <div class="col-md-4 text-center mb-5" data-aos="fade-up" data-aos-delay="400">
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
        <h2 class="section-title" data-aos="fade-up">Traveler Stories</h2>
        <p class="section-subtitle" data-aos="fade-up" data-aos-delay="100">Hear from those who have explored the world with us.</p>
        
        <div class="row">
            <div class="col-md-4" data-aos="fade-up" data-aos-delay="200">
                <div class="testimonial-card">
                    <p class="testimonial-text">"Ang Baguio ay tunay na paraiso! Ang malamig na hangin at magagandang puno ay nagbigay sa amin ng perpektong bakasyon. Hindi kami makakalimutan ang karanasang ito."</p>
                    <div>
                        <p class="testimonial-author">Maria Santos</p>
                        <p class="testimonial-role">Baguio Traveler</p>
                    </div>
                </div>
            </div>
            
            <div class="col-md-4" data-aos="fade-up" data-aos-delay="300">
                <div class="testimonial-card">
                    <p class="testimonial-text">"Napakasaya ng karanasan sa Strawberry Farm! Ang pamimili ng sariwang strawberry mula sa sakahan ay isang natatanging karanasan na hindi namin makakalimutan."</p>
                    <div>
                        <p class="testimonial-author">Juan Dela Cruz</p>
                        <p class="testimonial-role">La Trinidad Traveler</p>
                    </div>
                </div>
            </div>
            
            <div class="col-md-4" data-aos="fade-up" data-aos-delay="400">
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
        <h2 data-aos="fade-up">Stay Inspired</h2>
        <p data-aos="fade-up" data-aos-delay="100">Subscribe to our newsletter for travel tips, exclusive deals, and destination inspiration.</p>
        <div class="newsletter-form" data-aos="fade-up" data-aos-delay="200">
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
    <script src="assets/js/script.js"></script>
    <script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>
    <script src="assets/js/animation.js"></script>
</body>
</html>