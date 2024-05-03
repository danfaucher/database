<?php
$con=mysqli_connect("localhost","groot","doot","images");
// Check connection
if (mysqli_connect_errno())
{
echo "Failed to connect to MySQL: " . mysqli_connect_error();
}
$courseResult = mysqli_query($con, "SELECT * FROM courses ORDER BY discipline");
$result = mysqli_query($con,"SELECT * FROM assets ORDER BY discipline, course_code");
$getCourse = mysqli_fetch_assoc(mysqli_query($con, "SELECT course_code FROM assets WHERE indexA = '1'"));
$course = $getCourse['course_code'];
$files = array();

while($row = mysqli_fetch_array($result))

    {
    if ($course == $row['course_code']){
      tableEntry($row);
      array_push($files, $row['file']);
    }
    else {
      if (!empty($course)){
      echo "</table>";
      echo "</div>";}
        tableHeader($row);
        tableEntry($row);
        array_push($files, $row['file']);
        $course = $row['course_code'];
      }
}

function tableHeader($row){
echo ('<h3 class="C'.$row['colour'].'">'.$row['course_code'].'</h3>'.'<div>'.
'<table class="table table-bordered" style="width:100%">
<tr>
<th>Discipline</th>
<th><a href="https://dcc.ilc.org/global_visual_language/">GVL Colour</a></th>
<th>Course Code</th>
<th>Course</th>
<th>Artwork</th>
<th>File</th>
<th>Section</th>
<th>Status</th>
</tr>');
return;
}

function tableEntry($row){
  echo '<tr class="clickable-file" data-file="'.$row['file'].'">';
  echo "<td>" . $row['discipline'] . "</td>";
  echo '<td style="background-color:#' . $row['colour']. '">' . $row['colour'] . "</td>";
  echo "<td>" . $row['course_code'] . "</td>";
  echo "<td>" . $row['course'] . "</td>";
  echo '<td>' . '<img class="thumbnail" src="images/' . $row['file'] . '" />'. "</td>";
  echo '<td>' . $row['file'] . "</td>";
  echo "<td>" . $row['section'] . "</td>";
  echo "<td>" . $row['status'] . "</td>";
  echo "</tr>";
  return;
}

mysqli_close($con);
?>