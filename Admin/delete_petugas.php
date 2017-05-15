	<?php
		session_start();
		error_reporting(0);
		if (!isset($_SESSION['level'])){
			header('location:/kpku/index.php');
			exit;
		}elseif($_SESSION['level']!="admin"){
			header('location:/kpku/unauthorized.php');
		}else{
			include('../header.php');
		}
		
		require_once('../config.php');
		$idpetugas = $_GET['id'];

		$db = new mysqli($db_host, $db_username, $db_password, $db_database);
		if($db->connect_errno){
			die('Could not connect to database = '.$db->connect_error);
		}

		$query = 'DELETE FROM petugas WHERE idpetugas="'.$idpetugas.'"';
		$result = $db->query($query);
				if(!$result){
					die("Could not query the database: <br />". $db->error);
				}else{
        echo '<script>window.alert("Petugas Sudah Dihapus");window.location="index.php"</script>';
        mysqli_close($con);
        exit;
					$db->close();
					exit;
				}
	?>
