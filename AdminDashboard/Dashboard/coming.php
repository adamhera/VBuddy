<?php 
include 'c:\xampp\htdocs\MainVbuddy\AdminDashboard\datavbuddy.php';
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Course</title>
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


      <a href="index2.php">
        <h2 style="font-size:18px">Admin Dashboard</h2>
      </a>
    </div>

    <div class="navbar">
      <a href="index2.php" >
        <span class="material-icons-sharp">home</span>
        <h3 style="font-size:10px">Home</h3>
      </a>

      <a href="Request.php" onclick="timeTableAll()">
        <span class="material-icons-sharp">grid_view</span>
        <h3 style="font-size:10px">Request</h3>
      </a>

      <a href="assign.php" onclick="timeTableAll()">
        <span class="material-icons-sharp">book</span>
        <h3 style="font-size:10px">Assign</h3>
      </a>

      <a href="Report.php" >
        <span class="material-icons-sharp">report</span>
        <h3 style="font-size:10px">Report</h3>
      </a>

      <a href="coming.php" class="active">
        <span class="material-icons-sharp">book</span>
        <h3 style="font-size:10px">Manage Subject</h3>
      </a>

      <a href="password.php">
        <span class="material-icons-sharp">password</span>
        <h3 style="font-size:10px">Change Password</h3>
      </a>

      <a href="logout.php">
        <span class="material-icons-sharp" onclick="">logout</span>
        <h3 style="font-size:10px">Logout</h3>
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
    <div class="exam timetable2">
      <h2>Add a New Course</h2>
      <table>

        <thead>
          <form method="POST" action="coming0.php">
            <tr>
              <th>Course Code:</th>
              <th>
                <div class="center">
                  <input type="text" style="height:30px; width:80px;" name="courseid" id="courseid" /> </div>
              </th>

              <th>Course Name:</th>
              <th>
                <div class="center">
                  <input type="text" style="height:30px; width:300px;" name="coursename" id="coursename" /> </div>
              </th>
            </tr>


            <tr>
              <td><b>Course Desc:<b></td>
              <td>
                <div class="center">
                  <input type="text" style="height:30px; width:400px;" name="coursedesc" id="coursedesc" /> </div>
              </td>

              <td><b>Course Semester:<b></td>
              <td>
                <div class="center">
                  <input type="text" style="height:30px; width:80px;" name="coursesem" id="coursesem" /> </div>
              </td>
            </tr>

            <tr>
              <td> </td>
              <td> </td>
              <td> </td>
              <td> </td>
              <td>
                <input style="height:30px; width:100px;" type="submit" name="submit" value="Add Subject">

              </td>

            </tr>
          </form>


        </thead>
      </table>
    </div>

    <p><center> *Note: Please enter the Course Code that's not been registered yet.</center></p>



    <!-- add on search -->
    <div class="exam timetable">
      <h2>List of Courses</h2>
	  <form method="GET" action="coming.php">

		Search :  <input type="text"  style="height:30px; width:400px;" name="search" placeholder="Search by CourseID/Course Name/Course Semester" />
		<button type="submit" class="back-button">Search</button>
		<?php if (isset($_GET['search'])) : ?>
		  <a href="coming.php" class="back-button">Back</a>
		<?php endif; ?>
	  </form>
      <span class="closeBtn" onclick="timeTableAll()">X</span>
	  <br/>
      <table>
        <thead>
          <tr>
            <th>Course Code</th>
            <th>Course Name</th>
            <th>Course Description</th>
            <th>Course Semester</th>
            <th>Course Status</th>
            <th>Edit</th>
            <th>Action</th>
          </tr>
        </thead>
        <tbody>
          <?php
          if (isset($_GET['search'])) {
            $searchQuery = $_GET['search'];

            // Add the search query to the SQL query
           $query = "SELECT * FROM COURSE WHERE COURSEID LIKE '%$searchQuery%' OR COURSENAME LIKE '%$searchQuery%' OR COURSESEMESTER = '$searchQuery' ORDER BY COURSESEMESTER ASC";

          } else {
            // If no search query is present, retrieve all courses
            $query = "SELECT * FROM COURSE ORDER BY COURSESEMESTER ASC";
          }

          $result = mysqli_query($conn, $query);

          while ($row = mysqli_fetch_array($result)) {
          ?>
            <tr>
              <td><?php echo $row['COURSEID']; ?></td>
              <td><?php echo $row['COURSENAME']; ?></td>
              <td><?php echo $row['COURSEDESC']; ?></td>
              <td><?php echo $row['COURSESEMESTER']; ?></td>
              <td><?php echo $row['COURSESTATUS']; ?></td>
              <td>
                <a href="editcourse.php?courseid=<?php echo $row['COURSEID']; ?>">Edit Course</a>
              </td>
              <td>
                <form action="coming.php" method="POST">
                  <input type="hidden" name="COURSEID" value="<?php echo $row['COURSEID']; ?>" />
                  <input style="height:20px; width:70px;" type="submit" name="unactive" value="Unactive" />
				  <input style="height:20px; width:70px;" type="submit" name="active" value="Active" />
                </form>
              </td>
            </tr>
          <?php
          }
          ?>
        </tbody>
      </table>
    </div>

    <?php
	if (isset($_POST['unactive'])) {
	  $id = $_POST['COURSEID'];

	  $update = "UPDATE course SET COURSESTATUS = 'UNACTIVE' WHERE COURSEID = '$id'";
	  $result = mysqli_query($conn, $update);
	  echo '<script type="text/javascript">';
	  echo 'alert("Course Unactive")';
	  echo 'window.location.href = "coming.php"';
	  echo '</script>';
	}

	if (isset($_POST['active'])) {
	  $id = $_POST['COURSEID'];

	  $update = "UPDATE course SET COURSESTATUS = 'ACTIVE' WHERE COURSEID = '$id'";
	  $result = mysqli_query($conn, $update);
	  echo '<script type="text/javascript">';
	  echo 'alert("Course Activated")';
	  echo 'window.location.href = "coming.php"';
	  echo '</script>';
	}
?>


    <br />
    <br />
  </main>
</body>
<script src="app.js"></script>
</html>
