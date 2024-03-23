<?php
session_start();
session_unset(); // Clear all session variables
session_destroy(); // Destroy the session

// Redirect the user to the login page
header("Location: login.php"); // Change this to your actual login page URL
exit();
