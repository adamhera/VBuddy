<?php
include("dbconn.php");
$assignid = $_GET['assignid'];

$sql = "SELECT A.ASSIGNID, E.COURSEID, U.NAME, U.AGE, U.EMAIL, U.PHONE_NUMBER, U.GENDER
		FROM USER U JOIN ENROLL E ON U.USERID = E.USERID
		JOIN ASSIGN A ON U.USERID = A.MENTORID
		WHERE A.ASSIGNID = '$assignid';";
		
$result = mysqli_query($dbconn, $sql) or die(mysqli_error($dbconn));

$json = array(); // Create an empty array to store the data

while ($r = mysqli_fetch_assoc($result)) {
    $json[] = $r; // Append each row to the array
}
echo json_encode($json, JSON_UNESCAPED_UNICODE);
mysqli_free_result($result);
mysqli_close($dbconn);
?>