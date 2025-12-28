<?php
include 'C:\xampp\htdocs\MainVbuddy\MentorDashboard\Dashboard\dbconn.php';

session_start();
if (isset($_SESSION['username'])) {
    $username = $_SESSION['username'];

    // Query the database to retrieve user data
    $sql = "SELECT * FROM user WHERE username = '$username'";
    $result = mysqli_query($dbconn, $sql);

    // If there is data in the result, then the code runs
    if ($result && mysqli_num_rows($result) > 0) {
        $row = mysqli_fetch_assoc($result);
        $userID = $row['USERID'];
        $name = $row['NAME'];
        $age = $row['AGE'];
        $email = $row['EMAIL'];
        $address = $row['ADDRESS'];
        $phoneNumber = $row['PHONE_NUMBER'];
        $gender = $row['GENDER'];

        // Check if form is submitted
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            // Get the updated values from the form
			$newName= $_POST['name'];
			$newAge = $_POST['age'];
            $newUsername = $_POST['username'];
            $newEmail = $_POST['email'];
            $newAddress = $_POST['address'];
            $newPhoneNumber = $_POST['phoneNumber'];

            // Update the user data in the database
            $updateSql = "UPDATE user SET username = '$newUsername',name = '$newName', age = '$newAge',email = '$newEmail', address = '$newAddress', phone_number = '$newPhoneNumber' WHERE userid = '$userID'";
            $updateResult = mysqli_query($dbconn, $updateSql);

            if ($updateResult) {
                // Update the session variable with the new username
                $_SESSION['username'] = $newUsername;

                echo "<script>alert('Profile Updated Successfully');";
                echo 'window.location.href = "editprofile.php"';
                echo '</script>';
            } else {
                echo "<script>alert('Failed to Update Profile, Please Try Again');</script>";
            }
        }
    } else {
        echo "<script>alert('No Data Found. Please Check Back or contact the admin.');</script>";
    }
} else {
    echo "<script>alert('Session username not set.');</script>";
}

// Close the database connection
mysqli_close($dbconn);
?>

