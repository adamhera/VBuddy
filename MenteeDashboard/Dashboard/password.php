<?php 

include ("dbconn.php");
?>

<?php
session_start();
if (isset($_SESSION['username'])) {
    $username = $_SESSION['username'];

    // Query the database to retrieve user data
    $sql = "SELECT userID, username, name FROM user WHERE username = '$username'";
    $result = mysqli_query($dbconn, $sql);

    // If there is data in the result, then the code runs
    if ($result && mysqli_num_rows($result) > 0) {
        $row = mysqli_fetch_assoc($result);
        $userID = $row['userID'];
        // Rest of the code

    ?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8" />
  <meta http-equiv="X-UA-Compatible" content="IE=edge" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Mentor Dashboard</title>
  <link rel="shortcut icon" href="images/university.png" />
  <link href="https://fonts.googleapis.com/icon?family=Material+Icons+Sharp" rel="stylesheet" />
  <link rel="stylesheet" href="css/style.css" />
  <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Rounded:opsz,wght,FILL,GRAD@20..48,100..700,0..1,-50..200">
  <script src="https://kit.fontawesome.com/2b25f4f529.js" crossorigin="anonymous"></script>
  <script src="script.js" defer></script>

  <style>
    header {
      position: relative;
    }

    .change-password-container {
      display: flex;
      align-items: center;
      justify-content: center;
      width: 100%;
      height: 88vh;
    }

    .change-password-container form {
      display: flex;
      flex-direction: column;
      justify-content: center;
      border-radius: var(--border-radius-2);
      padding: 3.5rem;
      background-color: var(--color-white);
      box-shadow: var(--box-shadow);
      width: 95%;
      max-width: 32rem;
    }

    .change-password-container form:hover {
      box-shadow: none;
    }

    .change-password-container form input[type="password"] {
      border: none;
      outline: none;
      border: 1px solid var(--color-light);
      background: transparent;
      height: 2rem;
      width: 100%;
      padding: 0 0.5rem;
    }

    .change-password-container form .box {
      padding: 0.5rem 0;
    }

    .change-password-container form .box p {
      line-height: 2;
    }

    .change-password-container form h2+p {
      margin: 0.4rem 0 1.2rem 0;
    }

    .btn {
      background: none;
      border: none;
      border: 2px solid var(--color-primary) !important;
      border-radius: var(--border-radius-1);
      padding: 0.5rem 1rem;
      color: var(--color-white);
      background-color: var(--color-primary);
      cursor: pointer;
      margin: 1rem 1.5rem 1rem 0;
      margin-top: 1.5rem;
    }

    .btn:hover {
      color: var(--color-primary);
      background-color: transparent;
    }
  </style>
</head>

<!-- button navigation for mentor dashboard -->
<body>
  <header>
    <div class="logo" title="Student Dashboard">
      <a rel="noopener" href="index.html">
        <img src="images/university.png" alt="" />
      </a>
	  
      <a href="indexmenteedash.php">
        <h2>Mentee Dashboard</h2>
      </a>
    </div>
	
    <div class="navbar">
      <a href="indexmenteedash.php" >
        <i class="fa-solid fa-house fa-lg"></i>
        <h3 style= font-size:10px>Home</h3>
      </a>
	  
      <a href="display.php">
        <i class="fa-solid fa-paperclip fa-lg"></i>
        <h3 style= font-size:10px>Announcement</h3>
      </a>
	  
	  <a href="attendance.php">
        <i class="fa-solid fa-paperclip fa-lg"></i>
        <h3 style= font-size:10px>Attendance</h3>
      </a>
      
        <a href="discussion.php" onclick="timeTableAll()" >
        <i class="fa-regular fa-clipboard fa-lg"></i>
        <h3 style= font-size:10px>Discussion</h3>
      </a>
	  
	  
      <a href="feedback.php" onclick="timeTableAll()">
        <i class="fa-regular fa-clipboard fa-lg"></i>
        <h3 style= font-size:10px>Feedback</h3>
      </a>
	  
	  <a href="password.php" class="active">
        <span class="material-icons-sharp">password</span>
        <h3  style= font-size:10px>Change Password</h3>
      </a>
    
      <a href="logout.php">
        <i class="fa-solid fa-right-from-bracket fa-lg"></i>
        <h3 style= font-size:10px>Logout</h3>
      </a>
    </div>
	
    <div id="profile-btn">
      <i class="fa-light fa-user fa-lg"></i>
    </div>
    <div class="theme-toggler">
      <span class="material-icons-sharp active">light_mode</span>
      <span class="material-icons-sharp">dark_mode</span>
    </div>
  </header>

  <div class="change-password-container">
    <form method="POST" action="password0.php">
	  <h2><b>Create new password</b></h2>
		  <p class="text-muted">
			Your new password must be different from previously used passwords.
		  </p>
	  <input type="hidden" name="userID" value="<?php echo $userID; ?>">
	  <div class="box">
			<p class="text-muted">Current Password</p>
			<input type="password" name="currentpass" id="currentpass" />
	  </div>
	  <div class="box">
			<p class="text-muted">New Password</p>
			<input type="password" name="newpass" id="newpass" />
	  </div>
	  <div class="box">
			<p class="text-muted">Confirm Password</p>
			<input type="password" name="confirmpass" id="confirmpass" />
	  </div>
	  <div class="button">
			<input type="submit" value="Save" name="submit" class="btn" />
			<a href="index2.php" class="text-muted">Cancel</a>
	  </div>
	  <a href="#">
		<p>Forget password?</p>
	  </a>
</form>

  </div>
  	<footer>
        <div class="footer-container">
            <p><center>Copyright &copy 2023 All rights reserved | QuadraTech </center></p>

        </div>
    </footer>
</body>

<script src="app.js"></script>

</html>

    <?php
    } else {
        echo "No user data found.";
    }
} else {
    echo "Session username not set.";
}

// Close the database connection
mysqli_close($dbconn);
?>