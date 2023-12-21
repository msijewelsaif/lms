<?php
// Database configuration and connection
$host = 'localhost';
$username = 'root';
$password = '';
$database = 'lms';

$conn = mysqli_connect($host, $username, $password, $database);

if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}

// Check if the form was submitted
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Handle course addition
    if (isset($_POST['add_course'])) {
        $course_name = mysqli_real_escape_string($conn, $_POST['course_name']);
        $price = mysqli_real_escape_string($conn, $_POST['price']);
        $description = mysqli_real_escape_string($conn, $_POST['description']);

        // File upload handling
        $course_photo = '';

        if (isset($_FILES['course_photo']) && $_FILES['course_photo']['error'] === UPLOAD_ERR_OK) {
            $targetDir = 'uploads/'; // Directory for uploaded photos
            $fileName = $_FILES['course_photo']['name'];
            $targetFilePath = $targetDir . $fileName;

            // Move the uploaded file to the target directory
            if (move_uploaded_file($_FILES['course_photo']['tmp_name'], $targetFilePath)) {
                $course_photo = $targetFilePath;
            } else {
                echo 'Error uploading the course photo.';
            }
        }

        $sql = "INSERT INTO courses (course_name, course_photo, price, description)
                VALUES ('$course_name', '$course_photo', '$price', '$description')";

        if (mysqli_query($conn, $sql)) {
            header('Location: ' . $_SERVER['PHP_SELF'] . '?course_added=1');
            exit();
        } else {
            echo 'Error: ' . mysqli_error($conn);
        }
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <style>
        body {
            font-family: Arial, sans-serif;
        }
        h1 {
            background-color: #333;
            color: #fff;
            padding: 10px;
        }
        .container {
            max-width: 800px;
            margin: 0 auto;
            padding: 20px;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }
        table, th, td {
            border: 1px solid #ccc;
        }
        th, td {
            padding: 8px;
            text-align: left;
        }
        th {
            background-color: #f2f2f2;
        }
        .form-label {
            font-weight: bold;
        }
        .form-input {
            width: 100%;
            padding: 10px;
            margin-bottom: 15px;
        }
        .form-textarea {
            width: 100%;
            padding: 10px;
            margin-bottom: 15px;
        }
        .form-submit {
            background-color: #333;
            color: #fff;
            padding: 10px 20px;
            border: none;
            cursor: pointer;
        }
    </style>
</head>
<body>
    <h1>Admin Course Page</h1>

    <?php
    if (isset($_GET['course_added'])) {
        echo '<p>Course added successfully!</p>';
    }
    ?>

    <h2>Course List</h2>
    <table>
        <tr>
            <th>Course Name</th>
            <th>Price</th>
            <th>Actions</th>
        </tr>

        <?php
        
        $query = "SELECT * FROM courses";
        $result = mysqli_query($conn, $query);
    
        while ($row = mysqli_fetch_assoc($result)) {
            echo '<tr>';
            echo '<td>' . $row['course_name'] . '</td>';
            echo '<td>$' . $row['price'] . '</td>';
            echo '<td><img src="' . $row['course_photo'] . '" alt="Course Photo" style="max-width: 100px; max-height: 100px;"></td>';
            echo '<td><a href="edit_course.php?id=' . $row['course_id'] . '">Edit</a> | <a href="delete_course.php?id=' . $row['course_id'] . '">Delete</a></td>';
            echo '</tr>';
        }
        ?>
       
    </table>

    <h2>Add a New Course</h2>
    <form method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>" enctype="multipart/form-data">
        <label for="course_name" class="form-label">Course Name:</label>
        <input type="text" name="course_name" id="course_name" class="form-input" required>

        <label for="course_photo" class="form-label">Course Photo (URL or file path):</label>
        <input type="file" name="course_photo" id="course_photo" class="form-input" accept="image/*">

        <label for="price" class="form-label">Price:</label>
        <input type="text" name="price" id="price" class="form-input" required>

        <label for="description" class="form-label">Description:</label>
        <textarea name="description" id="description" class="form-textarea" rows="4" required></textarea>

        <button type="submit" name="add_course" class="form-submit">Add Course</button>
    </form>
</body>
</html>
