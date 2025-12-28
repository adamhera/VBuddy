<?php
include ('dbconn.php');
$assignid = @$_POST['assignid'];
$topicid = @$_POST['topicid'];
$date = @$_POST['date'];
$starttime = @$_POST['starttime'];
$endtime = @$_POST['endtime'];
$remarks = @$_POST['remarks'];

$menteeids = array();
$mentee_query = "SELECT menteeid FROM mentee WHERE assignid = '$assignid'";
$mentee_result = mysqli_query($dbconn, $mentee_query);
while ($row = mysqli_fetch_assoc($mentee_result)) {
    $menteeids[] = $row['menteeid'];
}

// Inserting attendance records for each menteeid
$res = 0; // Initialize $res with default value
foreach ($menteeids as $menteeid) {
    $sql = "INSERT INTO attendance (assignid, topicid, menteeid, dateattend, attendstatus, remarks, starttime, endtime) 
            VALUES ('$assignid', '$topicid', '$menteeid', '$date', 'absent', '$remarks', '$starttime', '$endtime')";
    $res = mysqli_query($dbconn, $sql) or die(mysqli_error($dbconn));
}

if ($res == 1) {
    echo "OK";
}
mysqli_close($dbconn);
?>
