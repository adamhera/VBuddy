<?php
include("dbconn.php");
$userid=@$_GET['userid'];

$sql="update enroll set STATUS='approved' where USERID='$userid'";
$res=mysqli_query($dbconn,$sql) or die(mysqli_error($dbconn));
if ($res===true) echo "OK_EDIT";
mysqli_close($dbconn);
?>