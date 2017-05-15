<?php
session_start();
error_reporting(0);
if (!isset($_SESSION['level'])){
	header('location:../../index.php');
	exit;
}elseif (isset($_SESSION['level'])){
	include('../../header.php');
?>

<!DOCTYPE html>
<html lang="id">
	<head>
	</head>
	<body style="background-color:#FFF">
    <div id="wrapper">
      <!-- Main -->
      <div style="position: inherit; margin: 0 0 0 195px; padding: 0 30px; border-left: 2px solid #e7e7e7; padding: 0 15px; min-height: 568px; background-color: white;">
        <div class="col-lg-12">
					<?php
						require_once('../../config.php');
						$db=new mysqli($db_host,$db_username,$db_password,$db_database) or
						die("Maaf Anda gagal koneksi.!");

						$query = "SELECT max(idinspeksi) as id FROM inspeksi";
						$result =  $db->query($query);
						if (!$result){
							die ("Could not query the database: <br />". $db->error);
						}else{
							$date = date("Ymd");
							// ADD +1 with last usique ID
							$row = $result->fetch_object();
							$nilai = $row->id;
							$last_idtrx = empty($nilai)?$date."0000":$nilai;
							$next_idtrx = $last_idtrx+1;
							$unique = substr($next_idtrx, -4);
							$idinspeksi = $date.$unique;
							$date = strval($date);
							echo "ID inspeksi Selanjutnya : ";
							echo $idinspeksi;
							echo '<br/>';
							// echo $row->id;
						}
					?>
					<br/>
					<a style="margin-bottom:10px" class="btn btn-primary btn-block btn-lg" href="add_jembatan.php <?php echo '?id='.$idinspeksi;?>">JEMBATAN</a>
					<a style="margin-bottom:10px" class="btn btn-primary btn-block btn-lg" href="add_jalan.php <?php echo '?id='.$idinspeksi;?>">JALAN</a>
					<a style="margin-bottom:10px" class="btn btn-primary btn-block btn-lg" href="add_pju.php <?php echo '?id='.$idinspeksi;?>">PJU</a>
					<a style="margin-bottom:10px" class="btn btn-primary btn-block btn-lg" href="add_lain.php <?php echo '?id='.$idinspeksi;?>">LAIN-LAIN</a>
					<a style="margin-bottom:10px" class="btn btn-outline btn-primary btn-block" href="index.php">Kembali</a>
        </div>
      </div>
      <!-- close Main -->

      <!-- footer -->
      <div style="width:100%; margin-bottom:20px; padding:5px 20px 10px 20px; background:#0059B2; color:#cce6ff; text-align:right; font-size:80%">
        Copyright Informatika Undip 2017
      </div>
      <!-- close footer -->
    </div>
    <!-- /#wrapper -->
  </body>
</html>

<?php
//tutup kurung sesion
}
?>
