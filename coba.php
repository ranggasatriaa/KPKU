<html>
<body>


  <form action="coba.php" class="uniForm" enctype="multipart/form-data" id="something" method="post">
      <input class="fileUpload"  name="new_image" size="30" type="file">
      <button class="submitButton" name="submit" type="submit">Upload/Resize Image</button>
  </form>

</body>
</html>

<?php
    if(isset($_POST['submit'])){
      if (isset ($_FILES['new_image'])){
  $imagename = $_FILES['new_image']['name'];
  $source = $_FILES['new_image']['tmp_name'];
  $target = "images/".$imagename;
  move_uploaded_file($source, $target);

  $imagepath = $imagename;
  $save = "images/" . $imagepath; //tempat penyimpanan
  // $file = "images/" . $imagepath; //original file

  // list($width, $height) = getimagesize($file) ;


  // $tn = imagecreatetruecolor($width, $height) ;
  // $image = imagecreatefromjpeg($file) ;
  // imagecopyresampled($tn, $image, 0, 0, 0, 0, $width, $height, $width, $height) ;

  // imagejpeg($tn, $save, 100) ;

  $save = "images/sml_" . $imagepath; //tempat penyimpanan file baru
  $file = "images/" . $imagepath; //original file

  list($width, $height) = getimagesize($file) ;

  $modwidth = $width/2;

  $diff = $width / $modwidth;

  $modheight = $height/2;
  $tn = imagecreatetruecolor($modwidth, $modheight) ;
  $image = imagecreatefromjpeg($file) ;
  imagecopyresampled($tn, $image, 0, 0, 0, 0, $modwidth, $modheight, $width, $height) ;

  imagejpeg($tn, $save, 100) ;
        echo 'Large image: <img src="images/'.$imagepath.'">';
        echo 'Thumbnail: <img src="images/sml_'.$imagepath.'">';

      }
      unlink("images/".$imagepath);
    }

?>
