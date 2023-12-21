<?php
// Database configuration and connection (same as in the admin page)
$host = 'localhost';
$username = 'root';
$password = '';
$database = 'lms';

$conn = mysqli_connect($host, $username, $password, $database);

if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}

// Check if the course id is provided in the URL
if (isset($_GET['id']) && is_numeric($_GET['id'])) {
    $courseId = intval($_GET['id']); // Convert to an integer for security

    // Retrieve course details from the database
    $query = "SELECT * FROM courses WHERE course_id = $courseId";
    $result = mysqli_query($conn, $query);

    if ($result) {
        $course = mysqli_fetch_assoc($result);
        if ($course) {
            // Course found, display course details.
        } else {
            echo 'Course not found in the database.';
        }
    } else {
        echo 'Error fetching course details: ' . mysqli_error($conn);
    }
} else {
    echo 'Invalid course ID provided in the URL.';
}

?>

<!DOCTYPE html>
<html>
<head>
    <link rel="stylesheet" type="text/css" href="css/user_course.css">
</head>
<body>
    <div class="container">
        <?php if (isset($course)) { ?>
            <h1><?php echo $course['course_name']; ?></h1>
            <p>Price: $<?php echo $course['price']; ?></p>
            <img src="<?php echo $course['course_photo']; ?>" alt="Course Photo" style="max-width: 300px; max-height: 300px;">
            <p><?php echo $course['description']; ?></p>
            <button type="button" onclick="purchaseCourse(<?php echo $courseId; ?>)">Purchase Course</button>
        <?php } else { ?>
            <p>Course not found.</p>
        <?php } ?>
    </div>

    <script>
        function purchaseCourse(courseId) {
            // Handle the course purchase action here
        }
    </script>
</body>
</html>
