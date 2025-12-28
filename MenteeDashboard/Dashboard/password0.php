<?php
include("dbconn.php");
session_start();

if (isset($_POST['userID'])) {
    $userID = $_POST['userID'];
    $currentpass = $_POST['currentpass'];
    // Retrieve the new password from the form
    $newPassword = $_POST['newpass'];

    // Retrieve the new confirmed password from the form
    $confirmNew = $_POST['confirmpass'];

    // Validate and sanitize the input if necessary

    // Establish a connection to the database
    include 'c:\xampp\htdocs\MainVbuddy\AdminDashboard\datavbuddy.php';

    // Retrieve the old password from the database
    $oldPasswordQuery = "SELECT password FROM user WHERE userID = '$userID'";
    $oldPasswordResult = mysqli_query($dbconn, $oldPasswordQuery);

    if ($oldPasswordResult && mysqli_num_rows($oldPasswordResult) > 0) {
        $row = mysqli_fetch_assoc($oldPasswordResult);
        $oldPassword = $row['password'];

        // Check if the old password is the same as the password retrieved from the database
        if ($currentpass === $oldPassword) {
            // Check if the new password is the same as the old password
            if ($newPassword === $oldPassword) {
                // Display the error message using JavaScript
                echo "<script>alert('Error: New password should be different from the old password.');</script>";
                // Redirect to password.php after the alert is clicked
                echo '<script>var redirectToPassword = function() { window.location.href = "password.php"; };';
                echo 'alert("Error: New password should be different from the old password.");';
                echo 'setTimeout(redirectToPassword, 0);</script>';
                exit; // Stop further execution of the code
            } else {
                // Check if the new password matches the confirmed password
                if ($newPassword === $confirmNew) {
                    // Update the password in the database
                    $updateSql = "UPDATE user SET password = '$newPassword' WHERE userID = '$userID'";
                    $updateResult = mysqli_query($dbconn, $updateSql);

                    if ($updateResult) {
                        // Password update successful
                        echo "<script>alert('Password Updated Successfully');</script>";
                    } else {
                        // Password update failed
                        echo "<script>alert('Error updating password.');</script>";
                    }
                } else {
                    // Display error message when the new password and confirmed password do not match
                    echo "<script>alert('Error: Password is not the same as the confirm password, please try again.');</script>";
                }
            }
        } else {
            // Display error message when the old password entered is not the same as the one from the database
            echo "<script>alert('Error: Old password is incorrect. Please re-enter the form.');</script>";
        }
    } else {
        echo "<script>alert('Error: Failed to retrieve the old password.');</script>";
    }
} else {
    // Handle the case when userID is not provided
    echo "<script>alert('Invalid request.');</script>";
}

// Redirect to password.php after the alert is clicked
echo '<script>var redirectToPassword = function() { window.location.href = "password.php"; };';
echo 'setTimeout(redirectToPassword, 0);</script>';
exit;
?>
