<?php
  // Create database connection
  $db = mysqli_connect("localhost", "tvo", "polkaroo", "course_art");
  // Initialize message variable

  // Upload
  if (isset($_POST['upload'])) {
  	//file variables set on page
  	$file = $_FILES['image']['name'];
    $course_code = mysqli_real_escape_string($db, $_POST['course_code']);
    $section = mysqli_real_escape_string($db, $_POST['section']);
    //existing file check
    $existingFile = mysqli_fetch_assoc(mysqli_query($db, "SELECT file FROM assets WHERE file='$file' LIMIT 1"));
    $fileExists = $existingFile['file'];
    //get remaining database values
    $fileRow = mysqli_fetch_assoc(mysqli_query($db, "SELECT * FROM assets WHERE course_code='$course_code' LIMIT 1"));
    $discipline = $fileRow['discipline'];
    $colour = $fileRow['colour'];
    $course = $fileRow['course'];
    $status = "wip";
    
    if (!empty($fileExists)) {
      //overwrite file
      // image file directory
      $target = "images/".basename($file);
      //$sql = "INSERT INTO assets (discipline, colour, course, course_code, section, file, status) VALUES ('$discipline', '$colour', '$course', '$course_code', '$section', '$file', '$status')";
      // execute query
      //mysqli_query($db, $sql);
      if (move_uploaded_file($_FILES['image']['tmp_name'], $target)) {
        $msg = "Image uploaded moderatery succesfully";
      }else{
        $msg = "Failed to upload image";
      }
      //echo ("turnip");
      //return 'Assigned';
    } else {
      //create new entry
      //echo ("variable is ".$fileExists);
        //echo ("beets are tasty");
      //return 'Available';
      // image file directory
      $target = "images/".basename($file);
      $sql = "INSERT INTO assets (discipline, colour, course, course_code, section, file, status) VALUES ('$discipline', '$colour', '$course', '$course_code', '$section', '$file', '$status')";
      // execute query
      mysqli_query($db, $sql);

      if (move_uploaded_file($_FILES['image']['tmp_name'], $target)) {
        $msg = "Image uploaded successfully";
      }else{
        $msg = "Failed to upload image";
      }
    }
  }
?>
<!DOCTYPE html>
<html>
<head>
  <link href="https://dcc.ilc.org/global_visual_language/css/ilc_main.css" media="screen" rel="stylesheet" type="text/css">
  <link href="https://dcc.ilc.org/global_visual_language/css/gvl.css" media="screen" rel="stylesheet" type="text/css">
  <link href="css/styles.css" media="screen" rel="stylesheet" type="text/css">
  <script src="https://code.jquery.com/jquery-3.1.1.min.js" integrity="sha256-hVVnYaiADRTO2PzUGmuLJr8BLUSjGIZsDYGmIJLv2b8=" crossorigin="anonymous"></script>
<title>Image Upload</title>
</head>
<body>
  <div id="container">
<!--<div id="content">-->
  <h1>Course Art - Image Upload</h1>
  <a style="float:right;" href="index.php"><button>Go to main page</button></a><br/><br/>
  <h2>Upload images using file name from main page to overwrite images</h2>
  
  <form method="POST" action="fileUpload.php" enctype="multipart/form-data">
  <div style="display:inline">
      
    <!--course_code-->
  <select name="course_code">
  <option value="eng1d">eng1d</option>
  <option value="eng2d">eng2d</option>
  <option value="eng3e">eng3e</option>
  <option value="eng3c">eng3c</option>
  <option value="eng3u">eng3u</option>
  <option value="eng4c">eng4c</option>
  <option value="eng4u">eng4u</option>
  <option value="snc1d">snc1d</option>
  <option value="sch3u">sch3u</option>
  <option value="sch4u">sch4u</option>
  <option value="sbi3u">sbi3u</option>
  <option value="sbi4u">sbi4u</option>
  <option value="sph3u">sph3u</option>
  <option value="sph4u">sph4u</option>
  <option value="mpm1d">mpm1d</option>
  <option value="mpm2d">mpm2d</option>
  <option value="map4c">map4c</option>
  <option value="mdm4u">mdm4u</option>
  <option value="mcv4u">mcv4u</option>
  <option value="mhf4u">mhf4u</option>
    </select>
  </div>
    <div style="display:inline">
    <!--section-->
    <select name="section">
      <option value="cover">Cover</option>
      <option value="toc">Table of Contents</option>
      <option value="higlights">Course Highlights</option>
      <option value="related">Related Courses</option>
      <option value="unit">Unit Screen</option>
      <option value="activity">Learning Activity</option>
    </select>
  </div>
    <!--image-->
  	<input type="hidden" name="size" value="1000000">
  	<div style="display:inline">
  	  <input type="file" name="image">
  	</div>
  	<div style="display:inline">
  		<button type="submit" name="upload">POST</button>
  	</div>
  </form>
  <?php
    //while ($row = mysqli_fetch_array($result)) {
      //echo "<div id='img_div'>";
      	//echo "<img src='images/".$row['image']."' >";
      	//echo "<p>".$row['image_text']."</p>";
      //echo "</div>";
    //}
  ?>
<!--</div>-->
</div>
</body>
</html>