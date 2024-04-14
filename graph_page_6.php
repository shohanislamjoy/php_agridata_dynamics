<?php
// Database connection
include('connection.php');

// Fetch crop names
$sql = "SELECT DISTINCT c.crop_name FROM crop c";
$result = $conn->query($sql);

// Initialize arrays to hold crop names and fertilizers
$crops = array();
$fertilizers = array('urea', 'tsp', 'mp', 'dap');

// Fetch fertilizer data for each crop
if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $cropName = $row['crop_name'];
        $fertilizerData = array();
        foreach ($fertilizers as $fertilizer) {
            $fertilizerData[$fertilizer] = 0;
        }

        // Fetch fertilizer data for the current crop
        $sqlFertilizer = "SELECT urea, tsp, mp, dap
                          FROM fertilizer
                          WHERE crop_id = (SELECT corp_id FROM crop WHERE crop_name = '$cropName')";
        $resultFertilizer = $conn->query($sqlFertilizer);
        if ($resultFertilizer->num_rows > 0) {
            // Sum up fertilizer data for the current crop
            while ($rowFertilizer = $resultFertilizer->fetch_assoc()) {
                foreach ($fertilizers as $fertilizer) {
                    // Divide the value by 1000 to adjust
                    $fertilizerData[$fertilizer] += (int)$rowFertilizer[$fertilizer] / 1000;
                }
            }
        }

        // Add crop and its fertilizer data to the crops array
        $crops[$cropName] = $fertilizerData;
    }
}

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
    <link href="assets/img/favicon.png" rel="icon">
    <link href="assets/img/apple-touch-icon.png" rel="apple-touch-icon">

    <!-- Google Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Open+Sans:ital,wght@0,300;0,400;0,500;0,600;0,700;1,300;1,400;1,600;1,700&family=Roboto:ital,wght@0,300;0,400;0,500;0,600;0,700;1,300;1,400;1,500;1,600;1,700&family=Work+Sans:ital,wght@0,300;0,400;0,500;0,600;0,700;1,300;1,400;1,500;1,600;1,700&display=swap" rel="stylesheet">

    <!-- Vendor CSS Files -->
    <link href="assets/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
    <link href="assets/vendor/bootstrap-icons/bootstrap-icons.css" rel="stylesheet">
    <link href="assets/vendor/fontawesome-free/css/all.min.css" rel="stylesheet">
    <link href="assets/vendor/aos/aos.css" rel="stylesheet">
    <link href="assets/vendor/glightbox/css/glightbox.min.css" rel="stylesheet">
    <link href="assets/vendor/swiper/swiper-bundle.min.css" rel="stylesheet">

    <!-- Template Main CSS File -->
    <link href="assets/main.css" rel="stylesheet">
    <!-- Google Charts -->
    <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
    <script type="text/javascript">
        google.charts.load('current', {
            'packages': ['corechart']
        });
        google.charts.setOnLoadCallback(drawVisualization);

        function drawVisualization() {
            var data = google.visualization.arrayToDataTable([
                ['Crop', 'Urea', 'TSP', 'MP', 'DAP'],
                <?php
                foreach ($crops as $cropName => $fertilizerData) {
                    echo "['$cropName',";
                    echo $fertilizerData['urea'] . ",";
                    echo $fertilizerData['tsp'] . ",";
                    echo $fertilizerData['mp'] . ",";
                    echo $fertilizerData['dap'] . "],";
                }
                ?>
            ]);

            var options = {
                title: 'Fertilizers for Each Crop in 100 Acre',
                hAxis: {
                    title: 'Crop'
                },
                vAxis: {
                    title: 'Amount in KG',
                    textStyle: {
                        bold: true
                    }
                },
                seriesType: 'bars',
                series: {
                    4: {
                        type: 'line'
                    }
                }
            };

            var chart = new google.visualization.ComboChart(document.getElementById('chart_div'));
            chart.draw(data, options);
        }
    </script>


</head>

<body>

    <!-- ======= Header ======= -->
    <?php include('header.php'); ?>
    <!-- End Header -->

    <main id="main">


        <!-- Breadcrumbs -->
        <div class="breadcrumbs d-flex align-items-center" style="background-image: url('assets/img/hero/unsplash/16.jpg');">


            <div class="container position-relative d-flex flex-column align-items-center" data-aos="fade">

                <h2>Crops Data On Total yeild</h2>
                <ol>
                    <li><a href="index.php">Home</a></li>
                    <li>Analysis Page</li>
                </ol>

            </div>

        </div>

        <!-- Analysis Section -->
        <section class="analysis-section">
            <div class="container text-center">
                <!-- Graph -->
                <div id="chart_div" class="charts"></div>
                <!-- Analysis Content -->
                <div class="row">
                    <div class="col-lg-12 analysis-content">
                        <h3>Analysis</h3>
                        <p>The total production data from 2000 to 2016 provides a comprehensive overview of the agricultural landscape in Bangladesh, highlighting the production trends of key crops.</p>
                        <p>Between 2000 and 2016, potatoes emerged as a significant crop with a total production of 4,070,495 units. Maize, on the other hand, recorded a total production of 1,009,829 units during the same period. Rice, paddy production amounted to 315,939 units, while sorghum production reached 1,171,689 units. Additionally, wheat production totaled 1,020,860 units, and soybeans contributed 100,427 units to the overall production.</p>
                        <p>For yams and cassava, data is available for specific periods. Yams saw a total production of 216,558 units from 2006 to 2011, while cassava production amounted to 339,950 units between 2007 and 2011.</p>
                        <p>This analysis offers valuable insights into the total production values for each crop, providing a foundation for further examination of regional-specific trends and factors influencing production dynamics.</p>
                    </div>

                </div>
            </div>
        </section>

    </main>
    <!-- End #main -->

    <!-- ======= Footer ======= -->
    <?php include('footer.php') ?>

    <!-- End Footer -->


</body>

</html>