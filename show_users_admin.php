<?php
include('login_check.php');
if (!$userLoggedIn) {
    header("location:login.php");
    exit();
}
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
                <div class="container mt-5">
                    <h2 class="mb-4">User Management</h2>
                    <?php
                    // Include your database connection file and any necessary configurations
                    include 'connection.php';

                    // Function to delete user
                    function deleteUser($conn, $id)
                    {
                        $sql = "DELETE FROM users WHERE id=?";
                        $stmt = $conn->prepare($sql);
                        $stmt->bind_param("i", $id);
                        $stmt->execute();
                        $stmt->close();
                        return true;
                    }

                    // Check if form is submitted for deletion
                    if ($_SERVER["REQUEST_METHOD"] === "POST" && isset($_POST["delete_id"])) {
                        $delete_id = $_POST["delete_id"];
                        if (deleteUser($conn, $delete_id)) {
                            echo '<div class="alert alert-success" role="alert">User deleted successfully!</div>';
                        } else {
                            echo '<div class="alert alert-danger" role="alert">Error deleting user!</div>';
                        }
                    }

                    // Fetch all users from the database
                    $sql = "SELECT * FROM users";
                    $result = $conn->query($sql);

                    if ($result->num_rows > 0) {
                    ?>
                        <table class="table table-striped">
                            <thead>
                                <tr>
                                    <th>Name</th>
                                    <th>Email</th>
                                    <th>Phone</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php while ($row = $result->fetch_assoc()) { ?>
                                    <tr>
                                        <td><?php echo $row["name"]; ?></td>
                                        <td><?php echo $row["email"]; ?></td>
                                        <td><?php echo $row["phone"]; ?></td>
                                        <td>
                                            <!-- Edit Button -->
                                            <a href="edit_user.php?id=<?php echo $row["id"]; ?>" class="btn btn-primary btn-sm">Edit</a>

                                            <!-- Delete Button -->
                                            <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post" style="display: inline;">
                                                <input type="hidden" name="delete_id" value="<?php echo $row["id"]; ?>">
                                                <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Are you sure you want to delete this user?')">Delete</button>
                                            </form>
                                        </td>
                                    </tr>
                                <?php } ?>
                            </tbody>
                        </table>
                    <?php } else { ?>
                        <p>No users found.</p>
                    <?php } ?>
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