<?php
// tourguide.php - Tour Guide Management Page
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0">
    <title>Ed-Atok | Admin - Tour Guides</title>
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
        .status-active {
            color: #28a745;
        }
        .status-inactive {
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
                            <h3 class="page-title mt-3">Tour Guide Management</h3>
                            <ul class="breadcrumb">
                                <li class="breadcrumb-item"><a href="dashboard.php">Dashboard</a></li>
                                <li class="breadcrumb-item active">Tour Guides</li>
                            </ul>
                        </div>
                    </div>
                </div>
                
                <div class="row">
                    <div class="col-md-12">
                        <div class="card card-table">
                            <div class="card-header">
                                <h4 class="card-title float-left mt-2">All Tour Guides</h4>
                                <div class="float-right d-flex">
                                    <div class="input-group search-box mr-2">
                                        <input type="text" class="form-control" placeholder="Search tour guides..." id="searchInput">
                                    </div>
                                    <button class="btn btn-primary" onclick="loadTourGuides()">
                                        <i class="fas fa-sync-alt"></i>
                                    </button>
                                    <button class="btn btn-success ml-2" onclick="showAddModal()">
                                        <i class="fas fa-plus"></i>
                                    </button>
                                </div>
                            </div>

                            <div class="card-body">
                                <div class="table-responsive">
                                    <table class="table table-hover table-center mb-0" id="tourguidesTable">
                                        <thead>
    <tr>
        <th>#</th>
        <th>Full Name</th>
        <th>Status</th>
        <th class="text-right">Actions</th>
    </tr>
</thead>
                                        <tbody id="tourguidesTableBody">
                                            <tr>
                                                <td colspan="5" class="text-center">
                                                    <div class="loading-spinner">
                                                        <i class="fas fa-spinner fa-spin fa-2x"></i>
                                                        <p>Loading tour guides...</p>
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
    
    <!-- Add/Edit Tour Guide Modal -->
    <div class="modal fade" id="tourguideModal" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog modal-md" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="modalTitle">Add Tour Guide</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div id="modalAlert"></div>
                    <input type="hidden" id="tourguideId">
                    <div class="form-group">
                        <label>Full Name *</label>
                        <input type="text" class="form-control" id="fullName" placeholder="Enter full name">
                    </div>
                    <div class="form-group">
                        <label>Status</label>
                        <select class="form-control" id="status">
                            <option value="active">Active</option>
                            <option value="inactive">Inactive</option>
                        </select>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                    <button type="button" class="btn btn-primary" id="saveTourGuideBtn">
                        <i class="fas fa-save"></i> Save Tour Guide
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
                    <p>Are you sure you want to delete this tour guide?</p>
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
    let currentTourGuideId = null;
    let searchTimeout = null;

    $(document).ready(function() {
        // Load tour guides on page load
        loadTourGuides();
        
        // Real-time search on input
        $('#searchInput').on('input', function() {
            clearTimeout(searchTimeout);
            const searchTerm = $(this).val();
            
            // Add delay to prevent too many requests (300ms delay)
            searchTimeout = setTimeout(function() {
                loadTourGuides(searchTerm);
            }, 300);
        });
        
        // Save tour guide button click
        $('#saveTourGuideBtn').click(function() {
            saveTourGuide();
        });
        
        // Confirm delete button click
        $('#confirmDeleteBtn').click(function() {
            deleteTourGuide();
        });
    });

    // Load all tour guides
    function loadTourGuides(search = '') {
        // Show loading state
        $('#tourguidesTableBody').html(`
            <tr>
                <td colspan="5" class="text-center">
                    <div class="loading-spinner">
                        <i class="fas fa-spinner fa-spin fa-2x"></i>
                        <p>${search ? 'Searching...' : 'Loading tour guides...'}</p>
                    </div>
                </td>
            </tr>
        `);
        
        $.ajax({
            url: 'tourguide_ajax.php',
            type: 'POST',
            data: { 
                action: 'get_all_tourguides',
                search: search
            },
            dataType: 'json',
            success: function(response) {
                if (response.success) {
                    displayTourGuides(response.data, search);
                } else {
                    showToast('error', response.message);
                    $('#tourguidesTableBody').html(`
                        <tr>
                            <td colspan="5" class="text-center text-danger">
                                <i class="fas fa-exclamation-circle"></i> ${response.message}
                            </td>
                        </tr>
                    `);
                }
            },
            error: function() {
                showToast('error', 'Error loading tour guides');
                $('#tourguidesTableBody').html(`
                    <tr>
                        <td colspan="5" class="text-center text-danger">
                            <i class="fas fa-exclamation-triangle"></i> Error loading tour guides
                        </td>
                    </tr>
                `);
            }
        });
    }

    // Display tour guides in table
// Update the displayTourGuides function - remove the createdDate line
function displayTourGuides(tourguides, searchTerm = '') {
    let html = '';
    
    if (tourguides.length === 0) {
        if (searchTerm) {
            html = `
                <tr>
                    <td colspan="4" class="text-center">
                        <i class="fas fa-search"></i> No tour guides found for "<strong>${searchTerm}</strong>"
                    </td>
                </tr>
            `;
        } else {
            html = `
                <tr>
                    <td colspan="4" class="text-center">
                        <i class="fas fa-inbox"></i> No tour guides found
                    </td>
                </tr>
            `;
        }
    } else {
        tourguides.forEach(function(guide, index) {
            const statusClass = guide.status === 'active' ? 'status-active' : 'status-inactive';
            const statusText = guide.status.charAt(0).toUpperCase() + guide.status.slice(1);
            
            // Highlight search term in results
            let displayName = guide.full_name;
            
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
                        <button class="btn btn-sm btn-warning" onclick="editTourGuide(${guide.id})">
                            <i class="fas fa-edit"></i> Edit
                        </button>
                        <button class="btn btn-sm btn-danger" onclick="confirmDelete(${guide.id}, '${guide.full_name.replace(/'/g, "\\'")}')">
                            <i class="fas fa-trash"></i> Delete
                        </button>
                    </td>
                </tr>
            `;
        });
    }
    
    $('#tourguidesTableBody').html(html);
}

    // Helper function to escape special characters for regex
    function escapeRegExp(string) {
        return string.replace(/[.*+?^${}()|[\]\\]/g, '\\$&');
    }

    // Show add modal
    function showAddModal() {
        currentTourGuideId = null;
        $('#modalTitle').text('Add Tour Guide');
        $('#tourguideId').val('');
        $('#fullName').val('');
        $('#status').val('active');
        $('#modalAlert').html('');
        $('#tourguideModal').modal('show');
    }

    // Edit tour guide
    function editTourGuide(tourguideId) {
        currentTourGuideId = tourguideId;
        $('#modalTitle').text('Edit Tour Guide');
        $('#modalAlert').html('');
        $('#tourguideModal').modal('show');
        
        // Load tour guide details
        $.ajax({
            url: 'tourguide_ajax.php',
            type: 'POST',
            data: {
                action: 'get_tourguide_details',
                tourguide_id: tourguideId
            },
            dataType: 'json',
            success: function(response) {
                if (response.success) {
                    const guide = response.data;
                    $('#tourguideId').val(guide.id);
                    $('#fullName').val(guide.full_name);
                    $('#status').val(guide.status);
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
                        <i class="fas fa-exclamation-triangle"></i> Error loading tour guide details
                    </div>
                `);
            }
        });
    }

