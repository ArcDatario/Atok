<!DOCTYPE html>
<html lang="en">

<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0">
	<title>Ed-Atok | Admin</title>
	<link rel="shortcut icon" href="../icon/pin.png" type="image/x-icon">
	<link rel="stylesheet" href="assets/css/bootstrap.min.css">
	<link rel="stylesheet" href="assets/plugins/fontawesome/css/fontawesome.min.css">
	<link rel="stylesheet" href="assets/plugins/fontawesome/css/all.min.css">
	<link rel="stylesheet" href="assets/css/feathericon.min.css">
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/morris.js/0.5.1/morris.css">
	<link rel="stylesheet" href="assets/plugins/morris/morris.css">
	<link rel="stylesheet" href="assets/css/style.css">
</head>

<body>
	<div class="main-wrapper">
		<div class="header">
			<div class="header-left">
				<a href="dashboard" class="logo"> <img src="assets/img/lock.png" width="50" height="70" alt="logo"> <span class="logoclass">HOTEL</span> </a>
			</div>
			<a href="javascript:void(0);" id="toggle_btn"> <i class="fe fe-text-align-left"></i> </a>
			<a class="mobile_btn" id="mobile_btn"> <i class="fas fa-bars"></i> </a>
			<ul class="nav user-menu">
				<li class="nav-item dropdown noti-dropdown">
					<a href="#" class="dropdown-toggle nav-link" data-toggle="dropdown"> <i class="fe fe-bell"></i> <span class="badge badge-pill">3</span> </a>
					<div class="dropdown-menu notifications">
						<div class="topnav-dropdown-header"> <span class="notification-title">Notifications</span> <a href="javascript:void(0)" class="clear-noti"> Clear All </a> </div>
						<div class="noti-content">
							<ul class="notification-list">
								<li class="notification-message">
									<a href="#">
										<div class="media"> <span class="avatar avatar-sm">
											<img class="avatar-img rounded-circle" alt="User Image" src="assets/img/lock.png">
											</span>
											<div class="media-body">
												<p class="noti-details"><span class="noti-title">Carlson Tech</span> has approved <span class="noti-title">your estimate</span></p>
												<p class="noti-time"><span class="notification-time">4 mins ago</span> </p>
											</div>
										</div>
									</a>
								</li>
								<li class="notification-message">
									<a href="#">
										<div class="media"> <span class="avatar avatar-sm">
											<img class="avatar-img rounded-circle" alt="User Image" src="assets/img/lock.png">
											</span>
											<div class="media-body">
												<p class="noti-details"><span class="noti-title">International Software
													Inc</span> has sent you a invoice in the amount of <span class="noti-title">₱218</span></p>
												<p class="noti-time"><span class="notification-time">6 mins ago</span> </p>
											</div>
										</div>
									</a>
								</li>
								
							</ul>
						</div>
						<div class="topnav-dropdown-footer"> <a href="#">View all Notifications</a> </div>
					</div>
				</li>
				<li class="nav-item dropdown has-arrow">
					<a href="#" class="dropdown-toggle nav-link" data-toggle="dropdown"> <span class="user-img"><img class="rounded-circle" src="assets/img/lock.png" width="31" alt="Admin"></span> </a>
					<div class="dropdown-menu">
						<div class="user-header">
							<div class="avatar avatar-sm"> <img src="assets/img/lock.png" alt="User Image" class="avatar-img rounded-circle"> </div>
							<div class="user-text">
								<h6>Admin</h6>
								<p class="text-muted mb-0">Administrator</p>
							</div>
						</div> <a class="dropdown-item" href="profile">My Profile</a> <a class="dropdown-item" href="settings">Account Settings</a> <a class="dropdown-item" href="login">Logout</a> </div>
				</li>
			</ul>
			<div class="top-nav-search">
				<form>
					<input type="text" class="form-control" placeholder="Search here">
					<button class="btn" type="submit"><i class="fas fa-search"></i></button>
				</form>
			</div>
		</div>

		<!-- sidebar -->
		<?php include 'includes/sidebar.php'; ?>



		<div class="page-wrapper">
			<div class="content container-fluid">
				<div class="page-header">
					<div class="row">
						<div class="col-sm-12 mt-5">
							<h3 class="page-title mt-3">Good Morning Admin!</h3>
							<ul class="breadcrumb">
								<li class="breadcrumb-item active">Dashboard</li>
							</ul>
						</div>
					</div>
				</div>
				
				<div class="row">
    <div class="col-md-12 d-flex">
        <div class="card card-table flex-fill">
            <div class="card-header">
                <h4 class="card-title float-left mt-2">Booking</h4>
                <button type="button" class="btn btn-primary float-right veiwbutton">View All</button>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-hover table-center">
                        <thead>
                            <tr>
                                <th>Booking ID</th>
                                <th>Name</th>
                                <th>Email ID</th>
                                <th>Aadhar Number</th>
                                <th class="text-center">Room Type</th>
                                <th class="text-right">Number</th>
                                <th class="text-center">Status</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td class="text-nowrap"><div>BKG-0001</div></td>
                                <td class="text-nowrap">Juan dela Cruz</td>
                                <td>juan.delacruz@email.com</td>
                                <td>123456789012</td>
                                <td class="text-center">Double</td>
                                <td class="text-right"><div>0917-123-4567</div></td>
                                <td class="text-center"><span class="badge badge-pill bg-success inv-badge">INACTIVE</span></td>
                            </tr>
                            <tr>
                                <td class="text-nowrap"><div>BKG-0002</div></td>
                                <td class="text-nowrap">Maria Clara Santos</td>
                                <td>maria.santos@email.com</td>
                                <td>234567890123</td>
                                <td class="text-center">Double</td>
                                <td class="text-right"><div>0918-234-5678</div></td>
                                <td class="text-center"><span class="badge badge-pill bg-success inv-badge">INACTIVE</span></td>
                            </tr>
                            <tr>
                                <td class="text-nowrap"><div>BKG-0003</div></td>
                                <td class="text-nowrap">Jose Rizal</td>
                                <td>jose.rizal@email.com</td>
                                <td>345678901234</td>
                                <td class="text-center">Single</td>
                                <td class="text-right"><div>0919-345-6789</div></td>
                                <td class="text-center"><span class="badge badge-pill bg-success inv-badge">INACTIVE</span></td>
                            </tr>
                            <tr>
                                <td class="text-nowrap"><div>BKG-0004</div></td>
                                <td class="text-nowrap">Andres Bonifacio</td>
                                <td>andres.bonifacio@email.com</td>
                                <td>456789012345</td>
                                <td class="text-center">Double</td>
                                <td class="text-right"><div>0920-456-7890</div></td>
                                <td class="text-center"><span class="badge badge-pill bg-success inv-badge">INACTIVE</span></td>
                            </tr>
                            <tr>
                                <td class="text-nowrap"><div>BKG-0005</div></td>
                                <td class="text-nowrap">Luzviminda Reyes</td>
                                <td>luzviminda.reyes@email.com</td>
                                <td>567890123456</td>
                                <td class="text-center">Single</td>
                                <td class="text-right"><div>0921-567-8901</div></td>
                                <td class="text-center"><span class="badge badge-pill bg-success inv-badge">INACTIVE</span></td>
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
	
	<script src="assets/js/jquery-3.5.1.min.js"></script>
	<script src="assets/js/popper.min.js"></script>
	<script src="assets/js/bootstrap.min.js"></script>
	<script src="assets/plugins/slimscroll/jquery.slimscroll.min.js"></script>
	<script src="assets/plugins/raphael/raphael.min.js"></script>
	<script src="assets/plugins/morris/morris.min.js"></script>
	<script src="assets/js/chart.morris.js"></script>
	<script src="assets/js/script.js"></script>
</body>

</html>