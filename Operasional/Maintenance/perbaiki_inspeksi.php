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
		<title>Perbaiki Inspeksi</title>
	<?php
		$idinspeksi = $_GET['id'];
	?>
	</head>
	<body>
		<div id="wrapper">
			<div id="page-wrapper">
				<div class="row">
	        <div class="col-lg-12">
			      <h2 align="center"> Masukkan Detail Perbaikan </h2>
						<form action="proses_perbaikan_inspeksi.php" method="post" enctype="multipart/form-data"/>
							<div>
								<input type="hidden" name="id" value="<?php echo $idinspeksi;?>" />
								<input type="hidden" name="MAX_FILE_SIZE" value="1000000" />
								<div class="form-group">
								File diperbolehkan : jpg, jpeg, png or gif<br />
									<label for="userfile">Unggah foto (Ukuran Max 5Mb):</label>
									<br/><img id="img_prev" src="img.png" style="width:25%; max-height:300px; min-width:100px; margin-bottom:5px"/>
									<input type="file" name="userfile" id="userfile" required>
								</div>
								<div class="form-group">
									<input class="btn btn-success" type="submit" value="Submit"/>
									<a style="float:right" class="btn btn-danger" href="pil_perbaiki_inspeksi.php" >Batal</a>
								</div>
							</div>
						</form>
					</div>
					<!-- /.col -->
				</div>
				<!-- /. row -->
			</div>
			<!-- /. page wrapper -->
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
