<!DOCTYPE html>
<html lang="en">
	<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">
		<link rel="icon" type="image/ico?" href="/KPKU/logo.ico">
    <title>PT. JASAMARGA CABANG SEMARANG</title>

    <!-- Bootstrap Core CSS -->
    <link href="Utility/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">

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
	<body style="padding:0px">
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
                <div style="margin-top:10px" class="login-panel panel panel-default">
                    <div class="panel-heading">
                        <h2 align="center" class="panel-title">Masukkan NPP untuk meminta<br/> reset password</h2>
                    </div>
                    <div class="panel-body">
											<!-- <label>Untuk meminta reset password masukkan NPP anda</label> -->
                        <form role="form" method="post" action="lupa_password.php">
                            <fieldset>
                                <div class="form-group">
                                  <!-- <label>NPP :</label> -->
																	<input class="form-control" placeholder="NPP" name="npp" type="text" autofocus required>
                                </div>
                                <!-- Change this to a button or input when using this as a form -->
																<button type="submit" name="submit" class="btn btn-lg btn-success btn-block">Minta Reset Password</button>
																<a class="btn btn-danger btn-block" href="index.php">Batal</a>
                                <!-- <a href="login.php" class="btn btn-lg btn-success btn-block">Login</a> -->
                            </fieldset>
                        </form>
												<?php
													require_once('config.php');
													//inisiasi database
													$db = new mysqli($db_host, $db_username, $db_password, $db_database);
													if ($db->connect_errno){
														die ("Tidak dapat terkoneksi dengan database: <br/>".
														$db->connect_error);
													}
													//kondisi jika submit terdapat isi
													if(isset($_POST['submit'])){
														//menentukan nilai variabel dari inputan
														$npp = $_POST['npp'];

														if(!preg_match("/^[0-9]*$/",$npp)) {
															echo '<script>alert("NPP Tidak Valid: Hanya angka tanpa spasi yang diperbolehkan")</script><br /><br />';
															echo '<script> window.open ("lupa_password.php","_self")
															</script>';
																$valid_npp=FALSE;
														}elseif(strlen($npp)>5){
															echo '<script> alert("NPP terlalu panjang ")</script><br /><br />';
															echo '<script> window.open ("lupa_password.php","_self") </script>';
															$valid_npp=FALSE;
														}elseif(strlen($npp)<5 ){
															echo '<script>alert("NPP terlalu pendek ")</script><br /><br />';
															echo '<script> window.open ("lupa_password.php","_self") </script>';
															$valid_npp=FALSE;
														}elseif ($jumlahnpp != 0){
															echo '<script>alert("NPP sudah digunakan ")</script><br /><br />';
															echo '<script> window.open ("lupa_password.php","_self") </script>';
															$valid_npp=FALSE;
														}else{
															$valid_npp=TRUE;
														}
														//query untuk mengubah nilai request menjadi 1 berdasarkan
														if ($valid_npp==TRUE){
															$query = "UPDATE petugas SET request=1 WHERE npp='$npp' ";
															$result = $db->query( $query );
														//kondisi query tidak benar
															if (!$result){
																die ("Could not query the database: <br />". $db->error);
															}else{
																echo '<script> alert("Permintaan perubahan password telah	dikirim.")</script><br /><br />';
																echo '<script>window.open("index.php","_self")</script>';
															}
														}
													}

												?>
                    </div>
                </div>
            </div>
        </div>
    </div>
		<!-- footer -->
		<!-- <div style="text-align:right; font-size:80%; height:40px; background:#0059B2; color:#cce6ff; position:fixed; bottom:0px; width:100%; padding:5px 20px; margin:20px 0px" >
			Copyright Informatika Undip 2017
		</div> -->
		<!-- close footer -->
    <!-- jQuery -->
    <script src="Utility/vendor/jquery/jquery.min.js"></script>
    <!-- Bootstrap Core JavaScript -->
    <script src="Utility/vendor/bootstrap/js/bootstrap.min.js"></script>
    <!-- Metis Menu Plugin JavaScript -->
    <script src="Utility/vendor/metisMenu/metisMenu.min.js"></script>
    <!-- Custom Theme JavaScript -->
    <script src="Utility/dist/js/sb-admin-2.js"></script>

	</body>
</html>
