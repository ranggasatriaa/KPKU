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
			$npp=test_input($_GET["npp"]);
			$password=test_input($_GET["password"]);
			$confirmpassword=$_GET['confirmpassword'];
			$panjang=strlen($password);
			$nama=test_input($_GET["nama"]);

			//mendeteksi inputan npp apakah sesuai dengan ketentuan
			//validasi npp
			if(!preg_match("/^[0-9]*$/",$npp)) {
				echo '<script>alert("NPP Tidak Valid: Hanya angka tanpa spasi yang diperbolehkan")</script><br /><br />';
				echo '<script> window.open ("profile_settings.php","_self")
				</script>';
					$valid_npp=FALSE;
			}elseif(strlen($npp)>5){
				echo '<script> alert("NPP terlalu panjang ")</script><br /><br />';
				echo '<script> window.open ("profile_settings.php","_self") </script>';
				$valid_npp=FALSE;
			}elseif(strlen($npp)<5 ){
				echo '<script>alert("NPP terlalu pendek ")</script><br /><br />';
				echo '<script> window.open ("profile_settings.php","_self") </script>';
				$valid_npp=FALSE;
			}else{
				$valid_npp=TRUE;
			}
			//validasi password
			if($panjang>12){
				echo '<script>alert("Password terlalu panjang ")</script><br /><br />';
				echo '<script> window.open ("profile_settings.php","_self") </script>';
				//$error_password="Password Terlalu Panjang";
				$valid_password=FALSE;
			}elseif($panjang<6){
				echo '<script>alert("password terlalu pendek ")</script><br /><br />';
				echo '<script> window.open ("profile_settings.php","_self") </script>';
				// $error_password="Password Terlalu Pendek";
				$valid_password=FALSE;
			}else{
				$valid_password=TRUE;
			}

			if($confirmpassword!=$password){
				echo '<script>alert("Password dan Konfirmasi password berbeda")</script><br /><br />';
				echo '<script> window.open ("profile_settings.php","_self") </script>';
				//$error_password_confirm="Password dan Konfirmasi Password Harus Sama";
				$valid_password_confirm=FALSE;
			}else{
				$valid_password_confirm=TRUE;
			}

			//update data into database
			if ($valid_password && $valid_password_confirm && $valid_npp){
				//escape inputs data

				$nama = $db->real_escape_string($nama);
				$npp = $db->real_escape_string($npp);
				$password = md5($password);
				$password = $db->real_escape_string($password);
				//Asign a query
				$query = " UPDATE petugas SET nama='$nama',npp='$npp',password='$password' WHERE level='admin' ";
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
								<label>NPP:</label>
								<input type="text" class="form-control" name="npp" size="30" maxlength="40" placeholder="NPP tidak boleh sama" autofocus value="<?php if(isset($npp)) {echo $npp;}?>" required>
								<span class="error"> <?php if(isset($error_npp)) {echo $error_npp;}?></span>
							</div>
							<div style="max-width:300px" class="form-group">
								<label>Nama:</label>
								<input type="text" class="form-control" name="nama" size="30" maxlength="40" placeholder="Nama User" autofocus value="<?php if(isset($nama)) {echo $nama;}?>" required>
								<span class="error"> <?php if(isset($error_nama)) {echo $error_nama;}?></span></td>
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
