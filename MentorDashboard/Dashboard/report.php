<?php
session_start();
include("dbconn.php");

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
            return "No profile found for username: $username";
        }
    } else {
        return "Error retrieving data: " . mysqli_error($dbconn);
    }

    mysqli_close($dbconn);
}

// if user is logged in successfully, all data from username will be displayed in indexmenteedash.php
if (isset($_SESSION['username'])) {
    $username = $_SESSION['username'];

    // Query the database to retrieve user data
    $sql = "SELECT u.userID, u.username, u.name, a.assignid FROM user u INNER JOIN assign a ON u.userid = a.mentorid WHERE u.username = '$username'";
    $result = mysqli_query($dbconn, $sql);

    // If there is data in the result, then the code runs
    if ($result && mysqli_num_rows($result) > 0) {
        $row = mysqli_fetch_assoc($result);
        $userID = $row['userID'];
		$assignid = $row['assignid'];
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
  <title>Mentor Dashboard</title>
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
		
		.exam textarea {
            width: 500px; /* Set the desired width */
            height: 100px; /* Set the desired height */
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
      <a href="indexmentodash.php" >
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
	  
      <a href="report.php" onclick="timeTableAll()" class="active">
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
  
  
  <main>
  <!-- Create Attendance -->
	<div class="exam timetable2">
	  <h2>Feedback</h2>
	  
	  <table>
		<thead>
		  <form method="POST" action="report0.php"> 
			 <th>TopicID:</th>
			<th>
				<div class="center">
					<select name="topicid" id="topicid" style="height: 30px; width: 300px;">
						<?php
						// Establish database connection
						$conn = new mysqli('localhost', 'root', '', 'vbuddy');
						if ($conn->connect_error) {
							die("Connection failed: " . $conn->connect_error);
						}

						$query = "SELECT t.topicid, t.topic
									FROM topic t
									INNER JOIN assign a ON t.assignid = a.assignid
									LEFT JOIN feedback f ON t.topicid = f.topicid AND f.memberid IS NOT NULL
									WHERE a.assignid = '$assignid' AND a.mentorid = '$userID' AND f.topicid IS NULL;";

						$result = $conn->query($query);

						if ($result->num_rows > 0) {
							while ($row = $result->fetch_assoc()) {
								$topicid = $row['topicid'];
								$topic = $row['topic'];
								echo "<option value='$topicid'>$topicid - $topic</option>";
							}
						} else {
							echo "<option value=''>No topics found</option>";
						}

						// Close the database connection
						$conn->close();
						?>

					</select>
				</div>
			</th>
			
        <tr>
			  <th>Student ID:</th>
					<td><div style="font-size: 130%;left: 40%;">
					 <?php echo displayProfile($username, 'USERID'); ?>
					</div>
			  </td>
			  </th>
		</tr>
		
		<tr>
			<th> Feedback:</th>
				<td>
					<div class="center">
					<textarea  name="feedback" id="feedback"> </textarea>
					</div>
				</td>  
		</tr>
		
		<tr>
			<th> Suggestion:</th>
				<td>
					<div class="center">
					<textarea  name="suggestion" id="suggestion" ></textarea>
					</div>
				</td>  

          <td>
            <input style="height: 30px; width: 120px;" type="submit" name="submit" value="Submit">
          </td>
        </tr>
		
			</form>
		</thead>
	</table>
</div>


<!-- Feedback Report & Edit -->
	<div class="exam timetable2">
	 <h2>Edit & Feedback Report</h2>
	<span class="closeBtn" onclick="timeTableAll()">X</span>
        <table>
          <thead>
            <tr>
						<th>Topic ID</th>
                        <th>Topic Name</th>
                        <th>Date</th>
						<th>Edit</th>
                        <th>Action</th>
            </tr>
          </thead>
          <tbody>
  <?php
		   $conn = new mysqli('localhost', 'root', '', 'vbuddy');
			if ($conn->connect_error) {
				die("Connection failed: " . $conn->connect_error);
			}
			
			
			$query = "SELECT t.topicid, t.topic, u.name, t.date, a.mentorid
					  FROM topic t
					  INNER JOIN assign a ON t.assignid = a.assignid
					  INNER JOIN user u ON a.mentorid = u.userid
					  WHERE a.mentorid = '$userID' AND t.assignid = '$assignid'
					  ORDER BY t.topicid ASC";


			$result = mysqli_query($conn, $query);
			while ($row = mysqli_fetch_array($result)) {
			?>
			<tr>
			  <td><?php echo $row['topicid']; ?></td>
			  <td><?php echo $row['topic']; ?></td>
			  <td><?php echo $row['date']; ?></td>
			  <td>
				<a href="editfeedback.php?topicid=<?php echo $row['topicid']; ?>&mentorid=<?php echo $row['mentorid']; ?>">Edit Feedback</a>
			  </td>
			  <td>
				<a href="feedback.php?topicid=<?php echo $row['topicid']; ?>">View Feedback Class</a>
			  </td>
			</tr>
			<?php
			}
			// Close the database connection
			$conn->close();
			?>
        
	  
	  			</form>
		</thead>
	</table>
</div>


<!-- Attendance Report -->
	<div class="exam timetable2">
	 <h2>Attendance Report</h2>
	<span class="closeBtn" onclick="timeTableAll()">X</span>
        <table>
          <thead>
            <tr>
						<th>Topic ID</th>
                        <th>Topic Name</th>
                        <th>Date</th>
						<th>Start Time</th>
						<th>End Time</th>
                        <th>Action</th>
            </tr>
          </thead>
          <tbody>
		<?php
				$conn = new mysqli('localhost', 'root', '', 'vbuddy');
				if ($conn->connect_error) {
					die("Connection failed: " . $conn->connect_error);
				}

				$query = "SELECT DISTINCT t.topicid, t.topic, a.dateattend, a.starttime, a.endtime
						  FROM topic t 
						  INNER JOIN attendance a ON t.topicid = a.topicid
						  WHERE t.assignid = '$assignid';";

				$result = mysqli_query($conn, $query);
				while ($row = mysqli_fetch_array($result)) {
		?>
				<tr>
				  <td><?php echo $row['topicid']; ?></td>
				  <td><?php echo $row['topic']; ?></td>
				  <td><?php echo $row['dateattend']; ?></td>
				  <td><?php echo $row['starttime']; ?></td>
				  <td><?php echo $row['endtime']; ?></td>
				  <td>
					<a href="viewattendance.php?topicid=<?php echo $row['topicid']; ?>">View Attendance Status</a>
				  </td>
				</tr>
		<?php
		}
		// Close the database connection
		$conn->close();
		?>

        
	  
	  			</form>
		</thead>
	</table>
</div>


</main>
  </br>
  </br>
  
    <script src="app.js"></script>
	<footer>
        <div class="footer-container">
            <p><center>Copyright &copy 2023 All rights reserved | QuadraTech </center></p>

        </div>
    </footer>
</body>

</html>
<?php
// Close the database connection
mysqli_close($dbconn);
?>