
<!DOCTYPE html>
<html lang="id">
	<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">

    <!-- Vertical menu CSS -->
    <link href="/KPKU/Template/vendor/menu-vertical/menu-vertical.css" rel="stylesheet" type="text/css" />

    <!-- Bootstrap Core CSS -->
    <link href="/KPKU/Template/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">

    <!-- Custom CSS -->
    <link href="/KPKU/Template/dist/css/sb-admin-2.css" rel="stylesheet">

		<!-- DataTables CSS -->
		<link href="/KPKU/Template/vendor/datatables-plugins/dataTables.bootstrap.css" rel="stylesheet">

		<!-- DataTables Responsive CSS -->
		<link href="/KPKU/Template/vendor/datatables-responsive/dataTables.responsive.css" rel="stylesheet">

    <!-- Morris Charts CSS -->
		<link href="/KPKU/Template/vendor/morrisjs/morris.css" rel="stylesheet">

    <!-- Custom Fonts -->
    <link href="/KPKU/Template/vendor/font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css">

    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
        <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->
</head>
<body style="background-color:#FFF">

      <!-- Header -->
      <div style="height:50px;width:100%; padding:10px 20px 5px 20px; text-align:right; background:#0059B2; color:#cce6ff;">
				<button style="padding:0px;margin:0px;float:left" type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
						<span class="sr-only">Toggle navigation</span>
						<span style="font-size:150%"class="fa fa-align-justify"></span>
						<!-- <span class="icon-bar"></span>
						<span class="icon-bar"></span> -->
				</button>
        <a style="color:#cce6ff;text-decoration:none" href="/KPKU/logout.php"><i class="fa fa-sign-out fa fw"></i> Keluar</a>
      </div>
			<div style=" margin:0px 30px 10px 30px;border-bottom: 2px  solid #ddd;">
				<div style="text-align:right">
					<img style="float:left; margin-top:50px; width:30%; " src="/KPKU/logo.png">
					<img style="width:55%"src="/KPKU/header.png">
				</div>
			</div>
      <!-- clode header -->
      <!-- Navigator -->
      <div class="sidebar-nav navbar-collapse" style="padding:0px;z-index:1">
          <ul style="margin:0;" id="menu-v">
              <li style="padding:2px 0px 2px 0px"><a href="#">HRGA
                <span style="float:right; margin-top:7px"class="fa fa-chevron-right"></a>
              </li>
              <li style="padding:2px 0px 2px 0px" ><a href="/Laporan/Operational/index.php">Operasional
                <span style="float:right; margin-top:7px"class="fa fa-chevron-right"></a>
                <ul>
                  <li><a href="/KPKU/Operasional/MA/index.php">MA</a></li>
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
                        <li><a href="/KPKU/Finance/AdminFinance/view_anggaran_admin.php">Laporan</a></li>
                        <li><a href="/KPKU/Finance/AdminFInance/view_grafik_anggaran.php">Dashboard</a></li>
                      </ul>
                    </li>
										<li><a href="#">Tambah Tahun</a>
                    </li>
                  </ul>
              </li>
          </ul>
					<!-- <div style="min-height:124px">
						<h3 style="text-align:center;margin:0">SELAMAT DATANG</h3>
					</div> -->
      </div>
      <!-- close Navigator  -->

    <!-- jQuery -->
    <script src="/KPKU/Template/vendor/jquery/jquery.min.js"></script>
    <!-- Bootstrap Core JavaScript -->
		<script src="/KPKU/Template/vendor/bootstrap/js/bootstrap.min.js"></script>
    <!-- Vertical menu JavaScript -->
		<script src="/KPKU/Template/vendor/menu-vertical/menu-vertical.js" type="text/javascript"></script>
    <!-- Metis Menu Plugin JavaScript -->
    <!-- <script src="../vendor/metisMenu/metisMenu.min.js"></script> -->
    <!-- Morris Charts JavaScript -->
		<script src="/KPKU/Template/vendor/raphael/raphael.min.js"></script>
    <!-- <script src="../../vendor/morrisjs/morris.min.js"></script> -->
    <!-- <script src="../../data/morris-data.js"></script> -->
    <!-- Custom Theme JavaScript -->
    <script src="/KPKU/Template/dist/js/sb-admin-2.js"></script>
  </body>
</html>
