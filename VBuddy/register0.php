<?php
session_start();
// Include database connection settings
include("dbconn.php");

if (isset($_POST['submit'])) {
    /* Capture values from the HTML form */
    $name = $_POST['name'];
    $userid = $_POST['userid'];
    $age = $_POST['age'];
    $homeAddress = $_POST['homeAddress'];
    $email = $_POST['email'];
    $phone_number = $_POST['phone_number'];
    $gender = $_POST['gender'];
    $username = $_POST['username'];
    $password = $_POST['password'];

    $sql0 = "SELECT userid FROM user WHERE userid = '$userid'";
    $query0 = mysqli_query($dbconn, $sql0) or die("Error: " . mysqli_error($dbconn));
    $row0 = mysqli_num_rows($query0);

    if ($row0 != 0) {
        echo "Record already exists.";
    } else {
        /* execute SQL INSERT command */
        $sql2 = "INSERT INTO user (userid, username, password, name, age, email, address, phone_number, gender)
                VALUES ('$userid', '$username', '$password', '$name', '$age', '$email', '$homeAddress', '$phone_number', '$gender')";
        mysqli_query($dbconn, $sql2) or die("Error: " . mysqli_error($dbconn));

        /* display a success message */
        echo "<script>alert('Registered successfully. Click \'OK\' to select your role.');window.location.href = 'bforedash3.html';</script>";
exit();

		exit();
    }
}

/* close db connection */
mysqli_close($dbconn);
?>
