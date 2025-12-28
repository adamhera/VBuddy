<?php
include("dbconn.php");
$sql="SELECT t.TOPICID, DATEATTEND, b.MENTORID, b.MENTEEID, ASSIGNID,
       COALESCE(a.ATTENDANCE_COUNT, 0) AS ATTENDANCE_COUNT,
       COALESCE(b.ATTENDFULL_COUNT, 0) AS ATTENDFULL_COUNT,
       ROUND((COALESCE(a.ATTENDANCE_COUNT, 0) / COALESCE(b.ATTENDFULL_COUNT, 1)) * 100, 0) AS PERCENTAGE
FROM (SELECT DISTINCT TOPICID FROM ATTENDANCE) t
LEFT JOIN (
    SELECT TOPICID, COUNT(MENTEEID) AS ATTENDANCE_COUNT
    FROM ATTENDANCE
    WHERE ATTENDSTATUS = 'present'
    GROUP BY TOPICID
) a ON t.TOPICID = a.TOPICID
LEFT JOIN (
    SELECT ATTENDANCE.ASSIGNID, ATTENDANCE.MENTEEID, TOPICID, B.MENTORID, DATEATTEND, COUNT(DISTINCT MENTEEID) AS ATTENDFULL_COUNT
    FROM ATTENDANCE
    JOIN ASSIGN B
    GROUP BY ATTENDANCE.ASSIGNID, TOPICID, DATEATTEND
) b ON t.TOPICID = b.TOPICID;";
$res=mysqli_query($dbconn,$sql) or die(mysqli_error($dbconn));
$data = array(); // Create an empty array
while($r=mysqli_fetch_array($res,MYSQLI_ASSOC)){
	$data[] = array(
        'topic_id' => $r["TOPICID"],
        'percentage' => $r["PERCENTAGE"] . "%"
    );
}
echo json_encode($data); // Convert the array to JSON and output
mysqli_free_result($res);
mysqli_close($dbconn);
?>