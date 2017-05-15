<?php	
	session_start();
	error_reporting(0);
	if (!isset($_SESSION['level'])){
	header('location:../index.php');
	exit;
	}elseif($_SESSION['level']!="admin"){
		if($_SESSION['level']=="gm"){
			header('location:../GM/index.php');
		}
		elseif($_SESSION['level']=="dgm_hrga"){
			header('location:../HRGA/index.php');
		}
		elseif($_SESSION['level']=="ptg_hrga"){
			header('location:../HRGA/index.php');
		}
		elseif($_SESSION['level']=="dgm_op"){
			header('location:../Operasional/MA/index.php');
		}
		elseif($_SESSION['level']=="ptg_op" ){
			header('location:../Operasional/MA/index.php');
		}
		elseif($_SESSION['level']=="dgm_fn"){
			header('location:../Finance/DGMFinance/index.php');
		}
		elseif($_SESSION['level']=="ptg_fn"){
			header('location:../Finance/AdminFinance/index.php');
		}
	}
	elseif (isset($_SESSION['level'])){
		include('header_adm.php');
	}
	$idpetugas = $_GET['id'];
	require_once('../config.php');
	$db = new mysqli($db_host, $db_username, $db_password, $db_database);
		if ($db->connect_errno){
			die ("Tidak dapat terkoneksi dengan database: <br/>". $db->connect_error);
		}
		
	if (!isset($_GET["submit"])){

		//$nama=$_POST['nama'];
		//$nip=$_POST['nip'];
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
		$nip = test_input($_GET["nip"]);
			if ($nip == ''){
				$error_nip = "Mohon Masukkan NIP User";
				$valid_nip = FALSE;
			}else{
				$valid_nip = TRUE;
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
	if ($valid_nama && $valid_nip && $valid_password && $valid_level){
		//escape inputs data
		$nama = $db->real_escape_string($nama);
		$nip = $db->real_escape_string($nip);
		$password = $db->real_escape_string($password);
		$level = $db->real_escape_string($level);
		//Asign a query
		$query = " UPDATE petugas SET nama='".$nama."', nip='".$nip."', password='".$password."' ,level='".$level."' WHERE idpetugas=".$idpetugas." ";
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