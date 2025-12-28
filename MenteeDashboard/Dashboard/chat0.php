<?php
session_start();
include 'dbconn.php';

if (isset($_GET['topicid']) && isset($_GET['memberid']) && isset($_GET['groupid'])) {
  $topicid = $_GET['topicid'];
  $memberid = $_GET['memberid'];
  $group = $_GET['groupid'];
}

function displayProfile($username, $column)
{
  $dbconn = mysqli_connect("localhost", "root", "", "vbuddy");
  if (!$dbconn) {
    die("Connection failed: " . mysqli_connect_error());
  }

  $sql =  "SELECT b.ASSIGNID,d.USERNAME,b.MENTORID FROM course a JOIN assign b JOIN mentee c JOIN user d WHERE d.USERNAME='$username' AND b.MENTORID = d.USERID GROUP BY b.ASSIGNID";
  $result = mysqli_query($dbconn, $sql);

  if ($result) {
    if (mysqli_num_rows($result) > 0) {
      $row = mysqli_fetch_assoc($result);
      var_dump($row);
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

// Check user connectivity
if (isset($_SESSION['username'])) {
  $username = $_SESSION['username'];
} else {
  // Redirect to the login page if the user is not logged in
  header("Location: ../Vbuddy/login.html");
  exit();
}

// Check if the form is submitted
if (isset($_POST['submit'])) {
  $content = $_POST['content'];

  if (isset($_FILES['pdf_file']['name'])) {
    // If the 'pdf_file' field has an attachment
    $file_name = $_FILES['pdf_file']['name'];
    $file_tmp = $_FILES['pdf_file']['tmp_name'];

    // Move the uploaded pdf file into the pdf folder
    move_uploaded_file($file_tmp, "./pdf/" . $file_name);
    echo $file_name;

    $sql2 = "INSERT INTO discuss (TOPICID, MEMBERID, CONTENT, ATTACHMENT) VALUES ('$topicid', '$memberid', '$content', '$file_name')";
    mysqli_query($dbconn, $sql2);

    echo $file_name;

    $redirectUrl = 'chat.php?topicid=' . urlencode($topicid) . '&userid=' . urlencode($memberid) . '&groupid=' . urlencode($group);
    echo '<script>window.location.href = "' . $redirectUrl . '";</script>';
    exit();
  } else {
    echo "Message is not sent!";
  }
}
?>