<?php
session_start();
error_reporting(0);
if (!isset($_SESSION['level'])){
	header('location:/kpku/index.php');
	exit;
}elseif($_SESSION['level']!="dgm_op"){
	header('location:/kpku/unauthorized.php');
}else{
	include('../header.php');
}
?>

<!DOCTYPE html>
<html >
	<head>
		<title>Jenis Inspeksi</title>
		<script>
		function del(){
			var y=window.confirm("Anda yakin ingin menghapus?");
			return y;
		}
		</script>
	</head>
	<body>
		<div id="wrapper">
			<div id="page-wrapper">
				<div class="row">
				  <div class="col-lg-12">
						<h2>Data User</h2>
						<p><a href="add_jenis_inspeksi.php?" class="btn btn-primary"><i class="fa fa-plus"></i>  Tambah Jenis Inspeksi </a></p>
							<div class="row">
								<div class="col-lg-12">
									<!-- <div class="panel panel-default"> -->
										<!-- <div class="panel-body"> -->
										<table class="table table-striped table-bordered table-hover" id="dataTables-example" align="left">
											<tr>
												<th>No</th>
												<th>Nama Inspeksi</th>
												<th>Aksi</th>
											</tr>
											<?php
												// connect database
												require_once('../config.php');
												$db = new mysqli($db_host, $db_username, $db_password, $db_database);
												if ($db->connect_errno){
													die ("Could not connect to the database: <br />". $db->connect_error);
												}
												//Asign a query
												$query = " SELECT * FROM jenis_inspeksi ORDER BY idjenis_inspeksi ";
												// Execute the query
												$result = $db->query( $query );
												if (!$result){
													die ("Could not query the database: <br />". $db->error);
												}
												// Fetch and display the results
												$i = 1;
												while ($row = $result->fetch_object()){
														echo '<tr>';
															echo '<td>'.$i.'</td>';
															echo '<td>'.$row->nama_inspeksi.'</td> ';
															echo '<td>';
																echo '<a class="btn btn-warning" href="edit_jenis_inspeksi.php?id='.$row->idjenis_inspeksi.'"><i class="fa fa-edit"></i> Ubah</a>';
																echo '&nbsp&nbsp&nbsp<a class="btn btn-danger" href="delete_jenis_inspeksi.php?id='.$row->idjenis_inspeksi.'" onclick="return del()"><i class="fa fa-eraser"></i> Hapus</a>';
															echo '</td>';
														echo '</tr>';
														$i++;
												}
												$result->free();
												$db->close();
											?>
										</table>
									</div>
								</div>
							</div>
						</div>
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
