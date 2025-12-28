<?php
// Include database connection settings
include("dbconn.php");

if(isset($_POST['Submit'])) {
    // Capture values from HTML form
    $email = $_POST['email'];
    $newPassword = $_POST['newpassword'];
    $confirmPassword = $_POST['confirmpassword'];

    // Check if the new password and confirm password match
    if ($newPassword !== $confirmPassword) {
        // Passwords don't match
        echo "<script>alert('Error: New password and confirm password do not match.'); window.location.href = 'recover.html';</script>";
        exit();
    }

    // Update the password in the database for the given email
    $sql = "UPDATE user SET password = '$newPassword' WHERE email = '$email'";
    $query = mysqli_query($dbconn, $sql) or die("Error: " . mysqli_error($dbconn));

    if ($query) {
        // Password update successful
        echo "<script>alert('Password has been successfully updated.'); window.location.href = 'login.html';</script>";
        exit();
    } else {
        // Password update failed
        echo "<script>alert('Error updating password. Please try again.'); window.location.href = 'recover.html';</script>";
        exit();
    }
}

mysqli_close($dbconn);
?>
