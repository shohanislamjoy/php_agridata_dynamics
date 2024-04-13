<?php
// Database connection
include('connection.php');

// Check if the 'crop' parameter is set in the GET request
if (isset($_GET['crop'])) {
    // Sanitize the input to prevent SQL injection
    $crop = mysqli_real_escape_string($conn, $_GET['crop']);

    // Prepare SQL query to fetch production data for the selected crop
    $sql = "SELECT Year, SUM(production) AS Production FROM production_data pd
            JOIN crop c ON pd.crop_id = c.corp_id
            WHERE c.crop_name = '$crop'
            GROUP BY Year";

    // Execute the query
    $result = $conn->query($sql);

    if ($result) {
        // Fetch the results into an associative array
        $data = array();
        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                $data[] = $row;
            }
        }

        // Close the result set
        $result->close();

        // Close database connection
        $conn->close();

        // Echo out the array for debugging
        echo '<pre>';
        print_r($data);
        echo '</pre>';

        // Output data in JSON format
        echo json_encode($data);
    } else {
        // Handle query execution error
        echo json_encode(array('error' => 'Query execution failed: ' . $conn->error));
    }
} else {
    // Output an error message if the 'crop' parameter is not set
    echo json_encode(array('error' => 'Crop parameter is missing'));
}
