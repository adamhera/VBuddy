<?php
include("dbconn.php");
//take the data from post
$search = @$_POST['searches'];

//compare it with current data in database
$sql="SELECT DISTINCT a.assignid, a.courseid, u.userid, u.name, e.role, a.dateSTART, a.dateEND, a.remarks
FROM assign a
JOIN enroll e ON a.courseid = e.courseid
JOIN user u ON ((e.role = 'mentor' AND u.userid = a.mentorid) OR (e.role = 'mentee' AND u.userid = e.userid))
LEFT JOIN mentee m ON a.assignid = m.assignid AND u.userid = m.menteeid
WHERE (e.role = 'mentor' OR (e.role = 'mentee' AND m.menteeid IS NOT NULL))
AND a.assignid LIKE '%$search%'
ORDER BY a.assignid ASC, (CASE WHEN e.role = 'mentor' THEN 0 ELSE 1 END), e.role ASC;
";

$res=mysqli_query($dbconn,$sql) or die(mysqli_error($dbconn));
while($r=mysqli_fetch_array($res,MYSQLI_ASSOC)){
	$json[]=$r;
}
echo json_encode($json,JSON_UNESCAPED_UNICODE);
mysqli_free_result($res);
mysqli_close($dbconn);
?>