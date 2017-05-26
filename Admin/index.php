<?php
	session_start();
	error_reporting(0);
	if (!isset($_SESSION['level'])){
		header('location:/kpku/index.php');
		exit;
	}elseif($_SESSION['level']!="admin"){
		header('location:/kpku/unauthorized.php');
	}else{
		include('../header.php');
	}
?>

<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN"
"http://www.w3.org/TR/html401/loose.dtd">
<html>
  <head>
	<title>Admin</title>
		<script>
		function del(){
			var y=window.confirm("Anda yakin ingin menghapus?");
			return y;
		}
		</script>
		<script>
		function reset(){
			var x=window.confirm("Anda yakin ingin mereset password?");
			return x;
		}
		</script>
  </head>
  <body>
    <div id="wrapper">
			<div id="page-wrapper">
				<div class="row">
					<div class="col-lg-12">
          <h2>Data User</h2>
          <p><a href="add_petugas.php?" class="btn btn-primary"><i class="fa fa-plus"></i>  Tambah User </a></p>
            <div class="row">
      		    <div class="col-lg-12">
      				  <div class="panel panel-default">
      					  <!-- <div class="panel-body"> -->
									<table width="100%" class="table table-striped table-bordered table-hover" id="dataTables-example" align="center">
										<tr>
											<th style="align-center">No</th>
											<th style="align-center">NPP</th>
											<th style="align-center">Nama</th>
											<th style="align-center">Level</th>
											<th style="align-center">Aksi</th>
											<th style="align-center">Keterangan</th>
										</tr>
										<?php
											// connect database
											require_once('../config.php');
											$db = new mysqli($db_host, $db_username, $db_password, $db_database);
											if ($db->connect_errno){
												die ("Could not connect to the database: <br />". $db->connect_error);
											}
											//Asign a query
											$query = " SELECT * FROM petugas ORDER BY idpetugas ";
											// Execute the query
											$result = $db->query( $query );
											if (!$result){
												die ("Could not query the database: <br />". $db->error);
											}
											// Fetch and display the results
											$i = 1;
											while ($row = $result->fetch_object()){
												if ($row->idpetugas != 1){
													echo '<tr>';
														echo '<td>'.$i.'</td>';
														echo '<td>'.$row->npp.'</td> ';
														echo '<td>'.$row->nama.'</td> ';
														echo '<td>';
														if($row->level=="gm"){
															echo "General Manager";
														}elseif($row->level=="dgm_hrga"){
															echo "Deputy General Manager HRGA";
														}elseif($row->level=="dgm_op"){
															echo "Deputy General Manager Operasional";
														}elseif($row->level=="dgm_fn"){
															echo "Deputy General Manager Financial";
														}elseif($row->level=="ptg_hrga"){
															echo "Petugas HRGA";
														}elseif($row->level=="ptg_op"){
															echo "Petugas Operasional";
														}elseif($row->level=="ptg_fn"){
															echo "Petugas Financial";
														}else{
															echo "-";
														}
														echo '</td> ';
														echo '<td>';
															echo '<a class="btn btn-warning" href="edit_petugas.php?id='.$row->idpetugas.'"><i class="fa fa-edit"></i> Ubah</a>';
															echo '&nbsp&nbsp&nbsp<a class="btn btn-danger" href="delete_petugas.php?id='.$row->idpetugas.'" onclick="return del()"><i class="fa fa-eraser"></i> Hapus</a>';
															echo '&nbsp&nbsp&nbsp<a class="btn btn-info" href="reset_password.php?id='.$row->idpetugas.'" onclick="return reset()"><i class="fa fa-refresh"></i> Reset Password</a>';
														echo '</td>';
														echo '<td>';
															if($row->request==1){
																echo '<strong class="text-danger">Meminta Reset Password</strong>';
															}else{
																echo ' - ';
															}
														echo '</td>';
													echo '</tr>';
													$i++;
												}
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
        <!-- close col-lg-12 -->
      </div>
      <!-- close possition -->
    </div>
    <!-- close wrapper -->
		<!-- footer -->
		<div style="text-align:right; font-size:80%; height:40px; background:#0059B2; color:#cce6ff; position:relative; bottom:0px; width:100%; padding:5px 20px; margin:20px 0px" >
			Copyright Informatika Undip 2017
		</div>
		<!-- close footer -->
  </body>
</html>
