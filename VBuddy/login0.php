<?php
session_start();

/* include db connection file */
include("dbconn.php");

if(isset($_POST['Submit'])){
    /* capture values from HTML form */
    $username = $_POST['username'];
    $password = $_POST['password'];

    $sql= "SELECT username, password, levelid FROM user WHERE username= '$username' AND password= '$password' and status='approved' ";
    $query = mysqli_query($dbconn, $sql) or die ("Error: " . mysqli_error());
    $row = mysqli_num_rows($query);

    if($row == 0){
        // Redirect back to the login page with incorrect credentials parameter
        echo "<script>alert('Invalid username or password. Please try again.'); window.location.href = 'login.html';</script>";
		exit();
    } else {
        $r = mysqli_fetch_assoc($query);
        $username = $r['username'];
        $level = $r['levelid'];

        if($level == 1) {
            $_SESSION['username'] = $r['username'];
			header("Location: ../AdminDashboard/Dashboard/index2.php");
			exit();

        } elseif($level == 2) {
            $_SESSION['username'] = $r['username'];
            header("Location: ../MentorDashboard/Dashboard/indexmentodash.php");
			exit();
			
        } elseif ($level == 3){
             $_SESSION['username'] = $r['username'];
            header("Location: ../MenteeDashboard/Dashboard/indexmenteedash.php");
            exit();
        } elseif ($level == 0){
             $_SESSION['username'] = $r['username'];
            header("Location: level0.php");
            exit();
        }
		
		
		
		
		else {
            header('Location: register.html');
        }
    }
}
mysqli_close($conn);
?>
