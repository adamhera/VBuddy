
<?php
session_start();

/* include db connection file */
include("dbconn.php");

// Function to display profile information
function displayProfile($id, $column)
{
    $conn = mysqli_connect("localhost", "root", "", "vbuddy");
    if (!$conn) {
        die("Connection failed: " . mysqli_connect_error());
    }

    $sql = "SELECT * FROM user WHERE USERID='$id'";
    $result = mysqli_query($conn, $sql);

    if ($result) {
        if (mysqli_num_rows($result) > 0) {
            $row = mysqli_fetch_assoc($result);
            if (isset($row[$column])) {
                return $row[$column];
            } else {
                return "No data found for column: $column";
            }
        } else {
            return "No profile found for ID: $id";
        }
    } else {
        return "Error retrieving data: " . mysqli_error($conn);
    }

    mysqli_close($conn);
}

// if user is logged in succesfully,all data from userid will be displayed in indexmenteedash.php
if (isset($_SESSION['userid'])) {
    $userid = $_SESSION['userid'];
} else {
    // Redirect to the login page if the user is not logged in
    header("Location: login.html");
    exit();
}
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
</head>

<body>
  <header>
    <div class="logo" title="Student Dashboard">
      <a rel="noopener" href="index.html">
        <img src="images/university.png" alt="" />
      </a>
      <a href="index.html">
        <h2>Mentee Dashboard</h2>
      </a>
    </div>
    <div class="navbar">
      <a href="indexmentodash.php" class="active">
        <i class="fa-solid fa-house fa-lg"></i>
        <h3>Home</h3>
      </a>
      <a href="display.php">
        <i class="fa-solid fa-paperclip fa-lg"></i>
        <h3>View announcement</h3>
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
    <div id="profile-btn">
      <i class="fa-light fa-user fa-lg"></i>
    </div>
    <div class="theme-toggler">
      <span class="material-icons-sharp active">light_mode</span>
      <span class="material-icons-sharp">dark_mode</span>
    </div>
  </header>
  <div class="container">
    <aside>
      <div class="profile">
        <div class="top">
          <div class="profile-photo">
            <img src="images/avatar.png" alt="monkey suprised" />
          </div>
          <div class="info">
            <p><p>Hey, Mentee <b><?php echo displayProfile(    $userid,'NAME'); ?></b></p>
            <small class="text-muted"></small>
          </div>
        </div>
        <div class="about">
          <h5>Course</h5>
          <p>Computer Science</p>
         
          <h5>Contact</h5>
          <p><?php echo displayProfile(    $userid,'PHONE_NUMBER'); ?></p>
          <h5>Email</h5>
          <p><?php echo displayProfile(    $userid,'EMAIL'); ?></p>
          <h5>Address</h5>
          <p><?php echo displayProfile(    $userid,'ADDRESS'); ?></p>
          <br />
          <br />
          <a href="Profile/editprofile.html">
            <h5>Edit Profile</h5>
            <p>Edit your profile details</p>
          </a>
          <a href="../Academic Session/index.html">
            <h5>Change Session</h5>
            <p>Change Academic Session</p>
          </a>
          <a href="../Records/index.html">
            <h5>Student Records</h5>
            <p>Cummulative Records</p>
          </a>
        </div>
      </div>
    </aside>

    <main>

      <br>

      <h2>Calendar</h2>

      <div class="month">
        <ul>
          <li class="prev">&#10094;</li>
          <li class="next">&#10095;</li>
          <li>
            May<br>2023
          </li>
        </ul>
      </div>

      <ul class="weekdays">
        <li>Mo</li>
        <li>Tu</li>
        <li>We</li>
        <li>Th</li>
        <li>Fr</li>
        <li>Sa</li>
        <li>Su</li>
      </ul>

      <ul class="days">
        <li>1</li>
        <li><span class="active">2</span></li>
        <li>3</li>
        <li>4</li>
        <li>5</li>
        <li>6</li>
        <li>7</li>
        <li>8</li>
        <li>9</li>
        <li>10</li>
        <li>11</li>
        <li>12</li>
        <li>13</li>
        <li>14</li>
        <li>15</li>
        <li>16</li>
        <li>17</li>
        <li>18</li>
        <li>19</li>
        <li>20</li>
        <li>21</li>
        <li>22</li>
        <li>23</li>
        <li>24</li>
        <li>25</li>
        <li>26</li>
        <li>27</li>
        <li>28</li>
        <li>29</li>
        <li>30</li>
        <li>31</li>
      </ul>
    </main>

    <div class="right">
      <div class="announcements">
        <h2>Announcements</h2>
        <div class="updates">
          <div class="message">
            <p><strong>Subject:</strong> Important Notice</p>
            <p><strong>Date:</strong> 2023-05-02</p>
            <p><strong>Message:</strong> Lorem ipsum dolor sit amet, consectetur adipiscing elit. Mauris in nisl justo. Integer finibus erat a sem vehicula congue. Aenean iaculis nunc dolor, et vulputate orci efficitur nec.</p>
          </div>
          <div class="message">
            <p><strong>Subject:</strong> Exam Schedule</p>
            <p><strong>Date:</strong> 2023-05-05</p>
            <p><strong>Message:</strong> Lorem ipsum dolor sit amet, consectetur adipiscing elit. Mauris in nisl justo. Integer finibus erat a sem vehicula congue. Aenean iaculis nunc dolor, et vulputate orci efficitur nec.</p>
          </div>
        </div>
        <a href="display.php">
          <h4>View All Announcements</h4>
        </a>
      </div>
    </div>
  </div>
  <script src="js/script.js"></script>
</body>

</html>