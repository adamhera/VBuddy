
<?php
session_start();

/* include db connection file */
include("dbconn.php");

// Function to display profile information
function displayProfile($username, $column)
{
    $conn = mysqli_connect("localhost", "root", "", "vbuddy");
    if (!$conn) {
        die("Connection failed: " . mysqli_connect_error());
    }

    $sql = "SELECT * FROM user WHERE USERNAME='$username'";
    $result = mysqli_query($conn, $sql);

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
        return "Error retrieving data: " . mysqli_error($conn);
    }

    mysqli_close($conn);
}

function displayProfile2($username, $column)
{
    $dbconn = mysqli_connect("localhost", "root", "", "vbuddy");
    if (!$dbconn) {
        die("Connection failed: " . mysqli_connect_error());
    }

    $sql = "SELECT a.COURSENAME,d.* FROM course a JOIN assign b ON a.COURSEID = b.COURSEID JOIN mentee c ON b.ASSIGNID = c.ASSIGNID JOIN topic d ON b.ASSIGNID = d.ASSIGNID JOIN user e WHERE e.username = '$username' AND c.ASSIGNID = d.ASSIGNID AND b.MENTORID=e.USERID ORDER BY d.date DESC LIMIT 3";

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

<!-- button navigation for mentor dashboard -->
<body>
<header>
    <div class="logo" title="Student Dashboard">
	
      <a rel="noopener" href="index.html">
        <img src="images/university.png" alt="" />
      </a>
	  
      <a href="indexmentodash.php">
        <h2>Mentor Dashboard</h2>
      </a>
    </div>
	
    <div class="navbar">
      <a href="indexmentodash.php" class="active" >
        <i class="fa-solid fa-house fa-lg"></i>
        <h3 style= font-size:10px>Home</h3>
      </a>
	  
      <a href="topic.php" >
        <i class="fa-solid fa-paperclip fa-lg"></i>
        <h3 style= font-size:10px>Manage Group</h3>
      </a>
	  
      <a href="discussion.php" onclick="timeTableAll()">
        <i class="fa-regular fa-clipboard fa-lg"></i>
        <h3 style= font-size:10px>Discussion</h3>
      </a>
	  
      <a href="report.php" onclick="timeTableAll()">
        <i class="fa-regular fa-clipboard fa-lg"></i>
        <h3 style= font-size:10px>Report & Feedback</h3>
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
            <p><p>Hey, Mentor <br><b><?php echo displayProfile(    $username,'USERNAME'); ?></b></p>
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
          
        </div>
      </div>
    </aside>

    <main>

      <br>


       <h1>Overview</h1>
       <div class="subjects">
	         <!---First Textbox -->
			<div class="eg" style="background-color: #a0c3d2;">
			  <h3 style= font-size:20px >Group</h3>
			    <small class="text-muted">This is your Group ID that has been assigned to you </small>
				
			
				<?php
				// Assuming you have established a database connection

				// Execute the query to retrieve the assignid for the mentor
				$query = "SELECT assignid FROM assign WHERE mentorid = '$userID'";
				$result = mysqli_query($dbconn, $query);

				// Check if any assignid is found
				if ($result && mysqli_num_rows($result) > 0) {
					$row = mysqli_fetch_assoc($result);
					$assignID = $row['assignid'];

					// Display the assignid
					echo "<h3 style='font-size: 45px;'>$assignID</h3>";
				} else {
					echo "<p>No assignid found for the mentor.</p>";
				}
				?>


			  <small class="text-muted">Group that has been assigned</small>
            </div>
			
			
			
			
	        <!---Second Textbox -->
			<div class="eg" style="background-color: #a0c3d2;">
			  <h3 style= font-size:20px >Mentee</h3>
			    <small class="text-muted">Total of mentee that has been assign for your group </small>
				
				<?php
				// Assuming you have established a database connection

				// Execute the query to calculate the total course count
				$query = "SELECT COUNT(*) AS total_mentee FROM mentee a
                          INNER JOIN assign u ON u.mentorid = '$userID'
                          WHERE u.assignid	= a.assignid";
				$result = mysqli_query($dbconn, $query);
				$row = mysqli_fetch_assoc($result);
				$totalMentee = $row['total_mentee'];

				// Inject the total course count into the HTML template
				  echo "<h3 style= font-size:45px; text-align: center>$totalMentee</h3>";
				  ?>

			  <small class="text-muted">Limit only 3 mentee for each group</small>
            </div>
			
			<!---Third Textbox -->
			<div class="eg" style="background-color: #a0c3d2;">
			  <h3 style= font-size:20px >Class/Activity</h3>
			    <small class="text-muted">Total of class/activity that has been you create to teach your mentee </small>
				
				<?php
				// Assuming you have established a database connection

				// Execute the query to calculate the total course count
				$query = "SELECT COUNT(*) AS total_class FROM topic a
                          INNER JOIN assign u ON u.mentorid = '$userID'
                          WHERE u.assignid	= a.assignid";
				$result = mysqli_query($dbconn, $query);
				$row = mysqli_fetch_assoc($result);
				$totalClass = $row['total_class'];

				// Inject the total course count into the HTML template
				  echo "<h3 style= font-size:45px; text-align: center>$totalClass</h3>";
				  ?>

			  <small class="text-muted">Last 24 hours ago</small>
            </div>
		  </div>
		
          <div class="request-list">
		<h2> </h2>
          <h2>List of Mentee</h2>
        </div>
	 <div class="timetable" id="timetable">
        

            <table>
                <thead>
					  <tr>
						<th>Student ID</th>
						<th>Name</th>
						<th>Age</th>
						<th>Email</th>
						<th>Phone Number</th>
						<th>Gender</th>
					  </tr>
				</thead>
				
				
                <?php
        
					$query = "SELECT u.USERID, u.NAME, u.AGE, u.EMAIL, u.PHONE_NUMBER, u.GENDER
							  FROM USER u
							  JOIN MENTEE m ON u.USERID = m.MENTEEID
							  JOIN ASSIGN a ON m.ASSIGNID = a.ASSIGNID
							  WHERE a.MENTORID = '$userID'";
					$result = mysqli_query($dbconn, $query);
					while ($row = mysqli_fetch_array($result)) {
				?>
		
			    <tbody>
				  <td><?php echo $row['USERID']; ?></td>
				  <td><?php echo $row['NAME']; ?></td>
				  <td><?php echo $row['AGE']; ?></td>
				  <td><?php echo $row['EMAIL']; ?></td>
				  <td><?php echo $row['PHONE_NUMBER']; ?></td>
				  <td><?php echo $row['GENDER']; ?></td>
			    </tbody>
				
				<?php
				}
				?>
		  </table>
		</div>
		
	 
    </main>

    <div class="right">
         <div class="announcements">
              <h2>Announcements</h2>
                 <div class="updates">
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
	 <a href="display2.php">
          <h4>View All Activity</h4>
        </a>
        </div>
       
      </div>
    </div>
	<br/>
  </div>
      <footer>
        <div class="footer-container">
            <p><center>Copyright &copy 2023 All rights reserved | QuadraTech </center></p>

        </div>
    </footer>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.29.1/moment.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/fullcalendar/3.10.2/fullcalendar.min.js"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            var calendarEl = document.getElementById('calendar');

            var calendar = new FullCalendar.Calendar(calendarEl, {
                // Configure your calendar options here
                // For example, to display the current month by default:
                initialView: 'dayGridMonth'
            });

            calendar.render();
        });
    </script>
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