<!DOCTYPE html>
<html>
<head>
	<title></title>
</head>
<body>
	<?php
		require_once('db_login.php');
		$no_anggaran = $_GET['id'];

		$db = new mysqli($db_host, $db_username, $db_password, $db_database);
		if($db->connect_errno){
			die('Could not connect to database = '.$db->connect_error);
		}

		$query = " UPDATE labarugi SET anggaran='0' WHERE no_anggaran=".$no_anggaran." ";
		$result = $db->query($query);
				if(!$result){
					die("Could not query the database: <br />". $db->error);
				}else{
        echo '<script>window.alert("Data has been deleted");window.location="view_anggaran_admin.php"</script>';
        mysqli_close($con);
        exit;
					$db->close();
					exit;
				}
	?>
</body>
</html>
