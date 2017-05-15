<?php
session_start();
error_reporting(0);
if (!isset($_SESSION['level'])){
	header('location:../../index.php');
	exit;
}elseif (isset($_SESSION['level'])){
	include('header_ops.php');
}
?>

<!DOCTYPE html>
<html lang="id">
	<head>
		<title>Pilih Inspeksi</title>
	</head>
	<body style="background-color:#FFF">
    <div id="wrapper">
      <!-- Main -->
      <!-- <div style="position: inherit; margin: 0 0 0 195px; border-left: 2px solid #e7e7e7; padding: 0 15px; min-height: 500px; background-color: white;"> -->
			<div id="page-wrapper">
        <div class="col-lg-12">
					<?php
						require_once('../../config.php');
						$db=new mysqli($db_host,$db_username,$db_password,$db_database) or
						die("Maaf Anda gagal koneksi.!");
						// query untuk id
						$query_id = "SELECT max(idinspeksi) as id FROM inspeksi";
						$result_id =  $db->query($query_id);
						if (!$result_id){
							die ("Could not query the database: <br />". $db->error);
						}else{
							$date = date("Ymd");
							// ADD +1 with last usique ID
							$row_id = $result_id->fetch_object();
							$idterakhir = $row_id->id;
							$tanggalid = substr($idterakhir, 0,8);
							// perbandingan tanggal sekarang dan tanggal id terakhir
							if($tanggalid < $date){
								$unique = "001";
								$idinspeksi = $date.$unique;
							}else{
								$next_idtrx = $idterakhir+1;
								$unique = substr($next_idtrx, -3);
								$idinspeksi = $date.$unique;
								$date = strval($date);
							}
							echo "ID inspeksi Selanjutnya : ";
							echo $idinspeksi;
							echo '<br/>';
							// echo $row->id;
						}
						// query untuk jenis
						$query_pil = "SELECT * FROM jenis_inspeksi";
						$result_pil =  $db->query($query_pil);
						if (!$result_pil){
							die ("Could not query the database pilihan: <br />". $db->error);
						}else{
							echo '<br/>';
							// mengeluarkan button pilihan
							while($row_pil = $result_pil->fetch_object()){
								echo '<a style="margin-bottom:10px" class="btn btn-primary btn-block btn-lg" href="add_inspeksi.php?id='.$idinspeksi.'&idjenis_inspeksi='.$row_pil->idjenis_inspeksi.'">'.$row_pil->nama_inspeksi.'</a>';
							}
						}
					?>
					<a style="margin-bottom:10px" class="btn btn-outline btn-primary btn-block" href="index.php">Kembali</a>
        </div>
      </div>
      <!-- close Main -->
    </div>
    <!-- /#wrapper -->
  </body>
</html>
