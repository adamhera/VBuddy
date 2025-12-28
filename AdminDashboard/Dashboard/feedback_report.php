<?php 
include 'c:\xampp\htdocs\MainVbuddy\AdminDashboard\datavbuddy.php';
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Feedback Report</title>
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
        <h2 style= font-size:18px>Admin Dashboard</h2>
      </a>
    </div>
	
    <div class="navbar">
	  <a href="report.php">
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
		// Retrieve the topic ID from the query parameter
		if (isset($_GET['topicid'])) {
		  $topicid = $_GET['topicid'];

		  // Retrieve the feedback information from the database
		  $query = "SELECT f.MEMBERID, u.NAME, e.ROLE, f.FEEDBACK, f.SUGGESTION
					FROM FEEDBACK f
					INNER JOIN USER u ON f.MEMBERID = u.USERID
					INNER JOIN ENROLL e ON f.MEMBERID = e.USERID
					WHERE f.TOPICID = '$topicid'";

		  $result = mysqli_query($conn, $query);

		  // Display the feedback information
		  if (mysqli_num_rows($result) > 0) {
			echo "<h2>Feedback Details</h2>";
			echo "<table>";

			while ($row = mysqli_fetch_array($result)) {	
			echo "<tr><td><strong>Student ID:</strong></td><td>" . $row['MEMBERID'] . "</td></tr>";
			echo "<tr><td><strong>Name:</strong></td><td>" . $row['NAME']  . "</td></tr>";
			echo "<tr><td><strong>Role:</strong></td><td>" . $row['ROLE'] . "</td></tr>";
			echo "<tr><td><strong>Feedback:</strong></td><td>" . $row['FEEDBACK']  . "</td></tr>";
			echo "<tr><td><strong>Suggestion:</strong></td><td>" . $row['SUGGESTION'] . "</td></tr>";
            echo "<tr style='height: 55px;'></tr>"; // Add a blank row for spacing
			}

			echo "</table>";
		  } else {
			echo "No feedback found for the given topic ID.";
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
