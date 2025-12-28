<?php 
include 'dbconn.php';
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
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Assign</title>
    <link rel="shortcut icon" href="images/dashboard.png" />
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons+Sharp" rel="stylesheet">
    <link rel="shortcut icon" href="./images/logo.png">
    <link rel="stylesheet" href="css/style.css">

    <style>
        

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
		
		.container {
		width: 100%; /* Set the width of the container to 100% */
		margin: auto;
	    }

	    .subjects {
		align-items: center;
		width: 120%; /* Set the desired width for the subjects box */
		margin: 35px; /* Center the subjects box horizontally within the container */
	   }
		
    </style>
</head>

<!-- Header for Admin Dashboard (nav button) -->
<body>
  <header>
    <div class="logo" title="Student Dashboard">
      <a rel="noopener" href="index.html">
        <img src="images/dashboard.png" alt="" />
      </a>
	  
	  
      <a href="index2.php">
        <h2 style= font-size:18px>Admin Dashboard</h2>
      </a>
    </div>
	
    <div class="navbar">
      <a href="index2.php">
        <span class="material-icons-sharp">home</span>
        <h3 style= font-size:10px>Home</h3>
      </a>
	  
      <a href="Request.php" onclick="timeTableAll()">
        <span class="material-icons-sharp">grid_view</span>
        <h3 style= font-size:10px>Request</h3>
      </a>
	  
       <a href="assign.php" onclick="timeTableAll()" class="active">
        <span class="material-icons-sharp">book</span>
        <h3 style= font-size:10px>Assign</h3>
      </a>
	  
      <a href="Report.php" >
        <span class="material-icons-sharp">report</span>
        <h3 style= font-size:10px>Report</h3>
      </a>
	  
	  <a href="coming.php">
        <span class="material-icons-sharp">book</span>
        <h3 style= font-size:10px>Manage Subject</h3>
      </a>
	  
      <a href="password.php">
        <span class="material-icons-sharp">password</span>
        <h3  style= font-size:10px>Change Password</h3>
      </a>
	  
      <a href="logout.php">
        <span class="material-icons-sharp" onclick="">logout</span>
        <h3  style= font-size:10px>Logout</h3>
      </a>
    </div>
        <div id="profile-btn" style="display: none;">
            <span class="material-icons-sharp">person</span>
        </div>
        <div class="theme-toggler">
            <span class="material-icons-sharp active">light_mode</span>
            <span class="material-icons-sharp">dark_mode</span>
        </div>
    </header>

    <main>
	<div class="subjects">
	        <!---First Textbox -->
			<div class="eg" style="background-color: #eac7c7;">
			  <h3 style= font-size:20px >Total Group</h3>
			    <small class="text-muted">Total of that has been created for mentor and mentee.</small>
				
				<?php
				// Assuming you have established a database connection

				// Execute the query to calculate the total course count
				$query = "SELECT COUNT(*) AS total_group FROM assign";
				$result = mysqli_query($dbconn, $query);
				$row = mysqli_fetch_assoc($result);
				$totalRequest = $row['total_group'];

				// Inject the total course count into the HTML template
				  echo "<h3 style= font-size:45px;>$totalRequest</h3>";
				?>

			  <small class="text-muted">Last 24 Hours</small>
            </div>
			
			<!---Second Textbox -->
			<div class="eg" style="background-color: #eac7c7;">
			  <h3 style= font-size:20px >Mentor Available</h3>
			    <small class="text-muted">Total of mentor that is available to be assign in the group</small>
				
				<?php
				// Assuming you have established a database connection

				// Execute the query to calculate the total number of unassigned mentors
				$query = "SELECT COUNT(*) AS total_unassigned_mentors
								  FROM enroll e
								  WHERE e.role = 'mentor' AND e.status = 'approved' AND NOT EXISTS (
									SELECT 1 FROM assign a WHERE a.mentorid = e.userid
								  )";
				$result = mysqli_query($dbconn, $query);
				$row = mysqli_fetch_assoc($result);
				$totalUnassignedMentors = $row['total_unassigned_mentors'];

				// Inject the total unassigned mentors count into the HTML template
				echo "<h3 style='font-size: 45px;'> $totalUnassignedMentors</h3>";
				  ?>

			  <small class="text-muted">Last 24 Hours</small>
            </div>
			
			<!---Third Textbox -->
			<div class="eg" style="background-color: #eac7c7;">
			  <h3 style= font-size:20px >Mentee Available</h3>
			    <small class="text-muted">Total of mentee that is available to be assign in the group</small>
				
				<?php
				// Assuming you have established a database connection

				// Execute the query to calculate the total number of unapproved mentees
				$query = "SELECT COUNT(*) AS total_unapproved_mentees
						  FROM enroll e
						  WHERE e.role = 'mentee' AND e.status ='approved' AND NOT EXISTS (
							SELECT 1 FROM mentee m WHERE m.menteeid = e.userid
						  )";
				$result = mysqli_query($dbconn, $query);
				$row = mysqli_fetch_assoc($result);
				$totalUnapprovedMentees = $row['total_unapproved_mentees'];

				// Inject the total unapproved mentees count into the HTML template
				echo "<h3 style='font-size: 45px;'> $totalUnapprovedMentees</h3>";
				?>


			  <small class="text-muted">Last 24 Hours</small>
            </div>
			
			<!---fourth Textbox -->
			<div class="eg" style="background-color: #eac7c7;">
			  <h3 style= font-size:20px >Latest Group ID</h3>
			    <small class="text-muted">Latest group id that has been created for mentor and mentee</small>
				
				<?php
				// Assuming you have established a database connection

				// Execute the query to retrieve the latest assignid
				$query = "SELECT assignid FROM assign ORDER BY assignid DESC LIMIT 1";
				$result = mysqli_query($dbconn, $query);
				$row = mysqli_fetch_assoc($result);
				$latestAssignId = $row['assignid'];

				// Inject the latest assignid into the HTML template
				echo "<h3 style='font-size: 45px;'>$latestAssignId</h3>";
				?>



			  <small class="text-muted">Last 24 Hours</small>
            </div>
	</div>
	
	
	
	<!-- Assign Group and mentor into a group -->
        <div class="exam timetable2">
            <h2>Create Group & Assign Mentor</h2>
            <table>

                <thead>
                    <form method="POST" action="assign0.php">
                    <tr>
					    <th>Group ID:</th>
                        <th>
						    <div class="center">
							<input type="text" style= "height:30px; width:80px;" name="assignid" id="assignid" /> </div>
						</th>
						
						<input type="hidden" name="userID" value="<?php echo $userID; ?>">
					</tr>
						
					<tr>
						<th>Mentor ID:</th>
                        <td>
							 <div class="center">
							 <select name="mentorid" id="mentorid"type="text" style= "height:30px; width:450px;" /> 
							 <?php
								// Establish database connection
								$dbconn = new mysqli('localhost', 'root', '', 'vbuddy');
								if ($dbconn->connect_error) {
								  die("Connection failed: " . $dbconn->connect_error);
								}

								// Retrieve userid and name of mentors not in assign table
								$query = "SELECT u.userid, u.name FROM user u
										  INNER JOIN enroll e ON u.userid = e.userid
										  LEFT JOIN assign a ON u.userid = a.mentorid
										  WHERE e.role = 'mentor' AND e.status = 'approved' AND a.assignid IS NULL";
								$result = $dbconn->query($query);

								if ($result->num_rows > 0) {
								  while ($row = $result->fetch_assoc()) {
									$userid = $row['userid'];
									$name = $row['name'];
									echo "<option value='$userid'>$userid - $name</option>";
								  }
								} else {
								  echo "<option value=''>No mentors found</option>";
								}

								// Close the database connection
								$dbconn->close();
							?>
                             </select>
							 </div>
						</td>
						
						<th>Course Code:</th>
						<td>
						  <div class="center">
							<select name="courseid" id="courseid" style="height: 30px; width: 150px;">
							  <?php
								// Establish database connection
								$dbconn = new mysqli('localhost', 'root', '', 'vbuddy');
								if ($dbconn->connect_error) {
								  die("Connection failed: " . $dbconn->connect_error);
								}

								// Retrieve unique courseid from the database and populate the dropdown
								$query = "SELECT DISTINCT courseid FROM course";
								$result = $dbconn->query($query);

								if ($result->num_rows > 0) {
								  while ($row = $result->fetch_assoc()) {
									$courseid = $row['courseid'];
									echo "<option value='$courseid'>$courseid</option>";
								  }
								} else {
								  echo "<option value=''>No course found</option>";
								}

								// Close the database connection
								$dbconn->close();
							  ?>
							</select>
						  </div>
						</td>
					</tr>

					
					<tr> 
					  <th>Date Start:</th>
					  <td>
						<div class="center">
						  <input type="date" style="height: 30px; width: 110px;" name="datestart" id="datestart" pattern="\d{4}-\d{2}-\d{2}" />
						</div>
					  </td>
					
						<th>Date End:</th>
					  <td>
						<div class="center">
						  <input type="date" style="height: 30px; width: 250px;" name="dateend" id="dateend" pattern="\d{4}-\d{2}-\d{2}" />
						</div>
					  </td>
			
					</tr>
					
					<tr>
					    <th>Remarks:</th>
					   <td>
							<div class="center">
							<input type="text"  style= "height:30px; width:300px;" name="remarks" id="remarks" /> </div>
					   </td>
					   
					   <td> </td>
					   <td> </td>
					   
						<td>
							<input style= "height:30px; width:100px;" type="submit" name="submit" value="Create Group">
							
						</td>
						
					</tr>
					</form>
                    

                </thead>
            </table>
        </div>
		<p> <center> *Note: Please enter the Group ID start from "G" in the front, and enter 3 digit at the back, Example: "G001".</center></p>
		<p> <center> Please make sure that you not enter the same Group ID, Please check list in below.</center></p>
		
