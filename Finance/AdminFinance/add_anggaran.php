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
	//File	: add_anggaran.php
//Deskripsi	: menambah anggaran baru pada bulan dan tahun tertentu

require_once('../../config.php');
$db = new mysqli($db_host, $db_username, $db_password, $db_database);
if ($db->connect_errno){
	die ("Tidak dapat terkoneksi dengan database: <br />". $db->connect_error);
}

if(isset($_POST['submit'])){
	$bulan=$_POST['bulan'];
	$tahun=$_POST['tahun'];
	$nama_anggaran=$_POST['nama_anggaran'];
	$anggaran=$_POST['anggaran'];
	//validasi
		if($nama_anggaran=="Pendapatan Tol" ||	$nama_anggaran=="Pendapatan Non Tol"){
			$tipe_anggaran=1;
			$flag="Tambah";
		}
		else if($nama_anggaran=="Gaji dan Tunjangan" || $nama_anggaran=="Bonus Insentif dan Pesangon" ||$nama_anggaran=="Kesehatan" || $nama_anggaran=="Lembur"||$nama_anggaran=="Kesejahteraan Lainnya" ){
			$tipe_anggaran=7;
			$flag="Kurang";
		}
		else if($nama_anggaran=="Pengumpulan Tol" || $nama_anggaran=="Pelayanan Pemakai Jalan Tol" ||$nama_anggaran=="Pemeliharaan Jalan Tol" || $nama_anggaran=="Lembur"||$nama_anggaran=="Kesejahteraan Lainnya
		" ){
			$tipe_anggaran=6;
			$flag="Kurang";
		}
		else if($nama_anggaran=="Pajak Bumi dan Bangunan" ){
			$tipe_anggaran=8;
			$flag="Kurang";
		}
		else if($nama_anggaran=="Penyusutan dan Amortisasi" ){
			$tipe_anggaran=9;
			$flag="Kurang";
		}
		else if($nama_anggaran=="Beban Umum dan Administrasi" ){
			$tipe_anggaran=10;
			$flag="Kurang";
		}
		else if($nama_anggaran=="Beban Overlay" ){
			$tipe_anggaran=11;
			$flag="Kurang";
		}
		else if($nama_anggaran=="Penghasilan Bunga" ){
			$tipe_anggaran=3;
			$flag="Tambah";
		}
		else if($nama_anggaran=="Penghasilan Lain-Lain" ){
			$tipe_anggaran=4;
			$flag="Tambah";
		}
		else if($nama_anggaran=="Beban Lain-Lain" ){
			$tipe_anggaran=5;
			$flag="Tambah";
		}
		$anggaran=test_input($_POST["anggaran"]);
		if($anggaran==''){
			$error_anggaran="Mohon Isi uang anggaran";
			$valid_anggaran=FALSE;
		}
		else{
			$valid_anggaran=TRUE;
		}

	//insert data into database
	if ($valid_anggaran){
		//escape inputs data
		$bulan = $db->real_escape_string($bulan);
		$tahun = $db->real_escape_string($tahun);
		$nama_anggaran = $db->real_escape_string($nama_anggaran);
		$tipe_anggaran = $db->real_escape_string($tipe_anggaran);
		$anggaran = $db->real_escape_string($anggaran);
		$flag = $db->real_escape_string($flag);
		//Asign a query
		$query = "INSERT INTO labarugi (bulan, tahun, nama_anggaran,tipe_anggaran,anggaran,flag) VALUES('".$bulan."','".$tahun."','".$nama_anggaran."','".$tipe_anggaran."','".$anggaran."','".$flag."') ";
		// Execute the query
		$result = $db->query( $query );
		if (!$result){
		   die ("Could not query the database: <br />". $db->error);
		}else{
			echo "<script>alert('Anggaran Sudah Ditambahkan')</script><br /><br />";
			echo "<script>window.open('view_anggaran_admin.php','_self')</script>";
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
		<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
    <title>Tambahn Laporan Anggaran Laba Rugi</title>
		<style>
			.error {color: #FF0000;}
		</style>
	</head>
	<body>
		<div id="wrapper">
			<div id="page-wrapper">
				<div class="row">
					<div class="col-lg-12">
						<h2>Tambah Anggaran</h2>
						<p class="error">Perhatian:Tidak boleh memasukkan Urma yang sama di tahun dan bulan yang sama</p>
						<form method="POST" autocomplete="on" action="add_anggaran.php">
							<table>
								<tr>
									<td valign="top">Bulan</td>
									<td valign="top">:</td>
									<td valign="top"><select class="form-control" name="bulan" required>
										<?php
											require_once('../../config.php');
											$db = new mysqli($db_host, $db_username, $db_password, $db_database);
											if($db->connect_errno){
												die("Tidak dapat terkoneksi dengan database: </br>". $db->connect_errno);
											}
											$query = "SELECT * FROM bulan";
											$result = $db->query($query);
											if(!$result){
												die("Query tidak terkoneksi dengan database: </br>" .$db->error);
											}
											echo "<option value=''>-- Pilih Bulan --</option>";
											while($row = $result->fetch_object()){
												$nama_bulan = $row->nama_bulan;
												$id_bulan = $row->id_bulan;
												echo "<option value='$id_bulan'>$nama_bulan</option>";
											}
										?>
									</select>
									</td>
									<td valign="top"></td>
								</tr>

								<tr>
									<td valign="top">Tahun</td>
									<td valign="top">:</td>
									<td valign="top"><select class="form-control" name="tahun" required>
										<?php
											require_once('../../config.php');
											$db = new mysqli($db_host, $db_username, $db_password, $db_database);
											if($db->connect_errno){
												die("Tidak dapat terkoneksi dengan database: </br>". $db->connect_errno);
											}
											$query = "SELECT * FROM tahun ORDER BY nama_tahun";
											$result = $db->query($query);
											if(!$result){
												die("Query tidak terkoneksi dengan database: </br>" .$db->error);
											}
											echo "<option value=''>-- Pilih Tahun --</option>";
											while($row = $result->fetch_object()){
											  $nama_tahun = $row->nama_tahun;
											  $id_tahun = $row->id_tahun;
												echo "<option value='$id_tahun'>$nama_tahun</option>";
											}
										?>
									</select>
									</td>
									<td valign="top"></td>
								</tr>

								<tr>
									<td valign="top">Urma</td>
									<td valign="top">:</td>
									<td valign="top"><select class="form-control" name="nama_anggaran" required>
										<option value="none" >--Pilih Nama Anggaran--</option>
										<option value="Pendapatan Tol">Pendapatan Tol</option>
										<option value="Pendapatan Non Tol">Pendapatan Non Tol</option>
										<option value="Gaji dan Tunjangan">Gaji dan Tunjangan</option>
										<option value="Bonus Insentif dan Pesangon">Bonus Insentif dan Pesangon</option>
										<option value="Kesehatan">Kesehatan</option>
										<option value="Lembur">Lembur</option>
										<option value="Kesejahteraan Lainnya">Kesejahteraan Lainnya</option>
										<option value="Pengumpulan Tol">Pengumpulan Tol</option>
										<option value="Pelayanan Pemakai Jalan Tol"> Pelayanan Pemakai Jalan Tol</option>
										<option value="Pemeliharaan Jalan Tol">Pemeliharaan Jalan Tol</option>
										<option value="Pajak Bumi dan Bangunan">Pajak Bumi dan Bangunan</option>
										<option value="Penyusutan dan Amortisasi">Penyusutan dan Amortisasi</option>
										<option value="Beban Umum dan Administrasi">Beban Umum dan Administrasi</option>
										<option value="Beban Overlay">Beban Overlay</option>
										<option value="Penghasilan Bunga">Penghasilan Bunga</option>
										<option value="Penghasilan Lain-Lain">Penghasilan Lain-Lain</option>
										<option value="Beban Lain-Lain">Beban Lain-Lain</option>
										</select>
									</td>
									<td valign="top"></td>
								</tr>
									<td valign="top">Anggaran</td>
									<td valign="top">:</td>
									<td valign="top"><input type="text" class="form-control" name="anggaran" size="30" maxlength="50" placeholder="Anggaran(Uang)" autofocus value="<?php if(isset( $anggaran)) {echo $anggaran;}?>"></td>
									<td valign="top"><span class="error">* <?php if(isset($error_anggaran)) {echo $error_anggaran;}?></span></td>
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
