<?php
session_start();
include("dbconn.php");

if (isset($_POST['submit'])) {
    if (isset($_SESSION['userid'])) {
        $userid = $_SESSION['userid'];
    } else {
        // Redirect to the login page if the user is not logged in
        header("Location: login.html");
        exit();
    }

    $text = $_POST['announce_to_other'];
    $user = $_POST['userID'];

    // To prevent SQL injection
    $text = mysqli_real_escape_string($dbconn, $text);
    $user = mysqli_real_escape_string($dbconn, $user);

    // Create SQL query to insert data into mentor_announce table
    $insertDataQuery = "INSERT INTO mentor_announce (sentmessage, userID) VALUES ('$text', '$user')";
    $result = mysqli_query($dbconn, $insertDataQuery);

    if ($result) {
        echo "Data saved successfully\n";

        // Transfer data to the MenteeGet table
        $transferDataQuery = "INSERT INTO MenteeGet (getmessage, userID) SELECT sentmessage, userID FROM mentor_announce";
        $transferResult = mysqli_query($dbconn, $transferDataQuery);

        if ($transferResult) {
            echo "<script>alert('Data sent to mentee successfully... Return to homepage?'); window.location.href = 'indexmentodash.php';</script>";
        } else {
            echo "Error transferring data: " . mysqli_error($dbconn);
        }
    } else {
        echo "Error saving data: " . mysqli_error($dbconn);
    }

    // Check for errors during queries
    if ($result === false) {
        echo "Error executing insertDataQuery: " . mysqli_error($dbconn);
    }

    if ($transferResult === false) {
        echo "Error executing transferDataQuery: " . mysqli_error($dbconn);
    }
}

// Close the database connection
mysqli_close($dbconn);
?>