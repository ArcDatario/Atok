<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Adventure - Dark Themed Travel</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@600;800&family=Open+Sans:wght@400;600&display=swap" rel="stylesheet">
    <style>
        :root {
            --bg: #0b1214;
            --panel: #0f1719;
            --muted-panel: #111719;
            --text: #E6F0E8;
            --muted: #A3A8A5;
            --accent: #B8C43E;
            --accent-muted: #97A033;
            --line: #26322f;
            --radius: 12px;
            --max-width: 1200px;
            --shadow: 0 8px 30px rgba(0,0,0,0.6);
        }

        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            background-color: var(--bg);
            color: var(--text);
            font-family: 'Open Sans', sans-serif;
            line-height: 1.5;
            overflow-x: hidden;
        }

        h1, h2, h3, h4, h5, h6 {
            font-family: 'Montserrat', sans-serif;
            font-weight: 800;
        }

        h1 {
            font-size: 72px;
            letter-spacing: 6px;
            text-transform: uppercase;
        }

        h2 {
            font-size: 28px;
        }

        h3 {
            font-size: 20px;
        }

        p {
            font-size: 16px;
        }

        small {
            font-size: 13px;
        }

        a {
            color: var(--accent);
            text-decoration: none;
            transition: color 0.3s ease;
        }

        a:hover {
            color: var(--accent-muted);
        }

        img {
            max-width: 100%;
            display: block;
        }

        .container {
            max-width: var(--max-width);
            margin: 0 auto;
            padding: 0 24px;
        }

        section {
            padding: 80px 0;
        }

        .btn {
            display: inline-block;
            padding: 12px 28px;
            border-radius: 50px;
            font-weight: 600;
            font-family: 'Montserrat', sans-serif;
            text-transform: uppercase;
            letter-spacing: 1px;
            font-size: 14px;
            cursor: pointer;
            transition: all 0.3s ease;
            border: none;
        }

        .btn-primary {
            background-color: var(--accent);
            color: var(--bg);
        }

        .btn-primary:hover {
            background-color: var(--accent-muted);
            color: var(--bg);
        }

        .btn-ghost {
            background-color: transparent;
            color: var(--text);
            border: 2px solid var(--text);
        }

        .btn-ghost:hover {
            background-color: rgba(255, 255, 255, 0.1);
        }

        .btn-pill {
            background-color: var(--accent);
            color: var(--bg);
            border-radius: 50px;
        }

        .btn-pill:hover {
            background-color: var(--accent-muted);
        }

        /* Navigation */
        .navbar {
            position: fixed;
            top: 18px;
            left: 50%;
            transform: translateX(-50%);
            width: 90%;
            max-width: var(--max-width);
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 16px 24px;
            background-color: transparent;
            border-radius: var(--radius);
            z-index: 1000;
            transition: all 0.3s ease;
        }

        .navbar.scrolled {
            background-color: rgba(11, 18, 20, 0.85);
            box-shadow: var(--shadow);
        }

        .logo {
    font-family: 'Montserrat', sans-serif;
    font-weight: 800;
    font-size: 24px;
    color: var(--text);
    /* REMOVED: background-color, width, height, border-radius, display, align-items, justify-content */
    /* REMOVED: color: var(--bg) */
}

        .nav-links {
            display: flex;
            list-style: none;
            gap: 32px;
        }

        .nav-links a {
            color: var(--text);
            font-weight: 600;
            position: relative;
        }

        .nav-links a.active {
            color: var(--accent);
        }

        .nav-links a.active::after {
            content: '';
            position: absolute;
            bottom: -5px;
            left: 0;
            width: 100%;
            height: 2px;
            background-color: var(--accent);
        }

        .mobile-menu-btn {
            display: none;
            background: none;
            border: none;
            color: var(--text);
            font-size: 24px;
            cursor: pointer;
        }

        /* Hero Section */
        .hero {
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            position: relative;
            overflow: hidden;
        }

        .hero-bg {
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background-image: linear-gradient(rgba(11,18,20,0.45), rgba(11,18,20,0.65)), url('https://images.unsplash.com/photo-1506905925346-21bda4d32df4?ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D&auto=format&fit=crop&w=2070&q=80');
            background-size: cover;
            background-position: center;
            background-attachment: fixed;
            z-index: -1;
            animation: kenBurns 14s infinite alternate;
        }

        @keyframes kenBurns {
            0% {
                transform: scale(1);
            }
            100% {
                transform: scale(1.06);
            }
        }

        .hero-content {
            text-align: center;
            max-width: 800px;
            padding: 0 24px;
        }

        .hero h1 {
            margin-bottom: 24px;
            color: #ffffff;
        }

        .hero p {
            font-size: 18px;
            margin-bottom: 40px;
            color: var(--muted);
        }

        .hero-cta {
            display: flex;
            gap: 16px;
            justify-content: center;
            margin-bottom: 60px;
        }

        .hero-stats {
            display: flex;
            justify-content: center;
            gap: 40px;
            flex-wrap: wrap;
        }

        .stat {
            text-align: center;
        }

        .stat-number {
            font-family: 'Montserrat', sans-serif;
            font-weight: 800;
            font-size: 24px;
            color: var(--accent);
            margin-bottom: 8px;
        }

        .stat-label {
            font-size: 14px;
            color: var(--muted);
        }

        /* Wonders Section */
        .section-header {
            text-align: center;
            margin-bottom: 60px;
        }

        .section-header h2 {
            margin-bottom: 16px;
        }

        .section-header p {
            color: var(--muted);
            max-width: 600px;
            margin: 0 auto;
        }

        .card-grid {
            display: grid;
            grid-template-columns: repeat(4, 1fr);
            gap: 24px;
        }

        .card {
            background-color: var(--panel);
            border-radius: var(--radius);
            overflow: hidden;
            box-shadow: var(--shadow);
            transition: all 0.3s ease;
            position: relative;
        }

        .card:hover {
            transform: translateY(-10px);
            box-shadow: 0 15px 40px rgba(0,0,0,0.7);
        }

        .card-image {
            height: 200px;
            background-image: url('https://images.unsplash.com/photo-1506905925346-21bda4d32df4?ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D&auto=format&fit=crop&w=2070&q=80');
            background-size: cover;
            background-position: center;
            position: relative;
        }

        .card-badge {
            position: absolute;
            top: 16px;
            right: 16px;
            background-color: var(--accent);
            color: var(--bg);
            padding: 4px 12px;
            border-radius: 50px;
            font-size: 12px;
            font-weight: 600;
        }

        .card-content {
            padding: 20px;
        }

        .card h3 {
            margin-bottom: 8px;
        }

        .card p {
            color: var(--muted);
            font-size: 14px;
        }

        /* Features Section */
        .features {
            background-color: transparent;
        }

        .features-grid {
            display: grid;
            grid-template-columns: repeat(3, 1fr);
            gap: 40px;
        }

        .feature {
            text-align: center;
            padding: 0 20px;
        }

        .feature-icon {
            width: 60px;
            height: 60px;
            background-color: var(--accent);
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            margin: 0 auto 20px;
            color: var(--bg);
            font-size: 24px;
        }

        .feature h3 {
            margin-bottom: 16px;
        }

        .feature p {
            color: var(--muted);
        }

        /* Split Section */
        .split-section {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 32px;
            align-items: center;
        }

        .image-collage {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 16px;
        }

        .collage-img {
            border-radius: var(--radius);
            overflow: hidden;
            height: 200px;
            background-image: url('https://images.unsplash.com/photo-1506905925346-21bda4d32df4?ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D&auto=format&fit=crop&w=2070&q=80');
            background-size: cover;
            background-position: center;
            transition: transform 0.3s ease;
        }

        .collage-img:hover {
            transform: scale(1.08);
        }

        .collage-img:nth-child(1) {
            grid-column: 1 / 3;
            height: 250px;
        }

        .split-content h2 {
            margin-bottom: 20px;
        }

        .split-content p {
            color: var(--muted);
            margin-bottom: 30px;
        }

        /* Interactive Map */
        .map-section {
            position: relative;
            padding: 80px 0;
        }

        .map-bg {
            height: 500px;
            background-image: url('https://images.unsplash.com/photo-1506905925346-21bda4d32df4?ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D&auto=format&fit=crop&w=2070&q=80');
            background-size: cover;
            background-position: center;
            border-radius: var(--radius);
            position: relative;
        }

        .hotspot {
            position: absolute;
            width: 14px;
            height: 14px;
            background-color: var(--accent);
            border-radius: 50%;
            cursor: pointer;
            animation: pulse 2s infinite;
        }

        @keyframes pulse {
            0% {
                box-shadow: 0 0 0 0 rgba(184, 196, 62, 0.7);
            }
            70% {
                box-shadow: 0 0 0 10px rgba(184, 196, 62, 0);
            }
            100% {
                box-shadow: 0 0 0 0 rgba(184, 196, 62, 0);
            }
        }

        .hotspot-label {
            position: absolute;
            background-color: rgba(15,23,25,0.85);
            padding: 8px 12px;
            border-radius: 8px;
            width: 200px;
            bottom: 30px;
            left: 50%;
            transform: translateX(-50%);
            opacity: 0;
            transition: opacity 0.3s ease;
            pointer-events: none;
        }

        .hotspot:hover .hotspot-label {
            opacity: 1;
        }

        .hotspot-1 {
            top: 42%;
            left: 22%;
        }

        .hotspot-2 {
            top: 55%;
            left: 66%;
        }

        /* CTA Section */
        .cta-section {
            text-align: center;
            background: linear-gradient(0deg, rgba(11,18,20,0.4), rgba(11,18,20,0.2));
            padding: 48px 0;
            border-radius: var(--radius);
        }

        .cta-section h2 {
            margin-bottom: 16px;
        }

        .cta-section p {
            color: var(--muted);
            margin-bottom: 30px;
            max-width: 600px;
            margin-left: auto;
            margin-right: auto;
        }

        .cta-buttons {
            display: flex;
            gap: 16px;
            justify-content: center;
        }

        /* Footer */
        .footer {
            background-color: var(--panel);
            padding: 60px 0 30px;
        }

        .footer-grid {
            display: grid;
            grid-template-columns: repeat(4, 1fr);
            gap: 40px;
            margin-bottom: 40px;
        }

        .footer-column h3 {
            margin-bottom: 20px;
            font-size: 18px;
        }

        .footer-links {
            list-style: none;
        }

        .footer-links li {
            margin-bottom: 12px;
        }

        .footer-links a {
            color: var(--muted);
            transition: color 0.3s ease;
        }

        .footer-links a:hover {
            color: var(--text);
        }

        .copyright {
            text-align: center;
            padding-top: 30px;
            border-top: 1px solid var(--line);
            color: var(--muted);
            font-size: 14px;
        }

        /* Responsive Styles */
        @media (max-width: 1024px) {
            .card-grid {
                grid-template-columns: repeat(2, 1fr);
            }
            
            .features-grid {
                grid-template-columns: 1fr;
                gap: 40px;
            }
            
            .split-section {
                grid-template-columns: 1fr;
                gap: 40px;
            }
            
            .footer-grid {
                grid-template-columns: repeat(2, 1fr);
            }
        }

        @media (max-width: 768px) {
            h1 {
                font-size: 48px;
                letter-spacing: 4px;
            }
            
            .hero {
                min-height: 80vh;
            }
            
            .hero-cta {
                flex-direction: column;
                align-items: center;
            }
            
            .nav-links {
                display: none;
            }
            
            .mobile-menu-btn {
                display: block;
            }
            
            .card-grid {
                grid-template-columns: 1fr;
            }
            
            .footer-grid {
                grid-template-columns: 1fr;
            }
            
            .cta-buttons {
                flex-direction: column;
                align-items: center;
            }
        }

        /* Scroll reveal animation */
        .reveal {
            opacity: 0;
            transform: translateY(30px);
            transition: all 0.6s ease;
        }

        .reveal.active {
            opacity: 1;
            transform: translateY(0);
        }
    </style>
