<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">

    <!-- Bootstrap Core CSS -->
    <link href="/KPKU/Template/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">

    <!-- MetisMenu CSS -->
    <link href="/KPKU/Template/vendor/metisMenu/metisMenu.min.css" rel="stylesheet">

    <!-- Custom CSS -->
    <link href="/KPKU/Template/dist/css/sb-admin-2.css" rel="stylesheet">

    <!-- DataTables CSS -->
    <link href="/KPKU/Template/vendor/datatables-plugins/dataTables.bootstrap.css" rel="stylesheet">

    <!-- DataTables Responsive CSS -->
    <link href="/KPKU/Template/vendor/datatables-responsive/dataTables.responsive.css" rel="stylesheet">

    <!-- Custom Fonts -->
    <link href="/KPKU/Template/vendor/font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css">

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
          <a style="float:right;z-index:1; margin: 10px 15px; color:#cce6ff;text-decoration:none" href="/KPKU/logout.php"><i class="fa fa-sign-out fa fw"></i> Keluar</a>
            <div class="navbar-header">
                <button style="float:left; margin:10px 15px" type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
            </div>
            <!-- /.navbar-header -->
        </nav>
        <!-- /.navbar-static-side -->
        <!-- header image -->
        <div style=" margin:0px 30px 10px 30px;border-bottom: 2px  solid #ddd;">
  				<div style="text-align:right">
  					<img style="float:left; margin-top:50px; width:30%; " src="/KPKU/logo.png">
  					<img style="width:55%"src="/KPKU/header.png">
  				</div>
  			</div>
        <!--/. header image -->
        <div style="margin:0" class="navbar-default sidebar" role="navigation">
          <div class="sidebar-nav navbar-collapse">
            <ul class="nav" id="side-menu">
			<li>
                <a><i class="fa fa-dashboard fa-fw"></i> HRGA</a>
              </li>
              <li>
                <a><i class="fa fa-bar-chart-o fa-fw"></i> Operasional<span class="fa arrow"></span></a>
                <ul class="nav nav-second-level">
                  <li>
                    <a href="/KPKU/Operasional/MA/view_inspeksi_dgm_fn.php">MA</a>
                  </li>
                  <li>
                    <a>ME</a>
                  </li>
                  <li>
                    <a>TM</a>
                  </li>
                  <li>
                    <a>TC</a>
                  </li>
                </ul>
                <!-- end -second-level -->
              </li>
              <li>
                <a href="#"><i class="fa fa-usd fa-fw"></i> Finance<span class="fa arrow"></span></a>
                <ul class="nav nav-second-level">
                  <li>
                    <a href="#">Laba Rugi <span class="fa arrow"></span></a>
                    <ul class="nav nav-third-level">
                      <li>
                        <a href="/kpku/finance/dgmfinance/view_grafik_anggaran.php">Dashboard</a>
                      </li>
                      <li>
                        <a href="/kpku/finance/dgmfinance/view_anggaran_DGM.php">Laporan</a>
                      </li>
                    </ul>
                    <!-- /.nav-third-level -->
                  </li>
                </ul>
                <!-- /.nav-second-level -->
              </li>
            </ul>
          </div>
        <!-- /.sidebar-collapse -->
        </div>
        <!-- close navbar devault toolbar -->


    <!-- jQuery -->
    <script src="/KPKU/Template/vendor/jquery/jquery.min.js"></script>

    <!-- Bootstrap Core JavaScript -->
    <script src="/KPKU/Template/vendor/bootstrap/js/bootstrap.min.js"></script>

    <!-- Metis Menu Plugin JavaScript -->
    <script src="/KPKU/Template/vendor/metisMenu/metisMenu.min.js"></script>

    <!-- Morris Charts JavaScript -->
    <!-- <script src="../vendor/raphael/raphael.min.js"></script>
    <script src="../vendor/morrisjs/morris.min.js"></script>
    <script src="../data/morris-data.js"></script> -->

    <!-- Custom Theme JavaScript -->
    <script src="/KPKU/Template/dist/js/sb-admin-2.js"></script>

</body>

</html>
