<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);
include("dbconn.php");

if (isset($_POST['submit'])) {
    $userid = mysqli_real_escape_string($dbconn, $_POST['studID']); // Sanitize input
    $courseID = $_POST['courseid'];
    $role = 'MENTEE';
    $semester = $_POST['semester'];
    $GPA = $_POST['GPA'];
    $CGPA = $_POST['CGPA'];
    $remarks = $_POST['remarks'];

    #here
    $capturedImage1 = $_POST['capturedImage1'];
    $capturedImage2 = $_POST['capturedImage2'];
  
    # Convert and save captured images
    $base64Data1 = explode(',', $capturedImage1)[1];
    $base64Data2 = explode(',', $capturedImage2)[1];

    $imageData1 = base64_decode($base64Data1);
    $imageData2 = base64_decode($base64Data2);

    // Fetch username from the database
    $usernameQuery = "SELECT username FROM user WHERE userid = '$userid'";
    $usernameResult = mysqli_query($dbconn, $usernameQuery);

    if (!$usernameResult) {
        die("Error in query: " . mysqli_error($dbconn));
    }

    if ($usernameRow = mysqli_fetch_assoc($usernameResult)) {
        $username = $usernameRow['username'];
    } else {
        echo "<script>alert('Invalid userid. Username not found.');</script>";
        exit();
    }

    // Create folder path using username
    $folderPath = "../MenteeDashboard/Dashboard/Labels/{$username}/";

    if (!file_exists($folderPath)) {
        mkdir($folderPath, 0777, true);
    }

    $filePath1 = $folderPath . '1.png';
    $filePath2 = $folderPath . '2.png';

    file_put_contents($filePath1, $imageData1);
    file_put_contents($filePath2, $imageData2);

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
