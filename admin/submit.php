<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $studentName = $_POST["studentName"];
    
    // Perform any necessary validation and security checks here.

    // Log the attendance (e.g., store in a database or a file).
    $logEntry = date("Y-m-d H:i:s") . " - $studentName" . PHP_EOL;
    file_put_contents("attendance_log.txt", $logEntry, FILE_APPEND);

    echo "Attendance marked for $studentName successfully.";
} else {
    header("Location: index.html");
}
?>
