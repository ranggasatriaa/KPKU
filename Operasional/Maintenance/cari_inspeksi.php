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
							<label>Urutkan berdasarkan:</label>
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
												<option value="waktu_kerusakan">Waktu Kerusakan</option>
												<optio	value="status">Kondisi Inspeksi</option>
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
							</div>
						</form>

						<?php
						require_once ('../../config.php');
						$db=new mysqli($db_host,$db_username,$db_password,$db_database) or
						die("Maaf Anda gagal koneksi.!");

						if(isset($_GET['submit'])){
							$filter = $_GET['filter'];
							$urutan = $_GET['urutan'];
							if ($filter==""){
								$filter = "idinspeksi";
							}elseif ($urutan==""){
								$urutan = "ASC";
							}
							$tanggal1 = $_GET['tanggal1'];
							$tanggal2 = $_GET['tanggal2'];
							if($filter!="" || $urutan!=""){
								if($tanggal1=="" || $tanggal2=="")
								{
									die ('<br/><div class="alert alert-danger" style="font-size:150%; text-align:center">Masukkan Tanggal Terlebih dahulu </div>');
								}
							}
							$temp_tgl	 = $tanggal1;
							$selisih = ((abs(strtotime ($tanggal1) - strtotime ($tanggal2)))/(60*60*24));
							echo $filter;
							echo $urutan;

							echo '<div class="col-lg-12">';
								//perulangan menghitung kerusakan perhari
								echo '<h3 align="center">Kerusakan antara tanggal '.date('d-m-Y', strtotime($tanggal1)).' sampai '.date('d-m-Y', strtotime($tanggal2)).' </h3>';
								for ($i= 0; $i <= $selisih; $i++)
								{
									$query =  " SELECT * FROM inspeksi
														 JOIN petugas ON inspeksi.idpetugas=petugas.idpetugas
														 JOIN jenis_inspeksi ON inspeksi.idjenis_inspeksi=jenis_inspeksi.idjenis_inspeksi
														 JOIN jenis_kerusakan ON inspeksi.idjenis_kerusakan=jenis_kerusakan.idjenis_kerusakan
														 WHERE waktu_kerusakan='$temp_tgl' ORDER BY inspeksi.idjenis_inspeksi $urutan";
									// Execute the query
									$result = $db->query($query);
									if (!$result){
										die ("Could not query the database1: <br />". $db->error);
									}else{

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
												echo '<p>'.date ( 'd-m-Y' , strtotime($row->waktu_kerusakan)).'</p>';
											echo '</div>';
										}
									}
									$newdate = strtotime ( '+1 day' , strtotime ( $temp_tgl ) ) ;
									$temp_tgl = date ( 'Y-m-d' , $newdate );
								}
							echo '</div>';

							echo '<div class="col-lg-12">';
								//perulangan menghitung perbaikan perhari
								echo '<h3 align="center">Kerusakan antara tanggal '.date('d-m-Y', strtotime($tanggal1)).' sampai '.date('d-m-Y', strtotime($tanggal2)).' </h3>';
								$temp_tgl = $tanggal1;
								for ($i= 0; $i <= $selisih; $i++)
								{
									$query =  " SELECT * FROM inspeksi
														 JOIN petugas ON inspeksi.idpetugas=petugas.idpetugas
														 JOIN jenis_inspeksi ON inspeksi.idjenis_inspeksi=jenis_inspeksi.idjenis_inspeksi
														 JOIN jenis_kerusakan ON inspeksi.idjenis_kerusakan=jenis_kerusakan.idjenis_kerusakan
														 WHERE waktu_perbaikan='$temp_tgl' ORDER BY idinspeksi ASC";
									// Execute the query
									$result = $db->query($query);
									if (!$result){
										die ("Could not query the database1: <br />". $db->error);
									}else{

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
												echo '<p>'.date ( 'd-m-Y' , strtotime($row->waktu_kerusakan)).'</p>';
											echo '</div>';
										}
									}
									$newdate = strtotime ( '+1 day' , strtotime ( $temp_tgl ) ) ;
									$temp_tgl = date ( 'Y-m-d' , $newdate );
								}
							echo '</div>';
							// echo '<div id="grafik" style="min-width: 300px; height: 400px; margin: 0 auto"></div>';
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


<!--file untuk menampilkan grafik!-->
		<!-- <script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/1.8.2/jquery.min.js"></script> -->
		<script src="https://code.highcharts.com/highcharts.js"></script>
		<script src="https://code.highcharts.com/modules/exporting.js"></script>
		<script type="text/javascript">
			$(function () {
			  Highcharts.chart('grafik', {
			    title: {
			      text: 'Inspeksi <?php echo date('d M Y',strtotime($tanggal1));?> sd <?php echo date('d M Y',strtotime($tanggal2));?>',
			      x: -20 //center
			    },
			  	xAxis: {
			      categories: [
							<?php
								$temp_tgl =  $tanggal1;

								$temp_tgl2 = strtotime($tanggal1);
								$temp_tgl2 = date ( 'd M Y' , $temp_tgl2);
								echo "'.$temp_tgl2.'";
								for ($i= 1; $i <= $selisih; $i++)
								{
									$newdate = strtotime ( '+1 day' , strtotime ( $temp_tgl ) ) ;
									$temp_tgl = date ( 'Y-m-d' , $newdate );

									$temp_tgl2 = strtotime($temp_tgl);
									$temp_tgl2 = date ( 'd M Y' , $temp_tgl2 );
									echo ",'".$temp_tgl2."'";

								}
							?>
						]
			    },
			    yAxis: {
			      title: {
			        text: 'Jumlah'
			      },
			      plotLines: [{
			        value: 0,
			        width: 1,
			        color: '#808080'
			      }]
			    },
			    tooltip: {
			      valueSuffix: ''
			    },

			    legend: {
			      layout: 'vertical',
			      align: 'right',
			      verticalAlign: 'middle',
			      borderWidth: 0
			    },

			    series: [
						{
				      name: 'Kerusakan',
							color: '#ed3f3f',
				      data: [
								<?php
									echo $row_k[0];
							    for ($i= 1; $i <= $selisih; $i++)
							    {
							      echo ',';
										echo $row_k[$i];
							    }
							  ?>
							]
			    	},
						{
							name: 'Perbaikan',
							color: '#4CAF50',
						  data: [
								<?php
									echo $row_p[0];
									for ($i= 1; $i <= $selisih; $i++)
									{
										echo ',';
										echo $row_p[$i];
									}
								?>
							]
						}
					]
			  });
			});
		</script>
