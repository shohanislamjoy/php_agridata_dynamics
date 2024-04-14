<?php
include('login_check.php');

include('connection.php');

// Fetch data from the database and calculate total production per area
$sql = "SELECT d.division_name, SUM(pd.production) AS TotalProduction
FROM production_data pd
JOIN field f ON pd.field_id = f.field_id
JOIN division d ON f.div_id = d.div_id
GROUP BY d.division_name;
";
$result = $conn->query($sql);

// Prepare data for Google Charts
$data = array();
$data[] = ['division_name', 'TotalProduction', ['role' => 'style']];
$colors = ['#3366cc', '#dc3912', '#ff9900', '#109618', '#990099', '#0099c6', '#dd4477', '#66aa00', '#b82e2e', '#316395'];
$colorIndex = 0;
if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $area = (string)$row['division_name'];
        $totalProduction = (float)$row['TotalProduction'];
        $color = $colors[$colorIndex % count($colors)]; // Get color from the array, loop through if needed
        $data[] = [$area, $totalProduction, $color];
        $colorIndex++;
    }
}


// Convert data to Google Charts DataTable format
$dataJSON = json_encode($data);


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

                <h2>Total Production by Division</h2>
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
                <div id="column_chart" class="charts"></div>
                <div class="charts">
                    <div>
                        <label for="year_select" style="font-size:28px;">Select Year:</label>
                        <select id="year_select">
                            <?php
                            for ($year = 2016; $year >= 2008; $year--) {
                                echo "<option value=\"$year\">$year</option>";
                            }
                            ?>
                        </select>
                    </div>
                    <div id="chart_div" style="width: 900px; height: 500px;"></div>
                </div>
                <!-- Analysis Content -->
                <div class="row">
                    <div class="col-lg-12 analysis-content">
                        <h3>Analysis</h3>
                        <p>The total production data from 2000 to 2016 provides a comprehensive overview of the agricultural landscape in Bangladesh, highlighting the production trends of key crops.</p>
                        <p>Between 2000 and 2016, potatoes emerged as a significant crop with a total production of 4,070,495 units. Maize, on the other hand, recorded a total production of 1,009,829 units during the same period. Rice, paddy production amounted to 315,939 units, while sorghum production reached 1,171,689 units. Additionally, wheat production totaled 1,020,860 units, and soybeans contributed 100,427 units to the overall production.</p>
                        <p>For yams and cassava, data is available for specific periods. Yams saw a total production of 216,558 units from 2006 to 2011, while cassava production amounted to 339,950 units between 2007 and 2011.</p>
                        <p>This analysis offers valuable insights into the total production values for each crop, providing a foundation for further examination of regional-specific trends and factors influencing production dynamics.</p>
                    </div>
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
            var data = google.visualization.arrayToDataTable(<?php echo $dataJSON; ?>);

            var options = {
                title: 'Total Production by Division',
                legend: {
                    position: 'none'
                },
                hAxis: {
                    title: 'Divisions',
                    titleTextStyle: {
                        color: '#333',
                        bold: true
                    },
                },
                vAxis: {
                    title: 'Total Production(Tons)',
                    minValue: 0,
                    titleTextStyle: {
                        color: '#333',
                        bold: true
                    },
                }
            };

            var chart = new google.visualization.ColumnChart(document.getElementById('column_chart'));

            chart.draw(data, options);
        }
    </script>
    <script type="text/javascript">
        google.charts.load('current', {
            'packages': ['corechart', 'controls']
        });
        google.charts.setOnLoadCallback(drawDashboard);

        function drawDashboard() {
            var data = new google.visualization.DataTable();
            data.addColumn('string', 'Area');
            data.addColumn('number', 'Total Production');

            var chart = new google.visualization.ChartWrapper({
                chartType: 'ColumnChart',
                containerId: 'chart_div',
                options: {
                    title: 'Total Production by Area',
                    legend: {
                        position: 'none'
                    },
                    hAxis: {
                        title: 'Total Production'
                    },
                    vAxis: {
                        title: 'Area'
                    }

                }
            });

            var control = document.getElementById('year_select');

            function fetchData(year) {
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
                xhr.open('GET', 'fetch_data_by_year.php?year=' + year, true);
                xhr.send();
            }

            control.addEventListener('change', function() {
                var selectedYear = this.value;
                fetchData(selectedYear);
            });

            fetchData('2016'); // Default to 2016 data
        }

        function drawChart(jsonData) {
            var data = new google.visualization.DataTable();
            data.addColumn('string', 'Area');
            data.addColumn('number', 'Total Production');

            for (var i = 0; i < jsonData.length; i++) {
                data.addRow([jsonData[i].Area, parseInt(jsonData[i].TotalProduction)]);
            }

            var chart = new google.visualization.ColumnChart(document.getElementById('chart_div'));
            chart.draw(data, null);
        }
    </script>

</body>

</html>