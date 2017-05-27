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
?>

<!DOCTYPE html>
<html>
	<head>
		<title>Tambah Inspeksi</title>
	<?php
    $idpetugas=$_SESSION['idpetugas'];
	?>
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
						<form action="proses_add_inspeksi.php" method="post" enctype="multipart/form-data"/>
								<?php
								require_once('../../config.php');
								$db = new mysqli($db_host, $db_username, $db_password, $db_database);
								if($db->connect_errno){
									die("Tidak dapat terkoneksi dengan database: </br>". $db->connect_errno);
								}
								// query untuk id
								$query_id = "SELECT max(idinspeksi) as id FROM inspeksi";
								$result_id =  $db->query($query_id);
								if (!$result_id){
									die ("Could not query the database: <br />". $db->error);
								}else{
									$date = date("Ymd");
									// ADD +1 with last usique ID
									$row_id = $result_id->fetch_object();
									$idterakhir = $row_id->id;
									$tanggalid = substr($idterakhir, 0,8);
									// perbandingan tanggal sekarang dan tanggal id terakhir
									if($tanggalid < $date){
										$unique = "001";
										$idinspeksi = $date.$unique;
									}else{
										$next_idtrx = $idterakhir+1;
										$unique = substr($next_idtrx, -3);
										$idinspeksi = $date.$unique;
										$date = strval($date);
									}
									echo "ID Inspeksi: ";
									echo $idinspeksi;
									echo '<br/>';
									// echo $row->id;
								}
								?>
								<input type="hidden" name="id" value="<?php echo $idinspeksi;?>" />
	              <input type="hidden" name="idpetugas" value="<?php echo $idpetugas;?>" />
								<input type="hidden" name="MAX_FILE_SIZE" value="5000000" />
								<div class="form-group">
									<label for="userfile">Unggah foto (TUkuran Max 5Mb):</label>
									<!-- File diperbolehkan : jpg, jpeg, png or gif -->
									<br/><img id="img_prev" src="img.png" style="width:25%; max-height:300px; min-width:100px; margin-bottom:5px"/>
									<input type="file" name="userfile" id="userfile" required>
								</div>
								<div class="form-group">
									<label>Jenis Inspeksi:</label>
									<select name="idjenis_inspeksi" class="form-control" required>
										<?php
											$query_ji = "SELECT * FROM jenis_inspeksi";
											$result_ji = $db->query($query_ji);
											if(!$result_ji){
												die("Query tidak terkoneksi dengan database: </br>" .$db->error);
											}
											echo "<option value=''>-- Pilih Inspeksi --</option>";
											while($row_ji = $result_ji->fetch_object()){
												echo " <option value='$row_ji->idjenis_inspeksi'>$row_ji->nama_inspeksi</option>";
											}
										?>
									</select>
								</div>
								<div class="form-group">
									<label>Jenis Kerusakan:</label>
									<select name="idjenis_kerusakan" class="form-control" onchange="yesnoCheck(this);" required>
										<?php
											$query_jk = "SELECT * FROM jenis_kerusakan";
											$result_jk = $db->query($query_jk);
											if(!$result_jk){
												die("Query tidak terkoneksi dengan database: </br>" .$db->error);
											}
											echo "<option value=''>-- Pilih Kerusakan --</option>";
											while($row_jk = $result_jk->fetch_object()){
												echo " <option value='$row_jk->idjenis_kerusakan'>$row_jk->nama_kerusakan</option>";
											}
										?>
									</select>
								</div>
								<script>
									function yesnoCheck(that) {
							        if (that.value == "204") {
							            document.getElementById("kerusakan").style.display = "block";
							        } else {
							            document.getElementById("kerusakan").style.display = "none";
							        }
							    }
								</script>
								<div id="kerusakan" style="display: none;">
									<div class="form-group">
										<label>Keterangan:</label>
										<textarea name="keterangan" class="form-control" rows="3" placeholder="Masukkan keterangan Tambahan"></textarea>
									</div>
								</div>
								<div class="form-group">
									<label>Lokasi Kerusakan:</label>
									<textarea name="lokasi" class="form-control" rows="3" placeholder="Masukkan Lokasi Kerusakan" required></textarea>
								</div>
								<div class="form-group">
									<input class="btn btn-success" type="submit" value="Submit"/>
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
