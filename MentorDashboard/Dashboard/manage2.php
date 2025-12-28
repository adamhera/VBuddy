<?php
session_start();

/* Include the db connection file */
include("dbconn.php");

// Function to display profile information
function displayProfile($username, $column)
{
    $dbconn = mysqli_connect("localhost", "root", "", "vbuddy");
    if (!$dbconn) {
        die("Connection failed: " . mysqli_connect_error());
    }

    $sql =  "SELECT b.ASSIGNID,d.USERNAME FROM course a JOIN assign b JOIN mentee c JOIN user d WHERE d.USERNAME='$username' AND b.MENTORID = d.USERID GROUP BY b.ASSIGNID";
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

// if user is logged in successfully, all data from username will be displayed in indexmenteedash.php
if (isset($_SESSION['username'])) {
    $username = $_SESSION['username'];
} else {
    // Redirect to the login page if the user is not logged in
    header("Location: ../Vbuddy/login.html");
    exit();
}

                        // If submit button is clicked
                        if (isset($_POST['submit']))
                        {
                          // get value from the form when submitted
                          $topicid = $_POST['topicid'];
                          $assignid = displayProfile($username, 'ASSIGNID');
                          $date = $_POST['date'];
						  $timestart = $_POST['timestart'];
						  $timeend = $_POST['timeend'];

						// Check if the mentee exists in the ASSIGNMENT table
						$query = "SELECT MENTEEID FROM MENTEE WHERE ASSIGNID = '$assignid'";
						$result = mysqli_query($dbconn, $query);
						if ($result && mysqli_num_rows($result) > 0) {
							while ($row = mysqli_fetch_assoc($result)) {
								$menteeid = $row['MENTEEID'];

								// Insert attendance record for each mentee in the group
								$insertQuery = "INSERT INTO ATTENDANCE (ASSIGNID, TOPICID, MENTEEID, DATEATTEND, ATTENDSTATUS, STARTTIME, ENDTIME) VALUES ('$assignid', '$topicid', '$menteeid', '$date', 'absent','$timestart', '$timeend' )";
								if (mysqli_query($dbconn, $insertQuery)) {
									
									echo "<script>alert('Attendance record inserted successfully for mentee with ID: $menteeid');window.location.href = 'topic.php';</script>";

								} else {
									echo "Error inserting attendance record: " . mysqli_error($dbconn);
								}
							}
						} else {
							echo "No mentee found for ASSIGNID: $assignid";
						}
						}
                                                
                    ?>                                
