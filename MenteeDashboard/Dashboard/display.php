<?php
session_start();
include("dbconn.php");

if (isset($_SESSION['username'])) {
    $username = $_SESSION['username'];
} else {
    // Redirect to the login page if the user is not logged in
    header("Location: login.html");
    exit();
}
function displayProfile2($username, $column)
{
    $dbconn = mysqli_connect("localhost", "root", "", "vbuddy");
    if (!$dbconn) {
        die("Connection failed: " . mysqli_connect_error());
    }

    $sql = "SELECT a.COURSENAME,d.* FROM course a JOIN assign b ON a.COURSEID = b.COURSEID JOIN mentee c ON b.ASSIGNID = c.ASSIGNID JOIN topic d ON b.ASSIGNID = d.ASSIGNID JOIN user e ON e.USERID = c.MENTEEID WHERE e.username = '$username' AND c.ASSIGNID = d.ASSIGNID ORDER BY d.date DESC";

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
      <a href="indexmenteedash.php" >
        <i class="fa-solid fa-house fa-lg"></i>
        <h3 style= font-size:10px>Home</h3>
      </a>
	  
      <a href="display.php" class="active">
        <i class="fa-solid fa-paperclip fa-lg"></i>
        <h3 style= font-size:10px>Announcement</h3>
      </a>
	  
	  <a href="attendance.php" >
        <i class="fa-solid fa-paperclip fa-lg"></i>
        <h3 style= font-size:10px>Attendance</h3>
      </a>
      
        <a href="discussion.php" onclick="timeTableAll()">
        <i class="fa-regular fa-clipboard fa-lg"></i>
        <h3 style= font-size:10px>Discussion</h3>
      </a>
	  
	  
      <a href="report.php" onclick="timeTableAll()">
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
  
  <main>
<div class="exam timetable">
    <h2>Message from the mentor:</h2>
    <span class="closeBtn" onclick="timeTableAll()">X</span>
    
    <?php
    // Retrieve all topics
    $topics = displayProfile2($username, 'TOPIC');
    $coursenames = displayProfile2($username, 'COURSENAME');
    $dates = displayProfile2($username, 'DATE');
    $groupid = displayProfile2($username, 'ASSIGNID');
    $desc = displayProfile2($username, 'DESCRIPTION');
    $link = displayProfile2($username, 'LINK_MEETING');
    $attach = displayProfile2($username, 'ATTACHMENT');

    if (count($topics) > 0) {
        echo "<table>";
        echo "<tbody>";

        for ($i = 0; $i < count($topics); $i++) {
            echo "<tr>";
            echo "<td><strong>Group:</strong></td><td>$groupid[$i]</td>";
            echo "</tr>";
            echo "<tr>";
            echo "<td><strong>Subject:</strong></td><td>$coursenames[$i]</td>";
            echo "</tr>";
            echo "<tr>";
            echo "<td><strong>Date:</strong></td><td>$dates[$i]</td>";
            echo "</tr>";
            echo "<tr>";
            echo "<td><strong>Topic:</strong></td><td>$topics[$i]</td>";
            echo "</tr>";
            echo "<tr>";
            echo "<td><strong>Description:</strong></td><td>$desc[$i]</td>";
            echo "</tr>";
            echo "<tr>";
            echo "<td><strong>Link:</strong></td><td><a href='$link[$i]'>$link[$i]</a></td>";
            echo "</tr>";
            echo "<tr>";
            echo "<td><strong>Attachment:</strong></td><td>$attach[$i] <br/>";
            echo "<a href='download.php?filename=" . urlencode($attach[$i]) . "'>Download</a></td>";
            echo "</tr>";
            echo "<tr style='height: 55px;'></tr>"; // Add a blank row for spacing
        }

        echo "</tbody>";
        echo "</table>";
    } else {
        echo '<p>No topics found.</p>';
    }
    ?>

</div>


	
    </main>
	<br/>
	<br/>
<footer>
        <div class="footer-container">
            <p><center>Copyright &copy 2023 All rights reserved | QuadraTech </center></p>

        </div>
</body>

<script src="app.js"></script>

</html>
