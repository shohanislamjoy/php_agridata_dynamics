<?php
include('login_check.php');

if (!$userLoggedIn) {
    header("location:login.php");
    exit();
}

include('connection.php');

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Get form data
    $div_id = $_POST['division'];
    $crop_id = $_POST['crop'];
    $year = $_POST['year'];
    $urea = $_POST['urea'];
    $tsp = $_POST['tsp'];
    $mp = $_POST['mp'];
    $dap = $_POST['dap'];

    // Prepare SQL statement (using prepared statements for security)
    $sql = "INSERT INTO fertilizer (div_id, crop_id, Year, urea, tsp, mp, dap) VALUES (?, ?, ?, ?, ?, ?, ?)";

    $stmt = $conn->prepare($sql);
    $stmt->bind_param("iisiiii", $div_id, $crop_id, $year, $urea, $tsp, $mp, $dap); // Changed "siiiiii" to "iisiiii"

    if ($stmt->execute() === TRUE) {
        $successMessage = "Fertilizer data added successfully!";
    } else {
        $errorMessage = "Error: " . $conn->error;
    }

    // Close statement and connection
    $stmt->close();
    $conn->close();
}
?>




<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Administrative Panel:: projects</title>
    <!-- Google Font: Source Sans Pro -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="assets/plugins/fontawesome-free/css/all.min.css">
    <!-- Theme style -->
    <link rel="stylesheet" href="assets/css/adminlte.min.css">
    <link rel="stylesheet" href="assets/css/custom.css">
    <!-- bootstrap -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <style>
        form {
            max-width: 600px;
            width: 100%;
            margin: 3% auto;
            padding: 20px;
            background-color: #fff;
            border: 2px solid #ddd;
            border-radius: 5px;
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
        }

        form label {
            display: block;
            margin-top: 10px;
        }

        form input[type="text"],
        form textarea,
        form input[type="number"],
        form select,
        form input[type="file"] {
            width: 100%;
            padding: 10px;
            margin-bottom: 10px;
            border: 1px solid #ccc;
            border-radius: 4px;
        }

        form select {
            height: 40px;
        }

        form button {
            background-color: #333;
            color: #fff;
            padding: 10px 20px;
            border: none;
            border-radius: 4px;
            cursor: pointer;
            display: block;
            margin: 0 auto;
            /* Center the button */
        }
    </style>



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
            <!-- Content Header (Page header) -->
            <section class="content-header">
                <div class="container-fluid">
                    <div class="row mb-2">
                        <div class="col-sm-6">
                            <h1>Add Fertilizer Data</h1>
                        </div>

                    </div>
                </div>

                <div class="container mt-5">


                    <form action="add_fertilizer_data.php" method="POST">



                        <div class="form-group">
                            <label for="division">Division</label>
                            <select name="division" class="form-control" required>
                                <option value="">Select Division</option>
                                <?php
                                // Database connection
                                include('connection.php');

                                // Fetch division names and IDs
                                $sql = "SELECT div_id, division_name FROM division";
                                $result = $conn->query($sql);

                                // Fetching division names and building the options
                                if ($result->num_rows > 0) {
                                    while ($row = $result->fetch_assoc()) {
                                        $div_id = $row['div_id'];
                                        $division_name = $row['division_name'];
                                        echo "<option value='$div_id'>$division_name</option>";
                                    }
                                }

                                // Close database connection
                                $conn->close();
                                ?>
                            </select>
                        </div>



                        <div class="form-group">
                            <label for="crop">crop</label>
                            <select name="crop" class="form-control" required>
                                <option value="">Select crop</option>
                                <?php
                                // Database connection
                                include('connection.php');

                                // Fetch crop names and IDs
                                $sql = "SELECT crop_id, crop_name FROM crop";
                                $result = $conn->query($sql);

                                // Fetching crop names and building the options
                                if ($result->num_rows > 0) {
                                    while ($row = $result->fetch_assoc()) {
                                        $crop_id = $row['crop_id'];
                                        $crop_name = $row['crop_name'];
                                        echo "<option value='$crop_id'>$crop_name</option>";
                                    }
                                }

                                // Close database connection
                                $conn->close();
                                ?>
                            </select>
                        </div>

                        <!-- <div class="form-group">
                            <label for="item">Item</label>
                            <input type="text" name="item" class="form-control" maxlength="14" required>
                        </div> -->

                        <div class="form-group">
                            <label for="year_code">Year</label>
                            <input type="number" name="year" class="form-control" min="2000" max="2023" required>
                        </div>
                        <div class="form-group">
                            <label for="urea">Urea used in Tons</label>
                            <input type="number" name="urea" class="form-control" required>
                        </div>
                        <div class="form-group">
                            <label for="tsp">Triple superphosphate(TSP) used in Tons</label>
                            <input type="number" name="tsp" class="form-control" required>
                        </div>
                        <div class="form-group">
                            <label for="mp">Muriate of Potash(MP) used in Tons</label>
                            <input type="number" name="mp" class="form-control" required>
                        </div>
                        <div class="form-group">
                            <label for="dap">Diammonium phosphate(DAP) used in Tons</label>
                            <input type="number" name="dap" class="form-control" required>
                        </div>


                        <button type="submit" class="btn btn-primary">Submit</button>
                    </form>
                    <?php if (isset($successMessage)) : ?>
                        <div id="success-message" class="alert alert-success" role="alert">
                            <?php echo $successMessage; ?>
                        </div>
                    <?php elseif (isset($errorMessage)) : ?>
                        <div id="error-message" class="alert alert-danger" role="alert">
                            <?php echo $errorMessage; ?>
                        </div>
                    <?php endif; ?>



                </div>


            </section>
            <!-- /.content -->
        </div>
        <!-- /.content-wrapper -->
        <footer class="main-footer">

            <strong>Copyright &copy; AgriData Dynamics All rights reserved.
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

        function hideMessages() {
            setTimeout(function() {
                var successMessage = document.getElementById('success-message');
                var errorMessage = document.getElementById('error-message');

                if (successMessage) {
                    successMessage.style.display = 'none';
                }
                if (errorMessage) {
                    errorMessage.style.display = 'none';
                }
            }, 1000); // 1000 milliseconds = 1 second
        }

        // Call the hideMessages function when the page loads
        document.addEventListener('DOMContentLoaded', hideMessages);
    </script>

</body>

</html>