// Save tour guide - UPDATED VERSION
function saveTourGuide() {
    const tourguideId = $('#tourguideId').val();
    const fullName = $('#fullName').val().trim();
    const status = $('#status').val();

    // Validation
    if (!fullName) {
        $('#modalAlert').html(`
            <div class="alert alert-danger">
                <i class="fas fa-exclamation-circle"></i> Please enter full name
            </div>
        `);
        return;
    }

    if (fullName.length < 2) {
        $('#modalAlert').html(`
            <div class="alert alert-danger">
                <i class="fas fa-exclamation-circle"></i> Full name must be at least 2 characters long
            </div>
        `);
        return;
    }

    $('#saveTourGuideBtn').prop('disabled', true).html('<i class="fas fa-spinner fa-spin"></i> Saving...');

    $.ajax({
        url: 'tourguide_ajax.php',
        type: 'POST',
        data: {
            action: tourguideId ? 'update_tourguide' : 'add_tourguide',
            tourguide_id: tourguideId,
            full_name: fullName,
            status: status
        },
        dataType: 'json',
        success: function(response) {
            if (response.success) {
                $('#tourguideModal').modal('hide');
                loadTourGuides();
                showToast('success', response.message);
            } else {
                $('#modalAlert').html(`
                    <div class="alert alert-danger alert-dismissible fade show">
                        <i class="fas fa-exclamation-circle"></i> ${response.message}
                        <button type="button" class="close" data-dismiss="alert">&times;</button>
                    </div>
                `);
            }
            $('#saveTourGuideBtn').prop('disabled', false).html('<i class="fas fa-save"></i> Save Tour Guide');
        },
        error: function() {
            $('#modalAlert').html(`
                <div class="alert alert-danger">
                    <i class="fas fa-exclamation-triangle"></i> Error saving tour guide
                </div>
            `);
            $('#saveTourGuideBtn').prop('disabled', false).html('<i class="fas fa-save"></i> Save Tour Guide');
        }
    });
}

    // Confirm delete
    function confirmDelete(tourguideId, fullName) {
        currentTourGuideId = tourguideId;
        $('#deleteModal .modal-body p:first').html(
            `Are you sure you want to delete the tour guide "<strong>${fullName}</strong>"?`
        );
        $('#deleteModal').modal('show');
    }

    // Delete tour guide
    function deleteTourGuide() {
        if (!currentTourGuideId) return;

        $('#confirmDeleteBtn').prop('disabled', true).html('<i class="fas fa-spinner fa-spin"></i> Deleting...');

        $.ajax({
            url: 'tourguide_ajax.php',
            type: 'POST',
            data: {
                action: 'delete_tourguide',
                tourguide_id: currentTourGuideId
            },
            dataType: 'json',
            success: function(response) {
                if (response.success) {
                    $('#deleteModal').modal('hide');
                    loadTourGuides();
                    showToast('success', response.message);
                } else {
                    showToast('error', response.message);
                }
                $('#confirmDeleteBtn').prop('disabled', false).html('<i class="fas fa-trash"></i> Delete');
            },
            error: function() {
                showToast('error', 'Error deleting tour guide');
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