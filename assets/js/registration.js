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
    const pax = document.getElementById('pax').value;
    const visitDate = document.getElementById('visitDate').value;
    const hasCar = document.querySelector('input[name="hasCar"]:checked').value;
    
    if (!fullName) {
        showToast('Please enter your full name.', 'error');
        return;
    }
    
    if (!contact || contact.length !== 10 || !/^\d+$/.test(contact)) {
        showToast('Please enter a valid 10-digit contact number.', 'error');
        return;
    }
    
    if (!email || !isValidEmail(email)) {
        showToast('Please enter a valid email address.', 'error');
        return;
    }

    if (!pax || pax < 1 || pax > 20) {
        showToast('Please enter a valid number of pax (1-20).', 'error');
        return;
    }
    
    if (!visitDate) {
        showToast('Please select your visit date.', 'error');
        return;
    }
    
    // Show loading state
    submitBtn.classList.add('loading');
    submitBtn.disabled = true;
    submitBtn.querySelector('.submit-text').textContent = 'Processing...';
    submitBtn.querySelector('.spinner-border').classList.remove('d-none');
    
    // Prepare form data
    const formData = new FormData();
    formData.append('fullName', fullName);
    formData.append('contact', contact);
    formData.append('email', email);
    formData.append('pax', pax);
    formData.append('visitDate', visitDate);
    formData.append('hasCar', hasCar);
    formData.append('action', 'register');
    
    console.log('Sending registration data:', {
        fullName, contact, email, pax, visitDate, hasCar
    });
    
    // AJAX submission
    fetch('registration_process', {
        method: 'POST',
        body: formData
    })
    .then(response => {
        console.log('Response status:', response.status);
        if (!response.ok) {
            throw new Error(`HTTP error! status: ${response.status}`);
        }
        return response.json();
    })
    .then(data => {
        console.log('Response data:', data);
        if (data.success) {
            // Reset form
            registrationForm.reset();
            if (flatpickrInstance) {
                flatpickrInstance.clear();
            }
            parkingInfo.classList.add('d-none');
            
            // Hide modal
            const modal = bootstrap.Modal.getInstance(registrationModal);
            modal.hide();
            
            
           // In the fetch response, change the success toast to:
            showToast('Registration successful!', 'success');
        } else {
            showToast(data.message || 'Registration failed. Please try again.', 'error');
        }
    })
    .catch(error => {
        console.error('Error:', error);
        showToast('Network error: ' + error.message, 'error');
    })
    .finally(() => {
        // Reset button state
        submitBtn.classList.remove('loading');
        submitBtn.disabled = false;
        submitBtn.querySelector('.submit-text').textContent = 'Submit';
        submitBtn.querySelector('.spinner-border').classList.add('d-none');
    });
});
}

// Email validation function
function isValidEmail(email) {
    const emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
    return emailRegex.test(email);
}