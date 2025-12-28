<?php 
include("dbconn.php");
?>

<!DOCTYPE html>
<html>
<head>
  <title>Mentor Form</title>
  <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.4.1/css/all.css" integrity="sha384-5sAR7xN1Nv6T6+dT2mhtzEpVJvfS3NScPQTrOxhwjIuvcA67KV2R5Jz6kr4abQsz" crossorigin="anonymous">
  <link href="https://fonts.googleapis.com/css?family=Roboto:300,400,500,700" rel="stylesheet">
   <link rel="shortcut icon" type="image/x-icon" href="assets/img/favicon.ico">
  <style>
    html, body {
      min-height: 100%;
      padding: 0;
      margin: 0;
      font-family: Roboto, Arial, sans-serif;
      font-size: 14px;
      color: #666;
    }
    h1 {
      margin: 0 0 20px;
      font-weight: 400;
      color: #01468F;
    }
    p {
      margin: 0 0 5px;
    }
    .main-block {
      display: flex;
      flex-direction: column;
      justify-content: center;
      align-items: center;
      min-height: 100vh;
      background-image: url(assets/img/gallery/mentorbg3.jpg);
      background-position: left;
      background-repeat: no-repeat;
      background-size: 50%;
    }
    form {
      padding: 25px;
      margin: 25px;
      box-shadow: 0 4px 8px 0 rgba(0, 0, 0, 0.2), 0 6px 20px 0 rgba(0, 0, 0, 0.19);
      border-radius: 30px;
      background: #f5f5f5;
    }
    input, textarea {
      width: calc(100% - 18px);
      padding: 8px;
      margin-bottom: 20px;
      border: 1px solid #01468F;
      outline: none;
    }
    input::placeholder {
      color: #01468F;
    }
    .button-container {
      display: flex;
      justify-content: space-between;
    }
    button {
      flex: 1;
      padding: 10px;
      border: none;
      border-radius: 20px;
      background: #BEDBF2;
      font-size: 16px;
      font-weight: 400;
      color: #091E59;
    }
    button:hover {
      background: #215B8C;
      color: #fff;
    }
    @media (min-width: 568px) {
      .main-block {
        flex-direction: row;
      }
      .left-part, form {
        width: 50%;
      }
    }
  </style>
</head>
<body>
  <div class="main-block">
    <div class="left-part">
    </div>
    <form method="POST" action="mentorreg0.php">
      <h1>Mentor Registration</h1>
      <div class="info">
        <input class="fname" type="text" name="name" id="name" placeholder="Username">
        <input type="text" name="studID" id="studID" placeholder="Student ID">
        <select name="courseid" id="courseid" style="height: 30px; width: 150px;">
          <?php
          // Establish database connection
          $conn = new mysqli('localhost', 'root', '', 'vbuddy');
          if ($conn->connect_error) {
            die("Connection failed: " . $conn->connect_error);
          }

          // Retrieve unique courseid from the database and populate the dropdown
          $query = "SELECT DISTINCT courseid FROM course";
          $result = $conn->query($query);

          if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
              $courseid = $row['courseid'];
              echo "<option value='$courseid'>$courseid</option>";
            }
          } else {
            echo "<option value=''>No course found</option>";
          }

          // Close the database connection
          $conn->close();
          ?>
        </select>
      </div>
      <br/>
      <p>Result</p>
      <div>
        <input class="fname" type="text" name="semester" id="semester" placeholder="Current Semester">
        <input type="text" name="GPA" id="GPA" placeholder="GPA">
        <input type="text" name="CGPA" id="CGPA" placeholder="CGPA">
      </div>
      <p>Optional:</p>
      <div>
        <input type="text" name="remarks" id="remarks" placeholder="Why do you want to be a mentor">
      </div>
      <div class="button-container">
        <button type="submit" name="submit">SUBMIT</button>
        <a href="bforedash.html" style="width: 50%;"><button style="width: 100%;" type="button" name="cancel">CANCEL</button></a>
      </div>
    </form>
  </div>
</body>
</html>
