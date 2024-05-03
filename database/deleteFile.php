<?php
$file = $_POST['file'];

$db = mysqli_connect("localhost", "groot", "doot", "images");
// Check connection
if ($conn->connect_error) {
  die("Connection failed: " . $conn->connect_error);
} 
// sql to delete a record
$sql = "DELETE FROM assets WHERE file='$file'";

if ($conn->query($sql) === TRUE) {
  echo '<!DOCTYPE html>
  <html>
  <head>
    <link href="https://dcc.ilc.org/global_visual_language/css/ilc_main.css" media="screen" rel="stylesheet" type="text/css">
    <link href="https://dcc.ilc.org/global_visual_language/css/gvl.css" media="screen" rel="stylesheet" type="text/css">
    <link href="css/styles.css" media="screen" rel="stylesheet" type="text/css">
  <title>Delete Image</title>
  </head>
  <body>
    <div id="container">
  <!--<div id="content">-->
    <h1>Course Art - Delete Image</h1>
    <a style="float:right;" href="index.php"><button>Go to main page</button></a><br/><br/>
    <h4>Record deleted successfully</h4>
  </body>
  </html>';
} else {
  echo "Error deleting record: " . $conn->error;
}

$conn->close();
?>

