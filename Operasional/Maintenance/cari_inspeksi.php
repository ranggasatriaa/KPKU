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
		<?php
		require_once('../../config.php');
		$db = new mysqli($db_host, $db_username, $db_password, $db_database);
		if($db->connect_errno){
			die("Tidak dapat terkoneksi dengan database: </br>". $db->connect_errno);
		}
		?>
  </head>
	<body style="background-color:#FFF">
    <div id="wrapper">
			<div id="page-wrapper">
				<div class="row">
        	<div class="col-lg-12">
						<label>Pencarian Menurut Tanggal:</label>
						<!-- form input tanggal -->
						<form action="cari_inspeksi.php" method="GET" autocomplete="on">
							<input type="date" name="tanggal1" >
							<input type="date" name="tanggal2" >
							</br><label>Pencarian Menurut Kategori:</label>
							<table>
								<tr>
									<td width="158px">
										<select style="max-width:153px" name="kategori" class="form-control" onchange="yesnoCheck(this);">
											<option value="">-Pilih Ketegori-</option>
											<option value="jenis_inspeksi">Jenis Inspeksi</option>
											<option value="jenis_kerusakan">Jenis Kerusakan</option>
										</select>
										<script>
											function yesnoCheck(that) {
												if (that.value != "" ) {
													if (that.value == "jenis_inspeksi"){
														document.getElementById("nama_jenis_inspeksi").style.display = "block";
														document.getElementById("nama_jenis_kerusakan").style.display = "none";
														document.getElementById("kosong11").style.display = "none";
													} else{
														document.getElementById("nama_jenis_inspeksi").style.display = "none";
														document.getElementById("nama_jenis_kerusakan").style.display = "block";
														document.getElementById("kosong").style.display = "none";
													}
												}else{
													document.getElementById("nama_jenis_inspeksi").style.display = "none";
													document.getElementById("nama_jenis_kerusakan").style.display = "none";
													document.getElementById("kosong11").style.display = "block";
												}
											}
										</script>
									</td>
									<td width="157px">
										<div id="kosong11" style="display: block;">
											<select style="max-width:152px" name="pilihan" class="form-control" >
												<option value=''></option>
												<option value=''></option>
												<option value=''></option>
											</select>
										</div>
										<div id="nama_jenis_inspeksi" style="display: none;">
											<select style="max-width:152px" name="pilihan" class="form-control" >
												<?php
													$query_ji = "SELECT * FROM jenis_inspeksi";
													$result_ji = $db->query($query_ji);
													if(!$result_ji){
														die("Query tidak terkoneksi dengan database: </br>" .$db->error);
													}
													echo "<option value=''>-Pilih Inspeksi-</option>";
													while($row_ji = $result_ji->fetch_object()){
														echo " <option value='$row_ji->idjenis_inspeksi'>$row_ji->nama_inspeksi</option>";
													}
												?>
											</select>
										</div>
										<div id="nama_jenis_kerusakan" style="display: none;">
											<select style="max-width:152px" name="pilihan" class="form-control">
												<?php
													$query_jk = "SELECT * FROM jenis_kerusakan";
													$result_jk = $db->query($query_jk);
													if(!$result_jk){
														die("Query tidak terkoneksi dengan database: </br>" .$db->error);
													}
													echo "<option value=''>-Pilih Kerusakan-</option>";
													while($row_jk = $result_jk->fetch_object()){
														echo " <option value='$row_jk->idjenis_kerusakan'>$row_jk->nama_kerusakan</option>";
													}
												?>
											</select>
										</div>
									</td>
								<td>
									<input  type="submit" class="btn btn-primary" name="submit" value="CARI"></input>
								</td>
							</tr>
							</table>
						</form>
						<?php
						if(isset($_GET['submit'])){
						?>
						<!-- form urutan tampilan -->
						<form action="cari_inspeksi.php" method="GET" autocomplete="on">
							<label>Urutkan Berdasarkan:</label>
				 			<div style"float:left;width:20%">
								<input type="hidden" name="tanggal1" value="<?php echo $_GET['tanggal1'];?>"/>
								<input type="hidden" name="tanggal2" value="<?php echo $_GET['tanggal2'];?>"/>

								<table style="border: 1px  solid #FFFFFF";>
									<tr>
										<td>
											<select style="width:150px" name="filter" class="form-control" required>
												<option value="">- Jenis Urutan -</option>
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
											<select style="width:150px" name="urutan" class="form-control">
												<option value="">- Arah Urutan -</option>
												<option value="ASC">A-Z</option>
												<option value="DESC">Z-A</option>
											</select>
										</td>
										<td>
											&nbsp &nbsp
										</td>
										<td>
											<input  type="submit" class="btn btn-primary" name="submit" value="Urutkan"></input>
										</td>
									</tr>
								</table>
							</div>
						</form>
						<?php
						}
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
								$jumlah = 0;
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
										$jumlah = $jumlah + $result->num_rows;
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
								if ($jumlah == 0){
									echo '<h3 style="text-align:center" class="alert alert-danger"> Tidak ada inspeksi yang ditemukan</h3>';
								}

							echo '</div>';

							echo '<div class="col-lg-12">';
								//perulangan menghitung perbaikan perhari
								echo '<h3 align="center">Perbaikan antara tanggal '.date('d M Y', strtotime($tanggal1)).' sampai '.date('d M Y', strtotime($tanggal2)).' </h3>';
								$temp_tgl = $tanggal1;
								$jumlah = 0;
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
								if ($jumlah == 0){
									echo '<h3 style="text-align:center" class="alert alert-danger"> Tidak ada inspeksi yang ditemukan</h3>';
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
