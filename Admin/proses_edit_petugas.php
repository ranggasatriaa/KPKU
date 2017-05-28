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
	elseif (isset($_SESSION['level'])){
		include('header_adm.php');
	}
	$npp = $_GET['id'];
	require_once('../config.php');
	$db = new mysqli($db_host, $db_username, $db_password, $db_database);
		if ($db->connect_errno){
			die ("Tidak dapat terkoneksi dengan database: <br/>". $db->connect_error);
		}

	if (!isset($_GET["submit"])){

		//$nama=$_POST['nama'];
		//$npp=$_POST['npp'];
		$password=$_GET['password'];
		//$level=$_POST['level'];
		$confirmpassword=$_GET['confirmpassword'];
		$panjang=strlen($password);
		$nama = test_input($_GET["nama"]);
			if ($nama == ''){
				$error_nama = "Mohon Masukkan Nama User";
				$valid_nama = FALSE;
			}else{
				$valid_nama = TRUE;
			}
		$npp = test_input($_GET["npp"]);
			if ($npp == ''){
				$error_npp = "Mohon Masukkan NPP User";
				$valid_npp = FALSE;
			}else{
				$valid_npp = TRUE;
			}
		$password=test_input($_GET["password"]);
			if($password==''){
				$error_password="Mohon isi password user";
				$valid_password=FALSE;
			}
			else if($panjang<6){
				$error_password="Password Teralu Pendek";
				$valid_password=FALSE;
			}
			else if($confirmpassword!=$password){
				$error_password="Password dan Konfirmasi Password Harus Sama";
				$valid_password=FALSE;
			}
			else{
				$valid_password=TRUE;
			}
		$level = $_GET["level"];
		if ($level == '' || $level == 'none'){
			$error_level = "Masukkan Jabatan User";
			$valid_level = FALSE;
		}else{
			$valid_level = TRUE;
		}

	//update data into database
	if ($valid_nama && $valid_npp && $valid_password && $valid_level){
		//escape inputs data
		$nama = $db->real_escape_string($nama);
		$npp = $db->real_escape_string($npp);
		$password = $db->real_escape_string($password);
		$level = $db->real_escape_string($level);
		//Asign a query
		$query = " UPDATE petugas SET nama='".$nama."', npp='".$npp."', password='".$password."' ,level='".$level."' WHERE idpetugas=".$idpetugas." ";
		// Execute the query
		$result = $db->query($query);
		if (!$result){
		   die ("Could not query the database2: <br />". $db->error);
		}else{
			//echo "<script>alert('User Sudah Diedit')</script><br /><br />";
			//echo "<script>window.open('index.php','_self')</script>";
			echo 'sukses';
			$db->close();
			exit;
		}
	}
	else("ERROOOORRRR!!!");
}
function test_input($data) {
   $data = trim($data);
   $data = stripslashes($data);
   $data = htmlspecialchars($data);
   return $data;
}
?>
