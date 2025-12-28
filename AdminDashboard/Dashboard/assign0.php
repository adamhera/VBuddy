<?php
session_start();
// Include database connection settings
include 'c:\xampp\htdocs\MainVbuddy\AdminDashboard\datavbuddy.php';

if (isset($_POST['submit'])) {
  /* Capture values from the HTML form */
  $assignid = $_POST['assignid'];
  $adminid = $_POST['userID'];
  $mentorid = $_POST['mentorid'];
  $courseid = $_POST['courseid'];
  $datestart = $_POST['datestart'];
  $dateend = $_POST['dateend'];
  $remarks = $_POST['remarks'];

  if (!empty($assignid) && !empty($mentorid) && !empty($adminid) && !empty($courseid)) {
    // Check if the mentor ID exists in the user table with levelid = 2 (mentor level)
    $mentorQuery = "SELECT * FROM user WHERE userid = '$mentorid' AND levelid = 2";
    $mentorResult = $conn->query($mentorQuery);

    if ($mentorResult->num_rows > 0) { // Mentor ID exists
      // Check if the admin ID exists in the user table
      $adminQuery = "SELECT * FROM user WHERE userid = '$adminid' AND levelid = 1";
      $adminResult = $conn->query($adminQuery);

      if ($adminResult->num_rows > 0) { // Admin ID exists
        // Check if the mentor is enrolled in the selected course
        $enrollQuery = "SELECT * FROM enroll WHERE userid = '$mentorid' AND courseid = '$courseid' AND role = 'MENTOR'";
        $enrollResult = $conn->query($enrollQuery);

        if ($enrollResult->num_rows > 0) { // Mentor is enrolled in the course
          // Proceed with inserting the assignment record
          $insertQuery = "INSERT INTO assign (assignid, adminid, mentorid, courseid, datestart, dateend, remarks) 
                          VALUES ('$assignid', '$adminid', '$mentorid', '$courseid', '$datestart', '$dateend', '$remarks')";
          $insertResult = $conn->query($insertQuery);

          if ($insertResult) {
            echo "<script>alert('Group created successfully. Mentor successfully assigned to this group.'); window.location.href = 'assign.php';</script>";
            exit();
          } else {
            echo "Error inserting assignment record: " . $conn->error;
          }
        } else {
          echo "<script>alert('Mentor is not enrolled in the selected course.'); window.location.href = 'assign.php';</script>";
        }
      } else {
        echo "<script>alert('Admin ID does not exist.'); window.location.href = 'assign.php';</script>";
      }
    } else {
      echo "Mentor ID does not exist or is not a mentor.";
    }
  } else {
    echo "Please provide the Group ID, Admin ID, Mentor ID, and Course ID.";
  }
}

if (isset($_POST['submit2'])) {
  /* Capture values from the HTML form */
  $assignid = $_POST['assignid'];
  $menteeid = $_POST['menteeid'];
  $remarks = $_POST['remarks'];

  if (!empty($assignid) && !empty($menteeid)) {
    // Check if the assign ID exists in the assign table
    $query = "SELECT * FROM assign WHERE assignid = '$assignid'";
    $result = $conn->query($query);

    if ($result->num_rows > 0) { // Assign ID exists
      // Check if the group already has more than three mentees
      $menteeCountQuery = "SELECT COUNT(*) AS mentee_count FROM mentee_assignment WHERE assignid = '$assignid'";
      $menteeCountResult = $conn->query($menteeCountQuery);
      $menteeCountRow = $menteeCountResult->fetch_assoc();
      $menteeCount = $menteeCountRow['mentee_count'];

      if ($menteeCount >= 3) {
        echo "The group already has the maximum number of mentees.";
      } else {
        // Check if the mentee ID exists in the user table with levelid = 3 (mentee level)
        $query = "SELECT * FROM user WHERE userid = '$menteeid' AND levelid = 3";
        $result = $conn->query($query);

        if ($result->num_rows > 0) { // Mentee ID exists
          // Check if the mentee is enrolled in the chosen course
          $enrollmentQuery = "SELECT * FROM enroll WHERE userid = '$menteeid' AND courseid = '$assignid'";
          $enrollmentResult = $conn->query($enrollmentQuery);

          if ($enrollmentResult->num_rows > 0) { // Mentee is enrolled in the course
            // Insert the mentee assignment record
            $insertQuery = "INSERT INTO mentee (assignid, menteeid, remarks) 
                            VALUES ('$assignid', '$menteeid', '$remarks')";
            $insertResult = $conn->query($insertQuery);

            if ($insertResult) {
              echo "<script>alert('Mentee assigned successfully.'); window.location.href = 'coming0.php';</script>";
              exit();
            } else {
              echo "Error assigning mentee: " . $conn->error;
            }
          } else {
            echo "Mentee is not enrolled in the chosen course.";
          }
        } else {
          echo "Mentee ID does not exist or is not a mentee.";
        }
      }
    } else {
      echo "Assign ID does not exist.";
    }
  } else {
    echo "Please provide the Assign ID and Mentee ID.";
  }
}


/* Close the database connection */
mysqli_close($conn);
?>


