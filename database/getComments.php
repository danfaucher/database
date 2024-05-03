<?php
$con=mysqli_connect("localhost","groot","doot","images");
// Check connection
if (mysqli_connect_errno())
{
echo "Failed to connect to MySQL: " . mysqli_connect_error();
}

$result = mysqli_query($con,"SELECT * FROM comments WHERE file = '$file' ORDER BY file");

echo '<table class="table table-bordered" style="width:100%">
<tr>
<th>File</th>
<th>Comment</th>
</tr>';

while($row = mysqli_fetch_array($result))
{
echo "<tr>";
echo "<td>" . $row['file'] . "</td>";
echo "<td>" . $row['comment'] . "</td>";
echo "</tr>";
}
echo "</table>";

mysqli_close($con);
?>