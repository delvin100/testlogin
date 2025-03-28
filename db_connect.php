<?php
$servername = "localhost";
$username = "root";
$password = ""; // Keep it empty if phpMyAdmin shows NO
$database = "userdb";
$port = 3307; // Since you changed from 3306 to 3307

// Create connection
$conn = new mysqli($servername, $username, $password, $database, $port);

// Check connection
if ($conn->connect_error) {
    // Log the error to a file instead of displaying it
    error_log("Connection failed: " . $conn->connect_error, 3, "error.log");
    die("An error occurred. Please try again later."); // Generic user-facing message
}

// No "Connected successfully" message here to avoid displaying it on the page
?>