<?php
session_start();
error_reporting(0);
if (!isset($_SESSION['level'])){
	header('location:/kpku/index.php');
	exit;
}else{
	include('../../header.php');
}
?>
<!DOCTYPE html>
<html lang="id">
	<head>
		<title>Detail Foto</title>
  </head>
	<body style="background-color:#FFF">
    <div id="wrapper">
			<div id="page-wrapper">
				<div class="row">
        	<div class="col-lg-12">
						<?php
							$direktori	= $_GET['direktori'];
							$idinspeksi	= $_GET['id'];
							echo '<img src="'.$direktori.'" width="100%">';
							$type = filetype($file);
							echo'<br/><br/><a href="detail_inspeksi.php?id='.$idinspeksi.'" class="btn btn-default btn-outline btn-block">Kembali</a>';
						?>
						<!-- <form action="detail_image.php" method="GET" autocomplete="on">
							<input type="hidden" name="direktori" value="<?php echo $direktori?>">
							<input type="submit" class="btn btn-primary" name="submit" value="Unduh Gambar"></input>
						</form>
						<?php
							if (isset($_GET["submit"])){
								//Get a date and timestamp
								$direktori=$_GET['direktori'];
								$f=$direktori;
								header('Content-Type: image/jpeg');
								header('Content-Disposition: attachment; filename=' . urlencode($f));
								header('Content-Type: application/force-download');
								header('Content-Type: application/octet-stream');
								header('Content-Type: application/download');
								header('Content-Description: File Transfer');
								header('Content-Length: ' . filesize($f));
								echo file_get_contents($f);

							}

							// Send the file contents.
							//readfile($file);
						?> -->
					</div>
					<!-- /. col-md-12 -->
        </div>
				<!-- /. row -->
      </div>
      <!-- close Main -->
    </div>
    <!-- /#wrapper -->
		<!-- footer -->
		<div style="text-align:right; font-size:80%; height:40px; background:#0059B2; color:#cce6ff; position:relative; bottom:0px; width:100%; padding:5px 20px; margin:20px 0px" >
			Copyright Informatika Undip 2017
		</div>
		<!-- close footer -->
  </body>
