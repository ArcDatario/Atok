// Initialize AOS
    AOS.init({
        duration: 1000,
        once: true,
        offset: 100
    });

    // Initialize everything when page loads
    document.addEventListener('DOMContentLoaded', function() {
        // Initialize hero slider
        if (typeof initHeroSlider === 'function') {
            initHeroSlider();
        }
        
        // Initialize carousels
        if (typeof initCarousel === 'function') {
            document.querySelectorAll('.image-carousel').forEach(initCarousel);
        }
        
        // Create peaceful dove
        if (typeof createPeacefulDove === 'function') {
            createPeacefulDove();
        }
        
        // Initialize registration modal functionality
        initRegistrationModal();
    });

    // Registration Modal Functionality
    function initRegistrationModal() {
        let flatpickrInstance = null;
        
        // Initialize Flatpickr when modal is shown
        const registrationModal = document.getElementById('registrationModal');
        
        registrationModal.addEventListener('shown.bs.modal', function() {
            console.log('Modal shown - initializing Flatpickr');
            if (!flatpickrInstance) {
                flatpickrInstance = flatpickr("#visitDate", {
                    minDate: "today",
                    dateFormat: "M j, Y",
                    defaultDate: null,
                    placeholder: "Select your visit date",
                    theme: "light"
                });
                console.log('Flatpickr initialized');
            }
        });

        // Show/hide parking info based on car selection
        const carRadios = document.querySelectorAll('input[name="hasCar"]');
        const parkingInfo = document.getElementById('parkingInfo');
        
        carRadios.forEach(radio => {
            radio.addEventListener('change', function() {
                if (this.value === 'yes') {
                    parkingInfo.classList.remove('d-none');
                } else {
                    parkingInfo.classList.add('d-none');
                }
            });
        });

        // Form submission
        const submitBtn = document.getElementById('submitRegistration');
        const registrationForm = document.getElementById('registrationForm');
        
        submitBtn.addEventListener('click', function() {
            // Basic form validation
            const fullName = document.getElementById('fullName').value.trim();
            const contact = document.getElementById('contact').value.trim();
            const email = document.getElementById('email').value.trim();
            const visitDate = document.getElementById('visitDate').value;
            
            if (!fullName) {
                showToast('Please enter your full name.', 'error');
                return;
            }
            
            if (!contact || contact.length !== 10) {
                showToast('Please enter a valid 10-digit contact number.', 'error');
                return;
            }
            
            if (!email || !isValidEmail(email)) {
                showToast('Please enter a valid email address.', 'error');
                return;
            }
            
            if (!visitDate) {
                showToast('Please select your visit date.', 'error');
                return;
            }
            
            // Show loading state
            submitBtn.classList.add('loading');
            submitBtn.disabled = true;
            
            // Simulate API call/processing
            setTimeout(() => {
                // Reset form
                registrationForm.reset();
                if (flatpickrInstance) {
                    flatpickrInstance.clear();
                }
                parkingInfo.classList.add('d-none');
                
                // Hide modal
                const modal = bootstrap.Modal.getInstance(registrationModal);
                modal.hide();
                
                // Reset button state
                submitBtn.classList.remove('loading');
                submitBtn.disabled = false;
                
                // Show success toast
                showToast('Registration successful!', 'success');
            }, 2000);
        });
    }

    // Email validation function
    function isValidEmail(email) {
        const emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
        return emailRegex.test(email);
    }
