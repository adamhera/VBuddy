<?php
include("dbconn.php");
$mentorUsername = $_GET['username'];

$sql = "SELECT u.USERID, u.NAME, u.AGE, u.EMAIL, u.PHONE_NUMBER, u.GENDER FROM USER u JOIN MENTEE m ON u.USERID = m.MENTEEID JOIN ASSIGN a ON m.ASSIGNID = a.ASSIGNID JOIN USER mtr ON mtr.USERID = a.MENTORID WHERE mtr.USERNAME = '$mentorUsername'";
$result = mysqli_query($dbconn, $sql) or die(mysqli_error($dbconn));

$json = array(); // Create an empty array to store the data

while ($r = mysqli_fetch_assoc($result)) {
    $json[] = $r; // Append each row to the array
}
echo json_encode($json, JSON_UNESCAPED_UNICODE);
mysqli_free_result($result);
mysqli_close($dbconn);
?>