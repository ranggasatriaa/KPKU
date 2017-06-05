<?php
session_start();
error_reporting(0);
if (!isset($_SESSION['level'])){
	header('location:/kpku/index.php');
	exit;
}else{
	include('../../header.php');
}
?>

<!DOCTYPE html>
<html lang="id">
	<head>
		<title>Detail Inspeksi</title>
		<script>
			function del(){
				var x=window.confirm("Anda yakin ingin menghapus?");
				return x;
			}
		</script>
  </head>
	<body style="background-color:#FFF">
    <div id="wrapper">
			<div id="page-wrapper">
				<div class="row">
        	<div class="col-lg-12">
						<label>Masukkan Tanggal:</label>
						<!-- form input tanggal -->
						<form action="cari_inspeksi.php" method="GET" autocomplete="on">
							<input type="date" name="tanggal1" required>
							<input type="date" name="tanggal2" required>
							<input type="submit" class="btn btn-primary" name="submit" value="CARI"></input>
						</form>
						<!-- form urutan tampilan -->
						<form action="cari_inspeksi.php" method="GET" autocomplete="on">
							<label>Urutkan Berdasarkan:</label>
							<div style"float:left;width:20%">
								<input type="hidden" name="tanggal1" value="<?php echo $_GET['tanggal1'];?>"/>
								<input type="hidden" name="tanggal2" value="<?php echo $_GET['tanggal2'];?>"/>
								<table style="border: 1px  solid #FFFFFF";>
									<tr>
										<td>
											<select style="max-width:150px" name="filter" class="form-control" required>
												<option value="">- Pilihan -</option>
												<option value="inspeksi.idjenis_inspeksi">Jenis Inspeksi</option>
												<option value="inspeksi.idjenis_kerusakan">Jenis Kerusakan</option>
												<option value="inspeksi.waktu_kerusakan">Waktu Kerusakan</option>
												<optio	value="inspeksi.status">Kondisi Inspeksi</option>
											</select>
										</td>
										<td>
											&nbsp
										</td>
										<td>
											<select style="max-width:120px" name="urutan" class="form-control">
												<option value="">- Pilihan -</option>
												<option value="ASC">A-Z</option>
												<option value="DESC">Z-A</option>
											</select>
										</td>
										<td>
											&nbsp
										</td>
										<td>
											<input  type="submit" class="btn btn-primary" name="submit" value="Urutkan"></input>
										</td>
									</tr>
								</table>
							</div>.
						</form>
						<?php
						require_once ('../../config.php');
						//isisiasi database
						$db=new mysqli($db_host,$db_username,$db_password,$db_database) or
						die("Maaf Anda gagal koneksi.!");
						//mendeteksi apakah ada inputan
						if(isset($_GET['submit'])){
							//mebebtukan nilai variabel berdasarkan inputan
							$filter		= $_GET['filter'];
							$urutan		= $_GET['urutan'];
							$tanggal1 = $_GET['tanggal1'];
							$tanggal2 = $_GET['tanggal2'];
							//menentukan filter dan urutan default
							if ($filter==""){
								$filter = "idinspeksi";
							}elseif ($urutan==""){
								$urutan = "ASC";
							}
							//menentukan selisih hari dari tanggal
							$temp_tgl	 = $tanggal1;
							$selisih = ((abs(strtotime ($tanggal1) - strtotime ($tanggal2)))/(60*60*24));
							echo '<div class="col-lg-12">';
								//perulangan menghitung kerusakan perhari
								echo '<h3 align="center">Kerusakan antara tanggal '.date('d M Y', strtotime($tanggal1)).' sampai '.date('d M Y', strtotime($tanggal2)).' </h3>';
								for ($i= 0; $i <= $selisih; $i++)
								{
									//query penampil inspeksi berdasarkan waktu kerusakan
									$query =  "SELECT * FROM inspeksi
														 JOIN petugas ON inspeksi.npp=petugas.npp
														 JOIN jenis_inspeksi ON inspeksi.idjenis_inspeksi=jenis_inspeksi.idjenis_inspeksi
														 JOIN jenis_kerusakan ON inspeksi.idjenis_kerusakan=jenis_kerusakan.idjenis_kerusakan
														 WHERE waktu_kerusakan='$temp_tgl' ORDER BY $filter $urutan";
									// Execute the query
									$result = $db->query($query);
									if (!$result){
										die ("Could not query the database1: <br />". $db->error);
									}else{
										//penampil inspeksi
										while ($row = $result->fetch_object()){
											echo '<div class="col-md-4 portofolio-item">';
												echo '<a href="detail_inspeksi.php?id='.$row->idinspeksi.'">';
													echo '<img style="max-height:200px" class="img-responsive" src="'.$row->direktori_kerusakan.'" alt="klik untuk detail">';
												echo '</a>';
												echo '<h3 style="margin:10px 0px 0px 0px;">';
													echo '<a style="color:#0059B2" href="detail_inspeksi.php?id='.$row->idinspeksi.'">'.$row->nama_inspeksi.' - '.$row->nama_kerusakan.'</a>';
												echo '</h3>';
												if ($row->status==1){
													echo '<strong class="text-success">Telah diperbaiki</strong>';
												}else{
													echo '<strong class="text-danger">Belum diperbaiki</strong>';
												}
												echo '<p>'.date ( 'd M Y' , strtotime($row->waktu_kerusakan)).'</p>';
											echo '</div>';
										}
									}
									//mengubah tanggal 1 hari selanjutnya
									$newdate = strtotime ( '+1 day' , strtotime ( $temp_tgl ) ) ;
									$temp_tgl = date ( 'Y-m-d' , $newdate );
								}
							echo '</div>';

							echo '<div class="col-lg-12">';
								//perulangan menghitung perbaikan perhari
								echo '<h3 align="center">Perbaikan antara tanggal '.date('d M Y', strtotime($tanggal1)).' sampai '.date('d M Y', strtotime($tanggal2)).' </h3>';
								$temp_tgl = $tanggal1;
								for ($i= 0; $i <= $selisih; $i++)
								{
									//query penampil inspeksi berdasarkan waktu perbaikan
									$query =  " SELECT * FROM inspeksi
														 JOIN petugas ON inspeksi.npp=petugas.npp
														 JOIN jenis_inspeksi ON inspeksi.idjenis_inspeksi=jenis_inspeksi.idjenis_inspeksi
														 JOIN jenis_kerusakan ON inspeksi.idjenis_kerusakan=jenis_kerusakan.idjenis_kerusakan
														 WHERE waktu_perbaikan='$temp_tgl' ORDER BY $filter $urutan";
									// Execute the query
									$result = $db->query($query);
									if (!$result){
										die ("Could not query the database1: <br />". $db->error);
									}else{
										$jumlah = $jumlah + $result->num_rows;
										//penampil inspeksi
										while ($row = $result->fetch_object()){
											echo '<div class="col-md-4 portofolio-item">';
												echo '<a href="detail_inspeksi.php?id='.$row->idinspeksi.'">';
													echo '<img style="max-height:200px" class="img-responsive" src="'.$row->direktori_perbaikan.'" alt="klik untuk detail">';
												echo '</a>';
												echo '<h3 style="margin:10px 0px 0px 0px;">';
													echo '<a style="color:#0059B2" href="detail_inspeksi.php?id='.$row->idinspeksi.'">'.$row->nama_inspeksi.' - '.$row->nama_kerusakan.'</a>';
												echo '</h3>';
												if ($row->status==1){
													echo '<strong class="text-success">Telah diperbaiki</strong>';
												}else{
													echo '<strong class="text-danger">Belum diperbaiki</strong>';
												}
												echo '<p>'.date ( 'd M Y' , strtotime($row->waktu_kerusakan)).'</p>';
											echo '</div>';
										}
									}
									//mengubah tanggal menjadi 1 hari selanjutnya
									$newdate = strtotime ( '+1 day' , strtotime ( $temp_tgl ) ) ;
									$temp_tgl = date ( 'Y-m-d' , $newdate );
								}


							echo '</div>';
						}
					echo '</div>';
				echo '</div>';
				echo '<div class="row">';
					echo '<div class="col-lg-100">';
						if ($_SESSION['level']=="gm"){
							echo' <br/>	<a class="btn btn-outline btn-primary btn-block" href="/kpku/operasional/maintenance/index_luar.php">Kembali</a>';
						}elseif($_SESSION['level']=="dgm_op"){
							echo' <br/><a class="btn btn-outline btn-primary btn-block" href="/kpku/operasional/index.php">Kembali</a>';
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
