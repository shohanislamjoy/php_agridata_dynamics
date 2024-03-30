<?php
include('login_check.php');

// Database connection
include('connection.php');

// Fetch data from the database and calculate average yield per year
$sql = "SELECT Year, AVG(Value) AS AverageValue FROM `yield` WHERE Item = 'Wheat' GROUP BY Year ORDER BY Year";
$result = $conn->query($sql);

// Prepare data for Google Charts
$data = array();
$data[] = ['Year', 'Average Value'];
if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $data[] = [(string)$row['Year'], (float)$row['AverageValue']]; // Convert Year to string
    }
}
$dataJSON = json_encode($data); // Store JSON data in a variable

// Close database connection
$conn->close();
?>


<!DOCTYPE html>
<html lang="en">




<head>
    <meta charset="utf-8">
    <meta content="width=device-width, initial-scale=1.0" name="viewport">

    <title>AgriData Dynamics - Home</title>
    <meta content="" name="description">
    <meta content="" name="keywords">

    <!-- Favicons -->
    <link href="frontend/img/favicon.png" rel="icon">
    <link href="frontend/img/apple-touch-icon.png" rel="apple-touch-icon">

    <!-- Google Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Open+Sans:ital,wght@0,300;0,400;0,500;0,600;0,700;1,300;1,400;1,600;1,700&family=Roboto:ital,wght@0,300;0,400;0,500;0,600;0,700;1,300;1,400;1,500;1,600;1,700&family=Work+Sans:ital,wght@0,300;0,400;0,500;0,600;0,700;1,300;1,400;1,500;1,600;1,700&display=swap" rel="stylesheet">

    <!-- Vendor CSS Files -->
    <link href="frontend/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
    <link href="frontend/vendor/bootstrap-icons/bootstrap-icons.css" rel="stylesheet">
    <link href="frontend/vendor/fontawesome-free/css/all.min.css" rel="stylesheet">
    <link href="frontend/vendor/aos/aos.css" rel="stylesheet">
    <link href="frontend/vendor/glightbox/css/glightbox.min.css" rel="stylesheet">
    <link href="frontend/vendor/swiper/swiper-bundle.min.css" rel="stylesheet">

    <!-- Template Main CSS File -->
    <link href="frontend/main.css" rel="stylesheet">


</head>

