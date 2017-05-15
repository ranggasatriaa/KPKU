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

	$idinspeksi = $_GET['id'];
	require_once('../../config.php');
	$db = new mysqli($db_host, $db_username, $db_password, $db_database);
	if($db->connect_errno){
		die("Tidak dapat terkoneksi dengan database: </br>". $db->connect_errno);
	}
		// query untuk preview
		$query_edit = "SELECT * FROM inspeksi WHERE idinspeksi=".$idinspeksi."";
		$result_edit =  $db->query($query_edit);
		if (!$result_edit){
			die ("Could not query the database: <br />". $db->error);
		}else{
			// $date = date("Ymd");
			// ADD +1 with last usique ID
			$row_e = $result_edit->fetch_object();
			$idjenis_inspeksi 		= $row_e->idjenis_inspeksi;
			$idjenis_kerusakan 		= $row_e->idjenis_kerusakan;
			$direktori_kerusakan 	= $row_e->direktori_kerusakan;
			$direktori_perbaikan	= $row_e->direktori_perbaikan;
			$keterangan						= $row_e->keterangan;
			$lokasi								= $row_e->lokasi;
			$status								= $row_e->status;
		}
	?>

<!DOCTYPE html>
<html>
	<head>
		<title>Ubah Inspeksi</title>
	</head>
	<body>
		<div id="wrapper">
			<!-- <div style="position: inherit; margin: 0 0 0 195px; padding: 0 30px; border-left: 2px solid #e7e7e7; padding: 0 15px; min-height: 568px; background-color: white;"> -->
			<div id="page-wrapper">
				<div class="row">
	        <div class="col-lg-12">
						<div class="row">
			      	<h2 align="center"> Masukkan Detail Kerusakan </h2>
						</div>
						<form action="proses_edit_inspeksi.php" method="GET" />
								<input type="hidden" name="id" value="<?php echo $idinspeksi;?>" />
									<table>
										<tr>
											<td>
												<br/><img id="img_prev" src="<?php echo $direktori_kerusakan;?>" style="width:40%; max-height:200px; min-width:100px; margin-bottom:5px"/>
											<?php
												if ($status==1){
													echo '<td>';
													echo '<br/><img id="img_prev" src="'.$direktori_perbaikan.'" style="width:40%; max-height:200px; min-width:100px; margin-bottom:5px"/>';
													echo '</td>';
												}
											?>
											</td>
										</tr>
									</table>
								</div>
								<div class="form-group">
									<label>Jenis Inspeksi:</label>
									<select name="idjenis_inspeksi" class="form-control" value='201' required>
										<?php
										//query jenis_inspeksi
											$query_ji = "SELECT * FROM jenis_inspeksi";
											$result_ji = $db->query($query_ji);
											if(!$result_ji){
												die("Query tidak terkoneksi dengan database: </br>" .$db->error);
											}
											echo "<option value=''>-- Pilih Inspeksi --</option>";
											while($row_ji = $result_ji->fetch_object()){
												echo " <option value='$row_ji->idjenis_inspeksi'";
												if ($idjenis_inspeksi==$row_ji->idjenis_inspeksi){
													echo 'selected="true"';
												}
												echo ">$row_ji->nama_inspeksi</option>";
											}
											?>
									</select>
								</div>

								<div class="form-group">
									<label>Jenis Kerusakan: </label>
									<select name="idjenis_kerusakan" class="form-control" required>
										<?php
											$query_jk = "SELECT * FROM jenis_kerusakan";
											$result_jk = $db->query($query_jk);
											if(!$result_jk){
												die("Query tidak terkoneksi dengan database: </br>" .$db->error);
											}
											echo "<option value=''>-- Pilih Kerusakan --</option>";
											while($row_jk = $result_jk->fetch_object()){
												echo " <option value='$row_jk->idjenis_kerusakan'";
												if ($idjenis_kerusakan==$row_jk->idjenis_kerusakan){
													echo 'selected="true"';
												}
												echo ">$row_jk->nama_kerusakan</option>";
											}
										?>
									</select>
								</div>
								<div class="form-group">
									<label>Keterangan:</label>
									<textarea name="keterangan" class="form-control" rows="3" placeholder="Masukkan keterangan Tambahan"><?php echo $keterangan;?></textarea>
								</div>
								<div class="form-group">
									<label>Lokasi Kerusakan:</label>
									<textarea name="lokasi" class="form-control" rows="3" placeholder="Masukkan Lokasi Kerusakan" required><?php echo $lokasi;?></textarea>
								</div>
								<div class="form-group">
									<input class="btn btn-success" type="submit" name="submit" value="Submit"/>
									<a style="float:right" class="btn btn-danger" href="index.php" >Batal</a>
								</div>
							</form>
					</div>
        	<!-- /. col-lg-12 -->
				</div>
				<!-- /. row -->
			</div>
      <!-- /. page-wrapper -->
		</div>
    <!-- /. wrapper -->
		<!-- footer -->
		<div style="text-align:right; font-size:80%; height:40px; background:#0059B2; color:#cce6ff; position:relative; bottom:0px; width:100%; padding:5px 20px; margin:20px 0px" >
			Copyright Informatika Undip 2017
		</div>
    <!-- close footer -->
	</body>
	<script>
		function readURL(input){
			var reader = new FileReader();
			reader.onload = function(e){
				$('#img_prev').attr('src',e.target.result);
			}
			reader.readAsDataURL(input.files[0]);
		}
		$("#userfile").change(function(){
			readURL(this);
		})
	</script>
</html>
