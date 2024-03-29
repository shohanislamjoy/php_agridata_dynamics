<?php
include('connection.php');

if (isset($_GET["id"])) {
    $id = $_GET["id"];

    // Delete data from the database
    $sql = "DELETE FROM contact WHERE id = $id";
    if ($conn->query($sql)) {
        // Redirect back to the admin panel
        header("Location: adminLogin.php");
        exit();
    } else {
        echo "Error deleting data: " . $conn->error;
    }
}
