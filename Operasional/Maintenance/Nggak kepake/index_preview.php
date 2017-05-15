<?php
session_start();
error_reporting(0);
if (!isset($_SESSION['level'])){
	header('location:../../index.php');
	exit;
}elseif (isset($_SESSION['level'])){

?>

<!DOCTYPE html>
<html lang="id">
	<head>
	</head>
	<body style="background-color:#FFF">
		<div id="wrapper">
      <!-- Main -->
			<?php include('../../header.php');?>
			<!-- <div style="position: inherit; margin: 0 0 0 195px; border-left: 2px solid #e7e7e7; padding: 0 15px; min-height: 100px; height:relative;background-color: white;"> -->
			<div id="page-wrapper">
			  <div class="col-lg-12">
			    <a style="margin:10px 0px" class="btn btn-primary" href="pil_jenis_inspeksi.php"><i class="fa fa-plus"></i> Inspeksi Baru</a>
					<a style="margin:10px 0px; float:right" class="btn btn-info" href="print_inspeksi.php"><i class="fa fa-print"></i>  Cetak Inspeksi</a>
					<div style="margin-bottom:10px;">
						<form action="index.php" method="GET" autocomplete="on">
							<label>Urutkan berdasarkan:</label>
							<div style"float:left;width:20%">
								<table style="border: 1px  solid #FFFFFF";>
									<tr>
										<td>
											<select style="max-width:150px" name="filter" class="form-control">
												<option value="">- Pilihan -</option>
												<option value="inspeksi.idjenis_inspeksi">Jenis Inspeksi</option>
												<option value="inspeksi.idjenis_kerusakan">Jenis Kerusakan</option>
												<option value="waktu_kerusakan">Waktu Kerusakan</option>
												<option value="status">Kondisi Inspeksi</option>
											</select>
										</td>
										<td>
											&nbsp
										</td>
										<td>
											<select style="max-width:120px" name="urutan" class="form-control">
												<option value="">- Pilihan -</option>
												<option value='ASC'>A-Z</option>
												<option value='DESC'>Z-A</option>
											</select>
										</td>
										<td>
											&nbsp
										</td>
										<td>
											<input  type="submit" class="btn btn-primary" name="submit"></input>
										</td>
									</tr>
								</table>
						</div>
						</form>
					</div>
			      <?php
			        // Connect
							if(isset($_GET['submit'])){
								$filter = $_GET['filter'];
								$urutan = $_GET['urutan'];
							}else{
								$urutan = 'ASC';
								$filter = "status";
							}
							require_once('../../config.php');
							$db=new mysqli($db_host,$db_username,$db_password,$db_database) or
							die("Maaf Anda gagal koneksi.!");
			        //Asign a query
							$view_query = " SELECT * FROM inspeksi
												 JOIN petugas ON inspeksi.idpetugas=petugas.idpetugas
												 JOIN jenis_inspeksi ON inspeksi.idjenis_inspeksi=jenis_inspeksi.idjenis_inspeksi
												 JOIN jenis_kerusakan ON inspeksi.idjenis_kerusakan=jenis_kerusakan.idjenis_kerusakan
												 ORDER BY $filter $urutan";
			        // Execute the query
			        $result = $db->query($view_query);
			        if (!$result){
			           die ("Could not query the database: <br />". $db->error);
			        }
			        // Fetch and display the results
			        echo '<div class = "row">';
			        while ($row = $result->fetch_object()){

			            echo '<div class="col-md-4 portofolio-item">';
			              echo '<a href="detail_inspeksi.php?id='.$row->idinspeksi.'">';
			                echo '<img class="img-responsive" src="'.$row->direktori_kerusakan.'" alt="klik untuk detail">';
			              echo '</a>';
			              echo '<h3 style="margin:10px 0px 0px 0px">';
			                echo '<a href="detail_inspeksi.php?id='.$row->idinspeksi.'">'.$row->nama_inspeksi.' - '.$row->nama_kerusakan.'</a>';
			              echo '</h3>';
										if ($row->status==1){
											echo '<strong class="text-success">Telah diperbaiki</strong>';
										}else{
											echo '<strong class="text-danger">Belum diperbaiki</strong>';
										}
			              echo '<p>'.$row->lokasi.'</p>';
			            echo '</div>';
			        }
			        echo '</div>';
							$db->close();
							exit;
			        ?>
			  </div>
			</div>
			<!-- close Main -->
      <!-- footer -->
			<div style="position: relative; width:100%; margin-bottom:20px; padding:5px 20px 10px 20px; background:#0059B2; color:#cce6ff; text-align:right; font-size:80%">
				Copyright Informatika Undip 2017
			</div>
      <!-- close footer -->
		</div>
		<!-- /#wrapper -->
  </body>
</html>

<?php
//tutup kurung sesion
}
?>
