<?php
// registrations.php - Main Page (Frontend Only)
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0">
    <title>Ed-Atok | Admin - Registrations</title>
    <link rel="shortcut icon" href="../icon/pin.png" type="image/x-icon">
    <link rel="stylesheet" href="assets/css/bootstrap.min.css">
    <link rel="stylesheet" href="assets/plugins/fontawesome/css/fontawesome.min.css">
    <link rel="stylesheet" href="assets/plugins/fontawesome/css/all.min.css">
    <link rel="stylesheet" href="assets/css/feathericon.min.css">
    <link rel="stylesheet" href="assets/css/style.css">
    <style>
        /* Remove the existing status-badge styles and replace with: */
.status-badge {
    font-weight: 600;
    background: none !important;
    padding: 0.25em 0.4em;
}
        .status-badge:hover {
            opacity: 0.8;
        }
        .table-responsive {
            max-height: 600px;
        }
        .action-buttons .btn {
            margin: 2px;
        }
        .multiselect-container {
        max-height: 200px;
        overflow-y: auto;
        border-radius: 8px;
        padding: 12px;
        background: #fff;
        border: 1px solid #e0e0e0;
    }
    
    .form-check {
        padding: 10px 15px;
        margin: 6px 0;
        border-radius: 6px;
        transition: all 0.3s ease;
        border: 1px solid #f0f0f0;
        background: #fafafa;
        display: flex;
        align-items: center;
        justify-content: space-between;
    }
    
    .form-check:hover {
        background: #f0f7ff;
        border-color: #007bff;
        transform: translateY(-1px);
        box-shadow: 0 2px 4px rgba(0,0,0,0.1);
    }
    
    .form-check-input {
        margin-left: 10px;
        order: 2; /* Move to right side */
    }
    
    .form-check-label {
        display: flex;
        align-items: center;
        margin-bottom: 0;
        font-size: 0.9rem;
        line-height: 1.4;
        order: 1; /* Keep label on left */
        flex: 1;
    }
    
    /* Custom checkbox design */
    .form-check-input {
        width: 18px;
        height: 18px;
        border: 2px solid #ccc;
        border-radius: 4px;
        cursor: pointer;
        position: relative;
        appearance: none;
        -webkit-appearance: none;
        background: white;
        transition: all 0.2s ease;
    }
    
    .form-check-input:checked {
        background: #007bff;
        border-color: #007bff;
    }
    
    .form-check-input:checked::before {
        content: '✓';
        position: absolute;
        color: white;
        font-size: 12px;
        font-weight: bold;
        top: 50%;
        left: 50%;
        transform: translate(-50%, -50%);
    }
    
    .form-check-input:focus {
        outline: none;
        box-shadow: 0 0 0 3px rgba(0, 123, 255, 0.25);
        border-color: #007bff;
    }
    
    .form-check-input:hover {
        border-color: #007bff;
    }
    
    /* Selected state */
    .form-check-input:checked ~ .form-check-label {
        color: #007bff;
        font-weight: 500;
    }
    
    /* Better spacing in modals */
    .modal-body {
        padding: 20px;
    }
    
    .modal-md {
        max-width: 500px;
    }
    
    /* Guide info styling */
    .guide-info {
        display: flex;
        flex-direction: column;
    }
    
    .guide-name {
        font-weight: 600;
        color: #333;
        margin-bottom: 2px;
    }
    
    .guide-count {
        font-size: 0.8rem;
        color: #666;
    }
    
    /* Parking slot styling */
    .parking-slot {
        font-weight: 500;
        color: #333;
    }
        .loading-spinner {
            text-align: center;
            padding: 20px;
        }
        .detail-section {
            margin-bottom: 15px;
            padding: 12px;
            background: #f8f9fa;
            border-radius: 5px;
        }
        .detail-label {
            font-weight: 600;
            color: #495057;
            margin-bottom: 3px;
            font-size: 0.9rem;
        }
        .detail-value {
            color: #212529;
            font-size: 0.95rem;
        }
        .assignment-card {
            border: 1px solid #dee2e6;
            border-radius: 5px;
            padding: 12px;
            margin-bottom: 12px;
            background: white;
        }
        .edit-icon {
            cursor: pointer;
            color: #007bff;
            margin-left: 8px;
            font-size: 0.9rem;
        }
        .edit-icon:hover {
            color: #0056b3;
        }
        .search-box {
            max-width: 300px;
        }
        .total-display {
            font-weight: bold;
            color: #28a745;
        }
		/* Toast Notifications */
