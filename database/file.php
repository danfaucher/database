<?php
// Initialize the session
session_start();
 
// If session variable is not set it will redirect to login page
/*if(!isset($_SESSION['username']) || empty($_SESSION['username'])){
  header("location: login.php");
  exit;
}*/
?>

<!DOCTYPE html>
<html>
  <head>
    <title>File Comments</title>
    <link href="https://dcc.ilc.org/global_visual_language/css/ilc_main.css" media="screen" rel="stylesheet" type="text/css">
    <link href="https://dcc.ilc.org/global_visual_language/css/gvl.css" media="screen" rel="stylesheet" type="text/css">
    <link href="css/styles.css" media="screen" rel="stylesheet" type="text/css">
    <script src="https://code.jquery.com/jquery-3.1.1.min.js" integrity="sha256-hVVnYaiADRTO2PzUGmuLJr8BLUSjGIZsDYGmIJLv2b8=" crossorigin="anonymous"></script>
  </head>
  
<body>
  <?php
  if ( ! empty( $_COOKIE['file'] ) ) {
    $file = $_COOKIE['file'];
    $files = $_COOKIE['files'];
  }
  ?>
  <div id="container">
    <div id="imageContent">
    <h1><?php echo ($file);?></h1>
      <a style="float:right;" href="index.php"><button>Go to main page</button></a><br/><br/>
      <div style="float:right; padding-bottom:40px;"> 
        <button onclick="previousImage()">Previous Image</button>
        <button onclick="nextImage()">Next Image</button>
      <br/></div>
  
    <?php echo '<img src="images/'.$file.'"/>';?>
    <br/><br/>
    <form action="insertComment.php" method="post">
      <table style="width:1024px">
        <tr>
          <td> <label for="comment">Comment</label></td>
        </tr>
        <tr>
          <input type="hidden" name="file" value="<?php echo($file)?>">
          <td> <textarea style="width:100%; height:100px;"  type="text" name="comment"></textarea></td>
        </tr>
      </table>
      <br/>
      <input type="submit" value="Submit" style="float:left" class="btn btn-primary">
    </form>
    <?
    // If session variable is not set it will redirect to login page
    if(isset($_SESSION['username']) || !empty($_SESSION['username'])){
    echo '
    <form action="approveFile.php">
      <input type="hidden" name="file" value="<?php echo($file)?>">
      <input type="submit" value="Approve File" style="float:right" class="btn btn-info">
    </form>
    <form action="deleteFile.php" method="post">
      <input type="hidden" name="file" value="<?php echo($file)?>">
      <input type="submit" value="Delete File" style="float:right; margin-right:10px" class="btn btn-warning">
    </form> ';
    }
    ?>
    <br/>  <br/>  <br/>  <br/>  
    <?php include('getComments.php');?>
</div>
</div>
</body>
<script>

function nextImage(){
  
  var file = <?php echo json_encode($file)?>;
  var filesString = <?php echo json_encode($files)?>;

  var files = filesString.split(',');
  var fileIndex = Number(files.indexOf(file));
  
  var nextFile = fileIndex +1;
  var fileRef = files[nextFile];

  document.cookie = ("file=" + fileRef);
  document.cookie = ("files=" + files);
  
  window.location.href = 'file.php';
  
}


function previousImage(){
  
  var file = <?php echo json_encode($file)?>;
  var filesString = <?php echo json_encode($files)?>;

  var files = filesString.split(',');
  var fileIndex = Number(files.indexOf(file));
  
  var previousFile = fileIndex -1;
  var fileRef = files[previousFile];

  document.cookie = ("file=" + fileRef);
  document.cookie = ("files=" + files);
  
  window.location.href = 'file.php';
  
}
</script>

</html>