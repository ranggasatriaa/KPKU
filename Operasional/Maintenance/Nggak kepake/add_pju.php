<html>
	<head>
	<?php include ('../../header.php') ;
		$idinspeksi = $_GET['id'];
	?>
	</head>
	<body>
		<div id="wrapper">
			<div style="position: inherit; margin: 0 0 0 195px; padding: 0 30px; border-left: 2px solid #e7e7e7; padding: 0 15px; min-height: 568px; background-color: white;">
        <div class="col-lg-12">
		      <h2 align="center"> Masukkan Detail Kerusakan PJU </h2>
					<form action="compile_pju.php" method="post" enctype="multipart/form-data"/>
						<div>
							File allowed : jpg, jpeg, png or gif<br /><br />
							<input type="text" name="id" value="<?php echo $idinspeksi;?>" />
							<input type="hidden" name="MAX_FILE_SIZE" value="1000000" />
							<label for="userfile">Upload a file:</label>
							<input type="file" name="userfile" id="userfile" required/>

							<label>Jenis Kerusakan:</label>
							<select name="jenis_kerusakan" class="form-control" required>
									<option value="">- Pilih Kerusakan -</option>
									<option value="Retak">Retak</option>
									<option value="Lubang">Lubang</option>
									<option valur="Patah">Patah</option>
									<option value="Lain-lain">Lain-lain</option>
							</select>
							<span class="error">* <?php if(isset($error_jenis_kerusakan)) {echo $error_jenis_kerusakan;}?></span>
							<label>Lokasi Kerusakan:</label>
							<textarea name="lokasi" class="form-control" rows="3" placeholder="Masukkan Lokasi Kerusakan" required></textarea>
							<span class="error">* <?php if(isset($error_lokasi)) {echo $error_lokasi;}?></span>
							<input type="submit" value="Submit"/>
						</div>
					</form>
				</div>
			</div>
		</div>
	</body>
</html>