.toast-container {
    position: fixed;
    top: 20px;
    right: 20px;
    z-index: 9999;
    min-width: 300px;
}

.toast {
    background: white;
    border-radius: 8px;
    box-shadow: 0 4px 12px rgba(0,0,0,0.15);
    border-left: 4px solid #007bff;
    margin-bottom: 10px;
}

.toast-success {
    border-left-color: #28a745;
}

.toast-error {
    border-left-color: #dc3545;
}

.toast-warning {
    border-left-color: #ffc107;
}

.toast-info {
    border-left-color: #17a2b8;
}
    </style>
</head>

<body>
    <div class="main-wrapper">
        <!-- header -->
        <?php include 'includes/header.php'; ?>

        <!-- sidebar -->
        <?php include 'includes/sidebar.php'; ?>

        <div class="page-wrapper">
            <div class="content container-fluid">
                <div class="page-header">
                    <div class="row">
                        <div class="col-sm-12 mt-5">
                            <h3 class="page-title mt-3">Tourist Registrations</h3>
                            <ul class="breadcrumb">
                                <li class="breadcrumb-item"><a href="dashboard.php">Dashboard</a></li>
                                <li class="breadcrumb-item active">Registrations</li>
                            </ul>
                        </div>
                    </div>
                </div>
                
                <div class="row">
                    <div class="col-md-12">
                        <div class="card card-table">
                            <div class="card-header">
    <h4 class="card-title float-left mt-2">All Registrations</h4>
    <div class="float-right d-flex">
        <div class="input-group search-box mr-2">
            <input type="text" class="form-control" placeholder="Search..." id="searchInput">
        </div>
        <button class="btn btn-primary" onclick="loadRegistrations()">
            <i class="fas fa-sync-alt"></i>
        </button>
    </div>
</div>

<!-- Add this after the card-header and before card-body -->
<div class="card-header bg-light">
    <ul class="nav nav-tabs card-header-tabs">
        <li class="nav-item">
            <a class="nav-link active" href="#pending" data-toggle="tab" onclick="filterByStatus('pending')">
                <i class="fas fa-clock"></i> Pending
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="#approved" data-toggle="tab" onclick="filterByStatus('approved')">
                <i class="fas fa-check"></i> Approved
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="#ongoing" data-toggle="tab" onclick="filterByStatus('ongoing')">
                <i class="fas fa-play"></i> On Going
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="#completed" data-toggle="tab" onclick="filterByStatus('completed')">
                <i class="fas fa-flag-checkered"></i> Completed
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="#cancelled" data-toggle="tab" onclick="filterByStatus('cancelled')">
                <i class="fas fa-times"></i> Cancelled
            </a>
        </li>
    </ul>
