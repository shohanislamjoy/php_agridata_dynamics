<?php
// Database connection
include('connection.php');

// Default SQL query to fetch all data
$sql = "SELECT d.division_name AS Area, SUM(pd.production) AS TotalProduction 
        FROM production_data pd
        JOIN field f ON pd.field_id = f.field_id
        JOIN division d ON f.div_id = d.division_id
        GROUP BY d.division_name";

// Check if a specific year is provided in the request
if (isset($_GET['year']) && !empty($_GET['year']) && $_GET['year'] !== 'all') {
    $year = $_GET['year'];
    // Modify the SQL query to filter by the selected year
    $sql = "SELECT
    d.division_name AS Area,
    SUM(pd.production) AS TotalProduction
FROM
    production_data pd
JOIN
    field f ON pd.field_id = f.field_id
JOIN
    division d ON f.div_id = d.div_id
WHERE
    pd.Year = $year
GROUP BY
    d.div_id;
";
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
