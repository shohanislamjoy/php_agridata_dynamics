<?php
include('login_check.php');

// Database connection
include('connection.php');

// Fetching data from the database and calculate Total yield per year
$sql = "SELECT Year, SUM(Value) AS TotalValue FROM `yield` WHERE Item = 'Wheat' GROUP BY Year ORDER BY Year";
$result = $conn->query($sql);

// Prepare data for Google Charts
$data = array();
$data[] = ['Year', 'Total Value'];
if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $data[] = [(string)$row['Year'], (float)$row['TotalValue']]; // Convert Year to string
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

    <title>AgriData Dynamics - Analysis</title>
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
    <?php include('header.php'); ?>
    <!-- End Header -->

    <main id="main">


        <!-- Breadcrumbs -->
        <div class="breadcrumbs d-flex align-items-center" style="background-image: url('/frontend/img/hero/unsplash/16.jpg');">


            <div class="container position-relative d-flex flex-column align-items-center" data-aos="fade">

                <h2>Total Crop Yield Data by Year</h2>
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
                <div id="curve_chart" class="charts""></div>
                <!-- Analysis Content -->
                <div class=" row">
                    <div class="col-lg-12 analysis-content">
                        <h3>Analysis</h3>
                        <p>The total yield data by year provides valuable insights into the productivity trends of various crops in different regions over the years. </p>
                        <p>In Dhaka, the Total yield of maize fluctuated between approximately 14,036 and 23,600 from 2000 to 2004. Meanwhile, the Total yield of potatoes remained consistently high at around 167,000 during the same period. Rice, paddy showed an Total yield ranging from approximately 13,000 to 20,000, and wheat had an Total yield ranging from approximately 7,240 to 17,023 in Dhaka from 2000 to 2004.</p>
                        <p>Moving to Barisal, the Total yield of maize ranged from approximately 25,583 to 45,122 between 2008 and 2016. Potatoes in Barisal saw an increase in Total yield from around 236,393 to 306,198 during the same period. Rice, paddy had an Total yield ranging from approximately 13,952 to 17,502, while wheat showed an Total yield ranging from approximately 11,038 to 17,912 from 2007 to 2016 in Barisal.</p>
                        <p>Additionally, in Khulna, cassava had an Total yield ranging from approximately 30,000 to 66,667 between 2000 and 2009. In Mymensingh, the Total yield of cassava ranged from approximately 44,708 to 49,928 from 2007 to 2011. Sweet potatoes in Mymensingh showed an Total yield ranging from approximately 61,392 to 62,955 during the same period. Yams in Mymensingh had an Total yield ranging from approximately 33,345 to 34,911 from 2006 to 2011. In Khulna, yams showed an Total yield ranging from approximately 33,901 to 39,216 between 2009 and 2016.</p>
                        <p>Analyzing these Total yield data points helps in understanding the productivity trends of different crops over the years and can provide insights into factors influencing yield variations in various regions.</p>
                    </div>
                </div>
            </div>
        </section>

    </main>
    <!-- End #main -->

    <!-- ======= Footer ======= -->
    <?php include('footer.php') ?>
    <!-- End Footer -->


    <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
    <script type="text/javascript">
        google.charts.load('current', {
            'packages': ['corechart']
        });
        google.charts.setOnLoadCallback(drawChart);

        function drawChart() {
            var data = google.visualization.arrayToDataTable(<?php echo $dataJSON; ?>); // Use $dataJSON variable

            var options = {
                title: 'Total Yield Data by Year',
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