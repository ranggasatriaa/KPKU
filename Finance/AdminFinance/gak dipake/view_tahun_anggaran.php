<?php
session_start();
error_reporting(0);
if (!isset($_SESSION['level'])){
	header('location:../../index.php');
	exit;
}elseif (isset($_SESSION['level'])){
	include('../../header.php');

?>

<!DOCTYPE HTML PUBLIC>
<html>
  <head>
    <meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
    <title>View Tahun Laporan Anggaran Laba Rugi</title>
  </head>
  <body>
		<div id="wrapper">
			<div id="page-wrapper">
				<div class="row">
					<div class="col-lg-12">
				    <h2>Data Tahun</h2>
				    <p><a href="add_tahun.php?"class="btn btn-info">  Tambah Tahun  </a></p>
				      <div class="row">
						    <div class="col-lg-12">
								  <div class="panel panel-default">
										<table width="100%" class="table table-striped table-bordered table-hover" id="dataTables-example" align="center">
				              <tr>
				          	     <th style="text-align:center">No</th>
				          	     <th style="text-align:center">Tahun</th>
				              </tr>
				              <?php
				                // connect database
				                require_once('db_login.php');
				                $db = new mysqli($db_host, $db_username, $db_password, $db_database);
				                if ($db->connect_errno){
				                  die ("Could not connect to the database: <br />". $db->connect_error);
				                }
				                //Asign a query
				                $query = " SELECT * FROM tahun ORDER BY id_tahun ";
				              // Execute the query
				                $result = $db->query( $query );
				                if (!$result){
				                   die ("Could not query the database: <br />". $db->error);
				                }
				              	// Fetch and display the results
				                $i = 1;
				                while ($row = $result->fetch_object()){
				                echo '<tr>';
				                    	echo '<td>'.$i.'</td>';
				                    	echo '<td>'.$row->nama_tahun.'</td> ';
				                echo '</tr>';
				                	$i++;
				                }
			                  $result->free();
			                  $db->close();
			              	?>
			              </table>
				    			</div>
				    		</div>
				      </div>
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
<!-- <?php } ?> -->