<!-- Assign mentee into a group -->
<div class="exam timetable2">
  <h2>Assign Mentee</h2>
  <table>
    <thead>
      <form method="POST" action="assign1.php">
        <tr>
          <th>Group ID:</th>
          <th>
            <div class="center">
              <select name="assignid" id="assignid" style="height: 30px; width: 150px;">
                <?php
                  // Establish database connection
                  $dbconn = new mysqli('localhost', 'root', '', 'vbuddy');
                  if ($dbconn->connect_error) {
                    die("Connection failed: " . $dbconn->connect_error);
                  }

					 // Retrieve unique assignid and courseid combinations from the database and populate the dropdown
                  $query = "SELECT DISTINCT a.assignid, e.courseid
							FROM assign a
							INNER JOIN enroll e ON a.courseid = e.courseid
							WHERE a.assignid NOT IN (
							  SELECT assignid
							  FROM mentee
							  GROUP BY assignid
							  HAVING COUNT(menteeid) = 3
							);
							";
                  $result = $dbconn->query($query);

                  if ($result->num_rows > 0) {
                    while ($row = $result->fetch_assoc()) {
                      $assignid = $row['assignid'];
                      $courseid = $row['courseid'];
                      echo "<option value='$assignid'>$assignid - $courseid</option>";
                    }
                  } else {
                    echo "<option value=''>No assignid found</option>";
                  }

                  // Close the database connection
                  $dbconn->close();
                ?>

              </select>
            </div>
          </th>

          <th>Mentee ID:</th>
          <th>
            <div class="center">
              <select name="menteeid" id="menteeid" style="height: 30px; width: 300px;" />
			  <?php
				// Establish database connection
				$dbconn = new mysqli('localhost', 'root', '', 'vbuddy');
				if ($dbconn->connect_error) {
				  die("Connection failed: " . $dbconn->connect_error);
				}

				// Retrieve userid and name of approved mentees not in mentee table
				$query = "SELECT u.userid, u.name FROM user u
						  INNER JOIN enroll e ON u.userid = e.userid
						  LEFT JOIN mentee m ON u.userid = m.menteeid
						  WHERE e.role = 'mentee' AND e.status = 'approved' AND e.condition = 'available' ";
				$result = $dbconn->query($query);

				if ($result->num_rows > 0) {
				  while ($row = $result->fetch_assoc()) {
					$userid = $row['userid'];
					$name = $row['name'];
					echo "<option value='$userid'>$userid - $name</option>";
				  }
				} else {
				  echo "<option value=''>No approved mentees found</option>";
				}

				// Close the database connection
				$dbconn->close();
				?>


            </div>
          </th>
        </tr>

        <tr>
          <th>Remarks:</th>
          <td>
            <div class="center">
              <input type="text" style="height: 30px; width: 300px;" name="remarks" id="remarks" />
            </div>
          </td>
          <td></td>
          <td></td>

          <td>
            <input style="height: 30px; width: 100px;" type="submit" name="submit" value="Assign Mentee">
          </td>
        </tr>
      </form>
    </thead>
  </table>
