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

?>


<!DOCTYPE HTML>
<html>
	<head>
		<title>Tambah Petugas</title>
		<style>
			.error {color: #FF0000;}
		</style>
	</head>
	<body>
		<div id="wrapper">
			<div id="page-wrapper">
				<div class="row">
					<div class="col-lg-12">
						<h2>Tambah User</h2>
						<form method="POST" autocomplete="on" action="add_petugas.php">
							<div style="max-width:300px" class="form-group">
								<label>NPP:</label>
								<input type="text" class="form-control" name="npp" size="30" maxlength="40" placeholder="NPP tidak boleh sama" autofocus required>
							</div>
							<div style="max-width:300px" class="form-group">
								<label>Nama:</label>
								<input type="text" class="form-control" name="nama" size="30" maxlength="40" placeholder="Nama User" autofocus required>
							</div>
							<div style="max-width:300px" class="form-group">
								<label>Level:</label>
								<select class="form-control" name="level" required>
									<option value="" <?php if (!isset($level)) echo 'selected="true"';?>>--Pilih Jabatan--</option>
									<option value="gm" <?php if (isset($level) && $level=="gm") echo 'selected="true"';?>>General Manager</option>
									<option value="dgm_hrga" <?php if (isset($level) && $level=="dgm_hrga") echo 'selected="true"'; ?>>DGM HRGA</option>
									<option value="dgm_op" <?php if (isset($level) && $level=="dgm_op") echo 'selected="true"'; ?>>DGM Operasional</option>
									<option value="dgm_fn" <?php if (isset($level) && $level=="dgm_fn") echo 'selected="true"'; ?>>DGM Finance</option>
									<option value="ptg_hrga" <?php if (isset($level) && $level=="ptg_hrga") echo 'selected="true"'; ?>>Petugas HRGA</option>
									<option value="ptg_op" <?php if (isset($level) && $level=="ptg_op") echo 'selected="true"'; ?>>Petugas Operasional</option>
									<option value="ptg_fn" <?php if (isset($level) && $level=="ptg_fn") echo 'selected="true"'; ?>>Petugas Finance</option>
								</select>
							</div>
							<div style="max-width:300px" class="form-group">
								<input type="submit" class="btn btn-success" name="submit" value="Tambah">
								<a style="float:right"class="btn btn-danger" href="index.php">Batal</a>
							</div>
						</form>
						<?php
							require_once('../config.php');
							//inisiasi database
							$db = new mysqli($db_host, $db_username, $db_password,
							$db_database);
							if ($db->connect_errno){
								die ("Tidak dapat terkoneksi dengan database: <br />".
								$db->connect_error);
							}
							//kondisi jika submit terdapat isi
							if(isset($_POST['submit'])){
								//menentukan nilai variabel dari inputan
								$nama		= test_input($_POST['nama']);
								$npp 		= test_input($_POST['npp']);
								$password	= md5('123456');
								$level	= $_POST['level'];

								//quary untuk mencari npp yang sama
								$querynpp = "SELECT * FROM petugas WHERE npp='$npp' ";
								// Menjalankan query
								$resultnpp = $db->query( $querynpp );
								$jumlahnpp = $resultnpp->num_rows;

								//mendeteksi inputan npp apakah sesuai dengan ketentuan
								if(!preg_match("/^[0-9]*$/",$npp)) {
									echo '<script>alert("NPP Tidak Valid: Hanya angka tanpa spasi yang diperbolehkan")</script><br /><br />';
									echo '<script> window.open ("add_petugas.php","_self")
									</script>';
										$valid_npp=FALSE;
								}elseif(strlen($npp)>5){
									echo '<script> alert("NPP terlalu panjang ")</script><br /><br />';
									echo '<script> window.open ("add_petugas.php","_self") </script>';
									$valid_npp=FALSE;
								}elseif(strlen($npp)<5 ){
									echo '<script>alert("NPP terlalu pendek ")</script><br /><br />';
									echo '<script> window.open ("add_petugas.php","_self") </script>';
									$valid_npp=FALSE;
								}elseif ($jumlahnpp != 0){
									echo '<script>alert("NPP sudah digunakan ")</script><br /><br />';
									echo '<script> window.open ("add_petugas.php","_self") </script>';
									$valid_npp=FALSE;
								}else{
									$valid_npp=TRUE;
								}

								if ($valid_npp==TRUE){
								//escape inputs data
								$nama = $db->real_escape_string($nama);
								$npp = $db->real_escape_string($npp);
								$password = $db->real_escape_string($password);
								$level = $db->real_escape_string($level);
								//query untuk menambah data baru ke dalam tabel petugas
								$query = "INSERT INTO petugas (npp,nama,password,level)	VALUES ('$npp','$nama','$password','$level') ";
								// Menjalankan query
								$result = $db->query( $query );
								if (!$result){
									die ('<br/><div class="alert alert-danger">Tidak bisa menambah user: '.$db->error.'</div>');
								}else{
									echo '<script>alert("User Sudah Ditambahkan")
									</script><br /><br />';
									echo '<script> window.open("index.php","_self")
									</script>';
									$db->close();
								}
							}
						}
						//fungsi mendeteksi input data
						function test_input($data) {
							$data = trim($data);
							$data = stripslashes($data);
							$data = htmlspecialchars($data);
							return $data;
						}

						?>
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
