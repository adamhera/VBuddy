<?php
include("dbconn.php");
$userid = $_GET['userid'];

$sql = "SELECT USERID, NAME, AGE, EMAIL, PHONE_NUMBER, GENDER FROM USER WHERE userid = '$userid'";
$result = mysqli_query($dbconn, $sql) or die(mysqli_error($dbconn));

$json = array(); // Create an empty array to store the data

while ($r = mysqli_fetch_assoc($result)) {
    $json[] = $r; // Append each row to the array
}
echo json_encode($json, JSON_UNESCAPED_UNICODE);
mysqli_free_result($result);
mysqli_close($dbconn);
?>