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
?>
<!DOCTYPE HTML>
<html>
	<head>
		<title>Konfirmasi Password</title>
		<style>
			.error {color: #FF0000;}
		</style>
	</head>
	<body>
		<div id="wrapper">
			<div id="page-wrapper">
				<div class="row">
					<div class="col-lg-12">
						<h2>Silahkan masukkan password</h2>
						<form method="POST" autocomplete="on" action="confirm.php">
							<table>
								<tr>
									<td><input type="password" class="form-control" name="password" size="30" maxlength="12" placeholder="Masukkan Password" autofocus required></td>
								</tr>
								<tr>
									<td><br><input type="submit" class="btn btn-default" name="submit" value="Konfirmasi"></td>
								</tr>
							</table>
						</form>
						<?php
							require_once('../config.php');
							$db = new mysqli($db_host, $db_username, $db_password, $db_database);
							if ($db->connect_errno){
								die ("Tidak dapat terkoneksi dengan database: <br />". $db->connect_error);
							}

							if(isset($_POST['submit'])){
								$password=$_POST['password'];

								//Asign a query
								$query = "SELECT * FROM petugas where level='admin'";
								// Execute the query
								$result = $db->query( $query );
								if (!$result){
									die ("Could not query the database: <br />". $db->error);
								}
								else{
									while ($row = $result->fetch_object()){ //semua data yg diselect itu dimasukin ke objek
										$password1 = $row->password;
									}
									if($password==$password1){
										echo "<script>window.open('profile_settings.php','_self')</script>";
									}
									else{
										echo "<script>alert('Password Salah')</script><br /><br />";
										echo "<script>window.open('confirm.php','_self')</script>";
									}
								}
							}
						?>
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
