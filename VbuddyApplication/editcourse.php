<?php
include("dbconn.php");
$coursesid=@$_GET['courseid'];
$courseid=@$_POST['courseid'];
$coursename=@$_POST['coursename'];
$coursedesc=@$_POST['coursedesc'];
$coursesemester=@$_POST['coursesem'];

$sql="update course set COURSEID='$courseid', COURSENAME='$coursename', COURSEDESC='$coursedesc', COURSESEMESTER='$coursesemester' where COURSEID='$coursesid'";
$res=mysqli_query($dbconn,$sql) or die(mysqli_error($dbconn));
if ($res===true) echo "OK_EDIT";
mysqli_close($dbconn);
?>
