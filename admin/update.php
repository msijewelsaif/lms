<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $data = json_decode(file_get_contents('php://input'), true);

    $oldName = $data['oldName'];
    $newName = $data['newName'];

    $filename = "attendance_log.txt";
    $contents = file_get_contents($filename);

    $contents = str_replace($oldName, $newName, $contents);

    if (file_put_contents($filename, $contents)) {
        echo "Attendance data has been updated.";
    } else {
        header("HTTP/1.0 500 Internal Server Error");
        echo "Failed to update attendance data.";
    }
} else {
    header("HTTP/1.0 400 Bad Request");
    echo "Invalid request.";
}
?>
