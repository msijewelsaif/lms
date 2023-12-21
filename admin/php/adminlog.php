<?php
$host = "localhost";
$user = "root";
$password = "";
$db = "lms";

// Establish a MySQL database connection
$conn = mysqli_connect($host, $user, $password, $db);

if (!$conn) {
    die("Failed to connect to the database: " . mysqli_connect_error());
}

if (isset($_POST['email']) && isset($_POST['password'])) {
    $email = $_POST['email'];
    $password = $_POST['password'];

    // Sanitize user input to prevent SQL injection (use prepared statements for production)
    $email = mysqli_real_escape_string($conn, $email);
    $password = mysqli_real_escape_string($conn, $password);

    $sql = "SELECT * FROM admin WHERE email = '$email' AND password = '$password' LIMIT 1";
    $result = mysqli_query($conn, $sql);

    if (!$result) {
        die("Query failed: " . mysqli_error($conn));
    }

    if (mysqli_num_rows($result) == 1) {
        echo "You Have Successfully Logged in";


    } else {
        echo "You Have Entered Incorrect Email or Password";
    }
}

// Close the database connection
mysqli_close($conn);