</div>

                            <div class="card-body">
                                <div class="table-responsive">
                                    <table class="table table-hover table-center mb-0" id="registrationsTable">
                                        <thead>
                                            <tr>
                                                <th>Reference</th>
                                                <th>Name</th>
                                                <th>Visit Date</th>
                                                <th>Pax</th>
                                                <th>Vehicles</th>
                                                <th>Total</th>
                                                <th>Status</th>
                                                <th class="text-right">Actions</th>
                                            </tr>
                                        </thead>
                                        <tbody id="registrationsTableBody">
                                            <tr>
                                                <td colspan="8" class="text-center">
                                                    <div class="loading-spinner">
                                                        <i class="fas fa-spinner fa-spin fa-2x"></i>
                                                        <p>Loading registrations...</p>
                                                    </div>
                                                </td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    
    <!-- View Registration Modal -->
    <div class="modal fade" id="viewRegistrationModal" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog modal-md" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Registration Details</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body" id="registrationDetailsBody">
                    <div class="loading-spinner">
                        <i class="fas fa-spinner fa-spin fa-2x"></i>
                        <p>Loading details...</p>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-success" id="approveBtn" onclick="approveRegistration()">
                        <i class="fas fa-check"></i> Approve
                    </button>
                </div>
            </div>
        </div>
    </div>
    
    <!-- Edit Registration Modal -->
    <div class="modal fade" id="editRegistrationModal" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog modal-md" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Edit Registration</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div id="editAlert"></div>
                    <input type="hidden" id="editRegistrationId">
                    <div class="form-group">
                        <label>Number of Pax</label>
                        <input type="number" class="form-control" id="editPax" min="1" max="50">
                    </div>
                    <div class="form-group">
                        <label>Number of Vehicles</label>
                        <input type="number" class="form-control" id="editNumVehicles" min="0" max="5">
                    </div>
                    <div class="form-group">
                        <label>Total Fee</label>
                        <div class="total-display" id="editTotalDisplay">₱0.00</div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                    <button type="button" class="btn btn-primary" id="saveRegistrationBtn">
                        <i class="fas fa-save"></i> Save Changes
                    </button>
                </div>
            </div>
        </div>
    </div>
    
    <!-- Edit Tour Guides Modal -->
    <div class="modal fade" id="editTourGuidesModal" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog modal-md" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Edit Tour Guides</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div id="tourguidesAlert"></div>
                    <input type="hidden" id="tgRegistrationId">
                    <input type="hidden" id="tgVisitDate">
                    <div class="form-group">
                        <label>Available Tour Guides</label>
                        <div id="availableTourGuides" class="multiselect-container border p-2">
                            <div class="loading-spinner">
                                <i class="fas fa-spinner fa-spin"></i> Loading...
                            </div>
                        </div>
                        <small class="form-text text-muted" id="guidesNeededText"></small>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                    <button type="button" class="btn btn-primary" id="saveTourGuidesBtn">
                        <i class="fas fa-save"></i> Save Changes
                    </button>
                </div>
            </div>
        </div>
    </div>
    
    <!-- Edit Parking Modal -->
    <div class="modal fade" id="editParkingModal" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog modal-md" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Edit Parking Assignment</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div id="parkingAlert"></div>
                    <input type="hidden" id="pRegistrationId">
                    <input type="hidden" id="pVisitDate">
                    <div class="form-group">
                        <label>Available Parking Slots</label>
                        <div id="availableParking" class="multiselect-container border p-2">
                            <div class="loading-spinner">
                                <i class="fas fa-spinner fa-spin"></i> Loading...
                            </div>
                        </div>
                        <small class="form-text text-muted" id="vehiclesNeededText"></small>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                    <button type="button" class="btn btn-primary" id="saveParkingBtn">
                        <i class="fas fa-save"></i> Save Changes
                    </button>
                </div>
            </div>
        </div>
    </div>
    
    <script src="assets/js/jquery-3.5.1.min.js"></script>
    <script src="assets/js/popper.min.js"></script>
    <script src="assets/js/bootstrap.min.js"></script>
    <script src="assets/plugins/slimscroll/jquery.slimscroll.min.js"></script>
    <script src="assets/js/script.js"></script>
    
    <script>
    let currentRegistrationId = null;
let searchTimeout = null;
let currentStatusFilter = 'pending'; 

function filterByStatus(status) {
    currentStatusFilter = status;
    
    // Update active tab visually
    $('.nav-tabs .nav-link').removeClass('active');
    $(`.nav-tabs .nav-link[href="#${status}"]`).addClass('active');
    
    loadRegistrations($('#searchInput').val());
}

$(document).ready(function() {

	 $('.nav-tabs .nav-link[href="#pending"]').addClass('active');
    // Load registrations on page load
    loadRegistrations();
    
    // Real-time search on input
    $('#searchInput').on('input', function() {
        clearTimeout(searchTimeout);
        const searchTerm = $(this).val();
        
        // Add delay to prevent too many requests (300ms delay)
        searchTimeout = setTimeout(function() {
            loadRegistrations(searchTerm);
        }, 300);
    });
    
    // Calculate total when pax or vehicles change
    $('#editPax, #editNumVehicles').on('input', function() {
        calculateTotal();
    });
});

