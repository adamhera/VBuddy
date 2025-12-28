<?php
session_start();
// Include database connection settings
include 'c:\xampp\htdocs\MainVbuddy\AdminDashboard\datavbuddy.php';

if (isset($_POST['submit'])) {
  /* Capture values from the HTML form */
  $assignid = $_POST['assignid'];
  $menteeid = $_POST['menteeid'];
  $remarks = $_POST['remarks'];

  echo "Assign ID: " . $assignid . "<br>";
  echo "Mentee ID: " . $menteeid . "<br>";

  if (!empty($assignid) && !empty($menteeid)) {
    // Check if the assign ID exists in the assign table
    $query = "SELECT * FROM assign WHERE assignid = '$assignid'";
    $result = $conn->query($query);

    if ($result->num_rows > 0) { // Assign ID exists
      // Check if the group already has more than three mentees
      $menteeCountQuery = "SELECT COUNT(*) AS mentee_count FROM mentee WHERE assignid = '$assignid'";
      $menteeCountResult = $conn->query($menteeCountQuery);
      $menteeCountRow = $menteeCountResult->fetch_assoc();
      $menteeCount = $menteeCountRow['mentee_count'];

      if ($menteeCount >= 3) {
        echo "<script>alert('The group already has the maximum number of mentees.');</script>";
      } else {
        // Check if the mentee ID exists in the user table with levelid = 3 (mentee level)
        $query = "SELECT * FROM user WHERE userid = '$menteeid' AND levelid = 3";
        $result = $conn->query($query);

        if ($result->num_rows > 0) { // Mentee ID exists
          // Check if the mentee is enrolled in the chosen course
          $enrollmentQuery = "SELECT * FROM enroll WHERE userid = '$menteeid' AND courseid = (SELECT courseid FROM assign WHERE assignid = '$assignid')";
          $enrollmentResult = $conn->query($enrollmentQuery);

          if ($enrollmentResult->num_rows > 0) { // Mentee is enrolled in the course
            // Insert the mentee assignment record
            $insertQuery = "INSERT INTO mentee (assignid, menteeid, remarks) 
                            VALUES ('$assignid', '$menteeid', '$remarks')";
            $insertResult = $conn->query($insertQuery);

            if ($insertResult) {
              echo "<script>alert('Mentee assigned successfully.'); window.location.href = 'assign.php';</script>";
              exit();
            } else {
              echo "<script>alert('Error assigning mentee: " . $conn->error . "');</script>";
            }

            // Insert the condition "unavailable" in the enroll table for the mentee
            $updateEnrollmentQuery = "UPDATE enroll SET condition = 'unavailable' WHERE userid = '$menteeid'";
            $updateEnrollmentResult = $conn->query($updateEnrollmentQuery);

            if ($updateEnrollmentResult) {
              echo "<script>alert('Mentee enrollment updated successfully.');</script>";
            } else {
              echo "<script>alert('Error updating mentee enrollment: " . $conn->error . "');</script>";
            }
          } else {
            // Mentee is not enrolled in the chosen course
            echo "<script>alert('Mentee is not enrolled in the chosen course.');</script>";
          }
        } else {
          echo "<script>alert('Mentee ID does not exist or is not a mentee.');</script>";
        }
      }
    } else {
      echo "<script>alert('Assign ID does not exist.');</script>";
    }
  } else {
    echo "<script>alert('Please provide the Assign ID and Mentee ID.');</script>";
  }
}

/* Close the database connection */
mysqli_close($conn);
?>
