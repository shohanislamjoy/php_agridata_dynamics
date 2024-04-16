<?php
include('login_check.php');
if (!$userLoggedIn) {
	header("location:login.php");
	exit();
}
// Database configuration
include('connection.php');

// Fetch data from the database
$sql = "SELECT * FROM contact";
$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html lang="en">

<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Administrative Panel</title>
	<!-- Google Font: Source Sans Pro -->
	<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
	<!-- Font Awesome -->
	<link rel="stylesheet" href="assets/plugins/fontawesome-free/css/all.min.css">
	<!-- Theme style -->
	<link rel="stylesheet" href="assets/css/adminlte.min.css">
	<link rel="stylesheet" href="assets/css/custom.css">

</head>

<body class="hold-transition sidebar-mini">
	<!-- Site wrapper -->
	<div class="wrapper">
		<!-- Navbar -->
		<nav class="main-header navbar navbar-expand navbar-white navbar-light mb-4">
			<!-- Right navbar links -->
			<ul class="navbar-nav">
				<li class="nav-item">
					<a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
				</li>
			</ul>
			<div class="navbar-nav pl-2">
				<ol class="breadcrumb p-0 m-0 bg-white">
					<li class="breadcrumb-item active">Dashboard</li>
				</ol>
			</div>

			<ul class="navbar-nav ml-auto">
				<li class="nav-item">
					<a class="nav-link" data-widget="fullscreen" href="#" role="button">
						<i class="fas fa-expand-arrows-alt"></i>
					</a>
				</li>
				<li class="nav-item dropdown">
					<a class="nav-link p-0 pr-3" data-toggle="dropdown" href="#">
						<img src="assets/img/avatar.png" class='img-circle elevation-2' width="40" height="40" alt="">
					</a>
					<div class="dropdown-menu dropdown-menu-lg dropdown-menu-right p-3">
						<h4 class="h4 mb-0"><strong><?php echo $user_name; ?></strong></h4>
						<div class="mb-3"><?php echo $user_email;  ?></div>
						<div class="dropdown-divider"></div>
						<a href="#" class="dropdown-item">
							<i class="fas fa-user-cog mr-2"></i> Settings
						</a>
						<div class="dropdown-divider"></div>
						<a href="#" class="dropdown-item">
							<i class="fas fa-lock mr-2"></i> Change Password
						</a>
						<div class="dropdown-divider"></div>
						<a href="#" class="dropdown-item text-danger" id="logout-button">
							<i class="fas fa-sign-out-alt mr-2"></i> Logout
						</a>
					</div>
				</li>
			</ul>
		</nav>
		<!-- /.navbar -->
		<!-- Main Sidebar Container -->
		<aside class="main-sidebar sidebar-dark-primary elevation-4">
			<!-- Brand Logo -->
			<a href="./index.php" class="brand-link">
				<img src="assets/img/farm_1.png" alt="Logo" class="brand-image img-circle elevation-3" style="opacity: .8">
				<span class="brand-text font-weight-light">AgriData Dynamics</span>
			</a>

			<!-- Sidebar -->
			<div class="sidebar">
				<!-- Sidebar user (optional) -->
				<nav class="mt-2">
					<ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
						<!-- Add icons to the links using the .nav-icon class
								with font-awesome or any other icon font library -->
						<li class="nav-item">
							<a href="adminLogin.php" class="nav-link">
								<i class="nav-icon fas fa-tachometer-alt"></i>
								<p> Admin Dashboard</p>
							</a>
						</li>

						<li class="nav-item">
							<a href="add_crop_data.php" class="nav-link">
								<i class="nav-icon fas fa-tag"></i>
								<p>Add Crop Data</p>
							</a>
						</li>
						<li class="nav-item">
							<a href="add_fertilizer_data.php" class="nav-link">
								<i class="nav-icon fas fa-tag"></i>
								<p>Add Fertilizer Data</p>
							</a>
						</li>
						<li class="nav-item">
							<a href="add_division_data.php" class="nav-link">
								<i class="nav-icon fas fa-tag"></i>
								<p>Add Division</p>
							</a>
						</li>
						<li class="nav-item">
							<a href="add_production_data.php" class="nav-link">
								<i class="nav-icon fas fa-tag"></i>
								<p>Add Production Data</p>
							</a>
						</li>
						<li class="nav-item">
							<a href="add_sensor_data.php" class="nav-link">
								<i class="nav-icon fas fa-tag"></i>
								<p>Add sensor Data</p>
							</a>
						</li>
						<li class="nav-item">
							<a href="add_soil_type_data.php" class="nav-link">
								<i class="nav-icon fas fa-tag"></i>
								<p>Add Soil Type Data</p>
							</a>
						</li>
						<li class="nav-item">
							<a href="add_rainfall_data.php" class="nav-link">
								<i class="nav-icon fas fa-tag"></i>
								<p>Add Rainfall Data</p>
							</a>
						</li>

						<li class="nav-item">
							<a href="add_field.php" class="nav-link">
								<i class="nav-icon  fas fa-tag"></i>
								<p>Add Field data</p>
							</a>
						</li>

						<li class="nav-item">
							<a href="show_users_admin.php" class="nav-link">
								<i class="nav-icon  fas fa-users"></i>
								<p>Users</p>
							</a>
						</li>
						<li class="nav-item">
							<a href="review_admin.php" class="nav-link">
								<i class="nav-icon  fas fa-users"></i>
								<p>Reviews</p>
							</a>
						</li>
						<li class="nav-item">
							<a href="adminLogin.php" class="nav-link">
								<i class="nav-icon  far fa-file-alt"></i>
								<p>Pages</p>
							</a>
						</li>
					</ul>
				</nav>
				<!-- /.sidebar-menu -->
			</div>
			<!-- /.sidebar -->
		</aside>




		<!-- Content Wrapper. Contains page content -->
		<div class="content-wrapper">
			<!-- Main content -->
			<section class="content">
				<!-- Default box -->
				<div class="container-fluid">
					<div class="row">
						<div class="col-lg-4 col-6">
							<div class="small-box card">
								<div class="inner text-center">
									<?php
									$select_users = mysqli_query($conn, "SELECT * FROM `users` ") or die('query faild');
									$number_of_users = mysqli_num_rows($select_users);
									?>
									<h3><?php echo $number_of_users; ?></h3>
									<p>Total Users</p>
								</div>
								<div class="icon">
									<i class="ion ion-bag"></i>
								</div>
								<a href="#" class="small-box-footer text-dark">More info <i class="fas fa-arrow-circle-right"></i></a>
							</div>
						</div>

						<div class="col-lg-4 col-6">
							<div class="small-box card">
								<div class="inner text-center">
									<?php
									$select_users = mysqli_query($conn, "SELECT * FROM `testimonials` ") or die('query faild');
									$number_of_users = mysqli_num_rows($select_users);
									?>
									<h3><?php echo $number_of_users; ?></h3>

									<p>Total Reviews</p>
								</div>
								<div class="icon">
									<i class="ion ion-stats-bars"></i>
								</div>
								<a href="#" class="small-box-footer text-dark">More info <i class="fas fa-arrow-circle-right"></i></a>
							</div>
						</div>

						<div class="col-lg-4 col-6">
							<div class="small-box card">
								<div class="inner">
									<h3>9000000 Taka</h3>
									<p>Total Revenue</p>
								</div>
								<div class="icon">
									<i class="ion ion-person-add"></i>
								</div>
								<a href="javascript:void(0);" class="small-box-footer">&nbsp;</a>
							</div>
						</div>
					</div>
				</div>

				<div class="card-body">
					<table class="table">
						<thead>
							<tr>
								<th>Name</th>
								<th>Email</th>
								<th>Message</th>
								<th>Action</th>
							</tr>
						</thead>
						<tbody>
							<?php
							while ($row = $result->fetch_assoc()) {
								echo '<tr>';
								echo '<td>' . $row["name"] . '</td>';
								echo '<td>' . $row["email"] . '</td>';
								echo '<td>' . $row["message"] . '</td>';
								echo '<td><a href="delete_contact.php?id=' . $row["id"] . '">Delete</a></td>';
								echo '</tr>';
							}


							$conn->close();
							?>
						</tbody>
					</table>
				</div>
		</div>

		</section>
		<!-- /.content -->

		<!-- /.content-wrapper -->
		<footer class="main-footer">

			<strong>Copyright &copy; AgriData DynamicsAll rights reserved.
		</footer>
	</div>
	<!-- ./wrapper -->
	<!-- jQuery -->
	<script src="assets/plugins/jquery/jquery.min.js"></script>
	<!-- Bootstrap 4 -->
	<script src="assets/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
	<!-- AdminLTE App -->
	<script src="assets/js/adminlte.min.js"></script>
	<!-- AdminLTE for demo purposes -->
	<script src="assets/js/demo.js"></script>
	<script>
		document.getElementById('logout-button').addEventListener('click', function() {
			// Redirect to the logout page
			window.location.href = 'logout.php'; // Change 'logout.php' to the actual path of your logout script
		});
	</script>

</body>

</html>