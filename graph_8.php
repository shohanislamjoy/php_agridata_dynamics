<?php
// Database connection
include('connection.php');

// Fetch rainfall data for each division and year
$sql = "SELECT Year, Area AS Division, average_rain_fall_mm_per_year AS Rainfall 
        FROM rainfall";

// Execute the query
$result = $conn->query($sql);

// Fetch the results into an associative array
$data = array();
if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $data[] = $row;
    }
}
$dataJSON = json_encode($data);
echo $dataJSON;

// Close database connection
$conn->close();
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Rainfall in Divisions</title>

    <!-- Google Charts -->
    <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
    <script type="text/javascript">
        google.charts.load('current', {
            'packages': ['corechart']
        });
        google.charts.setOnLoadCallback(drawCharts);

        function drawCharts() {
            <?php
            // Group data by year
            $years = [];
            foreach ($data as $row) {
                $year = $row['Year'];
                if (!isset($years[$year])) {
                    $years[$year] = [];
                }
                $years[$year][] = $row;
            }

            // Draw chart for each year
            foreach ($years as $year => $yearData) {
                echo "drawChart$year();";
            }

            // Generate functions to draw charts for each year
            foreach ($years as $year => $yearData) {
                echo "function drawChart$year() {";
                echo "var data$year = new google.visualization.DataTable();";
                echo "data$year.addColumn('string', 'Division');";
                echo "data$year.addColumn('number', 'Rainfall');";
                echo "data$year.addRows([";
                foreach ($yearData as $row) {
                    $division = $row['Division'];
                    $rainfall = $row['Rainfall'];
                    echo "['$division', $rainfall],";
                }
                echo "]);";
                echo "var options$year = {";
                echo "title: 'Rainfall in Divisions - $year',";
                echo "legend: { position: 'top' }";
                echo "};";
                echo "var chart$year = new google.visualization.ColumnChart(document.getElementById('chart_div_$year'));";
                echo "chart$year.draw(data$year, options$year);";
                echo "}";
            }
            ?>
        }
    </script>
</head>

<body>
    <?php
    // Render charts for each year
    foreach ($years as $year => $yearData) {
        echo "<div id='chart_div_$year' style='width: 900px; height: 500px; margin: 20px auto;'></div>";
    }
    ?>
</body>

</html>