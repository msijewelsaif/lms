<?php
if (isset($_POST['submit'])) {
    $email = $_POST['email'];
    $password = $_POST['password'];

    // Establish a database connection (replace these credentials with your own)
    $conn = new mysqli("localhost", "root", "", "lms");

    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    // Use prepared statements to prevent SQL injection
    $sql = "SELECT * FROM lms_admin WHERE email = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("s", $email);
    $stmt->execute();
    $result = $stmt->get_result();
    $user = $result->fetch_assoc();

    if ($user) {
        // Verify the password
        if (password_verify($password, $user['password'])) {
            // Password is correct, redirect to the welcome page
            header("Location: welcome.php");
            exit();
        } else {
            // Password is incorrect
            echo '<script>
                    alert("Login failed. Invalid username or password!!");
                    window.location.href = "index.php"; // Redirect back to the login page
                  </script>';
        }
    } else {
        // User not found
        echo '<script>
                alert("Login failed. User not found!!");
                window.location.href = "index.php"; // Redirect back to the login page
              </script>';
    }

    // Close the database connection
    $stmt->close();
    $conn->close();
}
?>
s