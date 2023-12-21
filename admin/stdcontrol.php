<?php
// Database connection
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "lms";

// Create a connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Handle data insertion
if (isset($_POST['insert'])) {
    $firstName = $_POST['insertFirstName'];
    $lastName = $_POST['insertLastName'];
    $gender = $_POST['insertGender'];
    $email = $_POST['insertEmail'];
    $password = $_POST['insertPassword'];
    $number = $_POST['insertNumber'];

    $sql = "INSERT INTO signup (firstName, lastName, gender, email, password, number) VALUES ('$firstName', '$lastName', '$gender', '$email', '$password', '$number')";
    if ($conn->query($sql) === TRUE) {
        echo "Data inserted successfully!";
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
}

// Handle data editing
if (isset($_POST['edit'])) {
    $id = $_POST['editId'];
    $firstName = $_POST['editFirstName'];
    $lastName = $_POST['editLastName'];
    $gender = $_POST['editGender'];
    $email = $_POST['editEmail'];
    $password = $_POST['editPassword'];
    $number = $_POST['editNumber'];

    $sql = "UPDATE signup SET firstName='$firstName', lastName='$lastName', gender='$gender', email='$email', password='$password', number='$number' WHERE id=$id";
    if ($conn->query($sql) === TRUE) {
        echo "Data updated successfully!";
    } else {
        echo "Error updating record: " . $conn->error;
    }
}

// Handle data deletion
if (isset($_POST['delete'])) {
    $id = $_POST['deleteId'];

    $sql = "DELETE FROM signup WHERE id=$id";
    if ($conn->query($sql) === TRUE) {
        echo "Data deleted successfully!";
    } else {
        echo "Error deleting record: " . $conn->error;
    }
}

// SQL query to retrieve data
$sql = "SELECT * FROM signup";
$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Data Retrieval Page</title>
    <link rel="stylesheet" href=" css/stdcontrol.css"> <!-- Include the external CSS file -->
</head>

<body>
    <div class="container">
        <h1>Student Info</h1>
        <!-- Form for data insertion -->
        <form method="POST">
            <h2>Insert Data</h2>
            <input type="text" name="insertFirstName" placeholder="First Name" required>
            <input type="text" name="insertLastName" placeholder="Last Name" required>
            <input type="text" name="insertGender" placeholder="Gender" required>
            <input type="email" name="insertEmail" placeholder="Email" required>
            <input type="password" name="insertPassword" placeholder="Password" required>
            <input type="text" name="insertNumber" placeholder="Number" required>
            <button type="submit" name="insert">Insert</button>
        </form>

        <table>
            <tr>
                <th>ID</th>
                <th>First Name</th>
                <th>Last Name</th>
                <th>Gender</th>
                <th>Email</th>
                <th>Password</th>
                <th>Number</th>
                <th>Action</th>
            </tr>
            <?php
            if ($result->num_rows > 0) {
                while ($row = $result->fetch_assoc()) {
                    echo "<tr>";
                    echo "<td>" . $row["id"] . "</td>";
                    echo "<td>" . $row["firstName"] . "</td>";
                    echo "<td>" . $row["lastName"] . "</td>";
                    echo "<td>" . $row["gender"] . "</td>";
                    echo "<td>" . $row["email"] . "</td>";
                    echo "<td>" . $row["password"] . "</td>";
                    echo "<td>" . $row["number"] . "</td>";
                    echo "<td>";
                    echo '<form method="POST">';
                    echo '<input type="hidden" name="editId" value="' . $row["id"] . '">';
                    echo '<input type="text" name="editFirstName" value="' . $row["firstName"] . '" required>';
                    echo '<input type="text" name="editLastName" value="' . $row["lastName"] . '" required>';
                    echo '<input type="text" name="editGender" value="' . $row["gender"] . '" required>';
                    echo '<input type="email" name="editEmail" value="' . $row["email"] . '" required>';
                    echo '<input type="password" name="editPassword" value="' . $row["password"] . '" required>';
                    echo '<input type="text" name="editNumber" value="' . $row["number"] . '" required>';
                    echo '<button type="submit" name="edit">Edit</button>';
                    echo '</form>';
                    echo '<form method="POST">';
                    echo '<input type="hidden" name="deleteId" value="' . $row["id"] . '">';
                    echo '<button type="submit" name="delete" class="delete-button">Delete</button>';
                    echo '</form>';
                    echo "</td>";
                    echo "</tr>";
                }
            } else {
                echo "<tr><td colspan='8'>No data available</td></tr>";
            }
            ?>
        </table>
    </div>
</body>

</html>
