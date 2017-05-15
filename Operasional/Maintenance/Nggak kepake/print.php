<?php
session_start();
error_reporting(0);
if (!isset($_SESSION['level'])){
	header('location:../../index.php');
	exit;
}elseif (isset($_SESSION['level'])){
	include('header_ops.php');
}
?>

<!DOCTYPE html>
<html lang="id">
	<head>
  </head>

	<body style="background-color:#FFF">
    <div id="wrapper">
			<div style="position: inherit; margin: 0 0 0 195px; padding: 0 30px; border-left: 2px solid #e7e7e7; padding: 0 15px; min-height: 568px; background-color: white;">
			  <div class="col-lg-12">
					<form action="print_inspeksi.php" method="POST" autocomplete="on">
	    			<input type="date" name="tanggal" required>
						<input type="submit" class="btn btn-primary" name="submit"></input>
					</form>
					<?php

					if(isset($_POST['submit'])){
						require_once ('../../config.php');
						$db=new mysqli($db_host,$db_username,$db_password,$db_database) or
						die("Maaf Anda gagal koneksi.!");
						if($_POST['tanggal']==''){
							die ("Masukkan tanggal inspeksi terlebih dahulu");
						}else{
							$idinspeksi = "20170101001";
							$tanggal = $_POST['tanggal'];
							$tanggaldmy = date('d-m-Y', strtotime($tanggal));
							$jumlah  = 1;
							// $jumlah1[]  = array();
							$db=new mysqli($db_host,$db_username,$db_password,$db_database);
							if ($db->connect_errno){
								die ("Maaf Anda gagal koneksi.!: <br />". $db->connect_error);
							}
							// $query_kerusakan = " SELECT * FROM inspeksi WHERE waktu_kerusakan=".$tanggal." ";
							$query_kerusakan = " SELECT * FROM inspeksi
												 JOIN petugas ON inspeksi.idpetugas=petugas.idpetugas
												 JOIN jenis_inspeksi ON inspeksi.idjenis_inspeksi=jenis_inspeksi.idjenis_inspeksi
												 JOIN jenis_kerusakan ON inspeksi.idjenis_kerusakan=jenis_kerusakan.idjenis_kerusakan
												 WHERE waktu_kerusakan=".$idinspeksi." ";
							$result_kerusakan = $db->query($query_kerusakan);

							if (!$result_kerusakan){
								die ("Could not query the database: <br />". $db->error);
							}else{
								// while ($row_k = $result_kerusakan->fetch_object()){
								// 	$jumlah[] = $row_k;
								// }

							// close else result
							$count = count($jumlah);
							$count1 = count($jumlah1);
							$a = $result_perbaikan->num_rows;
							echo $a;
							echo $count;
							echo $tanggal;

							// echo $result_perbaikan ->num_rows;
							if($jumlah==0){
								echo '<div class="alert alert-danger">Tidak ada inspeksi pada tanggal '.$tanggaldmy.'</div>';
							}else{
								echo '<h3 align="center">Kerusakan pada tanggal '.$tanggaldmy.'</h3>';
								while ($row_k = $result_kerusakan->fetch_object()){
									echo '<div style="border-bottom: 2px  solid #ddd; border-top: 2px  solid #ddd;">';
									echo '<table width="100%">';
										echo '<tr>';
										echo '<th>Tanggal  Kerusakan</th>';
										echo '<th>:</th>';
										echo '<td>'.$tanggaldmy.'</td>';
										echo '</tr';
										echo '<tr>';
										echo '<th>Jenis Inspeksi</th>';
										echo '<th>:</th>';
										echo '<td>'.$row_k->jenis_inspeksi.'</td>';
										echo '</tr';
										echo '<tr>';
										echo '<th>Jenis Kerusakan</th>';
										echo '<th>:</th>';
										echo '<td>'.$row_k->jenis_kerusakan.'</td>';
										echo '</tr';
										echo '<tr>';
										echo '<th>Petugas Pelapor</th>';
										echo '<th>:</th>';
										echo '<td>'.$row_k->petugas.'</td>';
										echo '</tr';
										echo '<tr>';
										echo '<th>Lokasi</th>';
										echo '<th>:</th>';
										echo '<td>'.$row_k->lokasi.'</td>';
										echo '</tr';
									echo '</table>';
								}

							}
							// close else jumlah
						}
						}
						// close else get tanggal
					}
					// close submit
					?>






				</div>
      </div>
      <!-- close Main -->
      <!-- footer -->
			<div style="position:auto; width:100%; margin-bottom:20px; padding:5px 20px 10px 20px; background:#0059B2; color:#cce6ff; text-align:right; font-size:80%">
				Copyright Informatika Undip 2017
			</div>
      <!-- close footer -->
    </div>
    <!-- /#wrapper -->

  </body>
</html>
