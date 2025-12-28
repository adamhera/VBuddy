<?php
include("dbconn.php");
$userid = @$_GET['userid'];

$sql="select e.* , u.name from enroll e join user u ON e.userid = u.userid where e.userid = '$userid' and e.status = 'pending' ";

$res=mysqli_query($dbconn,$sql) or die(mysqli_error($dbconn));
while($r=mysqli_fetch_array($res,MYSQLI_ASSOC)){
	$json[]=$r;
}
echo json_encode($json,JSON_UNESCAPED_UNICODE);
mysqli_free_result($res);
mysqli_close($dbconn);
?>