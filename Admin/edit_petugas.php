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

	$id = $_GET['id'];
	require_once('../config.php');
	$db = new mysqli($db_host, $db_username, $db_password, $db_database);
		if ($db->connect_errno){
			die ("Tidak dapat terkoneksi dengan database: <br/>". $db->connect_error);
		}

		if (!isset($_GET["submit"])){
			$query = " SELECT * FROM petugas WHERE npp='$id' ";
			// Execute the query
			$result = $db->query( $query );
			if (!$result){
				die ("Could not query the database1: <br />". $db->error);
			}else{
				while ($row = $result->fetch_object()){ //semua data yg diselect itu dimasukin ke objek
					$nama = $row->nama;
					$npp = $row->npp;
					$level = $row->level;
					$id = $_GET['id'];
				}
			}
		}else{
		$nama = test_input($_GET['nama']);
		$level = $_GET['level'];
		$id = $_GET['id'];

			//update data into database
			//escape inputs data
			$nama = $db->real_escape_string($nama);
			$level = $db->real_escape_string($level);
			//Asign a query
			$query = " UPDATE petugas SET nama='$nama',level='$level' WHERE npp='$id' ";
			// Execute the query
			$result = $db->query( $query );
			if (!$result){
			   die ("Could not query the database2: <br />". $db->error);
			}else{
				echo "<script>alert('Data User Sudah Diubah')</script><br /><br />";
				echo "<script>window.open('index.php','_self')</script>";
				$db->close();
				exit;
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
		<title>Edit Petugas</title>
		<style>
			.error {color: #FF0000;}
		</style>
	</head>
	<body>
		<div id="wrapper">
			<div id="page-wrapper">
				<div class="row">
					<div class="col-lg-12">
						<h2>Edit Data User</h2>
						<form method="GET" autocomplete="on" action="edit_petugas.php">
							<input type="hidden" name="id"  value="<?php echo $npp?>">
							<div style="max-width:300px" class="form-group">
								<label>NPP: <?php if(isset($npp)) {echo $npp;}?></label>
							</div>
							<div style="max-width:300px" class="form-group">
								<label>Nama:</label>
								<input type="text" class="form-control" name="nama" size="30" maxlength="40" placeholder="Nama User" autofocus value="<?php if(isset($nama)) {echo $nama;}?>" required>
							</div>
							<div style="max-width:300px" class="form-group">
								<label>Level:</label>
								<select class="form-control" name="level" required>
									<option value="" <?php if (!isset($level)) echo 'selected="true"';?>>--Pilih Jabatan--</option>
									<option value="gm" <?php if (isset($level) && $level=="gm") echo 'selected="true"';?>>General Manager</option>
									<option value="dgm_hrga" <?php if (isset($level) && $level=="dgm_hrga") echo 'selected="true"'; ?>>DGM HRGA</option>
									<option value="dgm_op" <?php if (isset($level) && $level=="dgm_op") echo 'selected="true"'; ?>>DGM Operasional</option>
									<option value="dgm_fn" <?php if (isset($level) && $level=="dgm_fn") echo 'selected="true"'; ?>>DGM Finance</option>
									<option value="ptg_hrga" <?php if (isset($level) && $level=="ptg_hrga") echo 'selected="true"'; ?>>Admin HRGA</option>
									<option value="ptg_op" <?php if (isset($level) && $level=="ptg_op") echo 'selected="true"'; ?>>Admin Operasional</option>
									<option value="ptg_fn" <?php if (isset($level) && $level=="ptg_fn") echo 'selected="true"'; ?>>Admin Finance</option>
									</select>
							</div>
							<div style="max-width:300px" class="form-group">
								<input type="submit" class="btn btn-success" name="submit" value="Ubah">
								<a style="float:right" class="btn btn-danger" href="index.php">Batal</a>
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
