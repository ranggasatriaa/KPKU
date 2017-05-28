<?php
session_start();
error_reporting(0);
if (!isset($_SESSION['level'])){
	header('location:/kpku/index.php');
	exit;
}elseif($_SESSION['level']!="dgm_op"){
	header('location:/kpku/unauthorized.php');
}else{
	include('../header.php');
}

require_once('../config.php');
$db = new mysqli($db_host, $db_username, $db_password, $db_database);
if ($db->connect_errno){
	die ("Tidak dapat terkoneksi dengan database: <br />". $db->connect_error);
}

if(isset($_POST['submit'])){
	$nama_kerusakan=$_POST['nama_kerusakan'];

	if(!preg_match("/^[a-z A-Z]*$/",$nama_kerusakan)) {
		echo '<script>alert("Nama Tidak Valid: Hanya huruf tanpa spasi yang diperbolehkan")</script><br /><br />';
		echo '<script>window.open("add_jenis_kerusakan.php","_self")</script>';
		$valid_nama=FALSE;
	}else{
		$valid_nama=TRUE;
	}

	if ($valid_nama){
		//insert data into database
			$nama_kerusakan = $db->real_escape_string($nama_kerusakan);

			//Asign a query
			$query = "INSERT INTO jenis_kerusakan (nama_kerusakan) VALUES('".$nama_kerusakan."') ";
			// Execute the query
			$result = $db->query( $query );
			if (!$result){
				 die ("Could not query the database: <br />". $db->error);
			}else{
				echo "<script>alert('Jenis kerusakan Berhasil Ditambahkan')</script><br /><br />";
				echo "<script>window.open('jenis_kerusakan.php','_self')</script>";
				$db->close();
			}
	}
}
function test_input($data) {
	 $data = trim($data);
	 $data = stripslashes($data);
	 $data = htmlspecialchars($data);
	 return $data;
}
?>

<!DOCTYPE html>
<html>
	<head>
		<title>Tambah Kerusakan</title>

	</head>
	<body>
		<div id="wrapper">
			<div id="page-wrapper">
				<div class="row">
	        <div class="col-lg-12">
						<form action="add_jenis_kerusakan.php" method="POST" enctype="multipart/form-data"/>
								<h3 align="left"> Masukkan Jenis kerusakan Baru </h3>
								<div class="form-group">
									<label>Nama Jenis Kerusakan:</label>
								</div>
								<div style="max-width:300px"class="form-group">
									<input type="text" class="form-control" name="nama_kerusakan" size="10" maxlength="40" placeholder="Nama Jenis Kerusakan" autofocus required>
								</div>
								<div class="form-group">
									<input class="btn btn-success" type="submit" name="submit" value="Submit"/>
									<a class="btn btn-danger" href="jenis_kerusakan.php" >Batal</a>
								</div>
							</form>
					</div>
        	<!-- /. col-lg-12 -->
				</div>
				<!-- /. row -->
			</div>
      <!-- /. page-wrapper -->
		</div>
    <!-- /. wrapper -->
		<!-- footer -->
		<div style="text-align:right; font-size:80%; height:40px; background:#0059B2; color:#cce6ff; position:relative; bottom:0px; width:100%; padding:5px 20px; margin:20px 0px" >
			Copyright Informatika Undip 2017
		</div>
    <!-- close footer -->
	</body>
</html>
