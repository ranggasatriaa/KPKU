<?php
session_start();
error_reporting(0);
if (!isset($_SESSION['level'])){
	header('location:../../index.php');
	exit;
}elseif (isset($_SESSION['level'])){
	include('../../header.php');
?>

<!DOCTYPE html>
<html>
	<head>
	</head>
	<body>
		<div id="wrapper">
			<div style="position: inherit; margin: 0 0 0 195px; padding: 0 30px; border-left: 2px solid #e7e7e7; padding: 0 15px; min-height: 568px; background-color: white;">
				<div class="col-lg-12">
					<h1>Uploading file...</h1>
					<?php
					require_once ('../../config.php');
					$db = new mysqli($db_host, $db_username, $db_password, $db_database);
					if($db->connect_errno){
						die("Tidak dapat terkoneksi dengan database: </br>". $db->connect_errno);
					}
//fileeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeee
					if(count($_POST)>0){
						$idinspeksi=$_POST['id'];
						$waktu_kerusakan   = date("Y-m-d");
						$jenis_inspeksi    = "Lain-lain";
						$jenis_kerusakan	 = $_POST['jenis_kerusakan'];
						$lokasi						 = $_POST['lokasi'];
						$petugas					 = $_SESSION['nama'];

						if ($_FILES['userfile']['error'] > 0)
						{
							echo 'Problem: ';
							switch ($_FILES['userfile']['error'])
							{
								case 1:  echo 'File exceeded upload_max_filesize';
										break;
								case 2:  echo 'File exceeded max_file_size';
										break;
								case 3:  echo 'File only partially uploaded';
										break;
								case 4:  echo 'No file uploaded';
										break;
								case 6:  echo 'Cannot upload file: No temp directory specified';
										break;
								case 7:  echo 'Upload failed: Cannot write to disk';
										break;
							}
						}

						$target_dir = "gambar-kerusakan/";
						$target_file = $target_dir. $idinspeksi.'_'. basename($_FILES['userfile']['name']);
						$upload_ok = 1;
						$file_type = pathinfo($target_file,PATHINFO_EXTENSION);

						// Check if file already exists
						if (file_exists($target_file)) {
						    echo "Sorry, file already exists.<br />";
						    $upload_ok = 0;
						}
						// Check file size if you not use hidden input 'MAX_FILE_SIZE'
						/*if ($_FILES['userfile']['size'] > 1000000) {
						    echo "Sorry, your file is too large.<br />";

						    $upload_ok = 0;
						}*/
						// Allow certain file formats
						$allowed_type = array("jpg", "png", "jpeg", "gif");
						if(!in_array($file_type, $allowed_type)) {
						    echo "Sorry, only JPG, JPEG, PNG & GIF files are allowed.";
						    $upload_ok = 0;
						}
						// Does the file have the right MIME type?
						/*if ($_FILES['userfile']['type'] != 'text/plain'){
							echo 'Problem: file is not plain text';
							$uploadOk = 0;
						}*/
						// put the file where we'd like it
						if ($upload_ok != 0){
							if (is_uploaded_file($_FILES['userfile']['tmp_name'])){
								if (!move_uploaded_file($_FILES['userfile']['tmp_name'], $target_file)){
									echo 'Problem: Could not move file to destination directory';
								}else{
									echo '<h3 align="center">File uploaded successfully</h3>';

								}
							}else{
								echo 'Problem: Possible file upload attack. Filename: ';
								echo $_FILES['userfile']['name'];
							}
						}

				    // Seleksi Input Data
						$file_name = basename($_FILES['userfile']['name']);
						$direktori_kerusakan  = $target_file;
						$idinspeksi						= $db->real_escape_string($idinspeksi);
						$jenis_inspeksi				= $db->real_escape_string($jenis_inspeksi);
				    $jenis_kerusakan 			= $db->real_escape_string($jenis_kerusakan);
						$petugas							= $db->real_escape_string($petugas);
						$direktori_kerusakan	= $db->real_escape_string($direktori_kerusakan);
						$lokasi								= $db->real_escape_string($lokasi);

				    // Membuat query
				    $query_add_inspeksi = "INSERT INTO inspeksi (idinspeksi,jenis_inspeksi, jenis_kerusakan, waktu_kerusakan, waktu_perbaikan, petugas, direktori_kerusakan, direktori_perbaikan, lokasi,status)
				      VALUES('$idinspeksi','$jenis_inspeksi','$jenis_kerusakan','$waktu_kerusakan','','$petugas','$direktori_kerusakan','','$lokasi',FALSE)";
				    // Execute the query
				    $result = $db->query($query_add_inspeksi);
				    	if (!$result){
				       die ("Could not query the database: <br />". mysqli_error($db));
				    	}else{
								echo '<br/><a class="btn btn-outline btn-primary btn-block" href="index.php">Kembali</a>';				    		$db->close();
				    		exit;
				      }
					}
					// close submit
					?>
				</div>
			</div>
		</div>
	</body>
</html>

<?php } ?>
