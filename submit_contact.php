<?php
include('connection.php');

// Handle form submission
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = $_POST["name"];
    $email = $_POST["email"];
    $message = $_POST["message"];

    // Insert data into the database
    $sql = "INSERT INTO contact (name, email, message) VALUES ('$name', '$email', '$message')";

    if ($conn->query($sql) === TRUE) {
        echo "We got your message successfully.";
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }

    // Close database connection
    $conn->close();
}