// Search registrations
function searchRegistrations() {
    const searchTerm = $('#searchInput').val();
    loadRegistrations(searchTerm);
}

// Load all registrations
function loadRegistrations(search = '') {
    // Show loading state
    $('#registrationsTableBody').html(`
        <tr>
            <td colspan="8" class="text-center">
                <div class="loading-spinner">
                    <i class="fas fa-spinner fa-spin fa-2x"></i>
                    <p>${search ? 'Searching...' : 'Loading registrations...'}</p>
                </div>
            </td>
        </tr>
    `);
    
    $.ajax({
        url: 'registration_ajax.php',
        type: 'POST',
        data: { 
            action: 'get_all_registrations',
            search: search,
            status: currentStatusFilter
        },
        dataType: 'json',
        success: function(response) {
            if (response.success) {
                displayRegistrations(response.data, search);
            } else {
                showToast('error', response.message);
                $('#registrationsTableBody').html(`
                    <tr>
                        <td colspan="8" class="text-center text-danger">
                            <i class="fas fa-exclamation-circle"></i> ${response.message}
                        </td>
                    </tr>
                `);
            }
        },
        error: function() {
            showToast('error', 'Error loading registrations');
            $('#registrationsTableBody').html(`
                <tr>
                    <td colspan="8" class="text-center text-danger">
                        <i class="fas fa-exclamation-triangle"></i> Error loading registrations
                    </td>
                </tr>
            `);
        }
    });
}

// Display registrations in table
function displayRegistrations(registrations, searchTerm = '') {
    let html = '';
    
    if (registrations.length === 0) {
        if (searchTerm) {
            html = `
                <tr>
                    <td colspan="8" class="text-center">
                        <i class="fas fa-search"></i> No registrations found for "<strong>${searchTerm}</strong>"
                    </td>
                </tr>
            `;
        } else {
            html = `
                <tr>
                    <td colspan="8" class="text-center">
                        <i class="fas fa-inbox"></i> No registrations found
                    </td>
                </tr>
            `;
        }
    } else {
        registrations.forEach(function(reg) {
            const statusClass = getStatusClass(reg.status);
            const statusText = reg.status.charAt(0).toUpperCase() + reg.status.slice(1);
            
            // Highlight search term in results
            let displayName = reg.full_name;
            let displayReference = reg.reference;
            
            if (searchTerm) {
                const regex = new RegExp(`(${escapeRegExp(searchTerm)})`, 'gi');
                displayName = displayName.replace(regex, '<mark>$1</mark>');
                displayReference = displayReference.replace(regex, '<mark>$1</mark>');
            }
            
            html += `
                <tr>
                    <td>${displayReference}</td>
                    <td>${displayName}</td>
                    <td>${reg.visit_date}</td>
                    <td>${reg.pax}</td>
                    <td>${reg.num_vehicles}</td>
                    <td>₱${parseFloat(reg.total).toLocaleString()}</td>
                    <td>
                        <span class="badge badge-pill ${statusClass} status-badge">
                            ${statusText}
                        </span>
                    </td>
                    <td class="text-right">
                        <button class="btn btn-sm btn-info" onclick="viewRegistration(${reg.id})">
                            <i class="fas fa-eye"></i> View
                        </button>
                        <button class="btn btn-sm btn-warning" onclick="editRegistration(${reg.id})">
                            <i class="fas fa-edit"></i> Edit
                        </button>
                    </td>
                </tr>
            `;
        });
    }
    
    $('#registrationsTableBody').html(html);
}

// Helper function to escape special characters for regex
function escapeRegExp(string) {
    return string.replace(/[.*+?^${}()|[\]\\]/g, '\\$&');
}

