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
			//menentukan nilai variabel dari inputan
			$id = $_GET['id'];
			//menentukan password default
			$password = md5('123456');
			//inisiasi database
			$db = new mysqli($db_host, $db_username, $db_password, $db_database);
			if($db->connect_errno){
				die('Could not connect to database = '.$db->connect_error);
			}
			//query untuk mengupdate data user pada petugas
			$query = " UPDATE petugas SET password='$password', request=0 WHERE npp='".$id."' ";
			$result = $db->query($query);
			if(!$result){
				die("Could not query the database: <br />". $db->error);
			}else{
				echo '<script>window.alert("Passoword Telah di Reset. Segera hubungi user bersangkutan untuk mengubah passwordnya.");
				window.location="index.php"</script>';
		  mysqli_close($con);
		  exit;
				$db->close();
				exit;
			}
	?>
