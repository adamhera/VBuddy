<?php
session_start();
include("dbconn.php");

if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_SESSION['username'])) {
    try {
        // Ensure the necessary fields are available in POST data
        if (!isset($_POST['assignID'], $_POST['topicID'], $_POST['menteeID'], $_POST['dateAttend'])) {
            echo "Error: Missing required data.";
            exit();
        }

        // Retrieve data from POST
        $assignID = $_POST['assignID'];
        $topicID = $_POST['topicID'];
        $menteeID = $_POST['menteeID'];
        $dateAttend = $_POST['dateAttend'];

        // Prepare the SQL query to update attendance status
        $sql = "UPDATE attendance 
                SET ATTENDSTATUS = 'present' 
                WHERE ASSIGNID = ? AND TOPICID = ? AND MENTEEID = ? AND DATEATTEND = ?";
        $stmt = mysqli_prepare($dbconn, $sql);
        mysqli_stmt_bind_param($stmt, "ssss", $assignID, $topicID, $menteeID, $dateAttend);

        // Execute the query
        if (mysqli_stmt_execute($stmt)) {
            // Check if any rows were affected
            if (mysqli_stmt_affected_rows($stmt) > 0) {
                echo "Attendance marked successfully!";
            } else {
                // If no rows were affected, check if the record exists
                $checkSql = "SELECT * FROM attendance WHERE ASSIGNID = ? AND TOPICID = ? AND MENTEEID = ? AND DATEATTEND = ?";
                $checkStmt = mysqli_prepare($dbconn, $checkSql);
                mysqli_stmt_bind_param($checkStmt, "ssss", $assignID, $topicID, $menteeID, $dateAttend);
                mysqli_stmt_execute($checkStmt);
                $result = mysqli_stmt_get_result($checkStmt);

                if (mysqli_num_rows($result) > 0) {
                    echo "Attendance already marked.";
                } else {
                    echo "Error: Invalid data provided.";
                }

                mysqli_stmt_close($checkStmt);
            }
        } else {
            echo "Error: Unable to execute the query.";
        }

        mysqli_stmt_close($stmt);
    } catch (Exception $e) {
        // Catch any exception and show the error message
        echo "Error: " . $e->getMessage();
    }
} else {
    // If the user is not logged in or the request method is not POST
    echo "Invalid request or user not logged in.";
}

mysqli_close($dbconn);
?>