// View registration details
function viewRegistration(registrationId) {
    currentRegistrationId = registrationId;
    $('#viewRegistrationModal').modal('show');
    $('#registrationDetailsBody').html(`
        <div class="loading-spinner">
            <i class="fas fa-spinner fa-spin fa-2x"></i>
            <p>Loading details...</p>
        </div>
    `);
    
    $.ajax({
        url: 'registration_ajax.php',
        type: 'POST',
        data: {
            action: 'get_registration_details',
            registration_id: registrationId
        },
        dataType: 'json',
        success: function(response) {
            if (response.success) {
                displayRegistrationDetails(response.data);
            } else {
                $('#registrationDetailsBody').html(`
                    <div class="text-center text-danger py-4">
                        <i class="fas fa-exclamation-circle fa-2x mb-2"></i>
                        <p>${response.message}</p>
                    </div>
                `);
                showToast('error', response.message);
            }
        },
        error: function() {
            $('#registrationDetailsBody').html(`
                <div class="text-center text-danger py-4">
                    <i class="fas fa-exclamation-triangle fa-2x mb-2"></i>
                    <p>Error loading registration details</p>
                </div>
            `);
            showToast('error', 'Error loading registration details');
        }
    });
}

// Display registration details in modal
function displayRegistrationDetails(reg) {
    const statusClass = getStatusClass(reg.status);
    const statusText = reg.status.charAt(0).toUpperCase() + reg.status.slice(1);
    
    // Show/hide approve button based on current status
    if (reg.status === 'approved') {
        $('#approveBtn').hide();
    } else {
        $('#approveBtn').show();
    }
    
    const html = `
        <div class="row">
            <div class="col-md-6">
                <div class="detail-section">
                    <h6 class="mb-2"><i class="fas fa-user"></i> Personal Information</h6>
                    <div class="detail-label">Reference:</div>
                    <div class="detail-value mb-1">${reg.reference}</div>
                    
                    <div class="detail-label">Full Name:</div>
                    <div class="detail-value mb-1">${reg.full_name}</div>
                    
                    <div class="detail-label">Contact Number:</div>
                    <div class="detail-value mb-1">${reg.contact_number}</div>
                    
                    <div class="detail-label">Email:</div>
                    <div class="detail-value mb-1">${reg.email}</div>
                </div>
            </div>
            
            <div class="col-md-6">
                <div class="detail-section">
                    <h6 class="mb-2"><i class="fas fa-calendar-alt"></i> Visit Details</h6>
                    <div class="detail-label">Visit Date:</div>
                    <div class="detail-value mb-1">${reg.visit_date}</div>
                    
                    <div class="detail-label">Number of Pax:</div>
                    <div class="detail-value mb-1">${reg.pax}</div>
                    
                    <div class="detail-label">Has Vehicle:</div>
                    <div class="detail-value mb-1">${reg.car === 'yes' ? 'Yes' : 'No'}</div>
                    
                    <div class="detail-label">Number of Vehicles:</div>
                    <div class="detail-value mb-1">${reg.num_vehicles}</div>
                    
                    <div class="detail-label">Total Fee:</div>
                    <div class="detail-value mb-1 total-display">₱${parseFloat(reg.total).toLocaleString()}</div>
                </div>
            </div>
        </div>
        
        <div class="row mt-2">
            <div class="col-md-12">
                <div class="assignment-card">
                    <h6 class="mb-1">
                        <i class="fas fa-users"></i> Assigned Tour Guides
                        <i class="fas fa-edit edit-icon" onclick="editTourGuides(${reg.id}, '${reg.visit_date}')" title="Edit tour guides"></i>
                    </h6>
                    <div class="mt-1">
                        ${reg.tourguide_names ? 
                            reg.tourguide_names.split(',').map(name => `<span class="badge badge-info mr-1 mb-1">${name}</span>`).join('') : 
                            '<span class="text-muted">Not assigned</span>'}
                    </div>
                </div>
            </div>
        </div>
        
        <div class="row">
            <div class="col-md-12">
                <div class="assignment-card">
                    <h6 class="mb-1">
                        <i class="fas fa-parking"></i> Assigned Parking
                        <i class="fas fa-edit edit-icon" onclick="editParking(${reg.id}, '${reg.visit_date}')" title="Edit parking"></i>
                    </h6>
                    <div class="mt-1">
                        ${reg.parking_names ? 
                            reg.parking_names.split(',').map(name => `<span class="badge badge-secondary mr-1 mb-1">${name}</span>`).join('') : 
                            '<span class="text-muted">Not assigned</span>'}
                    </div>
                </div>
            </div>
        </div>
        
        <div class="row">
            <div class="col-md-12">
                <div class="detail-section">
                    <h6 class="mb-1"><i class="fas fa-info-circle"></i> Status</h6>
                    <span class="badge badge-pill ${statusClass}">
                        ${statusText}
                    </span>
                </div>
            </div>
        </div>
    `;
    
    $('#registrationDetailsBody').html(html);
}

