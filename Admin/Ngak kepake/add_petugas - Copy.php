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
							<table >
								<tr>
									<td>Nama</td>
									<td>:</td>
									<td><input type="text" class="form-control" name="nama" size="30" maxlength="40" placeholder="Nama User" autofocus value="<?php if(isset($nama)) {echo $nama;}?>" required></td>
									<td><span class="error"> <?php if(isset($error_nama)) {echo $error_nama;}?></span></td>
								</tr>
								<tr>
									<td>NIP</td>
									<td>:</td>
									<td><input type="text" class="form-control" name="nip" size="30" maxlength="40" placeholder="NIP tidak boleh sama" autofocus value="<?php if(isset($nip)) {echo $nip;}?>" required></td>
									<td><span class="error"> <?php if(isset($error_nip)) {echo $error_nip;}?></span></td>
								</tr>
								<tr>
									<td>Password</td>
									<td>:</td>
									<td><input type="password" class="form-control" name="password" size="30" maxlength="12" placeholder="Password(min 6 max 12)" autofocus value="<?php if(isset($password)) {echo $password;}?>" required></td>
									<td><span class="error"> <?php if(isset($error_password)) {echo $error_password;}?></span></td>
								</tr>
								<tr>
									<td>Confirm Password</td>
									<td>:</td>
									<td><input type="password" class="form-control" name="confirmpassword" size="30" maxlength="12" placeholder="Confirm Password" autofocus value="<?php if(isset($valid_password_confirm)) {echo $valid_password_confirm;}?>" required></td>
									<td><span class="error"> <?php if(isset($error_password)) {echo $error_password;}?></span></td>
								</tr>
								<tr>
								<td>Level</td>
								<td>:</td>
								<td>
									<select class="form-control" name="level" required>
										<option value="none" <?php if (!isset($level)) echo 'selected="true"';?>>--Pilih Jabatan--</option>
										<option value="gm" <?php if (isset($level) && $level=="gm") echo 'selected="true"';?>>General Manager</option>
										<option value="dgm_hrga" <?php if (isset($level) && $level=="dgm_hrga") echo 'selected="true"'; ?>>DGM HRGA</option>
										<option value="dgm_op" <?php if (isset($level) && $level=="dgm_op") echo 'selected="true"'; ?>>DGM Operasional</option>
										<option value="dgm_fn" <?php if (isset($level) && $level=="dgm_fn") echo 'selected="true"'; ?>>DGM Finance</option>
										<option value="ptg_hrga" <?php if (isset($level) && $level=="ptg_hrga") echo 'selected="true"'; ?>>Petugas HRGA</option>
										<option value="ptg_op" <?php if (isset($level) && $level=="ptg_op") echo 'selected="true"'; ?>>Petugas Operasional</option>
										<option value="ptg_fn" <?php if (isset($level) && $level=="ptg_fn") echo 'selected="true"'; ?>>Petugas Finance</option>
									</select>
								</td>
								<td><span class="error"> <?php if(isset($error_level)) {echo $error_level;}?></span></td>
							</tr>
								<tr>
									<td><br><input type="submit" class="btn btn-success" name="submit" value="Tambah"></td>
									<td></td>
									<td align="right"><br><a class="btn btn-danger" href="index.php">Batal</a></td>
								</tr>
							</table>
						</form>
						<?php
							require_once('../config.php');
							$db = new mysqli($db_host, $db_username, $db_password, $db_database);
							if ($db->connect_errno){
								die ("Tidak dapat terkoneksi dengan database: <br />". $db->connect_error);
							}

							if(isset($_POST['submit'])){
								$nama=test_input($_POST['nama']);
								$nip=test_input($_POST['nip']);
								$password=test_input($_POST['password']);
								$panjang=strlen($password);
								$confirmpassword=$_POST['confirmpassword'];
								$level=$_POST['level'];
								//cek validasi id tahun dan nama tahun,krn text jadi validasinya:
								// $nama=test_input($_POST["nama"]);

								// $password=test_input($_POST["password"]);
								if($panjang>12){
									$error_password="Password Teralu Panjang";
									$valid_password=FALSE;
								}elseif($panjang<6){
									$error_password="Password Teralu Pendek";
									$valid_password=FALSE;
								// }elseif(!preg_match("/^[a-zA-Z .]*$/",$password)) {
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
								//insert data into database
								if ($valid_password && $valid_password_confirm){
									//escape inputs data
									$nama = $db->real_escape_string($nama);
									$nip = $db->real_escape_string($nip);
									$password = $db->real_escape_string($password);
									$level = $db->real_escape_string($level);
									//Asign a query
									$query = "INSERT INTO petugas (nama,nip,password,level) VALUES('".$nama."','".$nip."','".$password."','".$level."') ";
									// Execute the query
									$result = $db->query( $query );
									if (!$result){
										 die ('<br/><div class="alert alert-danger alert-dismissable">Could not query the database: '.$db->error.'</div>');
									}else{
										echo '<script>alert("User Sudah Ditambahkan")</script><br /><br />';
										echo '<script>window.open("index.php","_self")</script>';
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
