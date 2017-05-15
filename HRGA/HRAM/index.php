<?php
session_start();
error_reporting(0);
if (!isset($_SESSION['level'])){
	header('location:/kpku/index.php');
	exit;
}elseif($_SESSION['level']!="ptg_hrga" && $_SESSION['level']!="dgm_hrga"){
	header('location:/kpku/unauthorized.php');
}else{
	include('../../header.php');
}
?>

<!DOCTYPE html>
<html >
	<head>
		<title>HRGA</title>
	</head>
	<body>
		<div id="wrapper">
			<div id="page-wrapper">
				<div class="row">
				  <div class="col-lg-12">
						SELAMAT DATANG
					</div>
					<!-- close col -->
				</div>
				<!-- /. row -->
			</div>
			<!-- close page-wrapper -->
		</div>
		<!-- /#wrapper -->
    <!-- footer -->
		<div style="text-align:right; font-size:80%; height:40px; background:#0059B2; color:#cce6ff; position:relative; bottom:0px; width:100%; padding:5px 20px; margin:20px 0px" >
			Copyright Informatika Undip 2017
		</div>
    <!-- close footer -->
  </body>
</html>
