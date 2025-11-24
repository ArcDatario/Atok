<div class="modal fade" id="registrationModal" tabindex="-1" aria-labelledby="registrationModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="registrationModalLabel">Tourist Registration</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form id="registrationForm">
                    <div class="mb-3">
                        <label for="fullName" class="form-label">Full Name *</label>
                        <input type="text" class="form-control" id="fullName" required placeholder="Enter your full name">
                    </div>
                    
                    <div class="mb-3">
                        <label for="contact" class="form-label">Contact Number *</label>
                        <div class="input-group">
                            <span class="input-group-text">+63</span>
                            <input type="tel" class="form-control" id="contact" required placeholder="9123456789" pattern="[0-9]{10}" maxlength="10">
                        </div>
                        <div class="form-text">Enter 10-digit number without +63</div>
                    </div>
                    
                    <div class="mb-3">
                        <label for="email" class="form-label">Email Address *</label>
                        <input type="email" class="form-control" id="email" required placeholder="your@email.com">
                    </div>
                    
                    <div class="mb-3">
                        <label for="visitDate" class="form-label">Visit Date *</label>
                        <input type="text" class="form-control flatpickr" id="visitDate" placeholder="Select date" readonly>
                    </div>
                    
                    <div class="mb-3">
                        <label class="form-label">Do you have a car?</label>
                        <div class="form-check">
                            <input class="form-check-input" type="radio" name="hasCar" id="hasCarYes" value="yes">
                            <label class="form-check-label" for="hasCarYes">
                                Yes, I have a car
                            </label>
                        </div>
                        <div class="form-check">
                            <input class="form-check-input" type="radio" name="hasCar" id="hasCarNo" value="no" checked>
                            <label class="form-check-label" for="hasCarNo">
                                No, I don't have a car
                            </label>
                        </div>
                    </div>
                    
                    <div id="parkingInfo" class="alert alert-info d-none">
                        <small>
                            <i class="fas fa-info-circle me-2"></i>
                            Car parking is available with an additional charge of ₱200 per day. 
                            This will be added to your total booking cost.
                        </small>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                <button type="button" class="btn btn-primary" id="submitRegistration">
                    <span class="submit-text">Submit Registration</span>
                    <div class="spinner-border spinner-border-sm d-none" role="status">
                        <span class="visually-hidden">Loading...</span>
                    </div>
                </button>
            </div>
        </div>
    </div>
</div>