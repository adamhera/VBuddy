<?php 
include 'c:\xampp\htdocs\MainVbuddy\AdminDashboard\datavbuddy.php';
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Report</title>
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
      <a href="index2.php" >
        <span class="material-icons-sharp">home</span>
        <h3 style= font-size:10px>Home</h3>
      </a>
	  
      <a href="Request.php" onclick="timeTableAll()" >
        <span class="material-icons-sharp">grid_view</span>
        <h3 style= font-size:10px>Request</h3>
      </a>
	  
       <a href="assign.php" onclick="timeTableAll()">
        <span class="material-icons-sharp">book</span>
        <h3 style= font-size:10px>Assign</h3>
      </a>
	  
      <a href="Report.php" class="active">
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
	<div class="exam timetable">
            	<h2>Class/Activities Report</h2>
	<table>
		<thead>
			<tr>
				<th>Group ID</th>
				<th>Mentor ID</th>
				<th>Date</th>
				<th>Total Class</th>
				<th>Action</th>
			</tr>
		</thead>
		<tbody>
		<?php
			$query = "SELECT B.assignid, B.mentorid, U.name AS mentor_name, COUNT(T.topicid) AS total_topic
					  FROM assign B
					  INNER JOIN user U ON B.mentorid = U.userid
					  LEFT JOIN topic T ON B.assignid = T.assignid
					  GROUP BY B.assignid
					  ORDER BY B.assignid ASC";

			$result = mysqli_query($conn, $query);
			while ($row = mysqli_fetch_array($result)) {
			?>

			<tr>
			  <td><?php echo $row['assignid']; ?></td>
			  <td><?php echo $row['mentorid']; ?></td>
			  <td><?php echo $row['mentor_name']; ?></td>
			  <td><?php echo $row['total_topic']; ?></td>
			  <td>
			  <a href="graph_page.php?assignid=<?php echo $row['assignid']; ?>&mentorid=<?php echo $row['mentorid']; ?>&mentor_name=<?php echo $row['mentor_name']; ?>">View Details and Graph</a>
			  </td>
			</tr>
			<?php
			}
			?>



				</tbody>
			</table>
		</div>
	
	<p><center> *Note: Please click "View Details & Graph" to view details about the class/activites for the group .</center></p>
	
	<!-- Attendance Report Coding -->
        <div class="exam timetable">
            	<h2>Attendance Report</h2>
	<table>
		<thead>
			<tr>
				<th>Group ID</th>
				<th>Class ID</th>
				<th>Mentor ID</th>
				<th>Date</th>
				<th>Percentage Attendance</th>
				<th>Action</th>
			</tr>
		</thead>
		<tbody>

		<?php
		$query = "SELECT t.TOPICID, DATEATTEND, b.MENTORID, b.MENTEEID, ASSIGNID,
			   COALESCE(a.ATTENDANCE_COUNT, 0) AS ATTENDANCE_COUNT,
			   COALESCE(b.ATTENDFULL_COUNT, 0) AS ATTENDFULL_COUNT,
			   (COALESCE(a.ATTENDANCE_COUNT, 0) / COALESCE(b.ATTENDFULL_COUNT, 1)) * 100 AS PERCENTAGE
				FROM (SELECT DISTINCT TOPICID FROM ATTENDANCE) t
				LEFT JOIN (
					SELECT TOPICID, COUNT(MENTEEID) AS ATTENDANCE_COUNT
					FROM ATTENDANCE
					WHERE ATTENDSTATUS = 'present'
					GROUP BY TOPICID
				) a ON t.TOPICID = a.TOPICID
				LEFT JOIN (
					SELECT ATTENDANCE.ASSIGNID,ATTENDANCE.MENTEEID, TOPICID, B.MENTORID, DATEATTEND, COUNT(DISTINCT MENTEEID) AS ATTENDFULL_COUNT
					FROM ATTENDANCE
					JOIN ASSIGN B
					GROUP BY ATTENDANCE.ASSIGNID, TOPICID, DATEATTEND
				) b ON t.TOPICID = b.TOPICID;";
		$result = mysqli_query($conn, $query);




		while ($row = mysqli_fetch_array($result)) {
			// Your code here

		   /*$attendanceCount = 0;
		$attendFullCount = 0;

		if (is_array($attendRow)) {
			$attendanceCount = $attendRow['ATTENDANCE_COUNT'];
		}

		if (is_array($row)) {
			$attendFullCount = $row['ATTENDFULL_COUNT'];
		}

		$percentage = ($attendFullCount != 0) ? (($attendanceCount / $attendFullCount) * 100) : 0;*/

    ?>
    <tr>
	    <td><?php echo $row['ASSIGNID']; ?></td>
        <td><?php echo $row['TOPICID']; ?></td>
        <td><?php echo $row['MENTORID']; ?></td>
        <td><?php echo $row['DATEATTEND']; ?></td>
        <td><?php echo $row['PERCENTAGE']; ?>%</td>
        <td><a href="generate_attend2.php?assignid=<?php echo $row['ASSIGNID']; ?>&menteeid=<?php echo $row['MENTEEID']; ?>&topicid=<?php echo $row['TOPICID']; ?>">Generate PDF</a></td>
    </tr>
    <?php
}


?>

				</tbody>
			</table>
		</div>

		   
		   <p><center> *Note: Please click "Generate PDF" to download and print report for Attendance.</center></p>
		   
		   
		   
		  <!-- Feedback Report Coding -->
		  <div class="exam timetable">
          <h2>Feedback Report</h2>
        <span class="closeBtn" onclick="timeTableAll()">X</span>
        <table>
          <thead>
            <tr>
						<th>Group ID</th>
                        <th>Topic Name</th>
                        <th>Mentor Name</th>
                        <th>Date</th>
                        <th>Action</th>
            </tr>
          </thead>
          <tbody>
           <?php
			$query = "SELECT a.assignid, t.topic, u.name, t.date, t.topicid
					  FROM ASSIGN a
					  INNER JOIN TOPIC t ON a.assignid = t.assignid
					  INNER JOIN USER u ON a.mentorid = u.userid
					  ORDER BY a.assignid ASC, t.date";

			$result = mysqli_query($conn, $query);
			while ($row = mysqli_fetch_array($result)) {
			?>
			<tr>
			  <td><?php echo $row['assignid']; ?></td>
			  <td><?php echo $row['topic']; ?></td>
			  <td><?php echo $row['name']; ?></td>
			  <td><?php echo $row['date']; ?></td>
			  <td>
				<a href="feedback_report.php?topicid=<?php echo $row['topicid']; ?>">View Feedback Class</a>
			  </td>
			</tr>
			<?php
			}
			?>

		   
          </tbody>
        </table>
      </div>
	  
	  <p><center> *Note: Please click "View Feedback Class/Activites" to view the feedback about the class/activites for the group .</center></p>
    <br />
	<br />
	
	</main>

</body>

<script src="app.js"></script>

</html>