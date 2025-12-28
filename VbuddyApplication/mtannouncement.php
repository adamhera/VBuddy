<?php
include("dbconn.php");
$username = $_GET['username'];

$sql = "SELECT t.*
FROM USER u
JOIN MENTEE m ON u.USERID = m.MENTEEID
JOIN TOPIC t ON m.ASSIGNID = t.ASSIGNID
WHERE u.USERNAME = '$username'";

$result = mysqli_query($dbconn, $sql) or die(mysqli_error($dbconn));

$json = array(); // Create an empty array to store the data

while ($r = mysqli_fetch_assoc($result)) {
    $json[] = $r; // Append each row to the array
}
echo json_encode($json, JSON_UNESCAPED_UNICODE);
mysqli_free_result($result);
mysqli_close($dbconn);
?>