<?php
include("dbconn.php");
$courseid=@$_GET['courseid'];

$sql="update course set COURSESTATUS='unactive' where COURSEID='$courseid'";
$res=mysqli_query($dbconn,$sql) or die(mysqli_error($dbconn));
if ($res===true) echo "OK_EDIT";
mysqli_close($dbconn);
?>