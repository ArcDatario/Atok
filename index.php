<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Voyage | Modern Travel Experiences</title>
    <link rel="stylesheet" href="https://unpkg.com/aos@2.3.1/dist/aos.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastify-js/1.12.0/toastify.min.css">
    <link rel="stylesheet" href="assets/css/style.css">
</head>
<body>
    <!-- Navigation -->
    <?php include "includes/navbar.php";?>

<!-- Hero Section -->
<section class="hero">
    <div class="container">
        <div class="hero-content">
            <h1>Ed-Atok</h1>
            <p>Explore breathtaking destinations and create unforgettable memories with our curated travel experiences.</p>
            <button class="btn btn-hero" data-bs-toggle="modal" data-bs-target="#registrationModal">Register</button>
        </div>
    </div>
</section>

<!-- Registration Modal -->
   <?php include "modal/registration-modal.php";?>

<!-- Destinations Section -->
   <?php include "includes/destinations.php";?>


    
<!-- Features Section -->
   <?php include "includes/features.php";?>


<!-- Testimonials Section -->
   <?php include "includes/testimonials.php";?>

<!-- Newsletter Section -->
   <?php include "includes/newsletter.php";?>

    <!-- Footer -->
   <?php include "includes/footer.php";?>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/flatpickr"></script>
    <script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/toastify-js/1.12.0/toastify.min.js"></script>
    
    <script src="assets/js/script.js"></script>
    <script src="assets/js/animation.js"></script>
    <script src="assets/js/toast.js"></script>
    <script src="assets/js/registration.js"></script>
   
</body>
</html>