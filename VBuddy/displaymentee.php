<?php
include("dbconn.php");

// Query the database to retrieve user data
$sql = "SELECT userID, name FROM user";
$result = mysqli_query($dbconn, $sql);

if ($result && mysqli_num_rows($result) > 0) {
    ?>
    <html>
    <head>
        <head>
  <meta charset="UTF-8" />
  <meta http-equiv="X-UA-Compatible" content="IE=edge" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Mentor Dashboard</title>
  <link rel="shortcut icon" href="images/university.png" />
  <link href="https://fonts.googleapis.com/icon?family=Material+Icons+Sharp" rel="stylesheet" />
  <link rel="stylesheet" href="css/style.css" />
  <script src="https://kit.fontawesome.com/2b25f4f529.js" crossorigin="anonymous"></script>
</head>

  <header>
    <div class="logo" title="Student Dashboard">
      <a rel="noopener" href="index.html">
        <img src="images/university.png" alt="" />
      </a>
      <a href="index.html">
        <h2>Mentor Dashboard</h2>
      </a>
    </div>
    <div class="navbar">
      <a href="indexmentodash.php" class="active">
        <i class="fa-solid fa-house fa-lg"></i>
        <h3>Home</h3>
      </a>
      <a href="save_announce.php">
        <i class="fa-solid fa-paperclip fa-lg"></i>
        <h3>Manage Group</h3>
      </a>
      <a href="displaymentee.php" onclick="timeTableAll()">
        <i class="fa-regular fa-clipboard fa-lg"></i>
        <h3>Mentees</h3>
      </a>
      <a href="courses.html" onclick="timeTableAll()">
        <i class="fa-regular fa-clipboard fa-lg"></i>
        <h3>Feedback</h3>
      </a>
    
      <a href="index.html">
        <i class="fa-solid fa-right-from-bracket fa-lg"></i>
        <h3>Logout</h3>
      </a>
    </div>
        <style>
            
            body {
                font-family: Arial, sans-serif;
                background-color: #f5f5f5;
                margin: 0;
             
            }

            h1 {
                color: #333;
                text-align: center;
            }

            .mentee-list {
                margin-top: 20px;
                padding: 10px;
                background-color: #fff;
                border-radius: 5px;
                box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
            }

            .mentee-name {
                font-weight: bold;
                color: #555;
            }
        </style>
    </header>
    </head>
    <body>
        <h1>List of Mentees</h1>
        <div class="mentee-list">
            <?php
            while ($row = mysqli_fetch_assoc($result)) {
                $userID = $row['userID'];
                $name = $row['name'];
                ?>
                <div class="mentee-name">
                    <?php echo $name; ?>
                </div>
                <?php
            }
            ?>
        </div>
    </body>
    </html>
    <?php
}
?>
