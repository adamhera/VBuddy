<?php 
include 'c:\xampp\htdocs\MainVbuddy\AdminDashboard\datavbuddy.php';
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>User Profile</title>
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
        <h2 style= font-size:15px>Admin Dashboard</h2>
      </a>
    </div>
	
    <div class="navbar">
	  <a href="assign.php">
        <span class="material-icons-sharp" onclick="">logout</span>
        <h3  style= font-size:10px>Back</h3>
      </a>
	  
      <a href="index2.php">
        <span class="material-icons-sharp">home</span>
        <h3  style= font-size:10px>Home</h3>
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
<div class="exam timetable">
<?php
// Retrieve the group ID from the query parameter
if (isset($_GET['assignid']) && isset($_GET['courseid'])){
  $assignid = $_GET['assignid'];
  $courseid = $_GET['courseid'];
  
  // Retrieve the mentees' information from the database based on the group ID
  $query = "SELECT m.assignid, e.courseid, m.menteeid, u.name, e.role, u.gender FROM MENTEE m JOIN USER u ON u.userid = m.menteeid 
            JOIN ENROLL e on e.userid = m.menteeid 
			WHERE m.assignid = '$assignid' AND e.courseid = '$courseid'";
  $result = mysqli_query($conn, $query);

  // Check if there are any mentees in the group
  if (mysqli_num_rows($result) > 0) {
    echo "<h2>List of Mentee</h2>";
    echo "<table>";


    // Loop through each row and display the mentee's information
    while ($row = mysqli_fetch_array($result)) {
      echo "<tr><td><strong>Group ID:</strong></td><td>" . $row['assignid'] . "</td></tr>";
      echo "<tr><td><strong>Course ID:</strong></td><td>" . $row['courseid'] . "</td></tr>";
      echo "<tr><td><strong>User ID:</strong></td><td>" . $row['menteeid'] . "</td></tr>";
      echo "<tr><td><strong>Name:</strong></td><td>" . $row['name'] . "</td></tr>";
      echo "<tr><td><strong>Role:</strong></td><td>" . $row['role'] . "</td></tr>";
      echo "<tr><td><strong>Gender:</strong></td><td>" . $row['gender'] . "</td></tr>";
      echo "<tr style='height: 55px;'></tr>"; // Add a blank row for spacing
    }

    echo "</table>";
  } else {
    echo "No mentees found for the given group ID.";
  }
}
?>
</div>

</main>
</body>
<script src="app.js"></script>

</html>
