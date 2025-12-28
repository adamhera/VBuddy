<?php
session_start();

/* Include the db connection file */
include("dbconn.php");

// Function to display profile information
function displayProfile($username, $column)
{
    $dbconn = mysqli_connect("localhost", "root", "", "vbuddy");
    if (!$dbconn) {
        die("Connection failed: " . mysqli_connect_error());
    }

    $sql =  "SELECT b.ASSIGNID, d.USERNAME, d.USERID FROM course a JOIN assign b JOIN mentee c JOIN user d WHERE d.USERNAME='$username' AND b.MENTORID = d.USERID GROUP BY b.ASSIGNID";
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
	  <a href="report.php">
        <i class="fa-solid fa-right-from-bracket fa-lg"></i>
        <h3 style= font-size:10px>Back</h3>
      </a>
	  
      <a href="indexmentodash.php">
        <span class="material-icons-sharp">home</span>
        <h3  style= font-size:10px>Home</h3>
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
  <div class="exam timetable2">
		<?php
		// Establish database connection
		$conn = new mysqli('localhost', 'root', '', 'vbuddy');
		if ($conn->connect_error) {
			die("Connection failed: " . $conn->connect_error);
		}
			
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
		
		// Close the database connection
		$conn->close();
		?>

   </div>
</main
</body>
<script src="app.js"></script>

</html>
<?php


// Close the database connection
mysqli_close($dbconn);
?>