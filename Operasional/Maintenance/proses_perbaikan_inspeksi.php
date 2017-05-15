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
							$idinspeksi				= $_POST['id'];
							$waktu_perbaikan 	= date("Y-m-d");

							if ($_FILES['userfile']['error'] > 0)
							{
								echo 'Problem: ';
								switch ($_FILES['userfile']['error'])
								{
									case 1:  echo '<div class="alert alert-warning">Gagal Mengunggah: Ukuran File terlalu besar</div>';
	                         echo '<a class="btn btn-outline btn-primary btn-block" href="add_inpeksi.php?id='.$idinspeksi.'">Kembali</a>';
											break;
									case 2:  echo '<div class="alert alert-warning">Gagal Mengunggah: Ukuran File terlalu besar</div>';
	                         echo '<a class="btn btn-outline btn-primary btn-block" href="add_inpeksi.php?id='.$idinspeksi.'">Kembali</a>';
											break;
									case 3:  echo '<div class="alert alert-warning">Gagal Mengunggah: Hanya sebagian file yang terunggah</div>';
	                         echo '<a class="btn btn-outline btn-primary btn-block" href="add_inpeksi.php?id='.$idinspeksi.'">Kembali</a>';
											break;
									case 4:  echo '<div class="alert alert-warning"> Tidak ada file yag diunggah</div>';
	                         echo '<a class="btn btn-outline btn-primary btn-block" href="add_inpeksi.php?id='.$idinspeksi.'">Kembali</a>';
											break;
									case 6:  echo '<div class="alert alert-warning">Gagal Mengunggah: Direktori tidak spesifik.</div>';
	                         echo '<a class="btn btn-outline btn-primary btn-block" href="add_inpeksi.php?id='.$idinspeksi.'">Kembali</a>';
											break;
									case 7:  echo '<div class="alert alert-warning">Gagal Mengunggah: Tidak dapat menulis ke hardisk.</div>';
	                         echo '<a class="btn btn-outline btn-primary btn-block" href="add_inpeksi.php?id='.$idinspeksi.'">Kembali</a>';
											break;
								}
							}

							$target_dir = "gambar-perbaikan/";
							$target_file = $target_dir. $idinspeksi.'_'. basename($_FILES['userfile']['name']);
							$upload_ok = 1;
							$file_type = pathinfo($target_file,PATHINFO_EXTENSION);

							// Check if file already exists
							if (file_exists($target_file)) {
							    echo '<div class="alert alert-danger">ERROR! File yang sama telah ada.</div><br />';
	                echo '<br/><a class="btn btn-outline btn-primary btn-block" href="add_inpeksi.php?id='.$idinspeksi.'">Kembali</a>';
							    $upload_ok = 0;
							}
							// Check file size if you not use hidden input 'MAX_FILE_SIZE'
							if ($_FILES['userfile']['size'] > 1000000) {
	              echo '<div class="alert alert-danger">Gagal Mengunggah: Ukuran File terlalu besar</div>';
	              echo '<a class="btn btn-outline btn-primary btn-block" href="add_inpeksi.php?id='.$idinspeksi.'">Kembali</a>';
							  $upload_ok = 0;
							}

							// Allow certain file formats
							$allowed_type = array("jpg", "png", "jpeg", "gif");
							if(!in_array($file_type, $allowed_type)) {
							    echo '<div class="alert alert-danger">ERROR! Hanya file bertipe: jpg, jpeg, png & gif yang diperbolehkan.</div>';
	                echo '<a class="btn btn-outline btn-primary btn-block" href="add_inpeksi.php?id='.$idinspeksi.'">Kembali</a>';
							    $upload_ok = 0;
							}
							// Does the file have the right MIME type?
							/*if ($_FILES['userfile']['type'] != 'text/plain'){
								echo 'Problem: file is not plain text';
								$uploadOk = 0;
							}*/
							// put the file where we'd like it
							if ($upload_ok != 0){

	                // Seleksi Input Data
	                $file_name = basename($_FILES['userfile']['name']);
	                $direktori_perbaikan  = $target_file;
	                $direktori_perbaikan	= $db->real_escape_string($direktori_perbaikan);

	                // Membuat query
	                $query_perbaiki_inspeksi = "UPDATE inspeksi SET waktu_perbaikan='".$waktu_perbaikan."',direktori_perbaikan='".$direktori_perbaikan."', status=TRUE WHERE idinspeksi='".$idinspeksi."' ";
	                // Execute the query
	                $result = $db->query($query_perbaiki_inspeksi);
	                if (!$result){
										echo '<br/><a class="btn btn-outline btn-primary btn-block" href="index.php">Kembali</a>';
	                  die ("Could not query the database: <br />". $db->error);
	                }elseif (!is_uploaded_file($_FILES['userfile']['tmp_name'])){
			                echo '<div class="alert alert-warning">ERROR! Kemungkinan file yang diunggah bertabrakan dengan:'.$_FILES['userfile']['name'].'</div';
			                echo '<a class="btn btn-outline btn-primary btn-block" href="add_inpeksi.php?id='.$idinspeksi.'">Kembali</a>';
										}elseif (!move_uploaded_file($_FILES['userfile']['tmp_name'], $target_file)){
			                echo '<div class="alert alert-warning">ERROR! Tidak dapat memindahkan file ke direktori</div>';
			                echo '<a class="btn btn-outline btn-primary btn-block" href="add_inpeksi.php?id='.$idinspeksi.'">Kembali</a>';
			              }else{
	                  echo '<div class="alert alert-success"><h2 align="center">File berhasil di unggah</h2></div>';
	                  echo '<br/><a class="btn btn-outline btn-primary btn-block" href="index.php">Kembali</a>';
	                  $db->close();

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
