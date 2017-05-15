<?php
	$id_tipe = $_GET['id'];
	// connect database
	require_once('db_login.php');
	$db = new mysqli($db_host, $db_username, $db_password, $db_database);
	if ($db->connect_errno){
		die ("Could not connect to the database: <br />". $db->connect_error);
	}

	if (!isset($_POST["submit"])){
		$query = " SELECT * FROM tipe_anggaran WHERE id_tipe=".$id_tipe." "; //nampilin data yang 'lama'
		// Execute the query
		$result = $db->query( $query );
		if (!$result){
			die ("Could not query the database: <br />". $db->error);
		}else{
			while ($row = $result->fetch_object()){ //semua data yg diselect itu dimasukin ke objek
				$nama_tipe = $row->nama_tipe;
				$flag = $row->flag;
			}
		}
	}else{
		$nama_tipe=$_POST['nama_tipe'];
			//cek validasi id tahun dan nama tahun,krn text jadi validasinya:
			$nama_tipe=test_input($_POST["nama_tipe"]);
			if($nama_tipe==''){
				$error_nama_tipe="Mohon isi nama tipe";
				$valid_nama_tipe=FALSE;
			}
			else{
				$valid_nama_tipe=TRUE;
			}
			$flag = $_POST['flag'];
			if ($flag == '' || $flag == 'none'){
				$error_flag = "Masukkan kondisi hitung";
				$valid_flag = FALSE;
			}else{
			$valid_flag = TRUE;
			}

			//update data into database
			if ($valid_nama_tipe && $valid_flag){
				//escape inputs data
				$nama_tipe = $db->real_escape_string($nama_tipe);
				$flag = $db->real_escape_string($flag);
				//Asign a query
				$query = " UPDATE tipe_anggaran SET nama_tipe='".$nama_tipe."',flag='".$flag."' WHERE id_tipe=".$id_tipe." ";
				// Execute the query
				$result = $db->query( $query );
				if (!$result){
				die ("Could not query the database: <br />". $db->error);
				}else{
					echo "<script>alert('Tipe Anggaran Sudah Diedit')</script><br /><br />";
					echo "<script>window.open('view_tipe_anggaran.php','_self')</script>";
					$db->close();
					exit;
				}
			}
		}
	function test_input($data) {
		$data = trim($data);
		$data = stripslashes($data);
		$data = htmlspecialchars($data);
		return $data;
	}
?>

<!DOCTYPE HTML>
<html>
	<head>
		<style>
			.error {color: #FF0000;}
		</style>
	</head>
	<body>
		<h2>Tambah Tipe Anggaran</h2>
		<form method="POST" autocomplete="on" action="add_tipe_anggaran.php">
			<table>
				<tr>
					<td valign="top">Tipe</td>
					<td valign="top">:</td>
					<td valign="top"><input type="text" name="nama_tipe" size="30" maxlength="10" placeholder="Tipe anggaran" autofocus value="<?php if(isset( $nama_tipe)) {echo $nama_tipe;}?>"></td>
					<td valign="top"><span class="error">* <?php if(isset($error_nama_tipe)) {echo $error_nama_tipe;}?></span></td>
				</tr>
				<tr>
					<td valign="top">Apakah Tipe dihitung dalam laba usaha?</td>
					<td valign="top">:</td>
					<td valign="top"><select name="flag" required>
						<option value="none" <?php if (!isset($flag)) echo 'selected="true"';?>>--Pilihan--</option>
						<option value="Hitung" <?php if (isset($city) && $city=="Hitung") echo 'selected="true"';?>>Hitung</option>
						<option value="Tidak" <?php if (isset($city) && $city=="Tidak") echo 'selected="true"'; ?>>Tidak</option>
						</select>
					</td>
					<td valign="top"><span class="error">* <?php if(isset($error_city)) {echo $error_city;}?></span></td>
				</tr>
					<td valign="top" colspan="3"><br><input type="submit" name="submit" value="Submit">
				</tr>
				</table>
		</form>
	</body>
</html>

<?php
$db->close();
?>
