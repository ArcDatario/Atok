// Initialize AOS
    AOS.init({
        duration: 1000,
        once: true,
        offset: 100
    });


        // Destination carousel functionality
document.addEventListener('DOMContentLoaded', function() {
    // Initialize all carousels
    document.querySelectorAll('.image-carousel').forEach(initCarousel);
});

function initCarousel(carousel) {
    const images = carousel.querySelectorAll('.carousel-image');
    const prevBtn = carousel.querySelector('.carousel-btn.prev');
    const nextBtn = carousel.querySelector('.carousel-btn.next');
    const indicators = carousel.querySelectorAll('.carousel-indicator');
    
    let currentIndex = 0;
    
    function showImage(index) {
        // Hide all images
        images.forEach(img => img.classList.remove('active'));
        indicators.forEach(indicator => indicator.classList.remove('active'));
        
        // Show current image
        images[index].classList.add('active');
        indicators[index].classList.add('active');
        
        currentIndex = index;
    }
    
    function nextImage() {
        let nextIndex = (currentIndex + 1) % images.length;
        showImage(nextIndex);
    }
    
    function prevImage() {
        let prevIndex = (currentIndex - 1 + images.length) % images.length;
        showImage(prevIndex);
    }
    
    // Event listeners
    if (nextBtn) nextBtn.addEventListener('click', nextImage);
    if (prevBtn) prevBtn.addEventListener('click', prevImage);
    
    // Indicator clicks
    indicators.forEach((indicator, index) => {
        indicator.addEventListener('click', () => showImage(index));
    });
    
    // Show first image
    showImage(0);
}