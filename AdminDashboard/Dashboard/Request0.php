<?php
session_start();

/* include db connection file */
include("dbconn.php");
if(isset($_POST['Submit'])){
	/* capture values from HTML form */
	$username = $_POST['username'];
	$password = $_POST['password'];
	if($username == "admin" && $password == "admin"){
		$_SESSION['username'] = "Administrator";
		header("Location: menuAdmin.php");
	}
// continue next slide…
// continue from previous slide…
	else{
	/* execute SQL command */
		$sql= "SELECT * FROM student WHERE 	studentusername= '$username' AND studentpassword= '$password'";
		$query = mysqli_query($dbconn, $sql) or die("Error: " . 			mysqli_error($dbconn));
		$row = mysqli_num_rows($query);
		if($row == 0){
		echo "Invalid Username/Password. Click here to <a href='login.php'>login</a>.";
		}
// continue next slide…
// continue from previous slide…
	else{
		$r = mysqli_fetch_assoc($query);
		$_SESSION['username'] = $r['studentname'];
		header("Location: menu.php");
	}
	}
}
mysqli_close($dbconn);?>