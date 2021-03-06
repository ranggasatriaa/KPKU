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
	</head>
	<body>
		<div id="wrapper">
			<div id="page-wrapper">
				<div class="row">
					<div class="col-lg-12">
						<h1>Mengunggah file...</h1>
						<?php
						require_once ('../../config.php');
						$db = new mysqli($db_host, $db_username, $db_password, $db_database);
						if($db->connect_errno){
							die("Tidak dapat terkoneksi dengan database: </br>". $db->connect_errno);
						}
						//fileeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeee
						if(count($_POST)>0){
              $idinspeksi					= $_GET['id'];
              $idjenis_inspeksi   = $_GET['idjenis_inspeksi'];
              $idjenis_kerusakan	= $_GET['idjenis_kerusakan'];
							$direktori_kerusakan= $_GET['direktori_kerusakan'];
							$direktori_perbaikan= $_GET['direktori_perbaikan'];
              $keterangan					= $_GET['keterangan'];
              $lokasi							= $_GET['lokasi'];

if(userfile_k)
							if ($_FILES['userfile_k']['error'] > 0)
							{
								echo 'Problem: ';
								switch ($_FILES['userfile']['error'])
								{
									case 1:  echo '<div class="alert alert-warning">Gagal Mengunggah: Ukuran File terlalu besar!</div>';
	                         echo '<a class="btn btn-outline btn-primary btn-block" href="add_inspeksi.php?id='.$idinspeksi.'">Kembali</a>';
											break;
									case 2:  echo '<div class="alert alert-warning">Gagal Mengunggah: Ukuran File terlalu besar!!</div>';
	                         echo '<a class="btn btn-outline btn-primary btn-block" href="add_inspeksi.php?id='.$idinspeksi.'">Kembali</a>';
											break;
									case 3:  echo '<div class="alert alert-warning">Gagal Mengunggah: Hanya sebagian file yang terunggah</div>';
	                         echo '<a class="btn btn-outline btn-primary btn-block" href="add_inspeksi.php?id='.$idinspeksi.'">Kembali</a>';
											break;
									case 4:  echo '<div class="alert alert-warning"> Tidak ada file yag diunggah</div>';
	                         echo '<a class="btn btn-outline btn-primary btn-block" href="add_inspeksi.php?id='.$idinspeksi.'">Kembali</a>';
											break;
									case 6:  echo '<div class="alert alert-warning">Gagal Mengunggah: Direktori tidak spesifik.</div>';
	                         echo '<a class="btn btn-outline btn-primary btn-block" href="add_inspeksi.php?id='.$idinspeksi.'">Kembali</a>';
											break;
									case 7:  echo '<div class="alert alert-warning">Gagal Mengunggah: Tidak dapat menulis ke hardisk.</div>';
	                         echo '<a class="btn btn-outline btn-primary btn-block" href="add_inspeksi.php?id='.$idinspeksi.'">Kembali</a>';
											break;
								}
							}

							$target_dir = "gambar-kerusakan/";
							$target_file = $target_dir. $idinspeksi.'_'. basename($_FILES['userfile']['name']);
							$upload_ok = 1;
							$file_type = pathinfo($target_file,PATHINFO_EXTENSION);

							// Check if file already exists
							if (file_exists($target_file)) {
							    echo '<div class="alert alert-danger">ERROR! File yang sama telah ada.</div><br />';
	                echo '<br/><a class="btn btn-outline btn-primary btn-block" href="add_inspeksi.php?id='.$idinspeksi.'">Kembali</a>';
							    $upload_ok = 0;
							}
							// Check file size if you not use hidden input 'MAX_FILE_SIZE'
							if ($_FILES['userfile']['size'] > 5300000) {
	              echo '<div class="alert alert-danger">Gagal Mengunggah: Ukuran File terlalu besar</div>';
	              echo '<a class="btn btn-outline btn-primary btn-block" href="add_inspeksi.php?id='.$idinspeksi.'">Kembali</a>';
							  $upload_ok = 0;
							}

							// Allow certain file formats
							$allowed_type = array("jpg", "png", "jpeg","bmp","gif","JPG","PNG","JPEG","BMP","GIF");
							if(!in_array($file_type, $allowed_type)) {
							    echo '<div class="alert alert-danger">ERROR! Hanya file bertipe: jpg, jpeg, png & gif yang diperbolehkan.</div>';
	                echo '<a class="btn btn-outline btn-primary btn-block" href="add_inspeksi.php?id='.$idinspeksi.'">Kembali</a>';
							    $upload_ok = 0;
							}
							// Does the file have the right MIME type?
							/*if ($_FILES['userfile']['type'] != 'text/plain'){
								echo 'Problem: file is not plain text';
								$uploadOk = 0;
							}*/
							// put the file where we'd like it
							if ($upload_ok != 0){
								if (!is_uploaded_file($_FILES['userfile']['tmp_name'])){
	                echo '<div class="alert alert-warning">ERROR! Kemungkinan file yang diunggah bertabrakan dengan:'.$_FILES['userfile']['name'].'</div';
	                echo '<a class="btn btn-outline btn-primary btn-block" href="add_inspeksi.php?id='.$idinspeksi.'">Kembali</a>';
								}elseif (!move_uploaded_file($_FILES['userfile']['tmp_name'], $target_file)){
	                echo '<div class="alert alert-warning">ERROR! Tidak dapat memindahkan file ke direktori</div>';
	                echo '<a class="btn btn-outline btn-primary btn-block" href="add_inspeksi.php?id='.$idinspeksi.'">Kembali</a>';
	              }else{
	                // Seleksi Input Data
	                $file_name = basename($_FILES['userfile']['name']);
	                $direktori_kerusakan  = $target_file;
	                $idinspeksi						= $db->real_escape_string($idinspeksi);
	                // $jenis_inspeksi				= $db->real_escape_string($jenis_inspeksi);
	                // $jenis_kerusakan 			= $db->real_escape_string($jenis_kerusakan);
	                // $petugas							= $db->real_escape_string($petugas);
	                $direktori_kerusakan	= $db->real_escape_string($direktori_kerusakan);
									$keterangan						= $db->real_escape_string($keterangan);
	                $lokasi								= $db->real_escape_string($lokasi);

	                // Membuat query
	                $query_add_inspeksi = "INSERT INTO inspeksi (idinspeksi,idjenis_inspeksi, idjenis_kerusakan, waktu_kerusakan, waktu_perbaikan, idpetugas, direktori_kerusakan, direktori_perbaikan, keterangan, lokasi,status)
	                VALUES('$idinspeksi','$idjenis_inspeksi','$idjenis_kerusakan','$waktu_kerusakan','','$idpetugas','$direktori_kerusakan','','$keterangan','$lokasi',0)";
	                // Execute the query
	                $result = $db->query($query_add_inspeksi);
	                if (!$result){
	                  die ("Could not query the database: <br />". mysqli_error($db));
	                }else{
	                  echo '<div class="alert alert-success" style="font-size:150%; text-align:center">File berhasil di unggah</div>';
	                  echo '<br/><a class="btn btn-outline btn-primary btn-block" href="index.php">Kembali</a>';
	                  $db->close();
	                  // exit;
	                }
	              }
							}
						}
						// close submit
						?>
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
</html>
