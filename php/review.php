<?php
    $testimonialText = $_POST['content'];
    $author = $_POST['author'];

    // Database connection
    $conn = new mysqli('localhost', 'root', '', 'lms'); // Replace 'your_database_name' with your actual database name
    if ($conn->connect_error) {
        die("Connection Failed: " . $conn->connect_error);
    } else {
        $stmt = $conn->prepare("INSERT INTO testimonials (content, author) VALUES (?, ?)");
        $stmt->bind_param("ss", $testimonialText, $author);
        $execval = $stmt->execute();
        if ($execval) {
            echo "Testimonial submitted successfully!";
            header('Location:/LMS/thanking.html');


        } else {
            echo "Error: " . $stmt->error;
        }
        $stmt->close();
        $conn->close();
    }
?>
