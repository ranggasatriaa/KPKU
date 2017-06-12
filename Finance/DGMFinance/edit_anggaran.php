<?php
session_start();
error_reporting(0);
if (!isset($_SESSION['level'])){
	header('location:/kpku/index.php');
	exit;
}elseif($_SESSION['level']!="dgm_fn"){
	header('location:/kpku/unauthorized.php');
}else{
	include('../../header.php');
}

$no_anggaran = $_GET['id'];
	// connect database
	require_once('../../config.php');
	$db = new mysqli($db_host, $db_username, $db_password, $db_database);
	if ($db->connect_errno){
		die ("Could not connect to the database: <br />". $db->connect_error);
	}

	if (!isset($_GET["submit"])){
		$query = " SELECT * FROM labarugi WHERE no_anggaran=".$no_anggaran." ";
		// Execute the query
		$result = $db->query( $query );
		if (!$result){
			die ("Could not query the database: <br />". $db->error);
		}else{
			while ($row = $result->fetch_object()){ //semua data yg diselect itu dimasukin ke objek
				$anggaran = $row->anggaran;
			}
		}
	}else{
		$anggaran=test_input($_GET["anggaran"]);
		if($anggaran<0){
			$error_anggaran="Anggaran Harus Positif";
			$valid_anggaran=FALSE;
		}
		else if($anggaran==''){
			$error_anggaran="Mohon Isi uang anggaran";
			$valid_anggaran=FALSE;
		}
		else if (!is_numeric($anggaran)) {
			$error_anggaran="Anggaran Harus Angka";
			$valid_anggaran=FALSE;
		} 
		else{
			$valid_anggaran=TRUE;
		}

			//update data into database
				if ($valid_anggaran){
				//escape inputs data
				$anggaran = $db->real_escape_string($anggaran);
				//Asign a query
				$query = " UPDATE labarugi SET anggaran='".$anggaran."' WHERE no_anggaran=".$no_anggaran." ";
				// Execute the query
				$result = $db->query( $query );
				if (!$result){
				die ("Could not query the database: <br />". $db->error);
				}else{

					echo "<script>alert('Anggaran Sudah Diedit')</script><br /><br />";
					$query2="SELECT bulan,tahun FROM labarugi where no_anggaran=".$no_anggaran."";
					$result2 = $db->query( $query2 );
						while($row2 = $result2->fetch_object()){
							$bulan = $row2->bulan;
							$tahun = $row2->tahun;
						}
					echo "<script>window.open('view_anggaran_DGM.php?bulan=$bulan&tahun=$tahun&submit=Browse','_self')</script>";
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
    <title>Edit Laporan Anggaran Laba Rugi</title>
		<style>
			.error {color: #FF0000;}
		</style>
	</head>
	<body>
		<div id="wrapper">
			<div id="page-wrapper">
				<div class="row">
				  <div class="col-lg-12">
						<h2>Edit Anggaran</h2>
						<form method="GET" autocomplete="on" action="edit_anggaran.php">
							<table>
								<tr>
									<td valign="top"><input type="hidden" class="form-control" name="id" size="30" maxlength="50" placeholder="Anggaran(Uang)" autofocus value="<?php if(isset( $no_anggaran)) {echo $no_anggaran;}?>"></td>
								</tr>
								</tr>
									<td valign="top">Anggaran</td>
									<td valign="top">:</td>
									<td valign="top"><input type="text" class="form-control" name="anggaran" size="30" maxlength="50" placeholder="Anggaran(Uang)" autofocus value="<?php if(isset( $anggaran)) {echo $anggaran;}?>"></td>
									<td valign="top"><span class="error">* <?php if(isset($error_anggaran)) {echo $error_anggaran;}?></span></td>
								</tr>

								<tr>
									<td valign="top" colspan="3"><br><input type="submit" class="btn btn-default" name="submit" value="Edit">
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
