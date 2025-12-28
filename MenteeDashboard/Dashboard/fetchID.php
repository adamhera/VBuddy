<?php
    include("dbconn.php");
?>

<?php
session_start();
if (isset($_SESSION['username'])) {
    $username = $_SESSION['username'];

    // Query the database to retrieve user data
    $sql = "SELECT userid, username, name FROM user WHERE username = '$username'";
    $result = mysqli_query($dbconn, $sql);

    // If there is data in the result, then the code runs
    if ($result && mysqli_num_rows($result) > 0) {
        $row = mysqli_fetch_assoc($result);
        $userid = $row['userid'];
        // Rest of the code

    } else {
        echo "No user data found.";
    }
    } else {
        echo "Session username not set.";
    }

    $result = $dbconn->query("SELECT menteeid FROM mentee");
    $menteeids = [];
    while ($row = $result->fetch_assoc()) {
        $menteeids[] = $row['menteeid'];
    }
    echo json_encode($menteeids);

// Close the database connection
mysqli_close($dbconn);
?>
