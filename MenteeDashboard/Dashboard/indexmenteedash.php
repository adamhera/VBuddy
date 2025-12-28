
<?php
session_start();

/* include db connection file */
include("dbconn.php");

// if user is logged in succesfully,all data from username will be displayed in indexmenteedash.php
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
		
} else {
    // Redirect to the login page if the user is not logged in
    header("Location: ../Vbuddy/login.html");
    exit();
}

// Function to display profile information
function displayProfile($username, $column)
{
    $dbconn = mysqli_connect("localhost", "root", "", "vbuddy");
    if (!$dbconn) {
        die("Connection failed: " . mysqli_connect_error());
    }

    $sql = "SELECT * FROM user WHERE USERNAME='$username'";
    $result = mysqli_query($dbconn, $sql);

    if ($result) {
        if (mysqli_num_rows($result) > 0) {
            $row = mysqli_fetch_assoc($result);
            if (isset($row[$column])) {
                return $row[$column];
            } else {
                return "No data found for column: $column";
            }
        } else {
            return "No profile found for ID: $id";
        }
    } else {
        return "Error retrieving data: " . mysqli_error($dbconn);
    }

    mysqli_close($dbconn);
}
function displayProfile2($username, $column)
{
    $dbconn = mysqli_connect("localhost", "root", "", "vbuddy");
    if (!$dbconn) {
        die("Connection failed: " . mysqli_connect_error());
    }

    $sql = "SELECT a.COURSENAME,d.* FROM course a JOIN assign b ON a.COURSEID = b.COURSEID JOIN mentee c ON b.ASSIGNID = c.ASSIGNID JOIN topic d ON b.ASSIGNID = d.ASSIGNID JOIN user e ON e.USERID = c.MENTEEID WHERE e.username = '$username' AND c.ASSIGNID = d.ASSIGNID ORDER BY d.date DESC
LIMIT 3";

    $result = mysqli_query($dbconn, $sql);

    if ($result) {
        if (mysqli_num_rows($result) > 0) {
            $data = array();
            while ($row = mysqli_fetch_assoc($result)) {
                $data[] = $row[$column];
            }
            return $data;
        } else {
            return array(); // Return an empty array if no topics found
        }
    } else {
        return "Error retrieving data: " . mysqli_error($dbconn);
    }

    mysqli_close($dbconn);
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
  <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Rounded:opsz,wght,FILL,GRAD@20..48,100..700,0..1,-50..200">
  <script src="https://kit.fontawesome.com/2b25f4f529.js" crossorigin="anonymous"></script>
  <script src="script.js" defer></script>
  
  <style>
        .subjects {
            width: 170%;
            /* Set the desired width for the subjects box */
            margin: 0 auto;
            /* Center the subjects box horizontally within the container */
        }

        .timetable {
            width: 100%;
            /* Adjust the width as needed */
            margin: 0 auto;
            /* Center the timetable horizontally */
        }

        .request-list {
            margin-top: 20px;
            /* Adjust the value to control the spacing */
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
      <a href="indexmenteedash.php" class="active">
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
      
        <a href="discussion.php" onclick="timeTableAll()">
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
  
  
  <div class="container">
    <aside>
      <div class="profile">
        <div class="top">
          <div class="profile-photo">
            <img src="images/avatar.png" alt="monkey suprised" />
          </div>
          <div class="info">
            <p><p>Hey, Mentee <br><b><?php echo displayProfile(    $username,'USERNAME'); ?></b></p>
            <small class="text-muted"></small>
          </div>
        </div>
        <div class="about">
		
          <h5>Full Name</h5>
          <p><?php echo displayProfile(    $username,'NAME'); ?></p>
          <h5>Age</h5>
          <p><?php echo displayProfile(    $username,'AGE'); ?></p>	
          <h5>Gender</h5>
          <p><?php echo displayProfile(    $username,'GENDER'); ?></p>		  
          <h5>Contact Number</h5>
          <p><?php echo "0" . displayProfile(    $username,'PHONE_NUMBER'); ?></p>
          <h5>Email</h5>
          <p><?php echo displayProfile(    $username,'EMAIL'); ?></p>
          <h5>Address</h5>
          <p><?php echo displayProfile(    $username,'ADDRESS'); ?></p>
          <br />
		  
		  
          <a href="Profile/editprofile.php">
            <h5>Edit Profile</h5>
            <p>Edit your profile details</p>
          </a>
          <a href=" ../../Vbuddy/bforedash2.html">
            <h5>Enroll Registration</h5>
            <p>New Enroll Registration</p>
          </a>
        </div>
      </div>
    </aside>

    <main>
      <br>


       <h1>Overview</h1>
       <div class="subjects">
	         <!---First Textbox -->
			<div class="eg" style="background-color: #c1e7e3;">
			  <h3 style= font-size:20px >Total Group</h3>
			    <small class="text-muted">This is total of Group that has been assigned to you </small>
				
			
				<?php
				// Assuming you have established a database connection

				// Execute the query to retrieve the assignid for the mentor
				$query = "SELECT count(assignid) as total_group FROM mentee WHERE menteeid = '$userID'";
				$result = mysqli_query($dbconn, $query);
				$row = mysqli_fetch_assoc($result);
				$totalGroup = $row['total_group'];

					// Display the assignid
					echo "<h3 style='font-size: 45px;'>$totalGroup</h3>";
				?>


			  <small class="text-muted">Total group that has been assign to you.</small>
            </div>
			
			
			
			
	        <!---Second Textbox -->
			<div class="eg" style="background-color: #c1e7e3;">
			  <h3 style= font-size:20px >Class/Activites</h3>
			    <small class="text-muted">Total of class that has been created by mentor for you. </small>
				<?php
					// Assuming you have established a database connection

					// Execute the query to calculate the total topic count
					$query = "SELECT COUNT(*) AS total_topics
							  FROM topic t
							  INNER JOIN mentee m ON m.assignid = t.assignid
							  INNER JOIN assign a ON a.assignid = m.assignid
							  WHERE m.menteeid = '$userID'";
					$result = mysqli_query($dbconn, $query);
					$row = mysqli_fetch_assoc($result);
					$totalTopics = $row['total_topics'];

					// Inject the total topic count into the HTML template
					echo "<h3 style='font-size: 45px;'>$totalTopics</h3>";
				?>


			  <small class="text-muted">Total of class/activities that has been created by your mentor.</small>
            </div>
			
			<!---Third Textbox -->
			<div class="eg" style="background-color: #c1e7e3;">
			  <h3 style= font-size:20px >Attendance</h3>
			    <small class="text-muted">Total of new attendance that need to be sign </small>
				
				<?php
				// Assuming you have established a database connection

				// Assign the SQL query to the $query variable
				$query = "SELECT COUNT(*) AS total_attendance
						  FROM topic a
						  INNER JOIN assign u ON u.mentorid = '$userID'
						  INNER JOIN attendance att ON att.topicid = a.topicid AND att.assignid = a.assignid
						  WHERE u.assignid = a.assignid
							AND att.dateattend = CURDATE() 
							AND att.starttime <= CURTIME()
							AND att.endtime >= CURTIME()";

				$result = mysqli_query($dbconn, $query);
				$row = mysqli_fetch_assoc($result);
				$totalAttendance = $row['total_attendance'];

				// Inject the total attendance count into the HTML template
				echo "<h3 style='font-size: 45px;'>$totalAttendance</h3>";
				?>


			  <small class="text-muted">Last 24 hours ago</small>
            </div>
		  </div>
     
	 
	 <!--List of group that has been assigned to the mentee-->
	  <div class="request-list">
		<h2> </h2>
          <h2>List of Group </h2>
		  <h3>This is the list of group that has been assign to you based by you own enroll registration.</h3>
        </div>
	 <div class="timetable" id="timetable">
    <table>
        <thead>
            <tr>
                <th>Assign ID</th>
                <th>Course ID</th>
                <th>Name of Mentor</th>
                <th>Date Start</th>
                <th>Date End</th>
            </tr>
        </thead>
        <tbody>
            <?php
                $query = "SELECT a.ASSIGNID, a.COURSEID, um.NAME AS MentorName, a.DATESTART, a.DATEEND
                          FROM ASSIGN a
                          JOIN USER um ON a.MENTORID = um.USERID
                          JOIN MENTEE me ON a.ASSIGNID = me.ASSIGNID
                          JOIN USER ue ON me.MENTEEID = ue.USERID
                          WHERE ue.USERID = '$userID'";
                $result = mysqli_query($dbconn, $query);
                while ($row = mysqli_fetch_array($result)) {
            ?>
                <tr>
                    <td><?php echo $row['ASSIGNID']; ?></td>
                    <td><?php echo $row['COURSEID']; ?></td>
                    <td><?php echo $row['MentorName']; ?></td>
                    <td><?php echo $row['DATESTART']; ?></td>
                    <td><?php echo $row['DATEEND']; ?></td>
                </tr>
            <?php
                }
            ?>
        </tbody>
    </table>
</div>

<br/>
<br/>
<footer>
        <div class="footer-container">
            <p><center>Copyright &copy 2023 All rights reserved | QuadraTech </center></p>

        </div>
	 
	 
	 
    </main>

    <div class="right">
         <div class="announcements">
              <h2>Announcements</h2>
                <div class="updates">
     <div class="message">
    <?php

    // Retrieve the three latest topics
    $topics = displayProfile2($username, 'TOPIC');
    $coursenames = displayProfile2($username, 'COURSENAME');
    $dates = displayProfile2($username, 'DATE');
    $group=displayProfile2($username,'ASSIGNID');

    if (count($topics) > 0 && count($coursenames) > 0 && count($dates) > 0) {
        for ($i = 0; $i < count($topics); $i++) {
           echo "<p><strong>Group: </strong>$group[$i]</p>";
            echo '<p><strong>Subject:</strong> ' . $coursenames[$i] . '</p>';
            echo '<p><strong>Date:</strong> ' . $dates[$i] . '</p>';
            echo '<p><strong>Message:</strong> ' . $topics[$i] . '</p><br>';
        }
    } else {
        echo '<p>No topics found.</p>';
    }
    ?>
</div>

        <a href="display.php"><h4>View All Announcements</h4>
        </a>
      </div>
    </div>
  </div>
  
  
   <script src="app.js"></script>
</body>

</html>
    <?php

} else {
    echo "Session username not set.";
}

// Close the database connection
mysqli_close($dbconn);
?>