// Edit registration details
function editRegistration(registrationId) {
    currentRegistrationId = registrationId;
    $('#editRegistrationModal').modal('show');
    
    // Load current registration details
    $.ajax({
        url: 'registration_ajax.php',
        type: 'POST',
        data: {
            action: 'get_registration_details',
            registration_id: registrationId
        },
        dataType: 'json',
        success: function(response) {
            if (response.success) {
                const reg = response.data;
                $('#editRegistrationId').val(reg.id);
                $('#editPax').val(reg.pax);
                $('#editNumVehicles').val(reg.num_vehicles);
                $('#editTotalDisplay').text('₱' + parseFloat(reg.total).toLocaleString());
            } else {
                showToast('error', response.message);
                $('#editRegistrationModal').modal('hide');
            }
        },
        error: function() {
            showToast('error', 'Error loading registration details');
            $('#editRegistrationModal').modal('hide');
        }
    });
}

// Calculate total based on pax and vehicles
function calculateTotal() {
    const pax = parseInt($('#editPax').val()) || 0;
    const numVehicles = parseInt($('#editNumVehicles').val()) || 0;
    
    // Calculate total based on pricing logic (same as in registration_process.php)
    const tourguideFeePerPax = 50; // Default value
    const parkingFee = 200; // Default value
    
    let total = pax * tourguideFeePerPax;
    if (numVehicles > 0) {
        total += numVehicles * parkingFee;
    }
    
    $('#editTotalDisplay').text('₱' + total.toLocaleString());
}

// Save registration changes
$('#saveRegistrationBtn').click(function() {
    const registrationId = $('#editRegistrationId').val();
    const pax = $('#editPax').val();
    const numVehicles = $('#editNumVehicles').val();
    
    if (pax < 1 || pax > 50) {
        showToast('error', 'Please enter a valid number of pax (1-50)');
        return;
    }
    
    if (numVehicles < 0 || numVehicles > 5) {
        showToast('error', 'Please enter a valid number of vehicles (0-5)');
        return;
    }
    
    $(this).prop('disabled', true).html('<i class="fas fa-spinner fa-spin"></i> Saving...');
    
    $.ajax({
        url: 'registration_ajax.php',
        type: 'POST',
        data: {
            action: 'update_registration',
            registration_id: registrationId,
            pax: pax,
            num_vehicles: numVehicles
        },
        dataType: 'json',
        success: function(response) {
            if (response.success) {
                showToast('success', response.message);
                
                setTimeout(function() {
                    $('#editRegistrationModal').modal('hide');
                    loadRegistrations();
                    if ($('#viewRegistrationModal').is(':visible')) {
                        viewRegistration(registrationId);
                    }
                }, 1000);
            } else {
                showToast('error', response.message);
            }
            $('#saveRegistrationBtn').prop('disabled', false).html('<i class="fas fa-save"></i> Save Changes');
        },
        error: function() {
            showToast('error', 'Error updating registration');
            $('#saveRegistrationBtn').prop('disabled', false).html('<i class="fas fa-save"></i> Save Changes');
        }
    });
});

// Approve registration
function approveRegistration() {
    if (!currentRegistrationId) return;
    
    if (confirm('Are you sure you want to approve this registration?')) {
        $.ajax({
            url: 'registration_ajax.php',
            type: 'POST',
            data: {
                action: 'update_status',
                registration_id: currentRegistrationId,
                status: 'approved'
            },
            dataType: 'json',
            success: function(response) {
                if (response.success) {
                    $('#viewRegistrationModal').modal('hide');
                    loadRegistrations();
                    showToast('success', 'Registration approved successfully!');
                } else {
                    showToast('error', response.message);
                }
            },
            error: function() {
                showToast('error', 'Error approving registration');
            }
        });
    }
}

