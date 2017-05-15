<?php
session_start();
error_reporting(0);
if (!isset($_SESSION['level'])){
	header('location:/kpku/index.php');
	exit;
}elseif($_SESSION['level']!="ptg_op" && $_SESSION['level']!="dgm_op"){
	header('location:/kpku/unauthorized.php');
}else{
	include('../../header.php');
}
?>

<!DOCTYPE html>
<html>
	<head>
		<title>Hapus Inspeksi</title>
	</head>
	<body>
		<div id="wrapper">
			<div id="page-wrapper">
				<div class="row">
					<div class="col-lg-12">
						<h1>Menghapus inspeksi...</h1>
						<?php
						require_once ('../../config.php');
						$db = new mysqli($db_host, $db_username, $db_password, $db_database);
						if($db->connect_errno){
							die("Tidak dapat terkoneksi dengan database: </br>". $db->connect_errno);
						}
	          //fileeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeee
	          $idinspeksi				= $_GET['id'];
	          $query_cari 			= "SELECT * FROM inspeksi WHERE idinspeksi=".$idinspeksi." ";
						$result_cari 			= $db->query($query_cari);
						if (!$result_cari){
							die ("Could not query cari: <br />". $db->error);
						}else{
							$row_cari 	= $result_cari->fetch_object();
							if ($row_cari->status==TRUE){
								$direktori_perbaikan	= $row_cari->direktori_perbaikan;
								$direktori_kerusakan	= $row_cari->direktori_kerusakan;
								if (!file_exists($direktori_perbaikan) || !file_exists($direktori_kerusakan)){
									die ("File tidak ditemukan!!");}
							}else{
								$direktori_kerusakan	= $row_cari->direktori_kerusakan;
								if (!file_exists($direktori_kerusakan)){
									die ("File tidak ditemukan");}
							}

							$query_hapus = "DELETE FROM inspeksi WHERE idinspeksi=".$idinspeksi." ";
							$result_hapus = $db->query($query_hapus);
							if (!$result_hapus){
								die ("Could not query hapus: <br />". $db->error);
								echo '<br/><a class="btn btn-outline btn-primary btn-block" href="index.php">Kembali</a>';
								die ("Could not query the database: <br />". $db->error);
							}
							if ($row_cari->status==TRUE){
								unlink($direktori_kerusakan);
								unlink($direktori_perbaikan);
							}else{
								unlink($direktori_kerusakan);
							}
							echo '<div class="alert alert-success"><h2 align="center">File berhasil di hapus</h2></div>';
							echo '<br/><a class="btn btn-outline btn-primary btn-block" href="index.php">Kembali</a>';
							$db->close();
							exit;
						}
						?>
					</div>
					<!-- /. col -->
				</div>
				<!-- /. row -->
			</div>
			<!-- /. page wrapper -->
		</div>
		<!-- /.wrapper -->
		<!-- footer -->
		<div style="text-align:right; font-size:80%; height:40px; background:#0059B2; color:#cce6ff; position:relative; bottom:0px; width:100%; padding:5px 20px; margin:20px 0px" >
			Copyright Informatika Undip 2017
		</div>
		<!-- close footer -->

	</body>
</html>
