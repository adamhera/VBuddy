<?php
session_start();

// Check if the form is submitted
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Retrieve the form data
    $assignID = $_POST['assignID'];
    $topicID = $_POST['topicID'];
    $menteeID = $_POST['menteeID'];
    $dateAttend = $_POST['dateAttend'];
    $attendanceCheckbox = isset($_POST['attendanceCheckbox']) ? $_POST['attendanceCheckbox'] : '';

    // Validate and sanitize the input if needed

    // Perform the database update
    $dbconn = mysqli_connect("localhost", "root", "", "vbuddy");
    if (!$dbconn) {
        die("Connection failed: " . mysqli_connect_error());
    }

    // Update the ATTENDSTATUS column based on the checkbox value
    if (!empty($attendanceCheckbox)) {
        $attendStatus = 'present';
    } else {
        $attendStatus = 'absent';
    }

    // Update the attendance record
    $sql = "UPDATE attendance SET ATTENDSTATUS = '$attendStatus' WHERE ASSIGNID = '$assignID' AND TOPICID = '$topicID' AND MENTEEID = '$menteeID' AND DATEATTEND = '$dateAttend'";
    $result = mysqli_query($dbconn, $sql);

    if ($result) {
        // Redirect back to the attendance page
        header("Location: attendance.php");
        exit();
    } else {
        echo "Error updating attendance: " . mysqli_error($dbconn);
    }

    mysqli_close($dbconn);
} else {
    // If the form is not submitted, redirect back to the attendance page
    header("Location: attendance.php");
    exit();
}
