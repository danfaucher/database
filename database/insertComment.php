<?php
/* Attempt MySQL server connection. Assuming you are running MySQL
server with default setting (user 'root' with no password) */
$con=mysqli_connect("localhost","groot","doot","images");
 
// Check connection
if($link === false){
    die("ERROR: Could not connect. " . mysqli_connect_error());
}
 
// Escape user inputs for security
$file = mysqli_real_escape_string($link, $_REQUEST['file']);
$comment = mysqli_real_escape_string($link, $_REQUEST['comment']);

// attempt insert query execution
$sql = "INSERT INTO comments (file, comment) VALUES ('$file', '$comment')";
if(mysqli_query($link, $sql)){
  header('Location: file.php');    

} else{
    echo "ERROR: Could not able to execute $sql. " . mysqli_error($link);
}
 
// close connection
mysqli_close($link);


?>