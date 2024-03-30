<?php
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
<html>

<head>
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
</head>

<body>
    <div id="curve_chart" style="width: 900px; height: 500px"></div>
    <a href="test_2.php">lol</a>
</body>

</html>