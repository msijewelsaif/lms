<?php
// Database connection
$conn = new mysqli('localhost', 'root', '', 'lms'); // Replace 'your_database_name' with your actual database name

if ($conn->connect_error) {
    die("Connection Failed: " . $conn->connect_error);
}

// Retrieve testimonials from the database
$sql = "SELECT * FROM testimonials";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        echo '<div class="testimonial">';
        echo '<p>' . $row['content'] . '</p>';
        echo '<p class="author">- ' . $row['author'] . '</p>';
        echo '</div>';
    }
} else {
    echo '<p>No testimonials available at the moment.</p>';
}

$conn->close();
?>