// Edit tour guides
function editTourGuides(registrationId, visitDate) {
    $('#tgRegistrationId').val(registrationId);
    $('#tgVisitDate').val(visitDate);
    $('#editTourGuidesModal').modal('show');
    
    $.ajax({
        url: 'registration_ajax.php',
        type: 'POST',
        data: {
            action: 'get_available_tourguides',
            registration_id: registrationId,
            visit_date: visitDate
        },
        dataType: 'json',
        success: function(response) {
            if (response.success) {
                displayTourGuides(response.tourguides, response.current_guides, response.guides_needed, response.pax);
            } else {
                $('#availableTourGuides').html(`
                    <div class="text-center text-danger py-3">
                        <i class="fas fa-exclamation-circle"></i> ${response.message}
                    </div>
                `);
                showToast('error', response.message);
            }
        },
        error: function() {
            $('#availableTourGuides').html(`
                <div class="text-center text-danger py-3">
                    <i class="fas fa-exclamation-triangle"></i> Error loading tour guides
                </div>
            `);
            showToast('error', 'Error loading tour guides');
        }
    });
}

// Update displayTourGuides function
function displayTourGuides(tourguides, currentGuides, guidesNeeded, pax) {
    let html = '';
    
    if (tourguides.length === 0) {
        html = '<div class="alert alert-warning mb-0">No available tour guides for this date</div>';
    } else {
        tourguides.forEach(function(guide) {
            const isChecked = currentGuides.includes(guide.id.toString()) ? 'checked' : '';
            html += `
                <div class="form-check">
                    <input class="form-check-input tourguide-checkbox" 
                           type="checkbox" 
                           value="${guide.id}" 
                           ${isChecked}
                           id="tg-${guide.id}">
                    <label class="form-check-label" for="tg-${guide.id}">
                        <div class="guide-info">
                            <span class="guide-name">${guide.full_name}</span>
                            <span class="guide-count">${guide.current_count} assignments today</span>
                        </div>
                    </label>
                </div>
            `;
        });
    }
    
    $('#availableTourGuides').html(html);
    $('#guidesNeededText').html(`
        <i class="fas fa-info-circle"></i> This group needs <strong>${guides_needed}</strong> tour guide(s) based on <strong>${pax}</strong> pax
    `);
}

// Save tour guides
$('#saveTourGuidesBtn').click(function() {
    const registrationId = $('#tgRegistrationId').val();
    const selectedGuides = [];
    
    $('.tourguide-checkbox:checked').each(function() {
        selectedGuides.push($(this).val());
    });
    
    $(this).prop('disabled', true).html('<i class="fas fa-spinner fa-spin"></i> Saving...');
    
    $.ajax({
        url: 'registration_ajax.php',
        type: 'POST',
        data: {
            action: 'update_tourguides',
            registration_id: registrationId,
            tourguide_ids: selectedGuides
        },
        dataType: 'json',
        success: function(response) {
            if (response.success) {
                showToast('success', response.message);
                
                setTimeout(function() {
                    $('#editTourGuidesModal').modal('hide');
                    viewRegistration(registrationId);
                    loadRegistrations();
                }, 1000);
            } else {
                showToast('error', response.message);
            }
            $('#saveTourGuidesBtn').prop('disabled', false).html('<i class="fas fa-save"></i> Save Changes');
        },
        error: function() {
            showToast('error', 'Error updating tour guides');
            $('#saveTourGuidesBtn').prop('disabled', false).html('<i class="fas fa-save"></i> Save Changes');
        }
    });
});

// Edit parking
function editParking(registrationId, visitDate) {
    $('#pRegistrationId').val(registrationId);
    $('#pVisitDate').val(visitDate);
    $('#editParkingModal').modal('show');
    
    $.ajax({
        url: 'registration_ajax.php',
        type: 'POST',
        data: {
            action: 'get_available_parking',
            registration_id: registrationId,
            visit_date: visitDate
        },
        dataType: 'json',
        success: function(response) {
            if (response.success) {
                displayParking(response.parking, response.current_parking, response.num_vehicles);
            } else {
                $('#availableParking').html(`
                    <div class="text-center text-danger py-3">
                        <i class="fas fa-exclamation-circle"></i> ${response.message}
                    </div>
                `);
                showToast('error', response.message);
            }
        },
        error: function() {
            $('#availableParking').html(`
                <div class="text-center text-danger py-3">
                    <i class="fas fa-exclamation-triangle"></i> Error loading parking
                </div>
            `);
            showToast('error', 'Error loading parking');
        }
    });
}

