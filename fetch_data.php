<?php
// Database connection
include('connection.php');

// Default SQL query to fetch all data
$sql = "SELECT Area, SUM(production) AS TotalProduction FROM `production_data` GROUP BY Area";

// Check if a specific year is provided in the request
if (isset($_GET['year']) && !empty($_GET['year']) && $_GET['year'] !== 'all') {
    $year = $_GET['year'];
    // Modify the SQL query to filter by the selected year
    $sql = "SELECT Area, SUM(production) AS TotalProduction FROM `production_data` WHERE Year = $year GROUP BY Area";
}

$result = $conn->query($sql);

$data = array();
if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $data[] = $row;
    }
}

// Close database connection
$conn->close();

// Output data in JSON format
echo json_encode($data);
