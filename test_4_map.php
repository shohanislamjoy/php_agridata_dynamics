<?php
// Database connection
include('connection.php');

// Fetch data from the database and sum up the values for each area
$sql = "SELECT Area, SUM(Value) AS TotalValue FROM `yield` GROUP BY Area";
$result = $conn->query($sql);

// Prepare data for Google Charts
$data = array();
$data[] = ['Area', 'Total Value'];
if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $data[] = [$row['Area'], (float)$row['TotalValue']];
    }
}

// Close database connection
$conn->close();
?>

<!DOCTYPE html>
<html>

<head>
    <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
    <script type="text/javascript">
        google.charts.load('current', {
            'packages': ['geochart']
        });
        google.charts.setOnLoadCallback(drawRegionsMap);

        function drawRegionsMap() {
            var data = google.visualization.arrayToDataTable(<?php echo json_encode($data); ?>);

            var options = {
                region: 'BD',
                resolution: 'provinces',
                colorAxis: {
                    colors: ['#e7711c', '#4374e0']
                }
            };

            var chart = new google.visualization.GeoChart(document.getElementById('regions_div'));

            chart.draw(data, options);
        }
    </script>
</head>

<body>
    <div id="regions_div" style="width: 100%; height: 500px;"></div>
</body>

</html>