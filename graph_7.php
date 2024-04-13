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


</head>

<body>

    <!-- ======= Header ======= -->
    <?php include('header.php'); ?>
    <!-- End Header -->

    <main id="main">


        <!-- Breadcrumbs -->
        <div class="breadcrumbs d-flex align-items-center" style="background-image: url('assets/img/hero/unsplash/16.jpg');">


            <div class="container position-relative d-flex flex-column align-items-center" data-aos="fade">

                <h2>Separately Average Yield Data of Crops by Year</h2>
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
                <div class="charts">
                    <div>
                        <label for="crop_select" style="font-size:28px;">Select Crop:</label>
                        <select id="crop_select">
                            <?php
                            // Database connection
                            include('connection.php');

                            // Fetch crop options from the database
                            $sql = "SELECT DISTINCT crop_name FROM crop";
                            $result = $conn->query($sql);

                            // Generate options for the select dropdown
                            if ($result->num_rows > 0) {
                                while ($row = $result->fetch_assoc()) {
                                    $crop = $row['crop_name'];
                                    echo "<option value=\"$crop\">$crop</option>";
                                }
                            }

                            // Close database connection
                            $conn->close();
                            ?>
                        </select>
                    </div>
                    <div id="chart_div" style="width: 900px; height: 500px;"></div>
                </div>
                <!-- Analysis Content -->
                <div class="row">
                    <div class="col-lg-12 analysis-content">
                        <h3>Analysis</h3>
                        <p>Analysis content goes here...</p>
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
        google.charts.setOnLoadCallback(drawDashboard);

        function drawDashboard() {
            var control = document.getElementById('crop_select');
            var chartDiv = document.getElementById('chart_div'); // Define chartDiv here

            var chart = new google.visualization.ChartWrapper({
                chartType: 'LineChart',
                containerId: 'chart_div',
                options: {
                    title: 'Crop Production Over Years',
                    legend: {
                        position: 'top'
                    },
                    hAxis: {
                        title: 'Year'
                    },
                    vAxis: {
                        title: 'Production'
                    }
                }
            });

            function fetchData(crop) {
                var xhr = new XMLHttpRequest();
                xhr.onreadystatechange = function() {
                    if (xhr.readyState === XMLHttpRequest.DONE) {
                        if (xhr.status === 200) {
                            var jsonData = JSON.parse(xhr.responseText);
                            drawChart(jsonData);
                        } else {
                            console.error('Error fetching data: ' + xhr.status);
                        }
                    }
                };
                xhr.open('GET', 'fetch_crop_data.php?crop=' + crop, true);
                xhr.send();
            }

            control.addEventListener('change', function() {
                var selectedCrop = this.value;
                fetchData(selectedCrop);
            });

            // Default to the first crop option
            fetchData(control.value);
        }

        function drawChart(jsonData) {
            var data = new google.visualization.DataTable();
            data.addColumn('number', 'Year');
            data.addColumn('number', 'Production');

            for (var i = 0; i < jsonData.length; i++) {
                var year = parseInt(jsonData[i].Year);
                var production = parseInt(jsonData[i].Production);
                data.addRow([year, production]);
            }

            // Use chartDiv from the outer scope
            var chart = new google.visualization.LineChart(chartDiv);
            chart.draw(data, null);
        }
    </script>



</body>

</html>