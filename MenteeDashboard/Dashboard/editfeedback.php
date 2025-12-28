<?php
session_start();
include("dbconn.php");

if (isset($_SESSION['username'])) {
    // Check if the required parameters are present in the URL
    if (isset($_GET['topicid']) && isset($_GET['memberid'])) {
        // Get the topic ID and member ID from the URL
        $topicid = $_GET['topicid'];
        $memberid = $_GET['memberid'];
        
        // Query the database to retrieve the feedback based on the topic ID and member ID
        $sql = "SELECT * FROM feedback WHERE topicid = '$topicid' AND memberid = '$memberid'";
        $result = mysqli_query($dbconn, $sql);
        
        // If there is data in the result, then the code runs
        if ($result && mysqli_num_rows($result) > 0) {
            $row = mysqli_fetch_assoc($result);

            // Close the database connection
            // Rest of the code
            
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
  <script src="https://kit.fontawesome.com/2b25f4f529.js" crossorigin="anonymous"></script>
  <link rel="stylesheet" href="css3/style.css">

  <style>
    header {
      position: relative;
    }

    .change-password-container {
      display: flex;
      align-items: center;
      justify-content: center;
      width: 100%;
      height: 90vh;
    }

    .change-password-container form {
      display: flex;
      flex-direction: column;
      justify-content: center;
      border-radius: var(--border-radius-2);
      padding: 3.5rem;
      background-color: var(--color-white);
      box-shadow: var(--box-shadow);
      width: 100%;
      max-width: 32rem;
    }

    .change-password-container form textarea {
            width: 350px; /* Set the desired width */
            height: 100px; /* Set the desired height */
        }
		
    .change-password-container form:hover {
      box-shadow: none;
    }

    .change-password-container form input[type="password"] {
      border: none;
      outline: none;
      border: 1px solid var(--color-light);
      background: transparent;
      height: 2rem;
      width: 100%;
      padding: 0 0.5rem;
    }

    .change-password-container form .box {
      padding: 0.5rem 0;
    }

    .change-password-container form .box p {
      line-height: 2;
    }

    .change-password-container form h2+p {
      margin: 0.4rem 0 1.2rem 0;
    }

    .btn {
      background: none;
      border: none;
      border: 2px solid var(--color-primary) !important;
      border-radius: var(--border-radius-1);
      padding: 0.5rem 1rem;
      color: var(--color-white);
      background-color: var(--color-primary);
      cursor: pointer;
      margin: 1rem 1.5rem 1rem 0;
      margin-top: 1.5rem;
    }

    .btn:hover {
      color: var(--color-primary);
      background-color: transparent;
    }
    </style>
</head>
<body>
<header>
    <div class="logo" title="Student Dashboard">
	
      <a rel="noopener" href="index.html">
        <img src="images/university.png" alt="" />
      </a>
	  
      <a href="indexmentedash.php">
        <h2>Mentee Dashboard</h2>
      </a>
    </div>
	
	  
    <div class="navbar">
	  <a href="feedback.php">
        <i class="fa-solid fa-right-from-bracket fa-lg"></i>
        <h3>Back</h3>
      </a>
	  
      <a href="indexmenteedash.php">
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
      <div class="change-password-container" >
			  <form method="POST" action="updatefeedback.php">
			  <h2><b>Edit Feedback </b></h2>
		       <p class="text-muted">

		      </p>
				<input type="hidden" name="topicid" value="<?php echo $row['TOPICID']; ?>">
				<input type="hidden" name="memberid" value="<?php echo $row['MEMBERID']; ?>">
				<div class="box">
				<label style = 'font-size : 15px'>Feedback:</label>
				</div>
				<div class="box">
				<textarea name="feedback"><?php echo isset($row['FEEDBACK']) ? $row['FEEDBACK'] : ''; ?></textarea>
				</br>
				</div>
				
				<div class="box">
				<label style = 'font-size : 15px'>Suggestion:</label>
				</div>
				<div class="box">
				<textarea name="suggestion"><?php echo isset($row['SUGGESTION']) ? $row['SUGGESTION'] : ''; ?></textarea>
				<br/>
				</div>
				
				<div class="button">
				<input style = "height: 30px; width:100px" type="submit" name="submit"  class="btn"  value="Update">
				</div>
			  </form>
         </thead>
      </table>
   </div>
</body>
<script src="app.js"></script>
</html>

<?php
            
        } else {
            echo "No feedback found for the given topic and member.";
        }
    } else {
        echo "Missing topic ID or member ID in the URL.";
    }
} else {
    // Redirect to the login page if the user is not logged in
    header("Location: ../Vbuddy/login.html");
    exit();
}
?>
