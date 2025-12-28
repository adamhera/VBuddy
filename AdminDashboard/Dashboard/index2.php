<?php 
include 'c:\xampp\htdocs\MainVbuddy\AdminDashboard\datavbuddy.php';
?>

<?php
session_start();

/* include db connection file */
include 'c:\xampp\htdocs\MainVbuddy\AdminDashboard\datavbuddy.php';

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
            return "No profile found for username: $username";
        }
    } else {
        return "Error retrieving data: " . mysqli_error($conn);
    }

    mysqli_close($conn);
}

// if user is logged in succesfully,all data from username will be displayed in index2.php
if (isset($_SESSION['username'])) {
    $username = $_SESSION['username'];
	 // Query the database to retrieve user data
    $sql = "SELECT userID, username, name FROM user WHERE username = '$username'";
    $result = mysqli_query($conn, $sql);

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
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Admin Dashboard</title>
    <link rel="shortcut icon" href="images/dashboard.png" />
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons+Sharp" rel="stylesheet">
    <link rel="shortcut icon" href="./images/logo.png">
    <link rel="stylesheet" href="css/style.css">

    <style>

        .exam {
            display: flex;
            align-items: center;
            justify-content: center;
            flex-direction: column;
            height: 50vh;
            width: 80%;
            margin: auto;
        }
		
      .message {
        display: flex;
      }
	  
	    .container {
        width: 100%; /* Set the width of the container to 100% */
      }

      .subjects {
        width: 160%; /* Set the desired width for the subjects box */
        margin: 0 auto; /* Center the subjects box horizontally within the container */
      }
	  
	  .timetable {
	    width: 130%; /* Adjust the width as needed */
	    margin: 0 auto; /* Center the timetable horizontally */
	  }
	  
	  .request-list {
	    margin-top: 20px; /* Adjust the value to control the spacing */
	  }

    </style>
</head>

<!-- Header for Admin Dashboard (nav button) -->
<body>
  <header>
    <div class="logo" title="Admin Dashboard">
      <a rel="noopener" href="index2.php">
        <img src="images/dashboard.png" alt="" />
      </a>
	  
      <a href="index2.php">
        <h2 style= font-size:18px>Admin Dashboard</h2>
      </a>
    </div>
	
    <div class="navbar">
      <a href="index2.php" onclick="timeTableAll()" class="active">
        <span class="material-icons-sharp">home</span>
        <h3 style= font-size:10px>Home</h3>
      </a>
	  
      <a href="Request.php" onclick="timeTableAll()">
        <span class="material-icons-sharp">grid_view</span>
        <h3 style= font-size:10px>Request</h3>
      </a>
	  
       <a href="assign.php" onclick="timeTableAll()">
        <span class="material-icons-sharp">book</span>
        <h3 style= font-size:10px>Assign</h3>
      </a>
	  
      <a href="Report.php" onclick="timeTableAll()">
        <span class="material-icons-sharp">report</span>
        <h3 style= font-size:10px>Report</h3>
      </a>
	  
	  <a href="coming.php" onclick="timeTableAll()">
        <span class="material-icons-sharp">book</span>
        <h3 style= font-size:10px>Manage Subject</h3>
      </a>
	  
      <a href="password.php" onclick="timeTableAll()">
        <span class="material-icons-sharp">password</span>
        <h3  style= font-size:10px>Change Password</h3>
      </a>
	  
      <a href="../../Vbuddy/index.html">
        <span class="material-icons-sharp" onclick="">logout</span>
        <h3  style= font-size:10px>Logout</h3>
      </a>
    </div>
      </a>
    </div>
    <div id="profile-btn">
      <span class="material-icons-sharp">person</span>
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
            <p><p>Hey, Admin <br><b><?php echo displayProfile(    $username,'USERNAME'); ?></b></p>
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
          <a href="../Profile/editprofile.php">
            <h5>Edit Profile</h5>
            <p>Edit your profile details</p>
          </a>
        </div>
      </div>
    </aside>

    <main>
      <h1>Overview</h1>
       <div class="subjects">
	   
	        <!---First Textbox -->
			<div class="eg" style="background-color: #f6f6eb;">
			  <h3 style= font-size:20px >Course</h3>
			    <small class="text-muted">Total of course that has been register and approve under Faculty Science Computer and Mathematics(FSKM)</small>
				
				<?php
				// Assuming you have established a database connection

				// Execute the query to calculate the total course count
				$query = "SELECT COUNT(*) AS total_course FROM course";
				$result = mysqli_query($conn, $query);
				$row = mysqli_fetch_assoc($result);
				$totalCourse = $row['total_course'];

				// Inject the total course count into the HTML template
				  echo "<h3 style= font-size:45px; text-align: center>$totalCourse</h3>";
				  ?>

			  <small class="text-muted">Last 24 Hours</small>
            </div>
			
		
			
			<!---Second Textbox -->
			<div class="eg" style="background-color: #f6ecf5;">
			  <h3 style= font-size:20px >Mentor</h3>
			    <small class="text-muted">Total mentor that already register and approve under Faculty Science Computer and Mathematics(FSKM)</small>
				
				<?php
				// Assuming you have established a database connection

				// Execute the query to calculate the total course count
				$query = "SELECT COUNT(*) AS total_mentor FROM user where levelid=2 AND status='approved'";
				$result = mysqli_query($conn, $query);
				$row = mysqli_fetch_assoc($result);
				$totalMentor = $row['total_mentor'];

				// Inject the total course count into the HTML template
				  echo "<h3 style= font-size:45px; text-align: center>$totalMentor</h3>";
				  ?>
			  <small class="text-muted">Last 24 Hours</small>
		    </div>
			
			<!---Third Textbox -->
			<div class="eg" style="background-color: #d7ecd9;">
			  <h3 style= font-size:20px >Mentee</h3>
			   <small class="text-muted">Total mentee already register and approve under Faculty Science Computer and Mathematics(FSKM)</small>
				  <?php
				// Assuming you have established a database connection

				// Execute the query to calculate the total course count
				$query = "SELECT COUNT(*) AS total_mentee FROM user where levelid=3 AND status='approved'";
				$result = mysqli_query($conn, $query);
				$row = mysqli_fetch_assoc($result);
				$totalMentee = $row['total_mentee'];

				// Inject the total course count into the HTML template
				  echo "<h3 style= font-size:45px; text-align: center>$totalMentee</h3>";
				  ?>
			  <small class="text-muted">Last 24 Hours</small>
		    </div>
			
			<!---Fourth Textbox -->
			<div class="eg" style="background-color: #cecbd6;">
			  <h3 style= font-size:20px >Group</h3>
			   <small class="text-muted">Total of group that has been created and assigned for mentor and mentee under FSKM</small>
				  <?php
				// Assuming you have established a database connection

				// Execute the query to calculate the total course count
				$query = "SELECT COUNT(*) AS total_group FROM assign";
				$result = mysqli_query($conn, $query);
				$row = mysqli_fetch_assoc($result);
				$totalRequest = $row['total_group'];

				// Inject the total course count into the HTML template
				  echo "<h3 style= font-size:45px; text-align: center>$totalRequest</h3>";
				  ?>
			  <small class="text-muted">Last 24 Hours</small>
		    </div>
     </div>
	 
	  <div>
          <h1></h1>
        </div>
		
	 <div class="request-list">
		<h2> </h2>
          <h2>List of Register New Account Request</h2>
        </div>
	 <div class="timetable" id="timetable">
        

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
						<th>Gender </th>
						<th>Action  </th>
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

			  $select = "DELETE FROM USER WHERE USERID = '$id'";
			  $result = mysqli_query($conn, $select);
			  echo '<script type="text/javascript">';
			  echo 'alert("User Denied")';
			  echo 'window.location.href = "Request.php"';
			  echo '</script>';
			}
			?>
	
	 <div class="request-list">
		<h2> </h2>
          <h2>List of Register Enroll Request</h2>
        </div>
	 <div class="timetable" id="timetable">
        

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
						<th>Gender </th>
						<th>Action  </th>
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

			  $select = "DELETE FROM USER WHERE USERID = '$id'";
			  $result = mysqli_query($conn, $select);
			  echo '<script type="text/javascript">';
			  echo 'alert("User Denied")';
			  echo 'window.location.href = "Request.php"';
			  echo '</script>';
			}
			?>

	
	<div class="request-list">
		<h2> </h2>
          <h2>List of Course</h2>
    </div>
	
	 <div class="timetable" id="timetable">
        <table>
          <thead>
            <tr>
						<th>Course Code</th>
                        <th>Course Name</th>
                        <th>Course Semester</th>
           </tr>
		   </thead>
		   <tbody>
		           <?php
					$query = "SELECT * FROM COURSE ORDER BY COURSESEMESTER ASC";
					$result = mysqli_query($conn, $query);
					while ($row = mysqli_fetch_array($result)) {
					?>
					
					  <tr>
						  <td><?php echo $row['COURSEID']; ?></td>
						  <td><?php echo $row['COURSENAME']; ?></td>
						  <td><?php echo $row['COURSESEMESTER']; ?></td>
					 
					  </tr>
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
    echo "Session username not set.";
}

// Close the database connection
mysqli_close($conn);
?>
