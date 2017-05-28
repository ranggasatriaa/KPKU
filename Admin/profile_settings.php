<?php
	session_start();
	error_reporting(0);
	if (!isset($_SESSION['level'])){
		header('location:/kpku/index.php');
		exit;
	}elseif($_SESSION['level']!="admin"){
		header('location:/kpku/unauthorized.php');
	}else{
		include('../header.php');
	}

		//GET ID DAN NAMA USER YANG LOGIN
		require_once('../config.php');
		$npp=$_SESSION['npp'];

		$db = new mysqli($db_host, $db_username, $db_password, $db_database);
		if ($db->connect_errno){
			die ("Tidak dapat terkoneksi dengan database: <br />". $db->connect_error);
		}
		if (!isset($_GET["submit"])){
			$query = " SELECT * FROM petugas WHERE level='admin' ";
			// Execute the query
			$result = $db->query( $query );
			if (!$result){
				die ("Could not query the database: <br />". $db->error);
			}else{
				while ($row = $result->fetch_object()){ //semua data yg diselect itu dimasukin ke objek
				$nama = $row->nama;
				$npp = $row->npp;
				$password = $row->password;
				}
			}
		}else{
			$nama=test_input($_GET['nama']);
			$password=test_input($_GET["password"]);
			$npp=test_input($_GET["npp"]);
			$panjang=strlen($password);
			$confirmpassword=$_GET['confirmpassword'];
			$nama=test_input($_GET["nama"]);

			// if($nama==''){
			// 	$error_nama="Mohon isi nama user";
			// 	$valid_nama=FALSE;
			// }
			// else{
			// 	$valid_nama=TRUE;
			// }

			// $npp=test_input($_GET["npp"]);
			// if($npp==''){
			// 	$error_npp="Mohon isi npp user";
			// 	$valid_npp=FALSE;
			// }
			// else{
			// 	$valid_npp=TRUE;
			// }
			// $password=test_input($_GET["password"]);
			// if($password==''){
			// 	$error_password="Mohon isi password user";
			// 	$valid_password=FALSE;
			// }
			if($panjang>12){
				$error_password="Password Teralu Panjang";
				$valid_password=FALSE;
			}elseif($panjang<6){
				$error_password="Password Teralu Pendek";
				$valid_password=FALSE;
			// }elseif(!preg_match('/^[0-9A-Za-z_]$/', $password1)) {
			// 	$error_password="Hanya huruf, angka dan garis bawah diperbolehkan";
			// 	$valid_password=FALSE;
			}else{
				$valid_password=TRUE;
			}

			if($confirmpassword1!=$password1){
				$error_password_confirm="Password dan Konfirmasi Password Harus Sama";
				$valid_password_confirm=FALSE;
			}else{
				$valid_password_confirm=TRUE;
			}

			//update data into database
			if ($valid_password && $valid_password_confirm){
				//escape inputs data

				$nama = $db->real_escape_string($nama);
				$npp = $db->real_escape_string($npp);
				$password = md5($password);
				$password = $db->real_escape_string($password);
				//Asign a query
				$query = " UPDATE petugas SET nama='".$nama."',npp='".$npp."',password='".$password."'WHERE level='admin' ";
				// Execute the query
				$result = $db->query( $query );
				if (!$result){
				die ("Could not query the database: <br />". $db->error);
				}else{
					echo "<script>alert('Profil Sudah Diedit')</script><br /><br />";
					echo "<script>window.open('index.php','_self')</script>";
					$db->close();
					exit;
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
<!DOCTYPE HTML>
<html>
	<head>
		<style>
			.error {color: #FF0000;}
		</style>
	</head>
	<body>
		<div id="wrapper">
			<div id="page-wrapper">
				<div class="row">
					<div class="col-lg-12">
						<h2>Edit Profil</h2>
						<form method="GET" autocomplete="on" action="profile_settings.php">
							<div style="max-width:300px" class="form-group">
								<label>Nama:</label>
								<input type="text" class="form-control" name="nama" size="30" maxlength="40" placeholder="Nama User" autofocus value="<?php if(isset($nama)) {echo $nama;}?>" required>
								<span class="error"> <?php if(isset($error_nama)) {echo $error_nama;}?></span></td>
							</div>
							<div style="max-width:300px" class="form-group">
								<label>NPP:</label>
								<input type="text" class="form-control" name="npp" size="30" maxlength="40" placeholder="NPP tidak boleh sama" autofocus value="<?php if(isset($npp)) {echo $npp;}?>" required>
								<span class="error"> <?php if(isset($error_npp)) {echo $error_npp;}?></span>
							</div>
							<div style="max-width:300px" class="form-group">
								<label>Password:</label>
								<input type="password" class="form-control" name="password" size="30" maxlength="12" placeholder="Password(min 6 max 12)" autofocus required>
								<span class="error"> <?php if(isset($error_password)) {echo $error_password;}?></span>
							</div>
							<div style="max-width:300px" class="form-group">
								<label>Konfirmasi Password:</label>
								<input type="password" class="form-control" name="confirmpassword" size="30" maxlength="12" placeholder="Confirm Password" autofocus required>
								<span class="error"> <?php if(isset($error_password)) {echo $error_password;}?></span>
							</div>
							<div style="max-width:300px" class="form-group">
								<input type="submit" class="btn btn-success" name="submit" value="Ubah">
								<a style="float:right" class="btn btn-danger" href="index.php">Batal</a></td>
							</div>
						</form>


					</div>
					<!-- close col -->
				</div>
				<!-- /. row -->
			</div>
			<!-- close page-wrapper -->
		</div>
		<!-- /#wrapper -->
		<!-- footer -->
		<div style="text-align:right; font-size:80%; height:40px; background:#0059B2; color:#cce6ff; position:relative; bottom:0px; width:100%; padding:5px 20px; margin:20px 0px" >
			Copyright Informatika Undip 2017
		</div>
		<!-- close footer -->

	</body>
</html>
