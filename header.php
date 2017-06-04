<?php
session_start();
error_reporting(0);
if (!isset($_SESSION['level'])){
	header('location:/KPKU/index.php');
	exit;
}
?>

<!DOCTYPE html>
<html lang="en">
	<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">
		<link rel="icon" type="image/ico?" href="/KPKU/logo.ico">
    <!-- Bootstrap Core CSS -->
    <link href="/KPKU/Utility/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">

    <!-- MetisMenu CSS -->
    <link href="/KPKU/Utility/vendor/metisMenu/metisMenu.min.css" rel="stylesheet">

    <!-- Custom CSS -->
    <link href="/KPKU/Utility/dist/css/sb-admin-2.css" rel="stylesheet">

    <!-- DataTables CSS -->
    <link href="/KPKU/Utility/vendor/datatables-plugins/dataTables.bootstrap.css" rel="stylesheet">

    <!-- DataTables Responsive CSS -->
    <link href="/KPKU/Utility/vendor/datatables-responsive/dataTables.responsive.css" rel="stylesheet">

    <!-- Custom Fonts -->
    <link href="/KPKU/Utility/vendor/font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css">

    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
        <script src="https://oss.index_luarxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->

	</head>
		<body>
	    <!-- Navigation -->
	  	<nav class="navbar navbar-default navbar-static-top" role="navigation" style="margin-bottom: 0">
			<a style="float:right; z-index:1; margin: 10px 15px; color:#cce6ff;text-decoration:none" href="/KPKU/logout.php"><i class="fa fa-sign-out fa fw"></i> Keluar</a>
			<?php
				if($_SESSION['level']!='admin'){
					echo '<a style="float:right;z-index:1; margin: 10px 15px; color:#cce6ff;text-decoration:none" href="/KPKU/Admin/ubah_password.php?id='.$_SESSION['npp'].'"><i class="fa fa-user fa fw"></i> Ubah Password</a>';
				}
			?>
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
					<img style="float:left; margin-top:50px; margin-left:20px; width:25%; " src="/KPKU/logo.png">
					<img style="width:50%"src="/KPKU/header.png">
				</div>
			</div>
	    <!--/. header image -->

