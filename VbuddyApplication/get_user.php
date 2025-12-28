<?php

//get the parameter
$username=$_GET['username'];
$password=$_GET['password'];


//connect to db
$dbconn=mysqli_connect('localhost','root','','vbuddy') or die(mysqli_error($dbconn));

$q="SELECT * from user where username='$username'and password='$password'";
//echo $q;
$res=mysqli_query($dbconn,$q);
$r=mysqli_fetch_assoc($res);

echo json_encode($r,JSON_UNESCAPED_UNICODE);

//clear results and close the connection
mysqli_free_result($res);
mysqli_close($dbconn);

?>


