<?php 
include 'c:\xampp\htdocs\MainVbuddy\AdminDashboard\datavbuddy.php';
?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Request</title>
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
            width: 85%;
            margin: auto;
        }
		
		.container {
		width: 100%; /* Set the width of the container to 100% */
		margin: auto;
	    }

	    .subjects {
		align-items: center;
		width: 160%; /* Set the desired width for the subjects box */
		margin: 35px; /* Center the subjects box horizontally within the container */
	   }
	   
	       .back-button {
      display: inline-block;
      margin-left: 10px;
      padding: 5px 10px;
      background-color: #ccc;
      color: #000;
      text-decoration: none;
      border-radius: 5px;
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
	  
	   
      <a href="index.html">
        <h2 style= font-size:18px>Admin Dashboard</h2>
      </a>
    </div>
	
    <div class="navbar">
      <a href="index2.php" >
        <span class="material-icons-sharp">home</span>
        <h3 style= font-size:10px>Home</h3>
      </a>
	  
      <a href="Request.php" onclick="timeTableAll()" class="active">
        <span class="material-icons-sharp">grid_view</span>
        <h3 style= font-size:10px>Request</h3>
      </a>
	  
       <a href="assign.php" onclick="timeTableAll()">
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
			<div class="eg" style="background-color: #f6f6eb;">
			  <h3 style= font-size:20px >New Account Request</h3>
			    <small class="text-muted">Total of new account register that need to be accepted/rejected </small>
				
				<?php
				// Assuming you have established a database connection

				// Execute the query to calculate the total course count
				$query = "SELECT COUNT(*) AS total_request FROM user WHERE status ='pending'";
				$result = mysqli_query($conn, $query);
				$row = mysqli_fetch_assoc($result);
				$totalCourse = $row['total_request'];

				// Inject the total course count into the HTML template
				  echo "<h3 style= font-size:45px; text-align: center>$totalCourse</h3>";
				  ?>

			  <small class="text-muted">Last 24 Hours</small>
            </div>
			
			<!---Second Textbox -->
			<div class="eg" style="background-color: #f6f6eb;">
			  <h3 style= font-size:20px >New Enroll Request</h3>
			    <small class="text-muted">Total of new enroll request that need to be accepted/rejected</small>
				
				<?php
				// Assuming you have established a database connection

				// Execute the query to calculate the total course count
				$query = "SELECT COUNT(*) AS total_request FROM enroll WHERE status ='pending'";
				$result = mysqli_query($conn, $query);
				$row = mysqli_fetch_assoc($result);
				$totalCourse = $row['total_request'];

				// Inject the total course count into the HTML template
				  echo "<h3 style= font-size:45px; text-align: center>$totalCourse</h3>";
				  ?>

			  <small class="text-muted">Last 24 Hours</small>
            </div>
			
			<!---Third Textbox -->
			<div class="eg" style="background-color: #f6f6eb;">
			  <h3 style= font-size:20px >Total User</h3>
			    <small class="text-muted">Total User that has been accepted their registration account</small>
				
				<?php
				// Assuming you have established a database connection

				// Execute the query to calculate the total course count
				$query = "SELECT COUNT(*) AS total_user FROM user WHERE status ='approved'";
				$result = mysqli_query($conn, $query);
				$row = mysqli_fetch_assoc($result);
				$totalCourse = $row['total_user'];

				// Inject the total course count into the HTML template
				  echo "<h3 style= font-size:45px; text-align: center>$totalCourse</h3>";
				  ?>

			  <small class="text-muted">Last 24 Hours</small>
            </div>
	</div>
	
	
        <div class="exam timetable">
            <h2>List of Register New Account Requests</h2>
				<table>
				  <thead>
					<tr>
					  <th>Student ID</th>
					  <th>Username</th>
					  <th>Name</th>
					  <th>Age</th>
					  <th>Email</th>
					  <th>Address</th>
					  <th>Phone Number</th>
					  <th>Gender</th>
					  <th>Action</th>
					</tr>
				  </thead>
				  
				  <?php
					$query = "SELECT * FROM USER WHERE STATUS = 'pending' ORDER BY USERNAME ASC";
					$result = mysqli_query($conn, $query);
					while ($row = mysqli_fetch_array($result)) {
				  ?>
				  
				  <tbody>
					<td><?php echo $row['USERID']; ?></td>
					<td><?php echo $row['USERNAME']; ?></td>
					<td><?php echo $row['NAME']; ?></td>
					<td><?php echo $row['AGE']; ?></td>
					<td><?php echo $row['EMAIL']; ?></td>
					<td><?php echo $row['ADDRESS']; ?></td>
					<td><?php echo $row['PHONE_NUMBER']; ?></td>
					<td><?php echo $row['GENDER']; ?></td>
					
					<td>
					  <form action="Request.php" method="POST">
						<input type="hidden" name="USERID" value="<?php echo $row['USERID']; ?>" />
						<input type="submit" name="approve" value="Approve" />
						<input type="submit" name="deny" value="Deny" />
					  </form>
					</td>
				  </tbody>
				  
				  <?php
					}
				  ?>
		  </table>
		</div>

			<?php
			if (isset($_POST['approve'])) {
			  $id = $_POST['USERID'];

			  $select = "UPDATE USER SET STATUS = 'approved' WHERE USERID = '$id'";
			  $result = mysqli_query($conn, $select);
			  echo '<script type="text/javascript">';
			  echo 'alert("User Approved")';
			  echo 'window.location.href = "Request.php"';
			  echo '</script>';
			}

			if (isset($_POST['deny'])) {
			  $id = $_POST['USERID'];

			  // Delete from ENROLL table
			  $deleteEnroll = "DELETE FROM ENROLL WHERE USERID = '$id'";
			  $resultEnroll = mysqli_query($conn, $deleteEnroll);

			  // Delete from USER table
			  $deleteUser = "DELETE FROM USER WHERE USERID = '$id'";
			  $resultUser = mysqli_query($conn, $deleteUser);

			  if ($resultEnroll && $resultUser) {
				echo '<script type="text/javascript">';
				echo 'alert("User Denied")';
				echo 'window.location.href = "Request.php"';
				echo '</script>';
			  } 
			}

			?>
		<p> <center> *Note: Please click button "Approve" to approve the registration or click button "Deny" to reject the registration.</center></p>
		
		
		<div class="exam timetable">
            <h2>List of Register Enroll Requests</h2>
				<table>
				  <thead>
					<tr>
					  <th>Student ID</th>
					  <th>Role</th>
					  <th>Semester</th>
					  <th>Course</th>
					  <th>Reason</th>
					  <th>Action</th>
					</tr>
				  </thead>
				  
				  <?php
					$query = "SELECT * FROM ENROLL WHERE STATUS = 'pending' ORDER BY USERID ASC";
					$result = mysqli_query($conn, $query);
					while ($row = mysqli_fetch_array($result)) {
				  ?>
				  
				  <tbody>
					<td><?php echo $row['USERID']; ?></td>
					<td><?php echo $row['COURSEID']; ?></td>
					<td><?php echo $row['ROLE']; ?></td>
					<td><?php echo $row['SEMESTER']; ?></td>
					<td><?php echo $row['REMARKS']; ?></td>
					
					<td>
					  <form action="Request.php" method="POST">
						<input type="hidden" name="USERID" value="<?php echo $row['USERID'];?>" />
						<input type="hidden" name="COURSEID" value="<?php echo $row['COURSEID']; ?>" />
						<input type="submit" name="accept" value="Approve" />
						<input type="submit" name="reject" value="Reject" />
					  </form>
					</td>
				  </tbody>
				  
				  <?php
					}
				  ?>
		  </table>
		</div>

			<?php
			if (isset($_POST['accept'])&& isset($_POST['COURSEID'])) {
				$id = $_POST['USERID'];
				$courseid = $_POST['COURSEID'];

				$selectEnroll = "SELECT ROLE FROM enroll WHERE USERID = '$id'";
				$enrollResult = mysqli_query($conn, $selectEnroll);

				if ($enrollResult && mysqli_num_rows($enrollResult) > 0) {
					$enrollData = mysqli_fetch_assoc($enrollResult);
					$role = $enrollData['ROLE'];

					if ($role == 'MENTOR') {
						$levelId = 2;
					} elseif ($role == 'MENTEE') {
						$levelId = 3;
					}

					$updateUser = "UPDATE USER SET LEVELID = '$levelId' WHERE USERID = '$id'";
					$result = mysqli_query($conn, $updateUser);

					if ($result) {
						$updateEnroll = "UPDATE enroll SET STATUS = 'approved' WHERE USERID = '$id' AND COURSEID = '$courseid'";
						$enrollUpdateResult = mysqli_query($conn, $updateEnroll);

						if ($enrollUpdateResult) {
							echo '<script type="text/javascript">';
							echo 'alert("User Approved")';
							echo 'window.location.href = "Request.php"';
							echo '</script>';
						} else {
							echo "Error updating enrollment status: " . mysqli_error($conn);
						}
					} else {
						echo "Error updating user status: " . mysqli_error($conn);
					}
				}
			}
             
			
			if (isset($_POST['reject']) && isset($_POST['COURSEID'])) {
				$id = $_POST['USERID'];
				$courseid = $_POST['COURSEID'];

				// Delete from ENROLL table
				$updateEnroll = "UPDATE enroll SET STATUS = 'rejected' WHERE USERID = '$id' AND COURSEID = '$courseid'";
				$resultEnroll = mysqli_query($conn, $updateEnroll);

				if ($resultEnroll) {
					echo '<script type="text/javascript">';
					echo 'alert("User Denied")';
					echo 'window.location.href = "Request.php"';
					echo '</script>';
				} else {
					echo "Error updating enrollment status: " . mysqli_error($conn);
				}
			}

			?>
		<p> <center> *Note: Please click button "Approve" to approve the registration or click button "Deny" to reject the registration.</center></p>
		
		
		
<div class="exam timetable">
  <h2>List of User / Students</h2>
  <form method="GET" action="Request.php" class="search-form">
    Search :  <input type="text" style="height:30px; width:300px;" name="search" placeholder="Search by User ID / Name" />
    <button type="submit" class="back-button">Search</button>
    <?php if (isset($_GET['search'])) : ?>
      <a href="Request.php" class="back-button">Back</a>
    <?php endif; ?>
  </form>
  <br/>
  <span class="closeBtn" onclick="timeTableAll()">X</span>
  <table>
    <thead>
      <tr>
        <th>Student ID</th>
        <th>Name</th>
        <th>Age</th>
        <th>Email</th>
        <th>Role</th>
        <th>Semester</th>
        <th>Course</th>
        <th>Full Profile</th>
      </tr>
    </thead>
    <tbody>
      <?php
      $searchQuery = "";
      if (isset($_GET['search'])) {
        $searchQuery = $_GET['search'];
      }

      $query = "SELECT * FROM USER u INNER JOIN ENROLL e ON u.USERID = e.USERID WHERE u.STATUS = 'approved' AND (u.USERID LIKE '%$searchQuery%' OR u.NAME LIKE '%$searchQuery%' ) ORDER BY u.USERNAME ASC";
      $result = mysqli_query($conn, $query);

      while ($row = mysqli_fetch_array($result)) {
        ?>
        <tr>
          <td><?php echo $row['USERID']; ?></td>
          <td><?php echo $row['NAME']; ?></td>
          <td><?php echo $row['AGE']; ?></td>
          <td><?php echo $row['EMAIL']; ?></td>
          <td><?php echo $row['ROLE']; ?></td>
          <td><?php echo $row['SEMESTER']; ?></td>
          <td><?php echo $row['COURSEID']; ?></td>
          <td>
            <a href="user_profile.php?userid=<?php echo $row['USERID']; ?>">View Profile</a>
          </td>
        </tr>
      <?php
      }
      ?>
    </tbody>
  </table>
</div>
<p><center>*Note: Please click "View Profile" to view the profile of the user.</center></p>

    </main>
 <br />
	<br />
</body>

<script src="app.js"></script>

</html>