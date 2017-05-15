<?php
session_start();
error_reporting(0);
if (!isset($_SESSION['level'])){
	header('location:/kpku/index.php');
	exit;
}elseif($_SESSION['level']!="ptg_op" && $_SESSION['level']!="dgm_op"){
	header('location:/kpku/unauthorized.php');
}else{
	include('../header.php');
}
?>

<!DOCTYPE html>
<html>
	<head>
		<title>Hapus kerusakan</title>
	</head>
	<body>
		<div id="wrapper">
			<div id="page-wrapper">
				<div class="row">
					<div class="col-lg-12">
						<h1>Menghapus jenis kerusakan...</h1>
						<?php
						require_once ('../config.php');
						$db = new mysqli($db_host, $db_username, $db_password, $db_database);
						if($db->connect_errno){
							die("Tidak dapat terkoneksi dengan database: </br>". $db->connect_errno);
						}
	          //fileeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeee
	          $idjenis_kerusakan				= $_GET['id'];

							$query_hapus = "DELETE FROM jenis_kerusakan WHERE idjenis_kerusakan=$idjenis_kerusakan ";
							$result_hapus = $db->query($query_hapus);
							if (!$result_hapus){
								die ("Could not query hapus: <br />". $db->error);
								echo '<br/><a class="btn btn-outline btn-primary 	btn-block" href="jenis_kerusakan.php">Kembali</a>';
								die ("Could not query the database: <br />". $db->error);
							}

							echo "<script>alert('Jenis Kerusakan Berhasil Dihapus')</script><br /><br />";
							echo "<script>window.open('jenis_kerusakan.php','_self')</script>";
							$db->close();
							exit;

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
