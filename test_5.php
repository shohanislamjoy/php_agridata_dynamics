<?php
// Database connection
include('connection.php');

// Fetch data from the database and calculate total production per area
$sql = "SELECT Area, SUM(Value) AS TotalProduction FROM `yield` GROUP BY Area";
$result = $conn->query($sql);

// Prepare data for Google Charts
$data = array();
$data[] = ['Area', 'Total Production', ['role' => 'style']];
$colors = ['#3366cc', '#dc3912', '#ff9900', '#109618', '#990099', '#0099c6', '#dd4477', '#66aa00', '#b82e2e', '#316395'];
$colorIndex = 0;
if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $area = (string)$row['Area'];
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
<html>

<head>
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
</head>

<body>
    <div id="column_chart" style="width: 900px; height: 500px;"></div>
</body>

</html>