<?php
session_start();
error_reporting(0);
if (!isset($_SESSION['level'])){
	header('location:/kpku/index.php');
	exit;
}elseif($_SESSION['level']!="ptg_op" && $_SESSION['level']!="dgm_op" && $_SESSION['level']!="gm"){
	header('location:/kpku/unauthorized.php');
}else{
	include('../../header.php');
}
?>

<!DOCTYPE html>
<html lang="id">
	<head>
		<title>Cetak Inspeksi</title>
  </head>
	<body style="background-color:#FFF">
    <div id="wrapper">
			<div id="page-wrapper">
				<div class="row">
				  <div class="col-lg-12">
						<label>Masukkan Tanggal:</label>
						<form action="print_inspeksi.php" method="POST" autocomplete="on">
		    			<input type="date" name="tanggal" required>
							<input type="submit" class="btn btn-primary" name="submit" value="CARI"></input>
						</form>
						<?php
							require_once ('../../config.php');
							//mebebtukan nilai variabel berdasarkan inputan
							$tanggal		= $_POST['tanggal'];
							$tanggaldmy = date('d-m-Y', strtotime($tanggal));
							$jumlah			= 0;
							//inisiasi database
							$db=new mysqli($db_host,$db_username,$db_password,$db_database);
							if($db->connect_errno){
								die("Tidak dapat terkoneksi dengan database: </br>". $db->connect_errno);
							}
							//mendeteksi apakah ada inputan
							if(count($_POST)>0){
								// query penampil kerusakan
								$query_kerusakan = "SELECT * FROM inspeksi
													LEFT JOIN petugas ON inspeksi.npp=petugas.npp
													LEFT JOIN jenis_inspeksi ON inspeksi.idjenis_inspeksi=jenis_inspeksi.idjenis_inspeksi
													LEFT JOIN jenis_kerusakan ON inspeksi.idjenis_kerusakan=jenis_kerusakan.idjenis_kerusakan
													WHERE waktu_kerusakan='$tanggal'";
								// Execute the query kerusakan
								$result_k = $db->query($query_kerusakan);
								// query penampil perbaikan
								$query_perbaikan = "SELECT * FROM inspeksi
													LEFT JOIN petugas ON inspeksi.npp=petugas.npp
													LEFT JOIN jenis_inspeksi ON inspeksi.idjenis_inspeksi=jenis_inspeksi.idjenis_inspeksi
													LEFT JOIN jenis_kerusakan ON inspeksi.idjenis_kerusakan=jenis_kerusakan.idjenis_kerusakan
													WHERE waktu_perbaikan='$tanggal'";
								// Execute the query perbaikan
								$result_p = $db->query($query_perbaikan);
								if (!$result_k || !$result_p){
									die ("Could not query the database: <br />". $db->error);
								}else{
									//menghitung jumlah
									$jumlah_k = $result_k->num_rows;
									$jumlah_p = $result_p->num_rows;
									//memeriksa apakah tidak ada inspeksi
									if($jumlah_k==0 && $jumlah_p==0){
											if ($_SESSION['level']=="gm"){
												die ('<br/><div class="alert alert-danger" style="font-size:150%; text-align:center">Tidak ada inspeksi pada tanggal '.$tanggaldmy.'</div>
												<a class="btn btn-outline btn-primary btn-block" href="/kpku/operasional/maintenance/index_luar.php">Kembali</a>');
											}else{
												die ('<br/><div class="alert alert-danger" style="font-size:150%; text-align:center">Tidak ada inspeksi pada tanggal '.$tanggaldmy.'</div>
												<a class="btn btn-outline btn-primary btn-block" href="/kpku/operasional/maintenance/index.php">Kembali</a>');
											}
									}elseif(!$jumlah_k==0){
										//menampilkan inspeksi berdsarkan waktu kerusakkan
										echo '<h3 align="center">Kerusakan pada tanggal '.$tanggaldmy.'</h3>';
										echo '<table class="table">';
						        while ($row_k = $result_k->fetch_object()){
											if ($row_k->status==1){
												echo '<tr>';
												echo '<td width="50%" align="center"><img src="'.$row_k->direktori_kerusakan.'" style="width:100%; max-height:450px"><br/>Kondisi Sebelum Diperbaiki ('. date('d-m-Y', strtotime($row_k->waktu_kerusakan)).')</td>';
												echo '<td></td>';
												echo '<td width="50%" align="center"><img src="'.$row_k->direktori_perbaikan.'" style="width:100%; max-height:450px"><br/>Kondisi Setelah Diperbaiki ('. date('d-m-Y', strtotime($row_k->waktu_perbaikan)).') </td>';
												echo '</tr>';
											}else{
												echo '<tr><td align="center" colspan="3"><img src="'.$row_k->direktori_kerusakan.'" style="width:50%; max-height:450px"><br/>';
												echo 'Gambar Sebelum Diperbaiki ('.$row_k->waktu_kerusakan.')</tr>';
											}
											echo '<tr>';
												echo '<th>Id Inspeksi</th>';
												echo '<th>:</th>';
												echo '<td>'.$row_k->idinspeksi.'</td>';
											echo '</tr>';
                      echo '<tr>';
    										echo '<th>Keadaan</th>';
    										echo '<th>:</th>';
    										echo '<td>';
    											if ($row_k->status==1){
    												echo '<strong class="text-success">Telah diperbaiki</strong>';
    											}else{
    												echo '<strong class="text-danger">Belum diperbaiki</strong>';
    											}
    										echo '</td> ';
    									echo '</tr>';
                      echo '<tr>';
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
                        if ($row_k->keterangan==null){
                          echo '<td>-</td> ';
                        }else{
                          echo '<td>'.$row_k->keterangan.'</td> ';
                        }
											echo '</tr>';
											echo '<tr>';
												echo '<th>Lokasi Kerusakan</th>';
												echo '<th>:</th>';
												echo '<td>'.$row_k->lokasi.'</td>';
											echo '</tr>';
											echo '<tr><td colspan="4"></td></tr>';
						        }
						        echo '</table>';
									}
									// close if !jumlah_k==0
									if(!$jumlah_p==0){
										//menampilkan inspeksi berdsarkan waktu perbaikan
										echo '<h3 align="center">Perbaikan pada tanggal '.$tanggaldmy.'</h3>';
										echo '<table class="table">';
						        while ($row_p = $result_p->fetch_object()){
											if ($row_p->status==1){
												echo '<tr>';
												echo '<td width="50%" align="center"><img src="'.$row_p->direktori_kerusakan.'" style="width:100%; max-height:450px"><br/>Kondisi Sebelum Diperbaiki ('. date('d-m-Y', strtotime($row_p->waktu_kerusakan)).')</td>';
												echo '<td></td>';
												echo '<td width="50%" align="center"><img src="'.$row_p->direktori_perbaikan.'" style="width:100%; max-height:450px"><br/>Kondisi Setalh Diperbaiki ('. date('d-m-Y', strtotime($row_p->waktu_perbaikan)).') </td>';
												echo '</tr>';
											}else{
												echo '<tr><td align="center" colspan="3"><img src="'.$row_p->direktori_kerusakan.'" width="60%"><br/>';
												echo 'Gambar Sebelum Diperbaiki ('.$row_p->waktu_kerusakan.')</tr>';
											}
                      echo '<tr>';
												echo '<th>Id Inspeksi</th>';
												echo '<th>:</th>';
												echo '<td>'.$row_p->idinspeksi.'</td>';
											echo '</tr>';
                      echo '<tr>';
    										echo '<th>Keadaan</th>';
    										echo '<th>:</th>';
    										echo '<td>';
    											if ($row_p->status==1){
    												echo '<strong class="text-success">Telah diperbaiki</strong>';
    											}else{
    												echo '<strong class="text-danger">Belum diperbaiki</strong>';
    											}
    										echo '</td> ';
    									echo '</tr>';
                      echo '<tr>';
                      echo '<th>Petugas Pelapor</th>';
                      echo '<th>:</th>';
                      echo '<td>'.$row_p->nama.'</td>';
                      echo '</tr>';
											echo '<tr>';
												echo '<th>Jenis Inspeksi</th>';
												echo '<th>:</th>';
												echo '<td>'.$row_p->nama_inspeksi.'</td>';
											echo '</tr>';
											echo '<tr>';
												echo '<th>Jenis Kerusakan</th>';
												echo '<th>:</th>';
												echo '<td>'.$row_p->nama_kerusakan.'</td>';
											echo '</tr>';
                      echo '<tr>';
                        echo '<th>Keterangan</th>';
                        echo '<th>:</th>';
                        if ($row_p->keterangan==null){
                          echo '<td>-</td> ';
                        }else{
                          echo '<td>'.$row_p->keterangan.'</td> ';
                        }
											echo '</tr>';
											echo '<tr>';
												echo '<th>Lokasi Inspeksi</th>';
												echo '<th>:</th>';
												echo '<td>'.$row_p->lokasi.'</td>';
											echo '</tr>';
											echo '<tr><td colspan="4"></td></tr>';
						        }
						        echo '</table>';
									}
									// close if !jumlah_p==0
									echo '<a style="margin-bottom:10px" class="btn btn-info btn-block" href="cetak.php?tanggal='.$tanggal.'">Cetak Inspeksi</a>';
								}
								// close else result_k
							}
							// close submit post
							if ($_SESSION['level']=="gm"){
								echo' <br/>	<a class="btn btn-outline btn-primary btn-block" href="/kpku/operasional/maintenance/index_luar.php">Kembali</a>';
							}else{
								echo' <br/><a class="btn btn-outline btn-primary btn-block" href="/kpku/operasional/maintenance/index.php">Kembali</a>';
							}
						?>
					</div>
					<!-- /. col-md-12 -->
				</div>
				<!-- /. row -->
      </div>
      <!-- close Main -->
    </div>
    <!-- /#wrapper -->
		<!-- footer -->
		<div style="text-align:right; font-size:80%; height:40px; background:#0059B2; color:#cce6ff; position:relative; bottom:0px; width:100%; padding:5px 20px; margin:20px 0px" >
			Copyright Informatika Undip 2017
		</div>
		<!-- close footer -->
  </body>
</html>
