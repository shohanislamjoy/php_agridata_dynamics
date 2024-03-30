<?php
// Database connection
include('connection.php');

// Fetch data from the database and calculate total yield per item
$sql = "SELECT Item, SUM(Value) AS TotalValue FROM `yield` GROUP BY Item ";
$result = $conn->query($sql);

// Prepare data for Google Charts
$data = array();
$data[] = ['Item', 'Total Value', ['role' => 'style']]; // Add an additional column for style
if ($result->num_rows > 0) {
    $colors = ['#3366cc', '#dc3912', '#ff9900', '#109618', '#990099', '#0099c6', '#dd4477', '#66aa00', '#b82e2e', '#316395', '#994499', '#22aa99', '#aaaa11', '#6633cc', '#e67300', '#8b0707', '#651067', '#329262', '#5574a6', '#3b3eac']; // Define colors for each item
    $i = 0;
    while ($row = $result->fetch_assoc()) {
        $data[] = [
            (string)$row['Item'],
            (float)$row['TotalValue'],
            $colors[$i % count($colors)] // Assign a color to each item
        ];
        $i++;
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
            var data = google.visualization.arrayToDataTable(<?php echo $dataJSON; ?>);

            var options = {
                title: 'Total Yield Data by Item',
                legend: {
                    position: 'none'
                },
                bars: 'horizontal' // Horizontal bars
            };

            var chart = new google.visualization.BarChart(document.getElementById('bar_chart'));

            chart.draw(data, options);
        }
    </script>
</head>

<body>
    <div id="bar_chart" style="width: 900px; height: 500px"></div>

</body>

</html>