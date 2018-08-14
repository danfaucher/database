<?php
// Initialize the session
session_start();
 
// If session variable is not set it will redirect to login page
if(!isset($_SESSION['username']) || empty($_SESSION['username'])){
  header("location: login.php");
  exit;
}
?>

<!DOCTYPE html>
<html lang="en">

<head>

  <title>Course Artwork</title>

  <link href="https://dcc.ilc.org/global_visual_language/css/ilc_main.css" media="screen" rel="stylesheet" type="text/css">
  <link href="https://dcc.ilc.org/global_visual_language/css/gvl.css" media="screen" rel="stylesheet" type="text/css">
  <link href="css/styles.css" media="screen" rel="stylesheet" type="text/css">
  <script src="https://code.jquery.com/jquery-3.1.1.min.js" integrity="sha256-hVVnYaiADRTO2PzUGmuLJr8BLUSjGIZsDYGmIJLv2b8=" crossorigin="anonymous"></script>
  <script src="https://code.jquery.com/jquery-1.12.4.js"></script>
<script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
</head>

<body>
  <div id="container">
  <h1>ILC Course Artwork</h1>
  <h3>Hi, <b><?php echo htmlspecialchars($_SESSION['username']); ?></b></h3>
  <a style="float:right;" href="fileUpload.php"><button>File Upload</button></a><br/><br/>
  <div id="accordion">
  <?php include('getUserAssets.php');?>
</div>
</div>           

</body>
<script>

//get file page
jQuery(document).ready(function($) {
  
    $(".clickable-file").click(function() {
      var fileRef = $(this).data("file");
      document.cookie = ("file=" + fileRef);
      document.cookie = ("files=" + files);
      window.location.href = 'file.php';
    });  
});
//javascript array for next previous image function
var files = <?php echo json_encode($files)?>;
for (var x in files) {
   data[x];
}
</script>

<script>
//accordion
  $( function() {
    $( "#accordion" ).accordion({
      active: false,
      collapsible: true,
      heightStyle: 'content',
    });
  } );
  
</script>
</html>