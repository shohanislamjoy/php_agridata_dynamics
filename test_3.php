<?php
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
</head>

<body>
    <div id="curve_chart" style="width: 80%; height: 800px"></div>
</body>

</html>