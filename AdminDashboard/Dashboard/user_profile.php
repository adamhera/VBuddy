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
	  
	   
      <a href="index.html">
        <h2 style= font-size:15px>Admin Dashboard</h2>
      </a>
    </div>
	
    <div class="navbar">
	  <a href="Request.php">
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
// Retrieve the user ID from the query parameter
if (isset($_GET['userid'])) {
  $userid = $_GET['userid'];

  // Retrieve the user's information from the database based on the ID
  $query = "SELECT * FROM USER WHERE USERID = '$userid'";
  $result = mysqli_query($conn, $query);
  $userRow = mysqli_fetch_array($result);

  // Retrieve the user's enrollment data from the database
  $enrollQuery = "SELECT * FROM ENROLL WHERE USERID = '$userid'";
  $enrollResult = mysqli_query($conn, $enrollQuery);

  // Display the user's full profile information
  if ($userRow) {
    echo "<h2>User Profile</h2>";
    echo "<table>";
    echo "<tr><td><strong>Student ID:</strong></td><td>" . $userRow['USERID'] . "</td></tr>";
    echo "<tr><td><strong>Username:</strong></td><td>" . $userRow['USERNAME'] . "</td></tr>";
    echo "<tr><td><strong>Name:</strong></td><td>" . $userRow['NAME'] . "</td></tr>";
    echo "<tr><td><strong>Age:</strong></td><td>" . $userRow['AGE'] . "</td></tr>";
    echo "<tr><td><strong>Email:</strong></td><td>" . $userRow['EMAIL'] . "</td></tr>";
    echo "<tr><td><strong>Address:</strong></td><td>" . $userRow['ADDRESS'] . "</td></tr>";
    echo "<tr><td><strong>Phone Number:</strong></td><td>" . $userRow['PHONE_NUMBER'] . "</td></tr>";
    echo "<tr><td><strong>Gender:</strong></td><td>" . $userRow['GENDER'] . "</td></tr>";
	
    // Display the user's enrollment data
    while ($enrollRow = mysqli_fetch_array($enrollResult)) {
	echo "<tr><td><strong>Role:</strong></td><td>" . $enrollRow['ROLE'] . "</td></tr>";
    echo "<tr><td><strong>Course Code:</strong></td><td>" . $enrollRow['COURSEID']. "</td></tr>";
    echo "<tr><td><strong>Date Register:</strong></td><td>" . $enrollRow['DATE']. "</td></tr>";
    echo "<tr><td><strong>Semester:</strong></td><td>" . $enrollRow['SEMESTER']. "</td></tr>";
     echo "<tr><td><strong>Remarks:</strong></td><td>" . $enrollRow['REMARKS']. "</td></tr>";

    }
    echo "</table>";
  } else {
    echo "User not found.";
  }
} else {
  echo "Invalid request.";
}

?>
   </div>
</main
</body>
<script src="app.js"></script>

</html>