// Display parking checkboxes
function displayParking(parking, currentParking, numVehicles) {
    let html = '';
    
    if (parking.length === 0) {
        html = '<div class="alert alert-warning mb-0">No available parking slots for this date</div>';
    } else {
        parking.forEach(function(slot) {
            const isChecked = currentParking.includes(slot.id.toString()) ? 'checked' : '';
            html += `
                <div class="form-check">
                    <input class="form-check-input parking-checkbox" 
                           type="checkbox" 
                           value="${slot.id}" 
                           ${isChecked}
                           id="p-${slot.id}">
                    <label class="form-check-label" for="p-${slot.id}">
                        ${slot.parking_name}
                    </label>
                </div>
            `;
        });
    }
    
    $('#availableParking').html(html);
    $('#vehiclesNeededText').html(`
        <i class="fas fa-info-circle"></i> This registration has <strong>${numVehicles}</strong> vehicle(s) - select <strong>${numVehicles}</strong> parking slot(s)
    `);
}

// Save parking
$('#saveParkingBtn').click(function() {
    const registrationId = $('#pRegistrationId').val();
    const selectedParking = [];
    
    $('.parking-checkbox:checked').each(function() {
        selectedParking.push($(this).val());
    });
    
    $(this).prop('disabled', true).html('<i class="fas fa-spinner fa-spin"></i> Saving...');
    
    $.ajax({
        url: 'registration_ajax.php',
        type: 'POST',
        data: {
            action: 'update_parking',
            registration_id: registrationId,
            parking_ids: selectedParking
        },
        dataType: 'json',
        success: function(response) {
            if (response.success) {
                showToast('success', response.message);
                
                setTimeout(function() {
                    $('#editParkingModal').modal('hide');
                    viewRegistration(registrationId);
                    loadRegistrations();
                }, 1000);
            } else {
                showToast('error', response.message);
            }
            $('#saveParkingBtn').prop('disabled', false).html('<i class="fas fa-save"></i> Save Changes');
        },
        error: function() {
            showToast('error', 'Error updating parking');
            $('#saveParkingBtn').prop('disabled', false).html('<i class="fas fa-save"></i> Save Changes');
        }
    });
});

// Helper function to get status text color class
function getStatusClass(status) {
    switch(status) {
        case 'approved': return 'text-success';
        case 'ongoing': return 'text-primary';
        case 'completed': return 'text-info';
        case 'cancelled': return 'text-danger';
        default: return 'text-warning'; // pending
    }
}

// Toast notification function
function showToast(type, message, title = '') {
    const icons = {
        success: 'fas fa-check-circle text-success',
        error: 'fas fa-exclamation-circle text-danger',
        warning: 'fas fa-exclamation-triangle text-warning',
        info: 'fas fa-info-circle text-info'
    };
    
    const toastId = 'toast-' + Date.now();
    const toastHtml = `
        <div id="${toastId}" class="toast toast-${type}" role="alert" aria-live="assertive" aria-atomic="true" data-delay="5000">
            <div class="toast-header">
                <i class="${icons[type]} mr-2"></i>
                <strong class="mr-auto">${title || type.charAt(0).toUpperCase() + type.slice(1)}</strong>
                <button type="button" class="ml-2 mb-1 close" data-dismiss="toast" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="toast-body">
                ${message}
            </div>
        </div>
    `;
    
    // Create toast container if it doesn't exist
    if ($('#toast-container').length === 0) {
        $('body').append('<div id="toast-container" class="toast-container"></div>');
    }
    
    $('#toast-container').append(toastHtml);
    $(`#${toastId}`).toast('show');
    
    // Remove toast after it's hidden
    $(`#${toastId}`).on('hidden.bs.toast', function () {
        $(this).remove();
    });
}
    </script>
</body>
</html>