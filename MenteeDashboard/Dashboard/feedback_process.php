<?php
session_start();
include("dbconn.php");
?>
<?php

function displayProfile($username, $column)
{
    $dbconn = mysqli_connect("localhost", "root", "", "vbuddy");
    if (!$dbconn) {
        die("Connection failed: " . mysqli_connect_error());
    }

    $sql = "SELECT * FROM user WHERE USERNAME='$username'";
    $result = mysqli_query($dbconn, $sql);

    if ($result) {
        if (mysqli_num_rows($result) > 0) {
            $row = mysqli_fetch_assoc($result);
            if (isset($row[$column])) {
                return $row[$column];
            } else {
                return "No data found for column: $column";
            }
        } else {
            return "No profile found for username: $username";
        }
    } else {
        return "Error retrieving data: " . mysqli_error($dbconn);
    }

    mysqli_close($dbconn);
}
if (isset($_SESSION['username'])) {
    $username = $_SESSION['username'];
    
     // Query the database to retrieve user data
    $sql = "SELECT userID, username, name FROM user WHERE username = '$username'";
    $result = mysqli_query($dbconn, $sql);

    // If there is data in the result, then the code runs
    if ($result && mysqli_num_rows($result) > 0) {
        $row = mysqli_fetch_assoc($result);
        $userID = $row['userID'];
        // Rest of the code
        
}
} else {
    // Redirect to the login page if the user is not logged in
    header("Location: ../Vbuddy/login.html");
    exit();
}


// Check if the form is submitted
if (isset($_POST['submit'])) {

    $topicid = $_POST['topicid'];
    $userid = displayProfile($username, 'USERID');
    $feedback = $_POST['feedback'];
    $suggestion = $_POST['suggestion'];

    // Prepare the SQL statement
   $stmt = $dbconn->prepare("INSERT INTO feedback (TOPICID, MEMBERID, FEEDBACK, SUGGESTION) VALUES (?, ?, ?, ?)");
   $stmt->bind_param('ssss', $topicid, $userid, $feedback, $suggestion);


    // Execute the statement
    if ($stmt->execute()) {
       echo '<script>alert("Succesfully! Feedback is created succesfully :)");window.location.href = "feedback.php";</script>';
    } else {
        echo "Error submitting feedback: " . $stmt->error;
    }

    // Close the statement
    $stmt->close();
}

// Close the database connection
$dbconn->close();
?>

