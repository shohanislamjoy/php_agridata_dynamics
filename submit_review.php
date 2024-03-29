<?php
include('connection.php');

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = $_POST["name"];
    $occupation = $_POST["occupation"];
    $message = $_POST["message"];
    $rating = $_POST["rate"];

    // Insert data into the testimonials table
    $sql = "INSERT INTO testimonials (name, occupation, message, rating) VALUES ('$name', '$occupation', '$message', '$rating')";

    if ($conn->query($sql) === TRUE) {
        // echo "Review submitted successfully.";
        header('Location:index.php');
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
        header('Location:index.php');
    }

    // Close the database connection
    $conn->close();
}
