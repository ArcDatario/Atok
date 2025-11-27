<!DOCTYPE html>
<html lang="en">

<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0">
	<title>Hotel Dashboard Template</title>
	<link rel="shortcut icon" type="image/x-icon" href="assets/img/favicon.png">
	<link rel="stylesheet" href="assets/css/bootstrap.min.css">
	<link rel="stylesheet" href="assets/plugins/fontawesome/css/fontawesome.min.css">
	<link rel="stylesheet" href="assets/plugins/fontawesome/css/all.min.css">
	<link rel="stylesheet" href="assets/css/feathericon.min.css">
	<link rel="stylesheet" href="assets/plugins/morris/morris.css">
	<link rel="stylesheet" type="text/css" href="assets/css/bootstrap-datetimepicker.min.css">
	<link rel="stylesheet" href="assets/css/style.css"> </head>

<body>
	<div class="main-wrapper">
		<div class="header">
			<div class="header-left">
				<a href="dashboard" class="logo"> <img src="assets/img/hotel_logo.png" width="50" height="70" alt="logo"> <span class="logoclass">HOTEL</span> </a>
				<a href="dashboard" class="logo logo-small"> <img src="assets/img/hotel_logo.png" alt="Logo" width="30" height="30"> </a>
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
                                            <img class="avatar-img rounded-circle" alt="User Image" src="assets/img/profiles/avatar-02.jpg">
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
                                            <img class="avatar-img rounded-circle" alt="User Image" src="assets/img/profiles/avatar-11.jpg">
                                            </span>
											<div class="media-body">
												<p class="noti-details"><span class="noti-title">International Software
                                                    Inc</span> has sent you a invoice in the amount of <span class="noti-title">$218</span></p>
												<p class="noti-time"><span class="notification-time">6 mins ago</span> </p>
											</div>
										</div>
									</a>
								</li>
								<li class="notification-message">
									<a href="#">
										<div class="media"> <span class="avatar avatar-sm">
                                            <img class="avatar-img rounded-circle" alt="User Image" src="assets/img/profiles/avatar-17.jpg">
                                            </span>
											<div class="media-body">
												<p class="noti-details"><span class="noti-title">John Hendry</span> sent a cancellation request <span class="noti-title">Apple iPhone
                                                    XR</span></p>
												<p class="noti-time"><span class="notification-time">8 mins ago</span> </p>
											</div>
										</div>
									</a>
								</li>
								<li class="notification-message">
									<a href="#">
										<div class="media"> <span class="avatar avatar-sm">
                                            <img class="avatar-img rounded-circle" alt="User Image" src="assets/img/profiles/avatar-13.jpg">
                                            </span>
											<div class="media-body">
												<p class="noti-details"><span class="noti-title">Mercury Software
                                                    Inc</span> added a new product <span class="noti-title">Apple
                                                    MacBook Pro</span></p>
												<p class="noti-time"><span class="notification-time">12 mins ago</span> </p>
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
					<a href="#" class="dropdown-toggle nav-link" data-toggle="dropdown"> <span class="user-img"><img class="rounded-circle" src="assets/img/profiles/avatar-01.jpg" width="31" alt="Admin"></span> </a>
					<div class="dropdown-menu">
						<div class="user-header">
							<div class="avatar avatar-sm"> <img src="assets/img/profiles/avatar-01.jpg" alt="User Image" class="avatar-img rounded-circle"> </div>
							<div class="user-text">
								<h6>Admin</h6>
								<p class="text-muted mb-0">Administrator</p>
							</div>
						</div> <a class="dropdown-item" href="profile">My Profile</a> <a class="dropdown-item" href="settings">Account Settings</a> <a class="dropdown-item" href="login">Logout</a> </div>
				</li>
			</ul>
		</div>
		<div class="sidebar" id="sidebar">
			<div class="sidebar-inner slimscroll">
				<div id="sidebar-menu" class="sidebar-menu">
					<ul>
						<li> <a href="dashboard"><i class="fas fa-tachometer-alt"></i> <span>Dashboard</span></a> </li>
						<li class="list-divider"></li>
						<li class="submenu"> <a href="#"><i class="fas fa-suitcase"></i> <span> Booking </span> <span class="menu-arrow"></span></a>
							<ul class="submenu_class" style="display: none;">
								<li><a href="all-booking"> All Booking </a></li>
								<li><a href="edit-booking"> Edit Booking </a></li>
								<li><a href="add-booking"> Add Booking </a></li>
							</ul>
						</li>
						<li class="submenu"> <a href="#"><i class="fas fa-user"></i> <span> Customers </span> <span class="menu-arrow"></span></a>
							<ul class="submenu_class" style="display: none;">
								<li><a href="all-customer"> All customers </a></li>
								<li><a href="edit-customer"> Edit Customer </a></li>
								<li><a href="add-customer"> Add Customer </a></li>
							</ul>
						</li>
						<li class="submenu"> <a href="#"><i class="fas fa-key"></i> <span> Rooms </span> <span class="menu-arrow"></span></a>
							<ul class="submenu_class" style="display: none;">
								<li><a href="all-rooms">All Rooms </a></li>
								<li><a href="edit-room"> Edit Rooms </a></li>
								<li><a href="add-room"> Add Rooms </a></li>
							</ul>
						</li>
						<li class="submenu"> <a href="#"><i class="fas fa-user"></i> <span> Staff </span> <span class="menu-arrow"></span></a>
							<ul class="submenu_class" style="display: none;">
								<li><a href="all-staff">All Staff </a></li>
								<li><a href="edit-staff"> Edit Staff </a></li>
								<li><a href="add-staff"> Add Staff </a></li>
							</ul>
						</li>
						<li> <a href="pricing"><i class="far fa-money-bill-alt"></i> <span>Pricing</span></a> </li>
						<li class="submenu"> <a href="#"><i class="fas fa-share-alt"></i> <span> Apps </span> <span class="menu-arrow"></span></a>
							<ul class="submenu_class" style="display: none;">
								<li><a href="chat"><i class="fas fa-comments"></i><span> Chat </span></a></li>
								<li class="submenu"> <a href="#"><i class="fas fa-video camera"></i> <span> Calls </span> <span class="menu-arrow"></span></a>
									<ul class="submenu_class" style="display: none;">
										<li><a class="active" href="voice-call"> Voice Call </a></li>
										<li><a href="video-call"> Video Call </a></li>
										<li><a href="incoming-call"> Incoming Call </a></li>
									</ul>
								</li>
								<li class="submenu"> <a href="#"><i class="fas fa-envelope"></i> <span> Email </span> <span class="menu-arrow"></span></a>
									<ul class="submenu_class" style="display: none;">
										<li><a href="compose">Compose Mail </a></li>
										<li><a href="inbox"> Inbox </a></li>
										<li><a href="mail-veiw"> Mail Veiw </a></li>
									</ul>
								</li>
							</ul>
						</li>
						<li class="submenu"> <a href="#"><i class="fas fa-user"></i> <span> Employees </span> <span class="menu-arrow"></span></a>
							<ul class="submenu_class" style="display: none;">
								<li><a href="employees">Employees List </a></li>
								<li><a href="leaves">Leaves </a></li>
								<li><a href="holidays">Holidays </a></li>
								<li><a href="attendance">Attendance </a></li>
							</ul>
						</li>
						<li class="submenu"> <a href="#"><i class="far fa-money-bill-alt"></i> <span> Accounts </span> <span class="menu-arrow"></span></a>
							<ul class="submenu_class" style="display: none;">
								<li><a href="invoices">Invoices </a></li>
								<li><a href="payments">Payments </a></li>
								<li><a href="expenses">Expenses </a></li>
								<li><a href="taxes">Taxes </a></li>
								<li><a href="provident-fund">Provident Fund </a></li>
							</ul>
						</li>
						<li class="submenu"> <a href="#"><i class="fas fa-book"></i> <span> Payroll </span> <span class="menu-arrow"></span></a>
							<ul class="submenu_class" style="display: none;">
								<li><a href="salary">Employee Salary </a></li>
								<li><a href="salary-veiw">Payslip </a></li>
							</ul>
						</li>
						<li> <a href="calendar"><i class="fas fa-calendar-alt"></i> <span>Calendar</span></a> </li>
						<li class="submenu"> <a href="#"><i class="fe fe-table"></i> <span> Blog </span> <span class="menu-arrow"></span></a>
							<ul class="submenu_class" style="display: none;">
								<li><a href="blog">Blog </a></li>
								<li><a href="blog-details">Blog Veiw </a></li>
								<li><a href="add-blog">Add Blog </a></li>
								<li><a href="edit-blog">Edit Blog </a></li>
							</ul>
						</li>
						<li> <a href="assets"><i class="fas fa-cube"></i> <span>Assests</span></a> </li>
						<li> <a href="activities"><i class="far fa-bell"></i> <span>Activities</span></a> </li>
						<li class="submenu"> <a href="#"><i class="fe fe-table"></i> <span> Reports </span> <span class="menu-arrow"></span></a>
							<ul class="submenu_class" style="display: none;">
								<li><a href="expense-reports">Expense Report </a></li>
								<li><a href="invoice-reports">Invoice Report </a></li>
							</ul>
						</li>
						<li> <a href="settings"><i class="fas fa-cog"></i> <span>Settings</span></a> </li>
						<li class="list-divider"></li>
						<li class="menu-title mt-3"> <span>UI ELEMENTS</span> </li>
						<li class="submenu"> <a href="#"><i class="fas fa-laptop"></i> <span> Components </span> <span class="menu-arrow"></span></a>
							<ul class="submenu_class" style="display: none;">
								<li><a href="uikit">UI Kit </a></li>
								<li><a href="typography">Typography </a></li>
								<li><a href="tabs">Tabs </a></li>
							</ul>
						</li>
						<li class="submenu"> <a href="#"><i class="fas fa-edit"></i> <span> Forms </span> <span class="menu-arrow"></span></a>
							<ul class="submenu_class" style="display: none;">
								<li><a href="form-basic-inputs">Basic Input </a></li>
								<li><a href="form-input-groups">Input Groups </a></li>
								<li><a href="form-horizontal">Horizontal Form </a></li>
								<li><a href="form-vertical">Vertical Form </a></li>
							</ul>
						</li>
						<li class="submenu"> <a href="#"><i class="fas fa-table"></i> <span> Tables </span> <span class="menu-arrow"></span></a>
							<ul class="submenu_class" style="display: none;">
								<li><a href="tables-basic">Basic Table </a></li>
								<li><a href="tables-datatables">Data Table </a></li>
							</ul>
						</li>
						<li class="list-divider"></li>
						<li class="menu-title mt-3"> <span>EXTRAS</span> </li>
						<li class="submenu"> <a href="#"><i class="fas fa-columns"></i> <span> Pages </span> <span class="menu-arrow"></span></a>
							<ul class="submenu_class" style="display: none;">
								<li><a href="login">Login </a></li>
								<li><a href="register">Register </a></li>
								<li><a href="forgot-password">Forgot Password </a></li>
								<li><a href="change-password">Change Password </a></li>
								<li><a href="lock-screen">Lockscreen </a></li>
								<li><a href="profile">Profile </a></li>
								<li><a href="gallery">Gallery </a></li>
								<li><a href="error-404">404 Error </a></li>
								<li><a href="error-500">500 Error </a></li>
								<li><a href="blank-page">Blank Page </a></li>
							</ul>
						</li>
						<li class="submenu"> <a href="#"><i class="fas fa-share-alt"></i> <span> Multi Level </span> <span class="menu-arrow"></span></a>
							<ul class="submenu_class" style="display: none;">
								<li><a href="">Level 1 </a></li>
								<li><a href="">Level 2 </a></li>
							</ul>
						</li>
					</ul>
				</div>
			</div>
		</div>
		<div class="page-wrapper" style="padding-top: 60px !important;">
			<div class="chat-main-row">
				<div class="chat-main-wrapper">
					<div class="col-lg-9 message-view task-view">
						<div class="chat-window">
							<div class="fixed-header">
								<div class="navbar">
									<div class="user-details mr-auto">
										<div class="float-left user-img">
											<a class="avatar" href="profile" title="Mike Litorus"> <img src="assets/img/profiles/avatar-05.jpg" alt="" class="rounded-circle"> <span class="status online"></span> </a>
										</div>
										<div class="user-info float-left"> <a href="profile"><span>Mike Litorus</span></a> <span class="last-seen">Online</span> </div>
									</div>
									<ul class="nav float-right custom-menu">
										<li class="nav-item dropdown dropdown-action"> <a href="#" class="nav-link dropdown-toggle" data-toggle="dropdown" aria-expanded="false"><i class="fas fa-cog"></i></a>
											<div class="dropdown-menu dropdown-menu-right"> <a href="javascript:void(0)" class="dropdown-item">Settings</a> </div>
										</li>
									</ul>
								</div>
							</div>
							<div class="chat-contents">
								<div class="chat-content-wrap">
									<div class="voice-call-avatar"> <img src="assets/img/profiles/avatar-02.jpg" alt="" class="call-avatar"> <span class="username">John Doe</span> <span class="call-timing-count">00:59</span> </div>
									<div class="call-users">
										<ul>
											<li>
												<a href="#"> <img src="assets/img/profiles/avatar-03.jpg" class="img-fluid" alt=""> <span class="call-mute"><i class="fas fa-microphone-slash"></i></span> </a>
											</li>
											<li>
												<a href="#"> <img src="assets/img/profiles/avatar-08.jpg" class="img-fluid" alt=""> <span class="call-mute"><i class="fas fa-microphone-slash"></i></span> </a>
											</li>
											<li>
												<a href="#"> <img src="assets/img/profiles/avatar-05.jpg" class="img-fluid" alt=""> <span class="call-mute"><i class="fas fa-microphone-slash"></i></span> </a>
											</li>
										</ul>
									</div>
								</div>
							</div>
							<div class="chat-footer">
								<div class="call-icons">
									<ul class="call-items">
										<li class="call-item">
											<a href="#" title="Enable Video" data-placement="top" data-toggle="tooltip"> <i class="fas fa-video camera"></i> </a>
										</li>
										<li class="call-item">
											<a href="#" title="Mute" data-placement="top" data-toggle="tooltip"> <i class="fas fa-microphone microphone"></i> </a>
										</li>
										<li class="call-item">
											<a href="#" title="Add User" data-placement="top" data-toggle="tooltip"> <i class="fas fa-user-plus"></i> </a>
										</li>
									</ul>
									<div class="end-call">
										<a href="javascript:void(0);"> <i class="material-icons">call_end</i> </a>
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
			<div id="drag_files" class="modal custom-modal fade" role="dialog">
				<div class="modal-dialog modal-dialog-centered modal-md" role="document">
					<div class="modal-content">
						<div class="modal-header">
							<h5 class="modal-title">Drag and drop files upload</h5>
							<button type="button" class="close" data-dismiss="modal" aria-label="Close"> <span aria-hidden="true">&times;</span> </button>
						</div>
						<div class="modal-body">
							<form id="js-upload-form">
								<div class="upload-drop-zone" id="drop-zone"> <i class="fas fa-cloud-upload-alt fa-2x"></i> <span class="upload-text">Just drag and drop files here</span> </div>
								<h4>Uploading</h4>
								<ul class="upload-list">
									<li class="file-list">
										<div class="upload-wrap">
											<div class="file-name"> <i class="fas fa-image"></i> photo.png </div>
											<div class="file-size">1.07 gb</div>
											<button type="button" class="file-close"> <i class="fas fa-times"></i> </button>
										</div>
										<div class="progress progress-xs progress-striped">
											<div class="progress-bar bg-success" role="progressbar" style="width: 65%"></div>
										</div>
										<div class="upload-process">37% done</div>
									</li>
									<li class="file-list">
										<div class="upload-wrap">
											<div class="file-name"> <i class="fas fa-file-alt"></i> task.doc </div>
											<div class="file-size">5.8 kb</div>
											<button type="button" class="file-close"> <i class="fas fa-times"></i> </button>
										</div>
										<div class="progress progress-xs progress-striped">
											<div class="progress-bar bg-success" role="progressbar" style="width: 65%"></div>
										</div>
										<div class="upload-process">37% done</div>
									</li>
									<li class="file-list">
										<div class="upload-wrap">
											<div class="file-name"> <i class="fas fa-image"></i> dashboard.png </div>
											<div class="file-size">2.1 mb</div>
											<button type="button" class="file-close"> <i class="fas fa-times"></i> </button>
										</div>
										<div class="progress progress-xs progress-striped">
											<div class="progress-bar bg-success" role="progressbar" style="width: 65%"></div>
										</div>
										<div class="upload-process">Completed</div>
									</li>
								</ul>
							</form>
							<div class="submit-section">
								<button class="btn btn-primary submit-btn">Submit</button>
							</div>
						</div>
					</div>
				</div>
			</div>
			<div id="add_group" class="modal custom-modal fade" role="dialog">
				<div class="modal-dialog modal-dialog-centered modal-md" role="document">
					<div class="modal-content">
						<div class="modal-header">
							<h5 class="modal-title">Create a group</h5>
							<button type="button" class="close" data-dismiss="modal" aria-label="Close"> <span aria-hidden="true">&times;</span> </button>
						</div>
						<div class="modal-body">
							<p>Groups are where your team communicates. They’re best when organized around a topic — #leads, for example.</p>
							<form>
								<div class="form-group">
									<label>Group Name <span class="text-danger">*</span></label>
									<input class="form-control" type="text"> </div>
								<div class="form-group">
									<label>Send invites to: <span class="text-muted-light">(optional)</span></label>
									<input class="form-control" type="text"> </div>
								<div class="submit-section">
									<button class="btn btn-primary submit-btn">Submit</button>
								</div>
							</form>
						</div>
					</div>
				</div>
			</div>
			<div id="add_chat_user" class="modal custom-modal fade" role="dialog">
				<div class="modal-dialog modal-dialog-centered modal-md" role="document">
					<div class="modal-content">
						<div class="modal-header">
							<h5 class="modal-title">Direct Chat</h5>
							<button type="button" class="close" data-dismiss="modal" aria-label="Close"> <span aria-hidden="true">&times;</span> </button>
						</div>
						<div class="modal-body">
							<div class="input-group m-b-30">
								<input placeholder="Search to start a chat" class="form-control search-input" type="text"> <span class="input-group-append">
                                <button class="btn btn-primary">Search</button>
                                </span> </div>
							<div>
								<h5>Recent Conversations</h5>
								<ul class="chat-user-list">
									<li>
										<a href="#">
											<div class="media"> <span class="avatar align-self-center"><img alt="" src="assets/img/profiles/avatar-16.jpg"></span>
												<div class="media-body align-self-center text-nowrap">
													<div class="user-name">Jeffery Lalor</div> <span class="designation">Team Leader</span> </div>
												<div class="text-nowrap align-self-center">
													<div class="online-date">1 day ago</div>
												</div>
											</div>
										</a>
									</li>
									<li>
										<a href="#">
											<div class="media "> <span class="avatar align-self-center"><img alt="" src="assets/img/profiles/avatar-13.jpg"></span>
												<div class="media-body align-self-center text-nowrap">
													<div class="user-name">Bernardo Galaviz</div> <span class="designation">Web Developer</span> </div>
												<div class="align-self-center text-nowrap">
													<div class="online-date">3 days ago</div>
												</div>
											</div>
										</a>
									</li>
									<li>
										<a href="#">
											<div class="media"> <span class="avatar align-self-center">
                                                <img alt="" src="assets/img/profiles/avatar-02.jpg">
                                                </span>
												<div class="media-body text-nowrap align-self-center">
													<div class="user-name">John Doe</div> <span class="designation">Web Designer</span> </div>
												<div class="align-self-center text-nowrap">
													<div class="online-date">7 months ago</div>
												</div>
											</div>
										</a>
									</li>
								</ul>
							</div>
							<div class="submit-section">
								<button class="btn btn-primary submit-btn">Submit</button>
							</div>
						</div>
					</div>
				</div>
			</div>
			<div id="share_files" class="modal custom-modal fade" role="dialog">
				<div class="modal-dialog modal-dialog-centered modal-md" role="document">
					<div class="modal-content">
						<div class="modal-header">
							<h5 class="modal-title">Share File</h5>
							<button type="button" class="close" data-dismiss="modal" aria-label="Close"> <span aria-hidden="true">&times;</span> </button>
						</div>
						<div class="modal-body">
							<div class="files-share-list">
								<div class="files-cont">
									<div class="file-type"> <span class="files-icon"><i class="fas fa-file-alt"></i></span> </div>
									<div class="files-info"> <span class="file-name text-ellipsis">AHA Selfcare Mobile Application Test-Cases.xls</span> <span class="file-author"><a href="#">Bernardo Galaviz</a></span> <span class="file-date">May 31st at 6:53 PM</span> </div>
								</div>
							</div>
							<div class="form-group">
								<label>Share With</label>
								<input class="form-control" type="text"> </div>
							<div class="submit-section">
								<button class="btn btn-primary submit-btn">Share</button>
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
	<script src="assets/js/moment.min.js"></script>
	<script src="assets/js/select2.min.js"></script>
	<script src="assets/plugins/slimscroll/jquery.slimscroll.min.js"></script>
	<script src="assets/js/script.js"></script>
</body>

</html>