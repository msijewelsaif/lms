<?php
$filename = "attendance_log.txt";

if (file_exists($filename)) {
    if (unlink($filename)) {
        echo "Attendance data has been deleted.";
    } else {
        header("HTTP/1.0 500 Internal Server Error");
        echo "Failed to delete attendance data.";
    }
} else {
    header("HTTP/1.0 404 Not Found");
    echo "Attendance data file not found.";
}
?>
