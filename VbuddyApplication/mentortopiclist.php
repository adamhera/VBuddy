<?php
include("dbconn.php");
$mentorUsername = $_GET['username'];

$sql = "SELECT a.TOPICID FROM TOPIC a JOIN assign b JOIN user c 
WHERE a.ASSIGNID = b.ASSIGNID AND b.MENTORID=c.USERID AND c.USERNAME='$mentorUsername'
ORDER BY a.TOPICID ASC";
$result = mysqli_query($dbconn, $sql) or die(mysqli_error($dbconn));

$json = array(); // Create an empty array to store the data

while ($r = mysqli_fetch_assoc($result)) {
    $json[] = $r; // Append each row to the array
}
echo json_encode($json, JSON_UNESCAPED_UNICODE);
mysqli_free_result($result);
mysqli_close($dbconn);
?>