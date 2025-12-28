<?php
//fetch.php
include("dbconn.php");
$output = '';
if(isset($_POST["query"]))
{
 $search = mysqli_real_escape_string($dbconn, $_POST["query"]);
 $query = "
  SELECT * FROM course 
  WHERE coursecode LIKE '%".$search."%'
  OR coursename LIKE '%".$search."%' 
  OR coursesemester LIKE '%".$search."%' 
 ";
}else{
 $query = "SELECT * FROM course ORDER BY coursesemester";
 $query = ""; //comment this line to list students upon page loading
}
if ($query!=""){
  $result = mysqli_query($dbconn, $query);
  if(mysqli_num_rows($result) > 0){
       $output .= '<div class="table-responsive">
       <table class="table table bordered"><tr>	
      <th>Course Code</th>
      <th>Course Name</th>
      <th>Course Description</th>
      <th>Course Semester</th>
      </tr>';
    while($row = mysqli_fetch_array($result)){
        $output .= '
	<tr>
	<td>'.$row["coursecode"].'</td>
	<td>'.$row["coursename"].'</td>
	<td>'.$row["coursedesc"].'</td>
	<td>'.$row["coursesemester"].'</td>
	</tr>
	';
    }
    echo $output;
 }else{
    echo 'Data Not Found';
 }
}else{
  echo 'Data Not Found';
}

?>
