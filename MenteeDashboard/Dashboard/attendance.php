<?php
session_start();
include("dbconn.php");

// Check if user is logged in
if (!isset($_SESSION['username'])) {
    header("Location: login.html");
    exit();
}

$username = $_SESSION['username'];

// Function to display profile information
function displayProfile($username, $column)
{
    $dbconn = mysqli_connect("localhost", "root", "", "vbuddy");
    if (!$dbconn) {
        die("Connection failed: " . mysqli_connect_error());
    }

    $sql = "SELECT * FROM user WHERE USERNAME='$username'";
    $result = mysqli_query($dbconn, $sql);

    if ($result) {
        if (mysqli_num_rows($result) > 0) {
            $row = mysqli_fetch_assoc($result);
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

// Function to display attendance information
function displayProfile2($username)
{
    $dbconn = mysqli_connect("localhost", "root", "", "vbuddy");
    if (!$dbconn) {
        die("Connection failed: " . mysqli_connect_error());
    }

    $sql = "SELECT a.COURSENAME, d.ASSIGNID, d.TOPICID, c.MENTEEID, d.DATEATTEND, d.STARTTIME, d.ENDTIME, d.ATTENDSTATUS, d.REMARKS
        FROM course a
        JOIN assign b ON a.COURSEID = b.COURSEID
        JOIN mentee c ON b.ASSIGNID = c.ASSIGNID
        JOIN attendance d ON c.MENTEEID = d.MENTEEID
        JOIN user e ON e.USERID = c.MENTEEID
        WHERE e.username = '$username' AND c.ASSIGNID = d.ASSIGNID
        ORDER BY d.DATEATTEND DESC;";

    $result = mysqli_query($dbconn, $sql);

    if ($result) {
        if (mysqli_num_rows($result) > 0) {
            $data = array();
            while ($row = mysqli_fetch_assoc($result)) {
                $data[] = $row;
            }
            return $data;
        } else {
            return array(); // Return an empty array if no topics found
        }
    } else {
        return "Error retrieving data: " . mysqli_error($dbconn);
    }

    mysqli_close($dbconn);
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
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Rounded:opsz,wght,FILL,GRAD@20..48,100..700,0..1,-50..200">
    <script src="https://kit.fontawesome.com/2b25f4f529.js" crossorigin="anonymous"></script>
    <!-- <script src="script.js" defer></script> -->
    <script src="https://cdn.jsdelivr.net/npm/face-api.js"></script>
    <script src="face-api.min.js"></script>

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

        #cameraContainer {
        position: relative;
        width: 640px; /* Match video width */
        height: 480px; /* Match video height */
        overflow: hidden;
        }

        #cameraContainer canvas {
        position: absolute;
        top: 0;
        left: 0;
        width: 100%; /* Match the video element */
        height: 100%; /* Match the video element */
        z-index: 2; /* Ensure it overlays the video */
        }

        #cameraContainer video {
        width: 100%; /* Match container width */
        height: 100%; /* Match container height */
        z-index: 1; /* Ensure it is below the canvas */
        }


    </style>
</head>

<body>
    <header>
        <div class="logo" title="Student Dashboard">
            <a rel="noopener" href="index.html">
                <img src="images/university.png" alt="" />
            </a>
            <a href="indexmenteedash.php">
                <h2>Mentee Dashboard</h2>
            </a>
        </div>

        <div class="navbar">
            <a href="indexmenteedash.php">
                <i class="fa-solid fa-house fa-lg"></i>
                <h3 style="font-size:10px">Home</h3>
            </a>
            <a href="display.php">
                <i class="fa-solid fa-paperclip fa-lg"></i>
                <h3 style="font-size:10px">Announcement</h3>
            </a>
            <a href="attendance.php" class="active">
                <i class="fa-solid fa-paperclip fa-lg"></i>
                <h3 style="font-size:10px">Attendance</h3>
            </a>
            <a href="discussion.php">
                <i class="fa-regular fa-clipboard fa-lg"></i>
                <h3 style="font-size:10px">Discussion</h3>
            </a>
            <a href="feedback.php">
                <i class="fa-regular fa-clipboard fa-lg"></i>
                <h3 style="font-size:10px">Feedback</h3>
            </a>
            <a href="password.php">
                <span class="material-icons-sharp">password</span>
                <h3 style="font-size:10px">Change Password</h3>
            </a>
            <a href="logout.php">
                <i class="fa-solid fa-right-from-bracket fa-lg"></i>
                <h3 style="font-size:10px">Logout</h3>
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
        <?php
        // Retrieve attendance information for the mentee
        $attendanceData = displayProfile2($username);

        if (!empty($attendanceData)) {
        ?>
            <div class="exam timetable">
                <h2>List of Attendance</h2>
                <table>
                    <thead>
                        <tr>
                            <th>ASSIGN ID</th>
                            <th>TOPIC ID</th>
                            <th>MENTEE ID</th>
                            <th>DATE</th>
                            <th>START TIME</th>
                            <th>END TIME</th>
                            <th>ATTENDANCE</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        foreach ($attendanceData as $attendance) {
                            $assignID = $attendance['ASSIGNID'];
                            $topicID = $attendance['TOPICID'];
                            $menteeID = $attendance['MENTEEID'];
                            $dateAttend = $attendance['DATEATTEND'];
                            $startTime = $attendance['STARTTIME'];
                            $endTime = $attendance['ENDTIME'];
                            $attendStatus = $attendance['ATTENDSTATUS'];
                        ?>
						<tr>
                                <td><?php echo $assignID; ?></td>
                                <td><?php echo $topicID; ?></td>
                                <td><?php echo $menteeID; ?></td>
                                <td><?php echo $dateAttend; ?></td>
                                <td><?php echo $startTime; ?></td>
                                <td><?php echo $endTime; ?></td>
                                <td>
                                    <?php
                                    date_default_timezone_set('Asia/Kuala_Lumpur');
                                    $currentTimestamp = time();
                                    $startTimeFormatted = strtotime($dateAttend . ' ' . $startTime);
                                    $endTimeFormatted = strtotime($dateAttend . ' ' . $endTime);

                                    if ($currentTimestamp >= $startTimeFormatted && $currentTimestamp <= $endTimeFormatted) {
                                        if ($attendStatus !== 'present') {
                                    ?>
                                            <button id="startButton" onclick="startWebcam('<?php echo $assignID; ?>', '<?php echo $topicID; ?>', '<?php echo $menteeID; ?>', '<?php echo $dateAttend; ?>', '<?php echo $username; ?>')">Take Attendance</button>
                                    <?php
                                        } else {
                                            echo 'Present';
                                        }
                                    } else {
                                        if ($attendStatus !== 'present') {
                                            echo 'Not available';
                                        } else {
                                            echo 'Present';
                                        }
                                    }
                                    ?>
                                </td>
                            </tr>
                        <?php
                        }
                        ?>
                    </tbody>
                </table>
            </div>

            <!-- Camera Container -->
            <div id="cameraContainer" class="exam timetable">
                <h2>Face Recognition Attendance</h2>
                <video id="video" width="640" height="480" autoplay></video>
            </div>
            <button id="captureBtn" onclick="takeAttendance()" style="display:none;">Mark Attendance</button>

        <?php
        } else {
            echo "<p>No attendance records found.</p>";
        }
        ?>
    </main>
    <script>
        let currentAssignID, currentTopicID, currentMenteeID, currentDateAttend;
        currentAssignID = assignID;
        currentTopicID = topicID;
        currentMenteeID = menteeID;
        currentDateAttend = dateAttend;
    </script>

    <script src="app.js"></script>
    <script src="getLabel.js"></script>

</body>

</html>