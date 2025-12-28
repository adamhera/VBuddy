<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);
include("dbconn.php");

if (isset($_POST['submit'])) {
    /* Capture values from the HTML form */
    // Get the studID from the form submission
    $username = $_POST['name'];
    $studID = $_POST['studID'];

// Query the database to check if studID exists
$sql = "SELECT * FROM user WHERE USERID = '$studID'";
$result = mysqli_query($dbconn, $sql);

if ($result) {
    if (mysqli_num_rows($result) > 0) {
        // studID exists in the database, update the LEVELID to 1
        $updateSql = "UPDATE user SET LEVELID = 2 WHERE USERID = '$studID'";
        if (mysqli_query($dbconn, $updateSql)) {
            echo "<script>alert('LEVELID updated successfully. You can now login with your credentials.');window.location.href = 'login.html';</script>";

        } else {
            echo "Error updating LEVELID: " . mysqli_error($dbconn);
        }
    } else {
        echo "Invalid studID. Please try again.";
    }
} else {
    echo "Error retrieving data: " . mysqli_error($dbconn);
}

// Close the database connection
mysqli_close($dbconn);
}
?>