<?php
session_start();

/* Include the db connection file */
include("dbconn.php");

// if user is logged in successfully, all data from username will be displayed in indexmenteedash.php
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
		
}
} else {
    // Redirect to the login page if the user is not logged in
    header("Location: ../Vbuddy/login.html");
    exit();
}


?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8" />
  <meta http-equiv="X-UA-Compatible" content="IE=edge" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Mentee Dashboard</title>
  <link rel="shortcut icon" href="images/university.png" />
  <link href="https://fonts.googleapis.com/icon?family=Material+Icons+Sharp" rel="stylesheet" />
  <link rel="stylesheet" href="css/style.css" />
  <script src="https://kit.fontawesome.com/2b25f4f529.js" crossorigin="anonymous"></script>
  <link rel="stylesheet" href="css3/style.css">

    <style>
        .exam.timetable2 {
            margin-top: 20px; /* Adjust the value as needed */
        }
        header {
            position: relative;
        }

        .exam {
            display: flex;
            align-items: center;
            justify-content: center;
            flex-direction: column;
            height: auto;
            width: 80%;
            margin: auto;
        }
		
		.center {
		  margin: auto;
		  width: 100%;
		  padding: 10px;
		}
    </style>
</head>

<!-- Navigation button for mentee dashboard -->
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
      
        <a href="discussion.php" onclick="timeTableAll()" class="active">
        <i class="fa-regular fa-clipboard fa-lg"></i>
        <h3 style= font-size:10px>Discussion</h3>
      </a>
	  
	  
      <a href="feedback.php" onclick="timeTableAll()">
        <i class="fa-regular fa-clipboard fa-lg"></i>
        <h3 style= font-size:10px>Feedback</h3>
      </a>
	  
	  <a href="password.php">
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

   <main>
       
         <div class="exam timetable">
          <h2>List of Topic Available</h2>
        <span class="closeBtn" onclick="timeTableAll()">X</span>
        <table>
          <thead>
              <tr>
                <th>TOPICID</th>
                <th>TOPIC NAME</th>
                <th>DATE CREATED</th>
                <th>PLATFORM</th>
                <th>GROUP</th>
                <th>ACTION</th>
              </tr>
         </thead>
        
         <?php
        
        $query = "SELECT a.*,b.MENTEEID,c.USERNAME,c.USERID FROM TOPIC a JOIN mentee b JOIN user c 
WHERE a.ASSIGNID = b.ASSIGNID AND b.MENTEEID=c.USERID AND c.USERNAME='$username' AND b.ASSIGNID=a.ASSIGNID
ORDER BY a.TOPICID ASC
";
        $result = mysqli_query($dbconn, $query);
        while ($row = mysqli_fetch_array($result)) {
        ?>
        
          <tbody>
              <td><?php echo $row['TOPICID']; ?></td>
              <td><?php echo $row['TOPIC']; ?></td>
              <td><?php echo $row['DATE']; ?></td>
              <td><?php echo $row['PLATFORM']; ?></td>
              <td><?php echo $row['ASSIGNID']; ?></td>
              <td>
                <a href=" chat.php?topicid=<?php echo $row['TOPICID']; ?>&userid=<?php echo $row['USERID']; ?>&groupid=<?php echo $row['ASSIGNID']; ?>">Enter Chat Room</a>
              </td>
          
        <?php
        }
        ?>
        </table>
        </div>
        <p> <center> *Note: Please click "Enter Chat Room" to enter discussion with your mentor.</center></p>
    </main>
 <br />
    <br />
	
</body>

 <script src="app.js"></script>
</html>