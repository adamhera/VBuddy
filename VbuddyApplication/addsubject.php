<?php
include ('dbconn.php');
$coursecode = @$_POST['scode'];
$coursename = @$_POST['sname'];
$coursedescription = @$_POST['sdesc'];
$coursesemester = @$_POST['ssem'];
$sql = "INSERT INTO course (COURSEID, COURSENAME, COURSEDESC, COURSESEMESTER, COURSESTATUS) 
        VALUES ('$coursecode', '$coursename', '$coursedescription', '$coursesemester', 'active')";
		
$res = mysqli_query($dbconn, $sql) or die(mysqli_error($dbconn));

if ($res == 1) {
    echo "OK";
}
mysqli_close($dbconn);
