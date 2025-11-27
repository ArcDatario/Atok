<?php
// parking.php - Parking Management Page
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0">
    <title>Ed-Atok | Admin - Parking</title>
    <link rel="shortcut icon" href="../icon/pin.png" type="image/x-icon">
    <link rel="stylesheet" href="assets/css/bootstrap.min.css">
    <link rel="stylesheet" href="assets/plugins/fontawesome/css/fontawesome.min.css">
    <link rel="stylesheet" href="assets/plugins/fontawesome/css/all.min.css">
    <link rel="stylesheet" href="assets/css/feathericon.min.css">
    <link rel="stylesheet" href="assets/css/style.css">
    <style>
        .table-responsive {
            max-height: 600px;
        }
        .action-buttons .btn {
            margin: 2px;
        }
        .loading-spinner {
            text-align: center;
            padding: 20px;
        }
        .search-box {
            max-width: 300px;
        }
        .status-badge {
            font-weight: 600;
        }
        .status-available {
            color: #28a745;
        }
        .status-maintenance {
            color: #dc3545;
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
                            <h3 class="page-title mt-3">Parking Management</h3>
                            <ul class="breadcrumb">
                                <li class="breadcrumb-item"><a href="dashboard.php">Dashboard</a></li>
                                <li class="breadcrumb-item active">Parking</li>
                            </ul>
                        </div>
                    </div>
                </div>
                
                <div class="row">
                    <div class="col-md-12">
                        <div class="card card-table">
                            <div class="card-header">
                                <h4 class="card-title float-left mt-2">All Parking Slots</h4>
                                <div class="float-right d-flex">
                                    <div class="input-group search-box mr-2">
                                        <input type="text" class="form-control" placeholder="Search parking slots..." id="searchInput">
                                    </div>
                                    <button class="btn btn-primary" onclick="loadParking()">
                                        <i class="fas fa-sync-alt"></i>
                                    </button>
                                    <button class="btn btn-success ml-2" onclick="showAddModal()">
                                        <i class="fas fa-plus"></i>
                                    </button>
                                </div>
                            </div>

                            <div class="card-body">
                                <div class="table-responsive">
                                    <table class="table table-hover table-center mb-0" id="parkingTable">
                                        <thead>
                                            <tr>
                                                <th>#</th>
                                                <th>Parking Name</th>
                                                <th>Status</th>
                                                <th class="text-right">Actions</th>
                                            </tr>
                                        </thead>
                                        <tbody id="parkingTableBody">
                                            <tr>
                                                <td colspan="4" class="text-center">
                                                    <div class="loading-spinner">
                                                        <i class="fas fa-spinner fa-spin fa-2x"></i>
                                                        <p>Loading parking slots...</p>
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
    
    <!-- Add/Edit Parking Modal -->
    <div class="modal fade" id="parkingModal" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog modal-md" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="modalTitle">Add Parking Slot</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div id="modalAlert"></div>
                    <input type="hidden" id="parkingId">
                    <div class="form-group">
                        <label>Parking Name *</label>
                        <input type="text" class="form-control" id="parkingName" placeholder="Enter parking name (e.g., Parking Slot A-1)">
                    </div>
                    <div class="form-group">
                        <label>Status</label>
                        <select class="form-control" id="status">
                            <option value="available">Available</option>
                            <option value="maintenance">Maintenance</option>
                        </select>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                    <button type="button" class="btn btn-primary" id="saveParkingBtn">
                        <i class="fas fa-save"></i> Save Parking Slot
                    </button>
                </div>
            </div>
        </div>
    </div>
    
    <!-- Delete Confirmation Modal -->
    <div class="modal fade" id="deleteModal" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog modal-sm" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Confirm Delete</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <p>Are you sure you want to delete this parking slot?</p>
                    <p class="text-danger"><strong>This action cannot be undone.</strong></p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                    <button type="button" class="btn btn-danger" id="confirmDeleteBtn">
                        <i class="fas fa-trash"></i> Delete
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
    let currentParkingId = null;
    let searchTimeout = null;

    $(document).ready(function() {
        // Load parking slots on page load
        loadParking();
        
        // Real-time search on input
        $('#searchInput').on('input', function() {
            clearTimeout(searchTimeout);
            const searchTerm = $(this).val();
            
            // Add delay to prevent too many requests (300ms delay)
            searchTimeout = setTimeout(function() {
                loadParking(searchTerm);
            }, 300);
        });
        
        // Save parking button click
        $('#saveParkingBtn').click(function() {
            saveParking();
        });
        
        // Confirm delete button click
        $('#confirmDeleteBtn').click(function() {
            deleteParking();
        });
    });

    // Load all parking slots
    function loadParking(search = '') {
        // Show loading state
        $('#parkingTableBody').html(`
            <tr>
                <td colspan="4" class="text-center">
                    <div class="loading-spinner">
                        <i class="fas fa-spinner fa-spin fa-2x"></i>
                        <p>${search ? 'Searching...' : 'Loading parking slots...'}</p>
                    </div>
                </td>
            </tr>
        `);
        
        $.ajax({
            url: 'parking_ajax.php',
            type: 'POST',
            data: { 
                action: 'get_all_parking',
                search: search
            },
            dataType: 'json',
            success: function(response) {
                if (response.success) {
                    displayParking(response.data, search);
                } else {
                    showToast('error', response.message);
                    $('#parkingTableBody').html(`
                        <tr>
                            <td colspan="4" class="text-center text-danger">
                                <i class="fas fa-exclamation-circle"></i> ${response.message}
                            </td>
                        </tr>
                    `);
                }
            },
            error: function() {
                showToast('error', 'Error loading parking slots');
                $('#parkingTableBody').html(`
                    <tr>
                        <td colspan="4" class="text-center text-danger">
                            <i class="fas fa-exclamation-triangle"></i> Error loading parking slots
                        </td>
                    </tr>
                `);
            }
        });
    }

    // Display parking slots in table
    function displayParking(parkingSlots, searchTerm = '') {
        let html = '';
        
        if (parkingSlots.length === 0) {
            if (searchTerm) {
                html = `
                    <tr>
                        <td colspan="4" class="text-center">
                            <i class="fas fa-search"></i> No parking slots found for "<strong>${searchTerm}</strong>"
                        </td>
                    </tr>
                `;
            } else {
                html = `
                    <tr>
                        <td colspan="4" class="text-center">
                            <i class="fas fa-inbox"></i> No parking slots found
                        </td>
                    </tr>
                `;
            }
        } else {
            parkingSlots.forEach(function(slot, index) {
                const statusClass = slot.status === 'available' ? 'status-available' : 'status-maintenance';
                const statusText = slot.status.charAt(0).toUpperCase() + slot.status.slice(1);
                
                // Highlight search term in results
                let displayName = slot.parking_name;
                
                if (searchTerm) {
                    const regex = new RegExp(`(${escapeRegExp(searchTerm)})`, 'gi');
                    displayName = displayName.replace(regex, '<mark>$1</mark>');
                }
                
                html += `
                    <tr>
                        <td>${index + 1}</td>
                        <td>${displayName}</td>
                        <td>
                            <span class="badge badge-pill ${statusClass} status-badge">
                                ${statusText}
                            </span>
                        </td>
                        <td class="text-right">
                            <button class="btn btn-sm btn-warning" onclick="editParking(${slot.id})">
                                <i class="fas fa-edit"></i> Edit
                            </button>
                            <button class="btn btn-sm btn-danger" onclick="confirmDelete(${slot.id}, '${slot.parking_name.replace(/'/g, "\\'")}')">
                                <i class="fas fa-trash"></i> Delete
                            </button>
                        </td>
                    </tr>
                `;
            });
        }
        
        $('#parkingTableBody').html(html);
    }

    // Helper function to escape special characters for regex
    function escapeRegExp(string) {
        return string.replace(/[.*+?^${}()|[\]\\]/g, '\\$&');
    }

    // Show add modal
    function showAddModal() {
        currentParkingId = null;
        $('#modalTitle').text('Add Parking Slot');
        $('#parkingId').val('');
        $('#parkingName').val('');
        $('#status').val('available');
        $('#modalAlert').html('');
        $('#parkingModal').modal('show');
    }

    // Edit parking slot
    function editParking(parkingId) {
        currentParkingId = parkingId;
        $('#modalTitle').text('Edit Parking Slot');
        $('#modalAlert').html('');
        $('#parkingModal').modal('show');
        
        // Load parking slot details
        $.ajax({
            url: 'parking_ajax.php',
            type: 'POST',
            data: {
                action: 'get_parking_details',
                parking_id: parkingId
            },
            dataType: 'json',
            success: function(response) {
                if (response.success) {
                    const slot = response.data;
                    $('#parkingId').val(slot.id);
                    $('#parkingName').val(slot.parking_name);
                    $('#status').val(slot.status);
                } else {
                    $('#modalAlert').html(`
                        <div class="alert alert-danger">
                            <i class="fas fa-exclamation-circle"></i> ${response.message}
                        </div>
                    `);
                }
            },
            error: function() {
                $('#modalAlert').html(`
                    <div class="alert alert-danger">
                        <i class="fas fa-exclamation-triangle"></i> Error loading parking slot details
                    </div>
                `);
            }
        });
    }

    // Save parking slot
// Save parking slot - UPDATED VERSION
function saveParking() {
    const parkingId = $('#parkingId').val();
    const parkingName = $('#parkingName').val().trim();
    const status = $('#status').val();

    // Validation
    if (!parkingName) {
        $('#modalAlert').html(`
            <div class="alert alert-danger">
                <i class="fas fa-exclamation-circle"></i> Please enter parking name
            </div>
        `);
        return;
    }

    if (parkingName.length < 2) {
        $('#modalAlert').html(`
            <div class="alert alert-danger">
                <i class="fas fa-exclamation-circle"></i> Parking name must be at least 2 characters long
            </div>
        `);
        return;
    }

    $('#saveParkingBtn').prop('disabled', true).html('<i class="fas fa-spinner fa-spin"></i> Saving...');

    $.ajax({
        url: 'parking_ajax.php',
        type: 'POST',
        data: {
            action: parkingId ? 'update_parking' : 'add_parking',
            parking_id: parkingId,
            parking_name: parkingName,
            status: status
        },
        dataType: 'json',
        success: function(response) {
            if (response.success) {
                $('#parkingModal').modal('hide');
                loadParking();
                showToast('success', response.message);
            } else {
                $('#modalAlert').html(`
                    <div class="alert alert-danger alert-dismissible fade show">
                        <i class="fas fa-exclamation-circle"></i> ${response.message}
                        <button type="button" class="close" data-dismiss="alert">&times;</button>
                    </div>
                `);
            }
            $('#saveParkingBtn').prop('disabled', false).html('<i class="fas fa-save"></i> Save Parking Slot');
        },
        error: function() {
            $('#modalAlert').html(`
                <div class="alert alert-danger">
                    <i class="fas fa-exclamation-triangle"></i> Error saving parking slot
                </div>
            `);
            $('#saveParkingBtn').prop('disabled', false).html('<i class="fas fa-save"></i> Save Parking Slot');
        }
    });
}

    // Confirm delete
    function confirmDelete(parkingId, parkingName) {
        currentParkingId = parkingId;
        $('#deleteModal .modal-body p:first').html(
            `Are you sure you want to delete the parking slot "<strong>${parkingName}</strong>"?`
        );
        $('#deleteModal').modal('show');
    }

    // Delete parking slot
    function deleteParking() {
        if (!currentParkingId) return;

        $('#confirmDeleteBtn').prop('disabled', true).html('<i class="fas fa-spinner fa-spin"></i> Deleting...');

        $.ajax({
            url: 'parking_ajax.php',
            type: 'POST',
            data: {
                action: 'delete_parking',
                parking_id: currentParkingId
            },
            dataType: 'json',
            success: function(response) {
                if (response.success) {
                    $('#deleteModal').modal('hide');
                    loadParking();
                    showToast('success', response.message);
                } else {
                    showToast('error', response.message);
                }
                $('#confirmDeleteBtn').prop('disabled', false).html('<i class="fas fa-trash"></i> Delete');
            },
            error: function() {
                showToast('error', 'Error deleting parking slot');
                $('#confirmDeleteBtn').prop('disabled', false).html('<i class="fas fa-trash"></i> Delete');
            }
        });
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