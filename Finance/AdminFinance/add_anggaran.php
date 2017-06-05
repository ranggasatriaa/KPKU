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

if(isset($_GET['submit'])){
	$bulan=$_GET['bulan'];
	$tahun=$_GET['tahun'];
	$nama_anggaran=$_GET['nama_anggaran'];
	$anggaran=$_GET['anggaran'];
	//validasi untuk menampilkan grafik
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
	//validasi untuk error pada anggaran
		$anggaran=test_input($_GET["anggaran"]);
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
		//Asign a query
		$query = "INSERT INTO labarugi (bulan, tahun, nama_anggaran,tipe_anggaran,anggaran) VALUES('".$bulan."','".$tahun."','".$nama_anggaran."','".$tipe_anggaran."','".$anggaran."') ";
		// Execute the query
		$result = $db->query( $query );
		if (!$result){
		   die ("Could not query the database: <br />". $db->error);
		}else{
			echo "<script>alert('Anggaran Sudah Ditambahkan')</script><br /><br />";
			echo "<script>window.open('view_anggaran_admin.php?bulan=$bulan&tahun=$tahun&submit=Browse','_self')</script>";
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
						<?php
							$bulan=$_GET['bulan'];
							$tahun=$_GET['tahun'];
							$nama_anggaran=$_GET['nama_anggaran'];
						?>
						<form method="GET" autocomplete="on" action="add_anggaran.php">
							<table>
								<input type="hidden" name ="bulan" value="<?php echo $bulan;?>">
								<input type="hidden" name ="tahun" value="<?php echo $tahun;?>">
								<input type="hidden" name ="nama_anggaran" value="<?php echo $nama_anggaran;?>">
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
