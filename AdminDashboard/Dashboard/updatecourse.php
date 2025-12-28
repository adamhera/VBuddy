<?php
session_start();
include 'c:\xampp\htdocs\MainVbuddy\AdminDashboard\datavbuddy.php';

if (isset($_SESSION['username'])) {
    // Check if the form is submitted
    if (isset($_POST['submit'])) {
        // Get the updated values from the form
		$oldcourseid= $_POST['oldcourseid'];
        $courseid= $_POST['courseid'];
        $coursename = $_POST['coursename'];
        $coursedesc = $_POST['coursedesc'];
        $coursesem = $_POST['coursesem'];

        // Update the feedback in the database
        $sql = "UPDATE COURSE SET courseid ='$courseid', COURSENAME = '$coursename', COURSEDESC = '$coursedesc', COURSESEMESTER = '$coursesem' WHERE COURSEID = '$oldcourseid'";
        $result = mysqli_query($conn, $sql);

        if ($result) {
            echo "Feedback updated successfully.";
            // Redirect to the desired page after updating the feedback
            header("Location: coming.php");
            exit();
        } else {
            echo "Error updating feedback: " . mysqli_error($conn);
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
$conn->close();
?>
