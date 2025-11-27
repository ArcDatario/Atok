// Initialize everything when page loads
document.addEventListener('DOMContentLoaded', function() {
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

    // Show/hide parking info and vehicle section based on car selection
    const carRadios = document.querySelectorAll('input[name="hasCar"]');
    const parkingInfo = document.getElementById('parkingInfo');
    const vehicleSection = document.getElementById('vehicleSection');
    
    carRadios.forEach(radio => {
        radio.addEventListener('change', function() {
            if (this.value === 'yes') {
                parkingInfo.classList.remove('d-none');
                vehicleSection.classList.remove('d-none');
            } else {
                parkingInfo.classList.add('d-none');
                vehicleSection.classList.add('d-none');
            }
            updateFeeCalculation();
        });
    });

    // Update tour guide info and fees when pax changes
    const paxInput = document.getElementById('pax');
    const paxInfo = document.getElementById('paxInfo');
    
    paxInput.addEventListener('change', updateFeeCalculation);
    paxInput.addEventListener('input', updateFeeCalculation);

    // Update fees when vehicles change
    const numVehiclesInput = document.getElementById('numVehicles');
    if (numVehiclesInput) {
        numVehiclesInput.addEventListener('change', updateFeeCalculation);
        numVehiclesInput.addEventListener('input', updateFeeCalculation);
    }

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
        const numVehicles = hasCar === 'yes' ? document.getElementById('numVehicles').value : 0;
        
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

        if (!pax || pax < 1 || pax > 50) {
            showToast('Please enter a valid number of pax (1-50).', 'error');
            return;
        }
        
        if (!visitDate) {
            showToast('Please select your visit date.', 'error');
            return;
        }
        
        if (hasCar === 'yes' && (!numVehicles || numVehicles < 1 || numVehicles > 5)) {
            showToast('Please enter a valid number of vehicles (1-5).', 'error');
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
        if (hasCar === 'yes') {
            formData.append('numVehicles', numVehicles);
        }
        formData.append('action', 'register');
        
        console.log('Sending registration data:', {
            fullName, contact, email, pax, visitDate, hasCar, numVehicles
        });
        
        // AJAX submission
        fetch('registration_process.php', {
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
                vehicleSection.classList.add('d-none');
                document.getElementById('feeSummary').classList.add('d-none');
                document.getElementById('paxInfo').classList.add('d-none');
                
                // Hide modal
                const modal = bootstrap.Modal.getInstance(registrationModal);
                modal.hide();
                
                showToast('Registration successful! Reference: ' + data.reference, 'success');
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

function updateFeeCalculation() {
    const pax = parseInt(document.getElementById('pax').value) || 0;
    const hasCar = document.querySelector('input[name="hasCar"]:checked').value;
    const numVehicles = hasCar === 'yes' ? parseInt(document.getElementById('numVehicles').value) || 0 : 0;
    const paxInfo = document.getElementById('paxInfo');
    const feeSummary = document.getElementById('feeSummary');
    
    if (pax > 0) {
        // Calculate tour guides needed
        let guidesNeeded = 1;
        if (pax <= 10) guidesNeeded = 1;
        else if (pax <= 20) guidesNeeded = 2;
        else if (pax <= 30) guidesNeeded = 3;
        else if (pax <= 40) guidesNeeded = 4;
        else guidesNeeded = 5;
        
        // Update tour guide info
        document.getElementById('guidesInfo').textContent = 
            `This group will be assigned ${guidesNeeded} tour guide(s)`;
        paxInfo.classList.remove('d-none');
        
        // Calculate fees (using default values - actual values come from config)
        const tourguideFeePerPax = 50; // Default, should come from config
        const parkingFeePerVehicle = 200; // Default, should come from config
        
        const guideFee = pax * tourguideFeePerPax;
        const parkingFee = hasCar === 'yes' ? numVehicles * parkingFeePerVehicle : 0;
        const totalFee = guideFee + parkingFee;
        
        // Update fee summary
        document.getElementById('guideFeeText').textContent = 
            `Tour Guide Fee: ${pax} pax × ₱${tourguideFeePerPax} = ₱${guideFee}`;
        
        const parkingFeeText = document.getElementById('parkingFeeText');
        if (hasCar === 'yes') {
            parkingFeeText.textContent = 
                `Parking Fee: ${numVehicles} vehicle(s) × ₱${parkingFeePerVehicle} = ₱${parkingFee}`;
            parkingFeeText.classList.remove('d-none');
        } else {
            parkingFeeText.classList.add('d-none');
        }
        
        document.getElementById('totalFee').textContent = `₱${totalFee}`;
        feeSummary.classList.remove('d-none');
    } else {
        paxInfo.classList.add('d-none');
        feeSummary.classList.add('d-none');
    }
}

// Email validation function
function isValidEmail(email) {
    const emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
    return emailRegex.test(email);
}