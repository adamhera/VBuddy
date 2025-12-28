<?php
session_start();
include("dbconn.php");

if (isset($_SESSION['username'])) {
    // Check if the form is submitted
    if (isset($_POST['submit'])) {
        // Get the updated values from the form
        $topicid = $_POST['topicid'];
        $memberid = $_POST['memberid'];
        $feedback = $_POST['feedback'];
        $suggestion = $_POST['suggestion'];

        // Update the feedback in the database
        $sql = "UPDATE feedback SET feedback = '$feedback', suggestion = '$suggestion' WHERE topicid = '$topicid' AND memberid = '$memberid'";
        $result = mysqli_query($dbconn, $sql);

        if ($result) {
            echo "Feedback updated successfully.";
            // Redirect to the desired page after updating the feedback
            header("Location: report.php");
            exit();
        } else {
            echo "Error updating feedback: " . mysqli_error($dbconn);
        }
    } else {
        echo "Form not submitted.";
    }
} else {
    // Redirect to the login page if the user is not logged in
    header("Location: ../Vbuddy/login.html");
    exit();
}

// Close the database connection
$dbconn->close();
?>
