<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);
include("dbconn.php");

if (isset($_POST['submit'])) {
  $userid = $_POST['studID'];
  $courseID = $_POST['courseid'];
  $role = 'MENTOR';
  $semester = $_POST['semester'];
  $GPA = $_POST['GPA'];
  $CGPA = $_POST['CGPA'];
   $remarks = mysqli_real_escape_string($dbconn, $_POST['remarks']);

  // Check if the userid exists in the user table
  $checkQuery = "SELECT * FROM user WHERE userid = '$userid'";
  $checkResult = mysqli_query($dbconn, $checkQuery);

   if (mysqli_num_rows($checkResult) == 0) {
    // userid does not exist in user table
    echo "<script>alert('Invalid userid. Please provide a valid userid.');</script>";
  } else {
    // Check if the data already exists in the enroll table
    $enrollCheckQuery = "SELECT * FROM enroll WHERE userid = '$userid' AND courseID = '$courseID'";
    $enrollCheckResult = mysqli_query($dbconn, $enrollCheckQuery);

    if (mysqli_num_rows($enrollCheckResult) > 0) {
      // Data already exists in the enroll table
      echo "<script>alert('Data already exists in the enroll table.');</script>";
    } else {
      // Data does not exist, proceed with the insertion
      $sql = "INSERT INTO enroll (USERID, COURSEID, ROLE, DATE, SEMESTER, REMARKS) VALUES ('$userid', '$courseID', '$role', '" . date('Y-m-d') . "', '$semester', '$remarks')";
     $sql2 = "INSERT INTO result (RESULTID, SEMESTER, GPA, CGPA, USERID) VALUES ('', '$semester', '$GPA', '$CGPA', '$userid')";
	 mysqli_query($dbconn, $sql);
       mysqli_query($dbconn, $sql2);
        echo "<script>alert('Registered into database. Please wait for verification from the admin.'); window.location.href = 'index.html';</script>";
        exit();
      } 
    
  }
  // Close the database connection
  mysqli_close($dbconn);
}
?>