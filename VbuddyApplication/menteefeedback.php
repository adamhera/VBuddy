<?php
include ('dbconn.php');

$username = @$_GET['username'];
$topicid = @$_POST['topicid'];
$feedback = @$_POST['feedback'];
$suggestion = @$_POST['suggestion'];

// Retrieve the USERID based on the provided USERNAME
$query = "SELECT USERID FROM USER WHERE USERNAME = '$username'";
$result = mysqli_query($dbconn, $query);

if ($result) {
    if (mysqli_num_rows($result) > 0) {
        // Fetch the USERID
        $row = mysqli_fetch_assoc($result);
        $userid = $row['USERID'];

        // Insert the feedback with the retrieved USERID
        $sql = "INSERT INTO FEEDBACK (FEEDID, TOPICID, MEMBERID, FEEDBACK, SUGGESTION)
                VALUES ('', '$topicid', '$userid', '$feedback', '$suggestion')";
		
        $res = mysqli_query($dbconn, $sql) or die(mysqli_error($dbconn));

        if ($res == 1) {
            echo "OK";
        } else {
            echo "Failed to insert feedback: " . mysqli_error($dbconn);
        }
    } else {
        echo "No user found with the provided username.";
    }
} else {
    echo "Query failed: " . mysqli_error($dbconn);
}

mysqli_close($dbconn);
?>
