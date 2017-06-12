<?php
session_start();
error_reporting(0);
if (!isset($_SESSION['level'])){
	header('location:/kpku/index.php');
	exit;
}elseif($_SESSION['level']!="ptg_fn"){
	header('location:/kpku/unauthorized.php');
}else{
	include('../../header.php');
}
//file:add_tahun.php
//deskripsi: menambah tahun untuk laporan anggaran

		require_once('../../config.php');
		$db = new mysqli($db_host, $db_username, $db_password, $db_database);
		if ($db->connect_errno){
			die ("Tidak dapat terkoneksi dengan database: <br />". $db->connect_error);
		}

		if(isset($_POST['submit'])){
			$id_tahun=$_POST['nama_tahun'];
			$nama_tahun=$_POST['nama_tahun'];

				//cek validasi id tahun dan nama tahun,krn text jadi validasinya:
				$nama_tahun=test_input($_POST["nama_tahun"]);
				if($nama_tahun==''){
					$error_nama_tahun="Mohon isi nama tahun";
					$valid_nama_tahun=FALSE;
				}
				if($nama_tahun<1000){
					$error_nama_tahun="Tahun Tidak Valid";
					$valid_nama_tahun=FALSE;
				}
				else{
					$valid_nama_tahun=TRUE;
				}

			//insert data into database
			if ($valid_nama_tahun){
				//escape inputs data
				$id_tahun = $db->real_escape_string($id_tahun);
				$nama_tahun = $db->real_escape_string($nama_tahun);

				//Asign a query
				$query = "INSERT INTO tahun (id_tahun,nama_tahun) VALUES('".$id_tahun."','".$nama_tahun."') ";
				// Execute the query
				$result = $db->query( $query );
				if (!$result){
					 die ("Could not query the database: <br />". $db->error);
				}else{
					echo "<script>alert('Tahun Sudah Ditambahkan')</script><br /><br />";
					echo "<script>window.open('index.php','_self')</script>";
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
						<h2>Tambah Tahun</h2>
						<form method="POST" autocomplete="on" action="add_tahun.php">
							<table>
								<tr>
									<td valign="top">Tahun</td>
									<td valign="top">:</td>
									<td valign="top"><input type="text" class="form-control" name="nama_tahun" size="15" maxlength="10" placeholder="Tahun" autofocus value="<?php if(isset( $nama_tahun)) {echo $nama_tahun;}?>"></td>
									<td valign="top"><span class="error">* <?php if(isset($error_nama_tahun)) {echo $error_nama_tahun;}?></span></td>
								</tr>

								<tr>
									<td valign="top" colspan="3"><br><input type="submit" class="btn btn-default" name="submit" value="Tambah">
								</tr>
							</table>
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

<?php
$db->close();
?>
