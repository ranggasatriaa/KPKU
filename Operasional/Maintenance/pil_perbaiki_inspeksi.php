<?php
session_start();
error_reporting(0);
if (!isset($_SESSION['level'])){
	header('location:/kpku/index.php');
	exit;
}elseif($_SESSION['level']!="ptg_op" && $_SESSION['level']!="dgm_op"){
	header('location:/kpku/unauthorized.php');
}else{
	include('../../header.php');
}
?>

<!DOCTYPE html>
<html lang="id">
	<head>
		<title>Perbaiki Inspeksi</title>
  </head>

	<body style="background-color:#FFF">
    <div id="wrapper">
			<!-- <div style="position: relative; margin: 0 0 0 195px; border-left: 2px solid #e7e7e7; padding: 0 15px; min-height: 800px; background-color: white;"> -->
			<div id="page-wrapper">
			  <div class="col-lg-12">
					<label>Masukkan Tanggal:</label>
					<form action="pil_perbaiki_inspeksi.php" method="POST" autocomplete="on">
	    			<input type="date" name="tanggal" required>
						<input type="submit" class="btn btn-primary" name="submit" value="CARI"></input>
					</form>
					<?php
						require_once ('../../config.php');
						$tanggal		= $_POST['tanggal'];
						$tanggaldmy = date('d-m-Y', strtotime($tanggal));
						$jumlah			= 0;

						$db=new mysqli($db_host,$db_username,$db_password,$db_database);
						if($db->connect_errno){
							die("Tidak dapat terkoneksi dengan database: </br>". $db->connect_errno);
						}
						if(count($_POST)>0){
							// query penampil kerusakan
							$query_kerusakan = "SELECT * FROM inspeksi
												LEFT JOIN petugas ON inspeksi.idpetugas=petugas.idpetugas
												LEFT JOIN jenis_inspeksi ON inspeksi.idjenis_inspeksi=jenis_inspeksi.idjenis_inspeksi
												LEFT JOIN jenis_kerusakan ON inspeksi.idjenis_kerusakan=jenis_kerusakan.idjenis_kerusakan
												WHERE waktu_kerusakan='$tanggal' AND status=0";
							// Execute the query kerusakan
							$result_k = $db->query($query_kerusakan);
							// query penampil perbaikan

							if (!$result_k){
								die ("Could not query the database: <br />". $db->error);
							}else{
								$jumlah_k = $result_k->num_rows;
								if($jumlah_k==0){
									die ('<br/><div class="alert alert-danger" style="font-size:150%; text-align:center">Tidak ada inspeksi pada tanggal '.$tanggaldmy.'</div>
									<a class="btn btn-outline btn-primary btn-block" href="index.php">Kembali</a>');
								}elseif(!$jumlah_k==0){
									echo '<h3 align="center">Kerusakan pada tanggal '.$tanggaldmy.'</h3>';
									echo '<table class="table">';
					        while ($row_k = $result_k->fetch_object()){
										// echo '<tr>';
										// 	echo '<th>Id Inspeksi</th>';
										// 	echo '<th>:</th>';
										// 	echo '<td>'.$row_k->idinspeksi.'</td>';
										// echo '</tr>';
										echo '<tr>';
											echo '<td rowspan="6" width="40%"><img width="100%" src="'.$row_k->direktori_kerusakan.'"></td>';
											echo '<th>Petugas Pelapor</th>';
											echo '<th>:</th>';
											echo '<td>'.$row_k->nama.'</td>';
										echo '</tr>';
										echo '<tr>';
											echo '<th>Jenis Inspeksi</th>';
											echo '<th>:</th>';
											echo '<td>'.$row_k->nama_inspeksi.'</td>';
										echo '</tr>';
										echo '<tr>';
											echo '<th>Jenis Kerusakan</th>';
											echo '<th>:</th>';
											echo '<td>'.$row_k->nama_kerusakan.'</td>';
										echo '</tr>';
										echo '<tr>';
											echo '<th>Keterangan</th>';
											echo '<th>:</th>';
											echo '<td>'.$row_k->keterangan.'</td>';
										echo '</tr>';
										echo '<tr>';
											echo '<th>Lokasi Kerusakan</th>';
											echo '<th>:</th>';
											echo '<td>'.$row_k->lokasi.'</td>';
										echo '</tr>';
										echo '<tr>';
											echo '<td colspan="3"> ';
											echo '<a style="margin:10px 0px" class="btn btn-info btn-block" href="detail_inspeksi.php?id='.$row_k->idinspeksi.'"><i class="fa fa-edit"></i> Detail</a>';
											echo '<a style="margin:10px 0px" class="btn btn-warning btn-block" href="perbaiki_inspeksi.php?id='.$row_k->idinspeksi.'"><i class="fa fa-edit"></i> Perbaiki Inspeksi</a>';
											echo '</td>';
										echo '</tr>';
										echo '<tr><td colspan="4"></td></tr>';
					        }
					        echo '</table>';
								}
								// echo '<a style="margin-bottom:10px" class="btn btn-info btn-block" href="cetak.php?tanggal='.$tanggal.'">Cetak Inspeksi</a>';
							}
							// close else result_k
						}
						// close submit post
					?>
					<a style="margin:10px 0px" class="btn btn-outline btn-primary btn-block" href="index.php">Kembali</a>
				</div>
      </div>
      <!-- close Main -->
    </div>
		<!-- /#wrapper -->
  </body>
</html>
