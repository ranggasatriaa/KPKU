<?php
session_start();
error_reporting(0);
if (!isset($_SESSION['level'])){
	header('location:/kpku/index.php');
	exit;
}elseif ($_SESSION['level'] != "ptg_op"){
	header('location:/kpku/unauthorized.php');
}else{
	include('../../header.php');
}
?>

<!DOCTYPE html>
<html >
	<head>
		<title>Inspeksi Operasional</title>
		<meta charset="utf-8">
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<meta name="description" content="">
		<meta name="author" content="">

		<!-- Bootstrap Core CSS -->
		<link href="/KPKU/Template/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">

		<!-- MetisMenu CSS -->
		<link href="/KPKU/Template/vendor/metisMenu/metisMenu.min.css" rel="stylesheet">

		<!-- Custom CSS -->
		<link href="/KPKU/Template/dist/css/sb-admin-2.css" rel="stylesheet">

		<!-- DataTables CSS -->
		<link href="/KPKU/Template/vendor/datatables-plugins/dataTables.bootstrap.css" rel="stylesheet">

		<!-- DataTables Responsive CSS -->
		<link href="/KPKU/Template/vendor/datatables-responsive/dataTables.responsive.css" rel="stylesheet">

		<!-- Custom Fonts -->
		<link href="/KPKU/Template/vendor/font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css">

		<!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
		<!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
		<!--[if lt IE 9]>
				<script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
				<script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
		<![endif]-->
	</head>
	<body>
		<div id="wrapper">
			<div id="page-wrapper">
				<div class="row">
				  <div class="col-lg-12">
						<?php
							echo '<a style="margin:10px 0px" class="btn btn-primary btn-lg" href="add_inspeksi.php"><i class="fa fa-plus"></i> Inspeksi Baru</a>';
							echo '&nbsp <a style="margin:10px 0px" class="btn btn-warning btn-lg" href="pil_perbaiki_inspeksi.php"><i class="fa fa-edit"></i> Perbaiki Inspeksi</a>';
							echo '&nbsp <a style="margin:10px 0px" class="btn btn-info btn-lg" href="print_inspeksi.php"><i class="fa fa-print"></i>  Cetak Inspeksi</a>';
							echo '&nbsp <a style="margin:10px 0px" class="btn btn-primary btn-outline btn-lg" href="cari_inspeksi.php"><i class="fa fa-search"></i>  Cari Inspeksi</a>';
						?>

						<div style="margin-bottom:10px;">
							<form action="index.php" method="GET" autocomplete="on">
								<label>Urutkan berdasarkan:</label>
								<div style"flo	at:left;width:20%">
									<table style="border: 1px  solid #FFFFFF";>
										<tr>
											<td>
												<select style="max-width:150px" name="filter" class="form-control">
													<option value="">- Pilihan -</option>
													<option value="inspeksi.idjenis_inspeksi">Jenis Inspeksi</option>
													<option value="inspeksi.idjenis_kerusakan">Jenis Kerusakan</option>
													<option value="waktu_kerusakan">Waktu Kerusakan</option>
													<?php
													if ($_SESSION['level'] != 'dgm_op' && $_SESSION['level'] != 'ptg_op')
													{
														echo '<option value="status">Kondisi Inspeksi</option>';
													}
													?>
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
												<input  type="submit" class="btn btn-primary" name="submit" value="Urutkan"></input>
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
								$filter = "waktu_perbaikan";
							}
							require_once('../../config.php');
							$db=new mysqli($db_host,$db_username,$db_password,$db_database) or
							die("Maaf Anda gagal koneksi.!");
								//Asign a query
								$view_query = " SELECT * FROM inspeksi
													 JOIN petugas ON inspeksi.npp=petugas.npp
													 JOIN jenis_inspeksi ON inspeksi.idjenis_inspeksi=jenis_inspeksi.idjenis_inspeksi
													 JOIN jenis_kerusakan ON inspeksi.idjenis_kerusakan=jenis_kerusakan.idjenis_kerusakan
													 WHERE status='0' ORDER BY $filter $urutan";
							// Execute the query
							$result = $db->query($view_query);
							if (!$result){
								 die ("Could not query the database: <br />". $db->error);
							}
							// Fetch and display the results
							// echo '<div class = "row">';
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
							// echo '</div>';
							$db->close();
						?>
						<!-- <a style="margin:10px 0px" class="btn btn-info btn-block" href="detail_inspeksi.php?id='.$row_k->idinspeksi.'"> Cari Inspeksi</a> -->
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
