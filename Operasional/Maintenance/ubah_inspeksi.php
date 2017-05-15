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
		<title>Ubah Inspeksi</title>
	<?php
		$idinspeksi = $_GET['id'];
	?>
	</head>
	<body>
		<div id="wrapper">
			<div style="position: inherit; margin: 0 0 0 195px; padding: 0 30px; border-left: 2px solid #e7e7e7; padding: 0 15px; min-height: 568px; background-color: white;">
        <div class="col-lg-12">
		      <h2 align="center"> Masukkan Detail Kerusakan Jembatan </h2>
					<form action="compile_jembatan.php" method="post" enctype="multipart/form-data"/>
						<div>
							<input type="hidden" name="id" value="<?php echo $idinspeksi;?>" />
							<input type="hidden" name="MAX_FILE_SIZE" value="1000000" />
							<div class="form-group">
							File diperbolehkan : jpg, jpeg, png or gif<br />
								<label for="userfile">Unggah foto:</label>
								<br/><img id="img_prev" src="img.png" style="width:25%; max-height:300px; min-width:100px; margin-bottom:5px"/>
								<input type="file" name="userfile" id="userfile" required>
							</div>
							<div class="form-group">
								<label>Jenis Kerusakan:</label>
								<select name="jenis_kerusakan" class="form-control" required>
										<option value="">- Pilih Kerusakan -</option>
										<option value="Retak">Retak</option>
										<option value="Lubang">Lubang</option>
										<option valur="Patah">Patah</option>
										<option value="Lain-lain">Lain-lain</option>
								</select>
							</div>
							<div class="form-group">
								<label>Lokasi Kerusakan:</label>
								<textarea name="lokasi" class="form-control" rows="3" placeholder="Masukkan Lokasi Kerusakan" required></textarea>
							</div>
							<div class="form-group">
								<input class="btn btn-success" type="submit" value="Submit"/>
								<a style="float:right" class="btn btn-primary btn-outline" href="pil_inspeksi.php" >Kembali</a>
							</div>
						</div>
					</form>
				</div>
				<!-- /.col -->
			</div>
			<!-- /. page wrapper -->
		</div>
		<!-- /. wrapper -->
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
