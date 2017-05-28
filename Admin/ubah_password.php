<?php
	session_start();
	error_reporting(0);
	if (!isset($_SESSION['level'])){
		header('location:/kpku/index.php');
		exit;
	}else{
		include('../header.php');
	}

	$id = $_GET['id'];
	require_once('../config.php');
	$db = new mysqli($db_host, $db_username, $db_password, $db_database);
		if ($db->connect_errno){
			die ("Tidak dapat terkoneksi dengan database: <br/>". $db->connect_error);
		}

		if (isset($_GET["submit"])){
			$password_lama =md5($_GET["password_lama"]);
			$password_baru1 =$_GET['password_baru1'];
			$password_baru2 =$_GET['password_baru2'];
			$panjang = strlen($password_baru1);
			$id = $_GET['id'];

			$query = "SELECT * FROM petugas where npp=$id";
			// Execute the query
			$result = $db->query( $query );
			if (!$result){
				die ("Could not query the database: <br />". $db->error);
			}
			else{
				while ($row = $result->fetch_object()){ //semua data yg diselect itu dimasukin ke objek
					$password = $row->password;
			}
			if($password_lama==$password){
				if($panjang>12){
					echo "<script>alert('Password Baru Terlalu Panjang. Maksimal 12 Karakter')</script><br /><br />";
					echo "<script>window.open('ubah_password.php?id=".$id.",'_self')</script>";
					$valid_password=FALSE;
				}elseif($panjang<6){
					echo "<script>alert('Password Baru Terlalu Pendek. Minimal 6 Karakter')</script><br /><br />";
					echo "<script>window.open('ubah_password.php?id=".$id.",'_self')</script>";
					$valid_password=FALSE;
				}else{
					$valid_password=TRUE;
				}
				if($password_baru2!=$password_baru1){
					echo "<script>alert('Konfirmasi Password Baru Tidak sama')</script><br /><br />";
					echo "<script>window.open('ubah_password.php?id=".$id.",'_self')</script>";
					$valid_password_confirm=FALSE;
				}else{
					$valid_password_confirm=TRUE;
				}
				if ( $valid_password && $valid_password_confirm){
					//escape inputs data
					$password_barumd5 = md5($password_baru1);
					$password_barumd5 = $db->real_escape_string($password_barumd5);
					//Asign a query
					$query = " UPDATE petugas SET password='".$password_barumd5."'  WHERE npp='".$id."' ";
					// Execute the query
					$result = $db->query( $query );
					if (!$result){
					   die ("Could not query the database2: <br />". $db->error);
					}else{
						echo "<script>alert('Password Sudah Diedit')</script><br /><br />";
						echo "<script>window.open('";
						if($_SESSION['level']=="gm"){
							echo '/KPKU/GM/index.php';
						}elseif($_SESSION['level']=="dgm_hrga"){
							echo '/KPKU/HRGA/index.php';
						}elseif($_SESSION['level']=="dgm_op"){
							echo '/KPKU/Operasional/index.php';
						}elseif($_SESSION['level']=="dgm_fn"){
							echo '/KPKU/Finance/DGMFinance/index.php';
						}elseif($_SESSION['level']=="ptg_hrga"){
							echo '/KPKU/HRGA/index.php';
						}elseif($_SESSION['level']=="ptg_op"){
							echo '/KPKU/Operasional/Maintenance/index.php';
						}elseif($_SESSION['level']=="ptg_fn"){
							echo '/KPKU/Finance/AdminFinance/index.php';
						}
						echo "','_self')</script>";
						$db->close();
						exit;
					}
				}
			}else{
				echo "<script>alert('Password Lama Salah')</script><br /><br />";
				echo "<script>window.open('ubah_password.php?id=".$id.",'_self')</script>";
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
		<title>Ubah Password</title>
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
						<form method="GET" autocomplete="on" action="ubah_password.php">
							<input type="hidden" name="id"  value="<?php echo $id?>">
							<div style="max-width:300px" class="form-group">
								<label>Password Lama:</label>
								<input type="password" class="form-control" name="password_lama" size="30" maxlength="12" placeholder="Password(min 6 max 12)" autofocus required>
							</div>
							<div style="max-width:300px" class="form-group">
								<label>Password Baru:</label>
								<input type="password" class="form-control" name="password_baru1" size="30" maxlength="12" placeholder="Password(min 6 max 12)" autofocus required>
							</div>
							<div style="max-width:300px" class="form-group">
								<label>Ulang Password Lama:</label>
								<input type="password" class="form-control" name="password_baru2" size="30" maxlength="12" placeholder="Ulangi Password" autofocus required>
							</div>
							<div style="max-width:300px" class="form-group">
								<input type="submit" class="btn btn-success" name="submit" value="Ubah">
								<?php
									if($_SESSION['level']=="gm"){
										echo '<a style="float:right" class="btn btn-danger" href="/KPKU/GM/index.php">Batal</a>';
									}elseif($_SESSION['level']=="dgm_hrga"){
										echo '<a style="float:right" class="btn btn-danger" href="/KPKU/HRGA/index.php">Batal</a>';
									}elseif($_SESSION['level']=="dgm_op"){
										echo '<a style="float:right" class="btn btn-danger" href="/KPKU/Operasional/index.php">Batal</a>';
									}elseif($_SESSION['level']=="dgm_fn"){
										echo '<a style="float:right" class="btn btn-danger" href="/KPKU/Finance/DGMFinance/index.php">Batal</a>';
									}elseif($_SESSION['level']=="ptg_hrga"){
										echo '<a style="float:right" class="btn btn-danger" href="/KPKU/HRGA/index.php">Batal</a>';
									}elseif($_SESSION['level']=="ptg_op"){
										echo '<a style="float:right" class="btn btn-danger" href="/KPKU/Operasional/Maintenance/index.php">Batal</a>';
									}elseif($_SESSION['level']=="ptg_fn"){
										echo '<a style="float:right" class="btn btn-danger" href="/KPKU/Finance/AdminFinance/index.php">Batal</a>';
									}
								?>
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
