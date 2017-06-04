Utility<?php
session_start();
error_reporting(0);
if (isset($_SESSION['level']))
{
	header('location:/kpku/sudah_login.php');
}

require_once 'config.php';
// Membaca inputan
  $npp = $_POST['npp'];
  $password = md5($_POST['password']);

// query untuk mendapatkan record dari tabel petugas
$db = mysqli_connect ($db_host, $db_username, $db_password, $db_database) or
die("Maaf Anda gagal koneksi.!");
$query = "SELECT * FROM petugas WHERE npp = '$npp'";
$result = mysqli_query($db,$query);
$data = mysqli_fetch_array($result);

// cek kesesuaian inputan dan database
if ($password == $data['password'])
{
    // menyimpan data petugas yg masuk ke dalam session
    $_SESSION['level'] = $data['level'];
    $_SESSION['npp'] = $data['npp'];
    $_SESSION['nama'] = $data['nama'];
		$_SESSION['request'] = $data['request'];
    if ($_SESSION['level']=='admin')    {
    	header('location: Admin/index.php');
    }elseif ($_SESSION['level']=='gm') {
      header('location: GM/index.php');
    }elseif ($_SESSION['level']=='dgm_hrga') {
      header('location: HRGA/index.php');
    }elseif ($_SESSION['level']=='dgm_op') {
      header('location: Operasional/index.php');
    }elseif ($_SESSION['level']=='dgm_fn') {
      header('location: Finance/DGMFinance/index.php');
    }elseif ($_SESSION['level']=='ptg_hrga') {
      header('location: HRGA/index.php');
    }elseif ($_SESSION['level']=='ptg_op') {
      header('location: Operasional/Maintenance/index.php');
    }elseif ($_SESSION['level']=='ptg_fn') {
      header('location: Finance/AdminFinance/index.php');
    }
}

?>
<html>
	<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">
		<link rel="icon" type="image/ico?" href="/KPKU/logo.ico">
    <title>LOGIN.php</title>

    <!-- Bootstrap Core CSS -->
    <link href="Utility/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
    <!-- MetisMenu CSS -->
    <link href="Utility/vendor/metisMenu/metisMenu.min.css" rel="stylesheet">
    <!-- Custom CSS Admin -->
    <link href="Utility/dist/css/sb-admin-2.css" rel="stylesheet">
    <!-- Custom CSS Table-->
    <link href="Utility/dist/css/3-col-portfolio.css" rel="stylesheet">
    <!-- Custom Fonts -->
    <link href="Utility/vendor/font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css">

    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
        <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->

  </head>
  <body>
		<!-- Navigation -->
  	<nav class="navbar navbar-default navbar-static-top" role="navigation" style="margin-bottom: 0">
      <div class="navbar-header"> </div>
        <!-- /.navbar-header -->
    </nav>
    <!-- /.navbar-static-side -->
		<!-- header image -->
		<div style=" margin:0px 30px 10px 30px;border-bottom: 2px  solid #ddd;">
			<div style="text-align:right">
				<img style="float:left; margin-top:50px; width:20%; " src="/KPKU/logo.png">
				<img style="width:45%"src="/KPKU/header.png">
			</div>
		</div>
		<!--/. header image -->
  <div class="container">
      <div class="row">
          <div class="col-md-4 col-md-offset-4">
              <div style="margin-top:20px" class="login-panel panel panel-default">
                  <div class="panel-heading">
                      <h2 align="center" class="panel-title">Gagal Login</h2>
                  </div>
                  <div class="panel-body">
                          <fieldset>
                              <div class="form-group">
                              <h3 align="center" >Kombinasi NPP dan Password tidak sesuai</h3>
                              <br/>
                              <a href="index.php" class="btn btn-lg btn-danger btn-block">Coba Lagi</a>
                          </fieldset>
                  </div>
              </div>
          </div>
      </div>
  </div>
	<!-- footer -->
	<div style="text-align:right; font-size:80%; height:40px; background:#0059B2; color:#cce6ff; position:fixed; bottom:0px; width:100%; padding:5px 20px; margin:20px 0px" >
		Copyright Informatika Undip 2017
	</div>
	<!-- close footer -->

  <!-- jQuery -->
  <script src="Utility/vendor/jquery/jquery.min.js"></script>
  <!-- Bootstrap Core JavaScript -->
  <script src="Utility/vendor/bootstrap/js/bootstrap.min.js"></script>
  <!-- Metis Menu Plugin JavaScript -->
  <script src="Utility/vendor/metisMenu/metisMenu.min.js"></script>
  <!-- Custom Theme JavaScript -->
  <script src="Template/dist/js/sb-admin-2.js"></script>

  </body>
</html>
