<?php
/* PHP & MySQL database connection file */
$host = "localhost"; // server name or IP address
$user = "root"; // MySQL username
$pass = ""; // MySQL password
$dbname = "vbuddy"; // your database name

$dbconn = mysqli_connect($host, $user, $pass, $dbname) or die("<center>Error: " . mysqli_error($dbconn) . "</center>");
?>