</head>
<body>
    <!-- Navigation -->
    <nav class="navbar">
        <div class="logo">Atok</div>
        <ul class="nav-links">
            <li><a href="#hero" class="active">Adventure</a></li>
            <li><a href="#about">About</a></li>
            <li><a href="#shop">Shop</a></li>
            <li><a href="#book" class="btn btn-primary">Book Now</a></li>
        </ul>
        <button class="mobile-menu-btn">☰</button>
    </nav>

    <!-- Hero Section -->
    <section id="hero" class="hero">
        <div class="hero-bg"></div>
        <div class="hero-content">
            <h1>ADVENTURE</h1>
            <p>Create Your Outdoor Adventure — Discover With Us.</p>
            <div class="hero-cta">
                <a href="#explore" class="btn btn-primary">Explore Trips</a>
                <a href="#book" class="btn btn-ghost">Book Now</a>
            </div>
            <div class="hero-stats">
                <div class="stat">
                    <div class="stat-number">100+</div>
                    <div class="stat-label">routes</div>
                </div>
                <div class="stat">
                    <div class="stat-number">250k</div>
                    <div class="stat-label">happy travelers</div>
                </div>
                <div class="stat">
                    <div class="stat-number">24/7</div>
                    <div class="stat-label">support</div>
                </div>
            </div>
        </div>
    </section>

    <!-- Wonders Section -->
    <section id="wonders" class="container">
        <div class="section-header reveal">
            <h2>The Wonders Of Nature</h2>
            <p>We seek to provide the authentic comfort for traveler around the world</p>
        </div>
        <div class="card-grid">
            <div class="card reveal">
                <div class="card-image">
                    <div class="card-badge">Popular</div>
                </div>
                <div class="card-content">
                    <h3>Carved Hills</h3>
                    <p>1 or 2 night adventure</p>
                </div>
            </div>
            <div class="card reveal">
                <div class="card-image"></div>
                <div class="card-content">
                    <h3>Hidden Stream</h3>
                    <p>Guided hiking trail</p>
                </div>
            </div>
            <div class="card reveal">
                <div class="card-image">
                    <div class="card-badge">New</div>
                </div>
                <div class="card-content">
                    <h3>Giant Falls</h3>
                    <p>Perfect for photographers</p>
                </div>
            </div>
            <div class="card reveal">
                <div class="card-image"></div>
                <div class="card-content">
                    <h3>Red Mountain</h3>
                    <p>Express route</p>
                </div>
            </div>
        </div>
    </section>

    <!-- Features Section -->
    <section id="whyChoose" class="features container">
        <div class="section-header reveal">
            <h2>Reason For Choosing Us</h2>
        </div>
        <div class="features-grid">
            <div class="feature reveal">
                <div class="feature-icon">✓</div>
                <h3>Tried and Trusted</h3>
                <p>Years of guiding experience with excellent reviews.</p>
            </div>
            <div class="feature reveal">
                <div class="feature-icon">ⓘ</div>
                <h3>Reliable Support</h3>
                <p>24/7 support before and during your trip.</p>
            </div>
            <div class="feature reveal">
                <div class="feature-icon">↗</div>
                <h3>One-stop Travel Partner</h3>
                <p>From booking to guided tours — we handle it all.</p>
            </div>
        </div>
    </section>

    <!-- Split Section -->
    <section id="promoSplit" class="container">
        <div class="split-section">
            <div class="image-collage reveal">
                <div class="collage-img"></div>
                <div class="collage-img"></div>
                <div class="collage-img"></div>
                <div class="collage-img"></div>
            </div>
            <div class="split-content reveal">
                <h2>Here's what makes a vacation perfect for you!</h2>
                <p>Whether you're planning a family vacation with your pet, a relaxing weekend getaway, or an adventurous excursion — find packages ideal for trips of all types.</p>
                <a href="#book" class="btn btn-pill">Book Now</a>
            </div>
        </div>
    </section>

    <!-- Interactive Map -->
    <section id="explore" class="container">
        <div class="section-header reveal">
            <h2>Explore The Nature With Us</h2>
            <p>Interactive highlights and storytelling map</p>
        </div>
        <div class="map-bg reveal">
            <div class="hotspot hotspot-1">
                <div class="hotspot-label">
                    <h4>Family-friendly valley</h4>
                    <p>Plan a family trip with gentle trails.</p>
                </div>
            </div>
            <div class="hotspot hotspot-2">
                <div class="hotspot-label">
                    <h4>Waterfall lookout</h4>
                    <p>Best spot at sunrise for photographers.</p>
                </div>
            </div>
        </div>
    </section>

    <!-- CTA Section -->
    <section id="footerCta" class="container">
        <div class="cta-section reveal">
            <h2>Ready to create your outdoor adventure?</h2>
            <p>Book a trip, learn more, or contact our specialists.</p>
            <div class="cta-buttons">
                <a href="#contact" class="btn btn-ghost">Contact Us</a>
                <a href="#book" class="btn btn-primary">Start Booking</a>
            </div>
        </div>
    </section>

    <!-- Footer -->
    <footer class="footer">
        <div class="container">
            <div class="footer-grid">
                <div class="footer-column">
                    <h3>About</h3>
                    <ul class="footer-links">
                        <li><a href="#">Company</a></li>
                        <li><a href="#">Careers</a></li>
                    </ul>
                </div>
                <div class="footer-column">
                    <h3>Support</h3>
                    <ul class="footer-links">
                        <li><a href="#">FAQs</a></li>
                        <li><a href="#">Contact</a></li>
                    </ul>
                </div>
                <div class="footer-column">
                    <h3>Legal</h3>
                    <ul class="footer-links">
                        <li><a href="#">Privacy</a></li>
                        <li><a href="#">Terms</a></li>
                    </ul>
                </div>
                <div class="footer-column">
                    <h3>Newsletter</h3>
                    <p style="color: var(--muted); margin-bottom: 16px;">Subscribe for updates</p>
                    <form>
                        <input type="email" placeholder="Your email" style="background: var(--muted-panel); border: 1px solid var(--line); padding: 10px; border-radius: var(--radius); width: 100%; color: var(--text); margin-bottom: 10px;">
                        <button type="submit" class="btn btn-primary" style="width: 100%;">Subscribe</button>
                    </form>
                </div>
            </div>
            <div class="copyright">
                © 2025 Adventure Co. All rights reserved.
            </div>
        </div>
    </footer>

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

        // Parallax effect for hero
        window.addEventListener('scroll', function() {
            const scrolled = window.pageYOffset;
            const heroBg = document.querySelector('.hero-bg');
            heroBg.style.transform = `translateY(${scrolled * 0.2}px)`;
        });

        // Scroll reveal animation
        function revealOnScroll() {
            const reveals = document.querySelectorAll('.reveal');
            
            for (let i = 0; i < reveals.length; i++) {
                const windowHeight = window.innerHeight;
                const elementTop = reveals[i].getBoundingClientRect().top;
                const elementVisible = 150;
                
                if (elementTop < windowHeight - elementVisible) {
                    reveals[i].classList.add('active');
                }
            }
        }

        window.addEventListener('scroll', revealOnScroll);
        revealOnScroll(); // Initial check

        // Mobile menu toggle
        const mobileMenuBtn = document.querySelector('.mobile-menu-btn');
        const navLinks = document.querySelector('.nav-links');
        
        mobileMenuBtn.addEventListener('click', function() {
            navLinks.style.display = navLinks.style.display === 'flex' ? 'none' : 'flex';
        });

        // Update active nav link on scroll
        window.addEventListener('scroll', function() {
            const sections = document.querySelectorAll('section');
            const navLinks = document.querySelectorAll('.nav-links a');
            
            let current = '';
            
            sections.forEach(section => {
                const sectionTop = section.offsetTop;
                const sectionHeight = section.clientHeight;
                if (pageYOffset >= sectionTop - 100) {
                    current = section.getAttribute('id');
                }
            });
            
            navLinks.forEach(link => {
                link.classList.remove('active');
                if (link.getAttribute('href').substring(1) === current) {
                    link.classList.add('active');
                }
            });
        });
    </script>
</body>
</html>