<?php
include('login_check.php');

// Database connection
include('connection.php');

// Fetch data from the database and calculate average yield per year for all items
$sql = "SELECT pd.Year, c.crop_name AS Item, AVG(pd.production) AS AverageValue 
        FROM production_data pd
        JOIN crop c ON pd.crop_id = c.crop_id
        GROUP BY pd.Year, c.crop_name
        ORDER BY pd.Year, c.crop_name";

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


</head>

<body>

    <!-- ======= Header ======= -->
    <?php include('header.php'); ?>
    <!-- End Header -->

    <main id="main">


        <!-- Breadcrumbs -->
        <div class="breadcrumbs d-flex align-items-center" style="background-image: url('assets/img/hero/unsplash/16.jpg');">


            <div class="container position-relative d-flex flex-column align-items-center" data-aos="fade">

                <h2>Average Crops Yielding Data of Years</h2>
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
                        <p>Here is the graph of  total production data from 2008 to 2017 provides a comprehensive overview of the agricultural landscape in Bangladesh, highlighting the production trends of key crops.</p>
                        <p>Customers have the option to choose every year between 2008-2017. </p>
                        <p>In 2008 to 2017 total production of Dhaka per year was 43427, 34573, 32178, 32995, …., 29668. In 2008 to 2017 total production of Rangpur per year was 28802, 35987, 37154,36856,....,37830. In 2008 to 2017 total production of Barisal per year was 36227, 42474, 38994, 41728,...,37805. In 2008 to 2017 total production of Khulna per year was 31723, 112318, 29431, 27684,.....,30371. In 2008 to 2017 total production of Chittagong per year was 39439, 39532,  29920,123370,.....,33797. In 2008 to 2017 total production of Sylhet per year was 38880, 31884, 37771, 33936,....,30479. In 2008 to 2017 total production of Rajshahi per year was 30225, 28346, 28030, 31344,....,29643.</p>
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
                title: 'Average Crops Yielding Data of Years',
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