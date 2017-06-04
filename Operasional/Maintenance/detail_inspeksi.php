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
						<h2 style="text-align:center">Detail Inspeksi</h2>

						<?php
						require_once ('../../config.php');
						$idinspeksi = $_GET['id'];
						$db=new mysqli($db_host,$db_username,$db_password,$db_database) or
						die("Maaf Anda gagal koneksi.!");
							$query = " SELECT * FROM inspeksi
												 JOIN petugas ON inspeksi.npp=petugas.npp
												 JOIN jenis_inspeksi ON inspeksi.idjenis_inspeksi=jenis_inspeksi.idjenis_inspeksi
												 JOIN jenis_kerusakan ON inspeksi.idjenis_kerusakan=jenis_kerusakan.idjenis_kerusakan
												 WHERE idinspeksi=".$idinspeksi." ";
							// Execute the query
							$result = $db->query($query);
							if (!$result){
								die ("Could not query the database: <br />". $db->error);
							}else{
								$row = $result->fetch_object();
								echo'<table class="table">';
								  if ($row->status==1){
										echo '<tr>';
										echo '<td style="width:50%; align:center"><a href="detail_image.php?id='.$row->idinspeksi.'&direktori='.$row->direktori_kerusakan.'"><img src="'.$row->direktori_kerusakan.'" width="100%"></a><br/>Kondisi Sebelum Diperbaiki</td>';
										echo '<td></td>';
										echo '<td style="width:50%; align:center"><a href="detail_image.php?id='.$row->idinspeksi.'&direktori='.$row->direktori_perbaikan.'"><img src="'.$row->direktori_perbaikan.'" style="width:100%; max-height:300px""></a><br/>Kondisi Setelah Diperbaiki </td>';
										echo '</tr>';
									}else{
										echo '<tr><td align="center" colspan="3"><a href="detail_image.php?id='.$row->idinspeksi.'&direktori='.$row->direktori_kerusakan.'"><img src="'.$row->direktori_kerusakan.'" width="60%"></a><br/>';
										echo 'Kondisi Sebelum Diperbaiki</tr>';
									}
									echo '<tr>';
										echo '<th>ID Inspeksi</th>';
										echo '<th>:</th>';
										echo '<td>'.$row->idinspeksi.'</td>';
									echo '</tr>';
									echo '<tr>';
										echo '<th>Keadaan</th>';
										echo '<th>:</th>';
										echo '<td>';
											if ($row->status==1){
												echo '<strong class="text-success">Telah diperbaiki</strong>';
											}else{
												echo '<strong class="text-danger">Belum diperbaiki</strong>';
											}
										echo '</td> ';
									echo '</tr>';
									echo '<tr>';
										echo '<th>Petugas Pelapor</th>';
										echo '<th>:</th>';
										echo '<td>'.$row->nama.'</td>';
									echo '</tr>';
									echo '<tr>';
										echo '<th>Tanggal Kerusakan</th>';
										echo '<th>:</th>';
										$waktu_kerusakan = date('d M Y',strtotime($row->waktu_kerusakan));
										echo '<td>'.$waktu_kerusakan.'</td> ';
									echo '</tr>';
									if ($row->status==1){
										echo '<tr>';
											echo '<th>Tanggal Perbaikan</th>';
											echo '<th>:</th>';
											$waktu_perbaikan = date('d M Y',strtotime($row->waktu_perbaikan));
											echo '<td>'.$waktu_perbaikan.'</td> ';
										echo '</tr>';
									}
									echo '<tr>';
										echo '<th>Jenis Inspeksi</th>';
										echo '<th>:</th>';
										echo '<td>'.$row->nama_inspeksi.'</td>';
									echo '</tr>';
									echo '<tr>';
										echo '<th>Jenis Kerusakan</th>';
										echo '<th>:</th>';
										echo '<td>'.$row->nama_kerusakan.'</td> ';
									echo '</tr>';
									echo '<tr>';
										echo '<th>Keterangan</th>';
										echo '<th>:</th>';
										if ($row->keterangan==null){
											echo '<td>-</td> ';
										}else{
											echo '<td>'.$row->keterangan.'</td> ';
										}
									echo '</tr>';
									echo '<tr>';
										echo '<th>Lokasi Kerusakan</th>';
										echo '<th>:</th>';
										echo '<td>'.$row->lokasi.'</td>';
									echo '</tr>';
									echo '<tr align="center">';
										echo'<td colspan="3">';
											if ($_SESSION['level'] == 'ptg_op')
											{
												if ($row->status==FALSE){
													echo'<a style="margin:5px" href="perbaiki_inspeksi.php?id='.$idinspeksi.'" class="btn btn-success">Perbaiki</a>';
												}
												echo'<a style="margin:5px" 	href="edit_inspeksi.php?id='.$idinspeksi.'" class="btn btn-warning btn-sm" ">Ubah</a>';
												echo'<a style="margin:5px" 	href="hapus_inspeksi.php?id='.$idinspeksi.'" class="btn btn-danger btn-sm" onclick="return del()">Hapus</a>';
											}
											if($_SESSION['level'] == 'ptg_op' ){
												echo'<a style="float:right; margin:5px" 	href="index.php" class="btn btn-default btn-sm">Kembali</a>';
											}elseif($_SESSION['level'] == 'dgm_op' ){
												echo'<a style="float:right; margin:5px" 	href="../index.php" class="btn btn-default btn-sm">Kembali</a>';
											}
										echo'</td>';
									echo '</tr>';
								echo '</table>';

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
