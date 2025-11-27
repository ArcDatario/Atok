<div class="modal fade" id="registrationModal" tabindex="-1" aria-labelledby="registrationModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-sm">
        <div class="modal-content">
            <div class="modal-header border-0 pb-0">
                <h6 class="modal-title fw-bold" id="registrationModalLabel">Tourist Registration</h6>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body pt-0">
                <form id="registrationForm">
                    <div class="mb-3">
                        <label for="fullName" class="form-label small fw-medium">Full Name *</label>
                        <input type="text" class="form-control form-control-sm" id="fullName" required placeholder="Enter full name">
                    </div>
                    
                    <div class="mb-3">
                        <label for="contact" class="form-label small fw-medium">Contact Number *</label>
                        <div class="input-group input-group-sm">
                            <span class="input-group-text bg-light">+63</span>
                            <input type="tel" class="form-control" id="contact" required placeholder="9123456789" pattern="[0-9]{10}" maxlength="10">
                        </div>
                        <div class="form-text small">10-digit number without +63</div>
                    </div>
                    
                    <div class="mb-3">
                        <label for="email" class="form-label small fw-medium">Email Address *</label>
                        <input type="email" class="form-control form-control-sm" id="email" required placeholder="your@email.com">
                    </div>

                    <div class="mb-3">
                        <label for="pax" class="form-label small fw-medium">Number of Pax *</label>
                        <input type="number" class="form-control form-control-sm" id="pax" required min="1" max="20" value="1" placeholder="Number of persons">
                        <div class="form-text small">Number of people including yourself</div>
                    </div>
                    
                    <div class="mb-3">
                        <label for="visitDate" class="form-label small fw-medium">Visit Date *</label>
                        <input type="text" class="form-control form-control-sm flatpickr" id="visitDate" placeholder="Select date" readonly>
                    </div>
                    
                    <div class="mb-3">
                        <label class="form-label small fw-medium">Do you have a car?</label>
                        <div class="form-check">
                            <input class="form-check-input" type="radio" name="hasCar" id="hasCarYes" value="yes">
                            <label class="form-check-label small" for="hasCarYes">
                                Yes, I have a car
                            </label>
                        </div>
                        <div class="form-check">
                            <input class="form-check-input" type="radio" name="hasCar" id="hasCarNo" value="no" checked>
                            <label class="form-check-label small" for="hasCarNo">
                                No, I don't have a car
                            </label>
                        </div>
                    </div>
                    
                    <div id="parkingInfo" class="alert alert-info d-none small p-2">
                        <i class="fas fa-info-circle me-1"></i>
                        Car parking: ₱200/day additional charge
                    </div>
                </form>
            </div>
            <div class="modal-footer border-0 pt-0">
                <button type="button" class="btn btn-outline-secondary btn-sm" data-bs-dismiss="modal">Cancel</button>
                <button type="button" class="btn btn-primary btn-sm" id="submitRegistration">
                    <span class="submit-text">Submit</span>
                    <div class="spinner-border spinner-border-sm d-none" role="status">
                        <span class="visually-hidden">Loading...</span>
                    </div>
                </button>
            </div>
        </div>
    </div>
</div>