<?php
// Database connection
include('connection.php');

// Fetch division names for dropdown
$sqlDivision = "SELECT * FROM division";
$resultDivision = $conn->query($sqlDivision);

// Fetch selected division from URL parameter or default to empty
$selectedDivision = isset($_GET['division']) ? $_GET['division'] : '';

// Fetch data from the database based on selected division
$sql = "SELECT st.type AS SoilType, SUM(pd.production) AS TotalProduction
        FROM production_data pd
        JOIN field f ON pd.field_id = f.field_id
        JOIN division d ON f.div_id = d.div_id
        JOIN soil_type st ON f.soil_id = st.soil_id";
if (!empty($selectedDivision)) {
    $sql .= " WHERE d.division_name = '$selectedDivision'";
}
$sql .= " GROUP BY st.type";
$result = $conn->query($sql);

// Initialize an array to hold the data
$data = array();

// Fetching data and building the array
while ($row = $result->fetch_assoc()) {
    $soilType = $row['SoilType'];
    $totalProduction = (float) $row['TotalProduction'];
    $data[] = array($soilType, $totalProduction);
}

// Convert data to Google Charts format
$chartData = array();
$chartData[] = ['Soil Type', 'Total Production'];
foreach ($data as $row) {
    $chartData[] = $row;
}
$chartJSON = json_encode($chartData);

// Close database connection
$conn->close();
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pie Chart</title>
    <!-- Load Google Charts -->
    <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
    <script type="text/javascript">
        google.charts.load('current', {
            'packages': ['corechart']
        });
        google.charts.setOnLoadCallback(drawChart);

        function drawChart() {
            var data = google.visualization.arrayToDataTable(<?php echo $chartJSON; ?>);

            var options = {
                title: 'Total Production by Soil Type <?php echo (!empty($selectedDivision)) ? "for $selectedDivision" : ""; ?>',
                pieHole: 0.4,
            };

            var pieChart = new google.visualization.PieChart(document.getElementById('pie_chart'));
            pieChart.draw(data, options);
        }
    </script>
</head>

<body>
    <div>
        <label>Select Division:</label>
        <select id="division_select" name="division_select" onchange="updateChart()">
            <option value="">All Divisions</option>
            <?php
            if ($resultDivision->num_rows > 0) {
                while ($rowDivision = $resultDivision->fetch_assoc()) {
                    $divisionName = $rowDivision['division_name'];
                    $selected = ($divisionName == $selectedDivision) ? 'selected' : '';
                    echo "<option value='$divisionName' $selected>$divisionName</option>";
                }
            }
            ?>
        </select>
    </div>
    <div id="pie_chart" style="width: 900px; height: 500px;"></div>

    <script>
        function updateChart() {
            var selectedDivision = document.getElementById("division_select").value;
            window.location.href = "graph_9.php?division=" + selectedDivision;
        }
    </script>
</body>

</html>