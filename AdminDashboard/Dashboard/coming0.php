<?php
session_start();
// Include database connection settings
include 'c:\xampp\htdocs\MainVbuddy\AdminDashboard\datavbuddy.php';

if (isset($_POST['submit'])) {
    /* Capture values from the HTML form */
    $courseid = $_POST['courseid'];
    $coursename = $_POST['coursename'];
    $coursedesc = $_POST['coursedesc'];
    $coursesem = $_POST['coursesem'];

    $sql0 = "SELECT COURSEID FROM course WHERE courseid = '$courseid'";
    $query0 = mysqli_query($conn, $sql0) or die("Error: " . mysqli_error($conn));
    $row0 = mysqli_num_rows($query0);

    if ($row0 != 0) {
        echo "Record already exists.";
    } else {
        /* execute SQL INSERT command */
        $sql2 = "INSERT INTO course (courseid, coursename, coursedesc, coursesemester)
                VALUES ('$courseid', '$coursename', '$coursedesc', '$coursesem')";
        mysqli_query($conn, $sql2) or die("Error: " . mysqli_error($conn));

        /* display a success message */
        echo "<script>alert('Course Added successful.');window.location.href = 'coming.php';</script>";
		exit();
    }
}

/* close db connection */
mysqli_close($conn);
?>
