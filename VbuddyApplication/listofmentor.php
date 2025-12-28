<?php
include("dbconn.php");
$username = $_GET['username'];

$sql = "SELECT M.*, A.ASSIGNID, A.COURSEID
		FROM USER AS U
		JOIN MENTEE AS ME ON U.USERID = ME.MENTEEID
		JOIN ASSIGN AS A ON ME.ASSIGNID = A.ASSIGNID
		JOIN USER AS M ON A.MENTORID = M.USERID
		WHERE U.USERNAME = '$username';";
		
$result = mysqli_query($dbconn, $sql) or die(mysqli_error($dbconn));

$json = array(); // Create an empty array to store the data

while ($r = mysqli_fetch_assoc($result)) {
    $json[] = $r; // Append each row to the array
}
echo json_encode($json, JSON_UNESCAPED_UNICODE);
mysqli_free_result($result);
mysqli_close($dbconn);
?>