<!-- Menu Admin			 -->
        <?php if($_SESSION['level']=="admin"){ ?>
          <div style="margin:0" class="navbar-default sidebar" role="navigation">
            <div class="sidebar-nav navbar-collapse">
              <ul class="nav" id="side-menu">
                <li>
                  <a href="/KPKU/Admin/index.php"><i class="fa fa-bank fa-fw"></i> Kelola User</a>
                </li>
                <li>
                  <a href="/KPKU/Admin/confirm.php"><i class="fa fa-wrench fa-fw"></i>Ubah Profil Admin<span></span></a>
                </li>
              </ul>
            </div> <!-- /.sidebar-collapse -->
          </div>  <!-- close navbar devault toolbar -->

<!-- Menu GM					 -->
        <?php }elseif ($_SESSION['level']=="gm") { ?>
          <div style="margin:0" class="navbar-default sidebar" role="navigation">
            <div class="sidebar-nav navbar-collapse">
              <ul class="nav" id="side-menu">
                <li>
									<a href="/KPKU/GM/hrga.php"><i class="fa fa-bank fa-fw"></i> HRGA <span class="fa arrow"></span> </a>
									<ul class="nav nav-second-level">
                    <li> <a href="/KPKU/HRGA/HRAM/index.php">HRAM</a> </li>
                    <li> <a href="/KPKU/HRGA/HRAM/index.php">Logistic</a> </li>
										<li> <a href="/KPKU/HRGA/HRAM/index.php">CDM</a> </li>
                  </ul>
								</li>
                <li>
                  <a href="#"><i class="fa fa-wrench"></i> Operasional<span class="fa arrow"></span></a>
                  <ul class="nav nav-second-level">
                    <li> <a href="/KPKU/Operasional/Maintenance/index_luar.php">Maintenance</a> </li>
                    <li> <a href="/KPKU/Operasional/TM/index.php">TM</a> </li>
                    <li> <a href="/KPKU/Operasional/TCM/index.php">TCM</a> </li>
                  </ul>
                  <!-- end -second-level -->
                </li>
                <li>
                  <a href="#"><i class="fa fa-dollar"></i> Finance<span class="fa arrow"></span></a>
                  <ul class="nav nav-second-level">
                    <li> <a href="#">Laba Rugi <span class="fa arrow"></span></a>
                      <ul class="nav nav-third-level">
                        <li> <a href="/KPKU/GM/view_grafik_anggaran.php">Dashboard</a> </li>
                        <li> <a href="/KPKU/GM/view_anggaran_GM.php">Laporan</a> </li>
                      </ul><!-- /.nav-third-level -->
                    </li>
                  </ul><!-- /.nav-second-level -->
                </li>
              </ul>
            </div><!-- /.sidebar-collapse -->
          </div>  <!-- close navbar devault toolbar -->

<!-- Menu DGM HRGA -->
        <?php }elseif ($_SESSION['level']=="dgm_hrga") { ?>
          <div style="margin:0" class="navbar-default sidebar" role="navigation">
            <div class="sidebar-nav navbar-collapse">
              <ul class="nav" id="side-menu">
								<li>
									<a href="/KPKU/GM/hrga.php"><i class="fa fa-bank fa-fw"></i> HRGA <span class="fa arrow"></span> </a>
									<ul class="nav nav-second-level">
										<li> <a href="/KPKU/HRGA/HRAM/index.php">HRAM</a> </li>
										<li> <a href="/KPKU/HRGA/HRAM/index.php">Logistic</a> </li>
										<li> <a href="/KPKU/HRGA/HRAM/index.php">CDM</a> </li>
									</ul>
								</li>
                <li>
                  <a href="#"><i class="fa fa-wrench"></i> Operasional<span class="fa arrow"></span></a>
                  <ul class="nav nav-second-level">
										<li> <a href="/KPKU/Operasional/Maintenance/index_luar.php">Maintenance</a> </li>
                    <li> <a href="/KPKU/Operasional/TM/index.php">TM</a> </li>
                    <li> <a href="/KPKU/Operasional/TCM/index.php">TCM</a> </li>
                  </ul><!-- end -second-level -->
                </li>
                <li>
                  <a href="#"><i class="fa fa-dollar"></i> Finance<span class="fa arrow"></span></a>
                  <ul class="nav nav-second-level">
                    <li> <a href="#">Laba Rugi <span class="fa arrow"></span></a>
                      <ul class="nav nav-third-level">
                        <li> <a href="/KPKU/GM/view_grafik_anggaran.php">Dashboard</a> </li>
                        <li> <a href="/KPKU/GM/view_anggaran_GM.php">Laporan</a> </li>
                      </ul><!-- /.nav-third-level -->
                    </li>
                  </ul><!-- /.nav-second-level -->
                </li>
              </ul>
            </div><!-- /.sidebar-collapse -->
          </div>  <!-- close navbar devault toolbar -->

<!-- Menu PETUGAS HRGA -->
        <?php }elseif ($_SESSION['level']=="ptg_hrga") { ?>
          <div style="margin:0" class="navbar-default sidebar" role="navigation">
            <div class="sidebar-nav navbar-collapse">
              <ul class="nav" id="side-menu">
								<li>
									<a href="/KPKU/GM/hrga.php"><i class="fa fa-bank fa-fw"></i> HRGA <span class="fa arrow"></span> </a>
									<ul class="nav nav-second-level">
										<li> <a href="/KPKU/HRGA/HRAM/index.php">HRAM</a> </li>
										<li> <a href="/KPKU/HRGA/HRAM/index.php">Logistic</a> </li>
										<li> <a href="/KPKU/HRGA/HRAM/index.php">CDM</a> </li>
									</ul>
								</li>
                <li>
                  <a href="#"><i class="fa fa-wrench"></i> Operasional<span class="fa arrow"></span></a>
                  <ul class="nav nav-second-level">
										<li> <a href="/KPKU/Operasional/Maintenance/index_luar.php">Maintenance</a> </li>
                    <li> <a href="/KPKU/Operasional/TM/index.php">TM</a> </li>
                    <li> <a href="/KPKU/Operasional/TCM/index.php">TCM</a> </li>
                  </ul>
                  <!-- end -second-level -->
                </li>
                <li>
                  <a href="#"><i class="fa fa-dollar"></i> Finance<span class="fa arrow"></span></a>
                  <ul class="nav nav-second-level">
                    <li> <a href="#">Laba Rugi <span class="fa arrow"></span></a>
                      <ul class="nav nav-third-level">
                        <li> <a href="/KPKU/GM/view_grafik_anggaran.php">Dashboard</a> </li>
                        <li> <a href="/KPKU/GM/view_anggaran_GM.php">Laporan</a> </li>
                      </ul>  <!-- /.nav-third-level -->
                    </li>
                  </ul><!-- /.nav-second-level -->
                </li>
              </ul>
            </div><!-- /.sidebar-collapse -->
          </div><!-- close navbar devault toolbar -->

<!-- Menu DGM OPERASIONAL -->
        <?php }elseif ($_SESSION['level']=="dgm_op") { ?>
          <div style="margin:0" class="navbar-default sidebar" role="navigation">
            <div class="sidebar-nav navbar-collapse">
              <ul class="nav" id="side-menu">
								<li>
									<a href="/KPKU/GM/hrga.php"><i class="fa fa-bank fa-fw"></i> HRGA <span class="fa arrow"></span> </a>
									<ul class="nav nav-second-level">
										<li> <a href="/KPKU/HRGA/HRAM/index.php">HRAM</a> </li>
										<li> <a href="/KPKU/HRGA/HRAM/index.php">Logistic</a> </li>
										<li> <a href="/KPKU/HRGA/HRAM/index.php">CDM</a> </li>
									</ul>
								</li>
                <li>
                  <a href="#"><i class="fa fa-wrench"></i> Operasional<span class="fa arrow"></span></a>
                  <ul class="nav nav-second-level">
										<li>
											<a href="/KPKU/Operasional/index.php">Maintenance <span class="fa arrow"></span></a>
											<ul class="nav nav-third-level">
												<li>
													<a href="/kpku/Operasional/index.php">Dashboard</a>
												</li>
												<li>
													<a href="/kpku/Operasional/jenis_inspeksi.php">Kelola Jenis Inspeksi</a>
												</li>
												<li>
													<a href="/kpku/Operasional/jenis_kerusakan.php">Kelola Jenis Kerusakan</a>
												</li>
											</ul>
										</li>
                    <li> <a href="/KPKU/Operasional/TM/index.php">TM</a> </li>
                    <li> <a href="/KPKU/Operasional/TCM/index.php">TCM</a> </li>
                  </ul> <!-- end -second-level -->
                </li>
                <li>
                  <a href="#"><i class="fa fa-dollar"></i> Finance<span class="fa arrow"></span></a>
                  <ul class="nav nav-second-level">
                    <li> <a href="#">Laba Rugi <span class="fa arrow"></span></a>
                      <ul class="nav nav-third-level">
                        <li> <a href="/KPKU/GM/view_grafik_anggaran.php">Dashboard</a> </li>
                        <li> <a href="/KPKU/GM/view_anggaran_GM.php">Laporan</a> </li>
                      </ul>  <!-- /.nav-third-level -->
                    </li>
                  </ul>  <!-- /.nav-second-level -->
                </li>
              </ul>
            </div> <!-- /.sidebar-collapse -->
          </div>  <!-- close navbar devault toolbar -->

<!-- Menu PETUGAS OPERASIONAL -->
        <?php }elseif ($_SESSION['level']=="ptg_op") { ?>
          <div style="margin:0" class="navbar-default sidebar" role="navigation">
            <div class="sidebar-nav navbar-collapse">
              <ul class="nav" id="side-menu">
								<li>
									<a href="/KPKU/GM/hrga.php"><i class="fa fa-bank fa-fw"></i> HRGA <span class="fa arrow"></span> </a>
									<ul class="nav nav-second-level">
										<li> <a href="/KPKU/HRGA/HRAM/index.php">HRAM</a> </li>
										<li> <a href="/KPKU/HRGA/HRAM/index.php">Logistic</a> </li>
										<li> <a href="/KPKU/HRGA/HRAM/index.php">CDM</a> </li>
									</ul>
								</li>
                <li>
                  <a href="#"><i class="fa fa-wrench"></i> Operasional<span class="fa arrow"></span></a>
                  <ul class="nav nav-second-level">
										<li> <a href="/KPKU/Operasional/Maintenance/index.php">Maintenance</a> </li>
                    <li> <a href="/KPKU/Operasional/TM/index.php">TM</a> </li>
                    <li> <a href="/KPKU/Operasional/TCM/index.php">TCM</a> </li>
                  </ul> <!-- end -second-level -->
                </li>
                <li>
                  <a href="#"><i class="fa fa-dollar"></i> Finance<span class="fa arrow"></span></a>
                  <ul class="nav nav-second-level">
                    <li> <a href="#">Laba Rugi <span class="fa arrow"></span></a>
                      <ul class="nav nav-third-level">
                        <li> <a href="/KPKU/GM/view_grafik_anggaran.php">Dashboard</a> </li>
                        <li> <a href="/KPKU/GM/view_anggaran_GM.php">Laporan</a> </li>
                      </ul>  <!-- /.nav-third-level -->
                    </li>
                  </ul>  <!-- /.nav-second-level -->
                </li>
              </ul>
            </div> <!-- /.sidebar-collapse -->
          </div>  <!-- close navbar devault toolbar -->

<!-- Menu DGM Finance -->
        <?php }elseif ($_SESSION['level']=="dgm_fn") { ?>
          <div style="margin:0" class="navbar-default sidebar" role="navigation">
            <div class="sidebar-nav navbar-collapse">
              <ul class="nav" id="side-menu">
								<li>
									<a href="/KPKU/GM/hrga.php"><i class="fa fa-bank fa-fw"></i> HRGA <span class="fa arrow"></span> </a>
									<ul class="nav nav-second-level">
										<li> <a href="/KPKU/HRGA/HRAM/index.php">HRAM</a> </li>
										<li> <a href="/KPKU/HRGA/HRAM/index.php">Logistic</a> </li>
										<li> <a href="/KPKU/HRGA/HRAM/index.php">CDM</a> </li>
									</ul>
								</li>
                <li>
                  <a><i class="fa fa-wrench"></i> Operasional<span class="fa arrow"></span></a>
                  <ul class="nav nav-second-level">
										<li> <a href="/KPKU/Operasional/Maintenance/index_luar.php">Maintenance</a> </li>
                    <li> <a href="/KPKU/Operasional/TM/index.php">TM</a> </li>
                    <li> <a href="/KPKU/Operasional/TCM/index.php">TCM</a> </li>
                  </ul><!-- end -second-level -->
                </li>
                <li>
                  <a href="#"><i class="fa fa-dollar"></i> Finance<span class="fa arrow"></span></a>
                  <ul class="nav nav-second-level">
                    <li>
                      <a href="#">Laba Rugi <span class="fa arrow"></span></a>
                      <ul class="nav nav-third-level">
                        <li><a href="/kpku/finance/dgmfinance/view_grafik_anggaran.php">Dashboard</a>
                        </li>
                        <li>
                          <a href="/kpku/finance/dgmfinance/view_anggaran_DGM.php">Laporan</a>
                        </li>
											</ul>
                    </li>
                  </ul><!-- /.nav-second-level -->
                </li>
              </ul>
            </div>  <!-- /.sidebar-collapse -->
          </div><!-- close navbar devault toolbar -->

<!-- Menu petugas Finance -->
        <?php }elseif ($_SESSION['level']=="ptg_fn") { ?>
          <div style="margin:0" class="navbar-default sidebar" role="navigation">
            <div class="sidebar-nav navbar-collapse">
              <ul class="nav" id="side-menu">
								<li>
									<a href="/KPKU/GM/hrga.php"><i class="fa fa-bank fa-fw"></i> HRGA <span class="fa arrow"></span> </a>
									<ul class="nav nav-second-level">
										<li> <a href="/KPKU/HRGA/HRAM/index.php">HRAM</a> </li>
										<li> <a href="/KPKU/HRGA/HRAM/index.php">Logistic</a> </li>
										<li> <a href="/KPKU/HRGA/HRAM/index.php">CDM</a> </li>
									</ul>
								</li>
                <li>
                  <a><i class="fa fa-wrench"></i> Operasional<span class="fa arrow"></span></a>
                  <ul class="nav nav-second-level">
										<li> <a href="/KPKU/Operasional/Maintenance/index_luar.php">Maintenance</a> </li>
		                <li> <a href="/KPKU/Operasional/TM/index.php">TM</a> </li>
		                <li> <a href="/KPKU/Operasional/TCM/index.php">TCM</a> </li>
                  </ul><!-- end -second-level -->
                </li>
                <li>
                  <a href="#"><i class="fa fa-dollar"></i> Finance<span class="fa arrow"></span></a>
                  <ul class="nav nav-second-level">
                    <li>
                      <a href="#">Laba Rugi <span class="fa arrow"></span></a>
                      <ul class="nav nav-third-level">
                        <li> <a href="/KPKU/Finance/AdminFInance/view_grafik_anggaran.php">Dashboard</a> </li>
                        <li> <a href="/KPKU/Finance/AdminFinance/view_anggaran_admin.php">Laporan</a> </li>
                      </ul>  <!-- /.nav-third-level -->
                    </li>
                    <li> <a href="/KPKU/Finance/AdminFinance/add_tahun.php">Tambah Tahun</a> </li>
                  </ul><!-- /.nav-second-level -->
                </li>
              </ul>
            </div>  <!-- /.sidebar-collapse -->
          </div><!-- close navbar devault toolbar -->

        <?php
        }
        // /. close all
        ?>
    <!-- jQuery -->
    <script src="/KPKU/Utility/vendor/jquery/jquery.min.js"></script>

    <!-- Bootstrap Core JavaScript -->
    <script src="/KPKU/Utility/vendor/bootstrap/js/bootstrap.min.js"></script>

    <!-- Metis Menu Plugin JavaScript -->
    <script src="/KPKU/Utility/vendor/metisMenu/metisMenu.min.js"></script>

    <!-- Custom Theme JavaScript -->
    <script src="/KPKU/Utility/dist/js/sb-admin-2.js"></script>

</body>

</html>
