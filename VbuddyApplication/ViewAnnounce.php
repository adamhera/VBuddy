<?php
include("dbconn.php");
$topicid = $_GET['topicid'];

$sql = "SELECT * FROM TOPIC WHERE TOPICID = '$topicid'";

$result = mysqli_query($dbconn, $sql) or die(mysqli_error($dbconn));

$json = array(); // Create an empty array to store the data

while ($r = mysqli_fetch_assoc($result)) {
    $json[] = $r; // Append each row to the array
}

echo json_encode($json, JSON_UNESCAPED_UNICODE);
mysqli_free_result($result);
mysqli_close($dbconn);
?>