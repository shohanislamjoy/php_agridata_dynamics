<?php
include('login_check.php');

// Database connection
include('connection.php');

// Fetch data from the database and calculate average yield per year for all items
$sql = "SELECT Year, Item, AVG(Value) AS AverageValue FROM `yield` GROUP BY Year, Item ORDER BY Year, Item";
$result = $conn->query($sql);

// Prepare data for Google Charts
$data = array();
$items = array(); // Store unique items
$itemCount = 0;
if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $year = (string)$row['Year'];
        $item = (string)$row['Item'];
        $averageValue = (float)$row['AverageValue'];

        // Add item to the data array if it's not already present
        if (!in_array($item, $items)) {
            $items[] = $item;
            $itemCount++;
        }

        // Find the index of the item in the data array
        $itemIndex = array_search($item, $items);

        // Add the average value to the corresponding year and item
        if (!isset($data[$year])) {
            $data[$year] = array_fill(0, $itemCount, null);
        }
        $data[$year][$itemIndex] = $averageValue;
    }
}

// Add headers for the items
$header = ['Year'];
foreach ($items as $item) {
    $header[] = $item;
}
$dataArray = array($header);

// Fill data array with values
foreach ($data as $year => $values) {
    $row = [$year];
    foreach ($values as $value) {
        $row[] = $value;
    }
    $dataArray[] = $row;
}

// Convert data to Google Charts DataTable format
$dataJSON = json_encode($dataArray); // Store JSON data in a variable

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
        <div class="breadcrumbs d-flex align-items-center" style="background-image: url('frontend/img/hero/unsplash/16.jpg');">


            <div class="container position-relative d-flex flex-column align-items-center" data-aos="fade">

                <h2>Crops Separately Average Yield Data by Year</h2>
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
                <div id="curve_chart" class="charts"></div>
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
                linewidth: 8,
                legend: {
                    position: 'bottom'
                },
                isStacked: true,
                hAxis: {
                    title: 'Year',
                    titleTextStyle: {
                        color: '#333',
                        bold: true
                    },
                    format: '####', // Format years without commas
                    slantedText: true, // Slant the text
                    slantedTextAngle: 45 // Angle of slanted text
                },
                vAxis: {
                    minValue: 0
                }
            };

            var chart = new google.visualization.LineChart(document.getElementById('curve_chart'));

            chart.draw(data, options);
        }
    </script>

</body>

</html>