<body>

    <!-- ======= Header ======= -->
    <header id="header" class="header d-flex align-items-center">
        <div class="container-fluid container-xl d-flex align-items-center justify-content-between">

            <a href="index.html" class="logo d-flex align-items-center">
                <!-- Uncomment the line below if you also wish to use an image logo -->
                <!-- <img src="assets/img/logo.png" alt=""> -->
                <h1>UpConstruction<span>.</span></h1>
            </a>

            <i class="mobile-nav-toggle mobile-nav-show bi bi-list"></i>
            <i class="mobile-nav-toggle mobile-nav-hide d-none bi bi-x"></i>
            <nav id="navbar" class="navbar">
                <ul>
                    <li><a href="index.html">Home</a></li>
                    <li><a href="about.html">About</a></li>
                    <li><a href="services.html">Services</a></li>
                    <li><a href="projects.html">Projects</a></li>
                    <li><a href="blog.html" class="active">Blog</a></li>
                    <li class="dropdown"><a href="#"><span>Dropdown</span> <i class="bi bi-chevron-down dropdown-indicator"></i></a>
                        <ul>
                            <li><a href="#">Dropdown 1</a></li>
                            <li class="dropdown"><a href="#"><span>Deep Dropdown</span> <i class="bi bi-chevron-down dropdown-indicator"></i></a>
                                <ul>
                                    <li><a href="#">Deep Dropdown 1</a></li>
                                    <li><a href="#">Deep Dropdown 2</a></li>
                                    <li><a href="#">Deep Dropdown 3</a></li>
                                    <li><a href="#">Deep Dropdown 4</a></li>
                                    <li><a href="#">Deep Dropdown 5</a></li>
                                </ul>
                            </li>
                            <li><a href="#">Dropdown 2</a></li>
                            <li><a href="#">Dropdown 3</a></li>
                            <li><a href="#">Dropdown 4</a></li>
                        </ul>
                    </li>
                    <li><a href="contact.html">Contact</a></li>
                </ul>
            </nav>
            <!-- .navbar -->

        </div>
    </header>
    <!-- End Header -->

    <main id="main">


        <!-- Breadcrumbs -->
        <div class="breadcrumbs d-flex align-items-center" style="background-image: url('/frontend/img/hero/unsplash/16.jpg');">


            <div class="container position-relative d-flex flex-column align-items-center" data-aos="fade">

                <h2>Average Yield Data by Year</h2>
                <ol>
                    <li><a href="index.php">Home</a></li>
                    <li>Analysis Page</li>
                </ol>

            </div>

        </div>

        <!-- Analysis Section -->
        <section class="analysis-section">
            <div class="container">
                <!-- Graph -->
                <div id="curve_chart" class="text-center" style="width: 900px; height: 500px; text-align:center"></div>
                <!-- Analysis Content -->
                <div class="row">
                    <div class="col-lg-12 analysis-content">
                        <h3>Analysis</h3>
                        <p>The average yield data by year provides valuable insights into the productivity trends of various crops in different regions over the years. </p>
                        <p>In Dhaka, the average yield of maize fluctuated between approximately 14,036 and 23,600 from 2000 to 2004. Meanwhile, the average yield of potatoes remained consistently high at around 167,000 during the same period. Rice, paddy showed an average yield ranging from approximately 13,000 to 20,000, and wheat had an average yield ranging from approximately 7,240 to 17,023 in Dhaka from 2000 to 2004.</p>
                        <p>Moving to Barisal, the average yield of maize ranged from approximately 25,583 to 45,122 between 2008 and 2016. Potatoes in Barisal saw an increase in average yield from around 236,393 to 306,198 during the same period. Rice, paddy had an average yield ranging from approximately 13,952 to 17,502, while wheat showed an average yield ranging from approximately 11,038 to 17,912 from 2007 to 2016 in Barisal.</p>
                        <p>Additionally, in Khulna, cassava had an average yield ranging from approximately 30,000 to 66,667 between 2000 and 2009. In Mymensingh, the average yield of cassava ranged from approximately 44,708 to 49,928 from 2007 to 2011. Sweet potatoes in Mymensingh showed an average yield ranging from approximately 61,392 to 62,955 during the same period. Yams in Mymensingh had an average yield ranging from approximately 33,345 to 34,911 from 2006 to 2011. In Khulna, yams showed an average yield ranging from approximately 33,901 to 39,216 between 2009 and 2016.</p>
                        <p>Analyzing these average yield data points helps in understanding the productivity trends of different crops over the years and can provide insights into factors influencing yield variations in various regions.</p>
                    </div>
                </div>
            </div>
        </section>

    </main>
    <!-- End #main -->

    <!-- ======= Footer ======= -->
    <footer id="footer" class="footer">

        <div class="footer-content position-relative">
            <div class="container">
                <div class="row">

                    <div class="col-lg-4 col-md-6">
                        <div class="footer-info">
                            <h3>UpConstruction</h3>
                            <p>
                                A108 Adam Street <br> NY 535022, USA<br><br>
                                <strong>Phone:</strong> +1 5589 55488 55<br>
                                <strong>Email:</strong> info@example.com<br>
                            </p>
                            <div class="social-links d-flex mt-3">
                                <a href="#" class="d-flex align-items-center justify-content-center"><i class="bi bi-twitter"></i></a>
                                <a href="#" class="d-flex align-items-center justify-content-center"><i class="bi bi-facebook"></i></a>
                                <a href="#" class="d-flex align-items-center justify-content-center"><i class="bi bi-instagram"></i></a>
                                <a href="#" class="d-flex align-items-center justify-content-center"><i class="bi bi-linkedin"></i></a>
                            </div>
                        </div>
                    </div>
                    <!-- End footer info column-->

                    <div class="col-lg-2 col-md-3 footer-links">
                        <h4>Useful Links</h4>
                        <ul>
                            <li><a href="#">Home</a></li>
                            <li><a href="#">About us</a></li>
                            <li><a href="#">Services</a></li>
                            <li><a href="#">Terms of service</a></li>
                            <li><a href="#">Privacy policy</a></li>
                        </ul>
                    </div>
                    <!-- End footer links column-->

                    <div class="col-lg-2 col-md-3 footer-links">
                        <h4>Our Services</h4>
                        <ul>
                            <li><a href="#">Web Design</a></li>
                            <li><a href="#">Web Development</a></li>
                            <li><a href="#">Product Management</a></li>
                            <li><a href="#">Marketing</a></li>
                            <li><a href="#">Graphic Design</a></li>
                        </ul>
                    </div>
                    <!-- End footer links column-->

                    <div class="col-lg-2 col-md-3 footer-links">
                        <h4>Hic solutasetp</h4>
                        <ul>
                            <li><a href="#">Molestiae accusamus iure</a></li>
                            <li><a href="#">Excepturi dignissimos</a></li>
                            <li><a href="#">Suscipit distinctio</a></li>
                            <li><a href="#">Dilecta</a></li>
                            <li><a href="#">Sit quas consectetur</a></li>
                        </ul>
                    </div>
                    <!-- End footer links column-->

                    <div class="col-lg-2 col-md-3 footer-links">
                        <h4>Nobis illum</h4>
                        <ul>
                            <li><a href="#">Ipsam</a></li>
                            <li><a href="#">Laudantium dolorum</a></li>
                            <li><a href="#">Dinera</a></li>
                            <li><a href="#">Trodelas</a></li>
                            <li><a href="#">Flexo</a></li>
                        </ul>
                    </div>
                    <!-- End footer links column-->

                </div>
            </div>
        </div>

        <div class="footer-legal text-center position-relative">
            <div class="container">
                <div class="copyright">
                    &copy; Copyright <strong><span>UpConstruction</span></strong>. All Rights Reserved
                </div>
            </div>
        </div>

    </footer>
    <!-- End Footer -->

    <!-- Template Main JS File -->
    <script src="frontend/main.js "></script>




    <!-- Vendor JS Files -->
    <script src="frontend/vendor/bootstrap/js/bootstrap.bundle.min.js "></script>
    <script src="frontend/vendor/aos/aos.js "></script>
    <script src="frontend/vendor/glightbox/js/glightbox.min.js "></script>
    <script src="frontend/vendor/isotope-layout/isotope.pkgd.min.js "></script>
    <script src="frontend/vendor/swiper/swiper-bundle.min.js "></script>
    <script src="frontend/vendor/purecounter/purecounter_vanilla.js "></script>
    <script src="frontend/vendor/php-email-form/validate.js "></script>


    <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
    <script type="text/javascript">
        google.charts.load('current', {
            'packages': ['corechart']
        });
        google.charts.setOnLoadCallback(drawChart);

        function drawChart() {
            var data = google.visualization.arrayToDataTable(<?php echo $dataJSON; ?>); // Use $dataJSON variable

            var options = {
                title: 'Average Yield Data by Year',
                curveType: 'function',
                legend: {
                    position: 'bottom'
                }
            };

            var chart = new google.visualization.LineChart(document.getElementById('curve_chart'));

            chart.draw(data, options);
        }
    </script>

</body>

</html>