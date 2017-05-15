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
		<title>Ubah Inspeksi</title>
	</head>
	<body>
		<div id="wrapper">
			<div id="page-wrapper">
				<div class="row">
					<div class="col-lg-12">
						<?php
						require_once ('../../config.php');
						$db = new mysqli($db_host, $db_username, $db_password, $db_database);
						if($db->connect_errno){
							die("Tidak dapat terkoneksi dengan database: </br>". $db->connect_errno);
						}
						//fileeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeee
						if(isset($_GET['submit'])){
              $idinspeksi					= $_GET['id'];
              $idjenis_inspeksi   = $_GET['idjenis_inspeksi'];
              $idjenis_kerusakan	= $_GET['idjenis_kerusakan'];
              $keterangan					= $_GET['keterangan'];
              $lokasi							= $_GET['lokasi'];

	                // Seleksi Input Data

									$keterangan						= $db->real_escape_string($keterangan);
	                $lokasi								= $db->real_escape_string($lokasi);
	                // Membuat query
	                $query_edit_inspeksi = "UPDATE inspeksi SET idjenis_inspeksi='$idjenis_inspeksi', idjenis_kerusakan='$idjenis_kerusakan' ,keterangan='$keterangan', lokasi='$lokasi'  WHERE idinspeksi='$idinspeksi' ";
	                // Execute the query
	                $result = $db->query($query_edit_inspeksi);
	                if (!$result){
	                  die ("Could not query the database: <br />". mysqli_error($db));
	                }else{
	                  echo '<div class="alert alert-success" style="font-size:150%; text-align:center">Data berhasil di ubah</div>';
	                  echo '<br/><a class="btn btn-outline btn-primary btn-block" href="index.php">Kembali</a>';
	                  $db->close();
	                  // exit;
							}
						}
						// close submit
						?>
					</div>
					<!-- /.col -->
				</div>
				<!-- /. row -->
			</div>
			<!-- /. page wrapper -->
		</div>
		<!-- /. wrapper -->
		<!-- footer -->
		<div style="text-align:right; font-size:80%; height:40px; background:#0059B2; color:#cce6ff; position:relative; bottom:0px; width:100%; padding:5px 20px; margin:20px 0px" >
			Copyright Informatika Undip 2017
		</div>
		<!-- close footer -->
	</body>
</html>
