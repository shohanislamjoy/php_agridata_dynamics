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
                          WHERE crop_id = (SELECT crop_id FROM crop WHERE crop_name = '$cropName')";
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
    <link href="assets/img/farm_1.png" rel="icon">

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
                title: 'Fertilizers Used For Each Crop in 100 Acre',
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

                <h2>Fertilizers Used For Each Crop in 100 Acre</h2>
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
                        <p>This Chat about Fertilizers Used For Each Crop in 100 Acre  for Maize Urea 145.616 ton, TSP 44.728 ton, MP 43.767 ton, DAP 27.84 ton,
 for Wheat Urea 111.82 ton, TSP 42.015 ton, MP 41.237 ton, DAP 26.319 ton,
For Potato Urea 232.41 ton, TSP 105.989 ton, MP 104.875 ton, DAP 66.721 ton,
For Rice Urea 277.926 ton, TSP 145.001 ton, MP 143.919 ton, DAP 91.55 ton,
For sugarcane Urea 171.616 ton, TSP 53.833 ton, MP 52.767 ton, DAP 33.53 ton,
</p>
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