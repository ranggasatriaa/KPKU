<?php
session_start();
error_reporting(0);
if (!isset($_SESSION['level'])){
	header('location:../../index.php');
	exit;
}elseif (isset($_SESSION['level'])){
	include('../../config.php');
?>

<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>SB Admin 2 - Bootstrap Admin Theme</title>
    <!-- Vertical menu CSS -->
    <link href="../../vendor/menu-vertical/menu-vertical.css" rel="stylesheet" type="text/css" />

    <!-- Bootstrap Core CSS -->
    <link href="../../vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">

    <!-- MetisMenu CSS -->
    <!-- <link href="../vendor/metisMenu/metisMenu.min.css" rel="stylesheet"> -->

    <!-- Custom CSS -->
    <link href="../../dist/css/sb-admin-2.css" rel="stylesheet">

    <!-- Morris Charts CSS -->
    <link href="../../vendor/morrisjs/morris.css" rel="stylesheet">

    <!-- Custom Fonts -->
    <link href="../../vendor/font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css">

    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
        <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->

</head>

<body style="background-color:#FFF">

    <div id="wrapper">
      <!-- Header -->
      <div style="width:100%; padding:10px 20px 5px 20px; text-align:right; background:#0059B2; color:#cce6ff;">
        Keluar
      </div>
			<div style=" margin:0px 30px 10px 30px;border-bottom: 2px  solid #ddd;">
				<div style="text-align:right">
					<img style="float:left; margin-top:50px; width:30%; " src="../../logo.png">
					<img style="width:55%"src="../../header.png">
				</div>
			</div>
      <!-- clode header -->
      <!-- Navigator -->
      <div style="float:left; height:100%">
          <ul id="menu-v">
              <li style="padding:2px 0px 2px 0px"><a href="#">HRGA
                  <span style="float:right; margin-top:7px"class="fa fa-chevron-right"></a>
              </li>
              <li style="padding:2px 0px 2px 0px" ><a href="../Operational/index.php">Operasional
                  <span style="float:right; margin-top:7px"class="fa fa-chevron-right"></a>
                <ul>
                  <li><a href="vertical-menu#1">MA</a></li>
                  <li><a href="vertical-menu#2">ME</a></li>
                  <li><a href="vertical-menu#2">TM</a></li>
                  <li><a href="vertical-menu#2">TE</a></li>
                </ul>
              </li>
              <li style="padding:2px 0px 2px 0px"><a href="#">Finance
                <span style="float:right; margin-top:7px"class="fa fa-chevron-right"></a>
                  <ul >
                      <li><a href="#">Laba-Rugi <span style="float:right; margin-top:9px"class="fa fa-chevron-right"></a>
                          <ul class="sub">
                              <li><a href="#521">Laporan</a></li>
                              <li><a href="#522">Dashboard</a></li>
                          </ul>
                      </li>
                  </ul>
              </li>
          </ul>
      </div>
      <!-- close Navigator  -->
      <!-- Main -->
      <div style="position: inherit; margin: 0 0 0 195px; padding: 0 30px; border-left: 2px solid #e7e7e7; padding: 0 15px; min-height: 568px; background-color: white;">
        <div class="col-lg-12">
					<?php
						require_once('../../config.php');
						$db = new msql($db_host, $db_username, $db_password, $db_database);
						if ($db->connect_errno){
							die ("Could not connect to the database: <br />". $db->connect_error);
						}

						$query = "SELECT MAX(idinspeksi) as id FROM inspeksi;";
						$result = $db->query($query);
						if (!$result){
							die ('error running query ['.$db->error.']');
						}else{
							$date = date("Ymd");
							// ADD +1 with last usique ID
							$row = $result->fetch_accoc();
							$last_idtrx = empty($row['id'])?$date."00000":$row['id'];
							$no_pinjam = substr($row['id'],-5);
							$next_idtrx = $last_idtrx+1;
							$unique = substr($next_idtrx, -5);
							$idinspeksi = $date.$unique;
							$date = strval($date);
							echo "ID inspeksi: ";
							echo $idinspeksi;
							echo '</br>';
							echo $last_idtrx;
							echo '</br>';
							echo $row['id'];
							echo '</br>';
							// echo $row->id;
						}
					?>
					<a style="margin-bottom:10px" class="btn btn-primary btn-block btn-lg" href="add_jembatan.php <?php echo '?id='.$idinspeksi;?>">JEMBATAN</a>
					<a style="margin-bottom:10px" class="btn btn-primary btn-block btn-lg" href="add_jalan.php <?php echo '?id='.$idinspeksi;?>">JALAN</a>
					<a style="margin-bottom:10px" class="btn btn-primary btn-block btn-lg" href="pil_pju.php <?php echo '?id='.$idinspeksi;?>">PJU</a>
					<a style="margin-bottom:10px" class="btn btn-primary btn-block btn-lg" href="pil_lain.php <?php echo '?id='.$idinspeksi;?>">LAIN-LAIN</a>
					<a style="margin-bottom:10px" class="btn btn-outline btn-primary " href="pil_lain.php <?php echo '?id='.$idinspeksi;?>">LAIN-LAIN</a>

        </div>
      </div>
      <!-- close Main -->

      <!-- footer -->
      <div style="width:100%; margin-bottom:20px; padding:5px 20px 10px 20px; background:#0059B2; color:#cce6ff; text-align:right; font-size:80%">
        Copyright Informatika Undip 2017
      </div>
      <!-- close footer -->

    </div>
    <!-- /#wrapper -->

    <!-- jQuery -->
    <script src="../../vendor/jquery/jquery.min.js"></script>
    <!-- Bootstrap Core JavaScript -->
    <script src="../../vendor/bootstrap/js/bootstrap.min.js"></script>
    <!-- Vertical menu JavaScript -->
    <script src="../../vendor/menu-vertical/menu-vertical.js" type="text/javascript"></script>
    <!-- Metis Menu Plugin JavaScript -->
    <!-- <script src="../vendor/metisMenu/metisMenu.min.js"></script> -->
    <!-- Morris Charts JavaScript -->
    <script src="../../vendor/raphael/raphael.min.js"></script>
    <!-- <script src="../../vendor/morrisjs/morris.min.js"></script> -->
    <!-- <script src="../../data/morris-data.js"></script> -->
    <!-- Custom Theme JavaScript -->
    <script src="../../dist/js/sb-admin-2.js"></script>

  </body>
</html>

<?php
//tutup kurung sesion
}
?>
