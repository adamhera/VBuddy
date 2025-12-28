<?php
include("dbconn.php");
$userid=@$_GET['userid'];

$deleteEnroll = "DELETE FROM ENROLL WHERE USERID = '$userid'";
$res=mysqli_query($dbconn,$deleteEnroll) or die(mysqli_error($dbconn));
$deleteUser = "DELETE FROM USER WHERE USERID = '$userid'";
$res1=mysqli_query($dbconn,$deleteUser) or die(mysqli_error($dbconn));
if ($res===true && $res1===true) echo "OK_EDIT";
mysqli_close($dbconn);
?>
