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

if(isset($_GET['submit'])){
	$idjenis_inspeksi=$_GET['idjenis_inspeksi'];
	$nama_inspeksi=$_GET['nama_inspeksi'];

	if(!preg_match("/^[a-z A-Z]*$/",$nama_inspeksi)) {
		echo '<script>alert("Nama Tidak Valif: Hanya huruf tanpa spasi yang diperbolehkan")</script><br /><br />';
		echo '<script>window.open("add_jenis_inspeksi.php","_self")</script>';
		$valid_nama=FALSE;
	}else{
		$valid_nama=TRUE;
	}

	if ($valid_nama){
		//insert data into database
			$idjenis_inspeksi =  $db->real_escape_string($idjenis_inspeksi);
			$nama_inspeksi = $db->real_escape_string($nama_inspeksi);

			//Asign a query
			$query = "UPDATE jenis_inspeksi SET idjenis_inspeksi='$idjenis_inspeksi', nama_inspeksi='$nama_inspeksi' WHERE idjenis_inspeksi='$idjenis_inspeksi' ";
			// Execute the query
			$result = $db->query( $query );
			if (!$result){
				 die ("Could not query the database: <br />". $db->error);
			}else{
				echo "<script>alert('Jenis Inspeksi Berhasil Dirubah')</script><br /><br />";
				echo "<script>window.open('jenis_inspeksi.php','_self')</script>";
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
		<title>Ubah Inspeksi</title>
	</head>
	<body>
		<div id="wrapper">
			<!-- <div style="position: inherit; margin: 0 0 0 195px; padding: 0 30px; border-left: 2px solid #e7e7e7; padding: 0 15px; min-height: 568px; background-color: white;"> -->
			<div id="page-wrapper">
				<div class="row">
	        <div class="col-lg-12">
						<?php
							$idjenis_inspeksi = $_GET['id'];
							require_once('../config.php');
							$db = new mysqli($db_host, $db_username, $db_password, $db_database);
							if($db->connect_errno){
								die("Tidak dapat terkoneksi dengan database: </br>". $db->connect_errno);
							}
								// query untuk preview
								$query_edit = "SELECT * FROM jenis_inspeksi WHERE idjenis_inspeksi=$idjenis_inspeksi";
								$result_edit =  $db->query($query_edit);
								if (!$result_edit){
									die ("Could not query the database: <br />". $db->error);
								}else{
									$row_e = $result_edit->fetch_object();
									$nama_inspeksi 		= $row_e->nama_inspeksi;
								}
						?>
						<form action="edit_jenis_inspeksi.php" method="GET" />
							<input type="hidden" name="idjenis_inspeksi" value="<?php echo $idjenis_inspeksi;?>" />
								<h3 align="left"> Masukkan Nama Inspeksi Pengganti </h3>
								<div class="form-group">
									<label>Nama Inspeksi:</label>
								</div>
								<div style="max-width:300px"class="form-group">
									<input type="text" class="form-control" name="nama_inspeksi" size="10" maxlength="40" placeholder="Nama User" autofocus required value="<?php if(isset($nama_inspeksi)) {echo $nama_inspeksi;}?>">
								</div>
								<div class="form-group">
									<input class="btn btn-success" type="submit" name="submit" value="Submit"/>
									<a class="btn btn-danger" href="jenis_inspeksi.php" >Batal</a>
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
