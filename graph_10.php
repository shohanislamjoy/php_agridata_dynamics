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
                          WHERE crop_id = (SELECT corp_id FROM crop WHERE crop_name = '$cropName')";
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
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Combo Chart</title>
    <!-- Load Google Charts -->
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
                title: 'Fertilizers for Each Crop in 100 Acre',
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
    <div id="chart_div" style="width: 900px; height: 500px;"></div>
</body>

</html>