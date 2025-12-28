<?php
session_start();
include("dbconn.php");

if (isset($_SESSION['userid'])) {
    $userid = $_SESSION['userid'];
} else {
    // Redirect to the login page if the user is not logged in
    header("Location: login.html");
    exit();
}
?>

<html>
<body>
  <h1>Message from the mentor:</h1>
  <?php
    // Retrieve data from the MenteeGet table
    $selectdata = "SELECT getmessage FROM MenteeGet WHERE userID = $userid";
    $result = mysqli_query($dbconn, $selectdata);

    if ($result) {
        // Check if there are any rows returned
        if (mysqli_num_rows($result) > 0) {
            // Iterate over the rows and display the messages
            while ($row = mysqli_fetch_assoc($result)) {
                echo "<p>" . $row['getmessage'] . "</p>";
            }
        } else {
            echo "No messages found";
        }
    } else {
        echo "Error retrieving data: " . mysqli_error($dbconn);
    }

    // Close the database connection
    mysqli_close($dbconn);
  ?>
</body>
</html>
