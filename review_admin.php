<?php
include('login_check.php');
if (!$userLoggedIn) {
    header("location:login.php");
    exit();
}
// Database configuration
include('connection.php');

// Fetch data from the database
$sql = "SELECT * FROM testimonials";
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
    <link rel="stylesheet" href="frontend/plugins/fontawesome-free/css/all.min.css">
    <!-- Theme style -->
    <link rel="stylesheet" href="frontend/css/adminlte.min.css">
    <link rel="stylesheet" href="frontend/css/custom.css">

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
                        <img src="frontend/img/avatar.png" class='img-circle elevation-2' width="40" height="40" alt="">
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
                <img src="frontend/img/AdminLTELogo.png" alt="AdminLTE Logo" class="brand-image img-circle elevation-3" style="opacity: .8">

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
                            <a href="add_projects.php" class="nav-link">
                                <i class="nav-icon fas fa-tag"></i>
                                <p>Add Projects</p>
                            </a>
                        </li>

                        <li class="nav-item">
                            <a href="users.php" class="nav-link">
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
                            <a href="pages.html" class="nav-link">
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

            <div class="container mt-5">
                <!-- reviwers -->

                <div class="piechart m-4" id="piechart" style="height: 500px; width: 100%;"></div>

                <div class="card-body">
                    <table class="table">
                        <thead>
                            <tr>
                                <th>Name</th>
                                <th>Occupation</th>
                                <th>Rating</th>
                                <th>Message</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            while ($row = $result->fetch_assoc()) {
                                echo '<tr>';
                                echo '<td>' . $row["name"] . '</td>';
                                echo '<td>' . $row["occupation"] . '</td>';
                                echo '<td>' . $row["rating"] . '</td>';
                                echo '<td>' . $row["message"] . '</td>';
                                echo '<td><a href="delete_review.php?id=' . $row["id"] . '">Delete</a></td>';
                                echo '</tr>';
                            }


                            ?>
                        </tbody>
                    </table>
                </div>


            </div>



        </div>
        <!-- /.content-wrapper -->
        <footer class="main-footer">

            <strong>Copyright &copy; Battery Low Interactive All rights reserved.
        </footer>

    </div>
    <!-- ./wrapper -->
    <!-- jQuery -->
    <script src="frontend/plugins/jquery/jquery.min.js"></script>
    <!-- Bootstrap 4 -->
    <script src="frontend/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
    <!-- AdminLTE App -->
    <script src="frontend/js/adminlte.min.js"></script>
    <!-- AdminLTE for demo purposes -->
    <script src="frontend/js/demo.js"></script>
    <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
    <script>
        google.charts.load('current', {
            'packages': ['corechart']
        });
        google.charts.setOnLoadCallback(drawChart);

        function drawChart() {
            <?php
            // Fetch data from the testimonials table
            $sql_1 = "SELECT rating, COUNT(*) AS count FROM testimonials GROUP BY rating";
            $result_1 = $conn->query($sql_1);

            // Initialize an array to store the rating counts
            $ratingCounts = array();

            if ($result_1->num_rows > 0) {
                // Loop through the results and store the counts in the array
                while ($row = $result_1->fetch_assoc()) {
                    $rating = $row["rating"];
                    $count = $row["count"];
                    $ratingCounts[$rating] = $count;
                }
                // Fill in missing rating counts with zero
                for ($i = 1; $i <= 5; $i++) {
                    if (!isset($ratingCounts[$i])) {
                        $ratingCounts[$i] = 0;
                    }
                }
                // Sort the array by keys (ratings)
                ksort($ratingCounts);
            } else {
                echo "No testimonials found.";
            }

            // Close the database connection
            $conn->close();

            // Convert the rating counts array to a format suitable for JavaScript
            $data = array();
            $data[] = ['Task', 'Count'];
            foreach ($ratingCounts as $rating => $count) {
                $data[] = ["$rating stars", $count];
            }
            ?>

            var data = google.visualization.arrayToDataTable(<?php echo json_encode($data, JSON_NUMERIC_CHECK); ?>);

            var options = {
                title: 'Testimonials Ratings'
            };

            var chart = new google.visualization.PieChart(document.getElementById('piechart'));
            chart.draw(data, options);
        }
    </script>



</body>

</html>