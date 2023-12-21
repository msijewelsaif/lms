<?php
$host = "localhost"; // Change this if your MySQL server is hosted elsewhere
$username = "root";
$password = "";
$database = "lms";

// Create a connection to the database
$conn = new mysqli($host, $username, $password, $database);

// Check the connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
?>
