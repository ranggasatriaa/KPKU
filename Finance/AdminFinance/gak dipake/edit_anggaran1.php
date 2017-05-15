<?php
	$no_anggaran = $_GET['id'];
	// connect database
	require_once('db_login.php');
	$db = new mysqli($db_host, $db_username, $db_password, $db_database);
	if ($db->connect_errno){
		die ("Could not connect to the database: <br />". $db->connect_error);
	}

	if (!isset($_GET["submit"])){
		$query = " SELECT * FROM labarugi WHERE no_anggaran=".$no_anggaran." ";
		// Execute the query
		$result = $db->query( $query );
		if (!$result){
			die ("Could not query the database: <br />". $db->error);
		}else{
			while ($row = $result->fetch_object()){ //semua data yg diselect itu dimasukin ke objek
				$anggaran = $row->anggaran;
			}
		}
	}else{
		$anggaran=test_input($_GET["anggaran"]);
		if($anggaran==''){
			$error_anggaran="Mohon Isi uang anggaran";
			$valid_anggaran=FALSE;
		}
		else{
			$valid_anggaran=TRUE;
		}

			//update data into database
				if ($valid_anggaran){
				//escape inputs data
				$anggaran = $db->real_escape_string($anggaran);
				//Asign a query
				$query = " UPDATE labarugi SET anggaran='".$anggaran."' WHERE no_anggaran=".$no_anggaran." ";
				// Execute the query
				$result = $db->query( $query );
				if (!$result){
				die ("Could not query the database: <br />". $db->error);
				}else{
					echo "<script>alert('Anggaran Sudah Diedit')</script><br /><br />";
					echo "<script>window.open('view_anggaran_admin.php','_self')</script>";
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
		<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">
    <title>Edit Laporan Anggaran Laba Rugi</title>
    <!-- Bootstrap Core CSS -->
    <link href="../vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
    <!-- MetisMenu CSS -->
    <link href="../vendor/metisMenu/metisMenu.min.css" rel="stylesheet">
    <!-- DataTables CSS -->
    <link href="../vendor/datatables-plugins/dataTables.bootstrap.css" rel="stylesheet">
    <!-- DataTables Responsive CSS -->
    <link href="../vendor/datatables-responsive/dataTables.responsive.css" rel="stylesheet">
    <!-- Custom CSS -->
    <link href="../dist/css/sb-admin-2.css" rel="stylesheet">
    <!-- Custom Fonts -->
    <link href="../vendor/font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css">
		<style>
			.error {color: #FF0000;}
		</style>
	</head>
	<body>
		<h2>Edit Anggaran</h2>
		<form method="GET" autocomplete="on" action="edit_anggaran.php">
			<table>
				<tr>
					<td valign="top"><input type="hidden" class="form-control" name="id" size="30" maxlength="50" placeholder="Anggaran(Uang)" autofocus value="<?php if(isset( $no_anggaran)) {echo $no_anggaran;}?>"></td>
				</tr>
				</tr>
					<td valign="top">Anggaran</td>
					<td valign="top">:</td>
					<td valign="top"><input type="text" class="form-control" name="anggaran" size="30" maxlength="50" placeholder="Anggaran(Uang)" autofocus value="<?php if(isset( $anggaran)) {echo $anggaran;}?>"></td>
					<td valign="top"><span class="error">* <?php if(isset($error_anggaran)) {echo $error_anggaran;}?></span></td>
				</tr>

				<tr>
					<td valign="top" colspan="3"><br><input type="submit" class="btn btn-default" name="submit" value="Edit">
				</tr>
				</table>
		</form>
	</body>
</html>

<?php
$db->close();
?>