</div>
	
		<div class="exam timetable">
		  <h2>List of Group, Mentor, and Mentee</h2>
		  <span class="closeBtn" onclick="timeTableAll()">X</span>
		  <table>
		  <tr>
			<th>Assign ID</th>
			<th>Course ID</th>
			<th>User ID</th>
			<th>Name</th>
			<th>Role</th>
			<th>Start Date</th>
			<th>End Date</th>
			<th>Remarks</th>
			<th>Action</th>
		  </tr>
		  <?php
			  // Include database connection settings
			include 'dbconn.php';

			  // Open the database connection
			  $dbconn = mysqli_connect('localhost', 'root', '', 'vbuddy');
			  if (!$dbconn) {
				die("Connection failed: " . mysqli_connect_error());
			  }

			  $query = "SELECT DISTINCT a.assignid, a.courseid, u.userid, u.name, e.role, a.dateSTART, a.dateEND, a.remarks
					  FROM assign a
					  JOIN enroll e ON a.courseid = e.courseid AND a.mentorid = e.userid
					  JOIN user u ON u.userid = a.mentorid
					  WHERE e.role = 'mentor'
					  ORDER BY a.assignid ASC;";

			  $result = mysqli_query($dbconn, $query);

			  if (!$result) {
				die("Query execution failed: " . mysqli_error($dbconn));
			  }

			  while ($row = mysqli_fetch_assoc($result)) {
		   ?>
			<tr>
			  <td><?php echo $row['assignid']; ?></td>
			  <td><?php echo $row['courseid']; ?></td>
			  <td><?php echo $row['userid']; ?></td>
			  <td><?php echo $row['name']; ?></td>
			  <td><?php echo $row['role']; ?></td>
			  <td><?php echo $row['dateSTART']; ?></td>
			  <td><?php echo $row['dateEND']; ?></td>
			  <td><?php echo $row['remarks']; ?></td>
			  <td>
                <a href="view_mentee.php?assignid=<?php echo $row['assignid']; ?>&courseid=<?php echo $row['courseid']; ?>">View Mentee</a>
              </td>
			  
			<?php
		  }
		  ?>
		   
	  </tbody>
  </table>
</div>


	<br />
	<br />
	
    </main>
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