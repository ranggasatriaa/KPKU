<?php
session_start();
error_reporting(0);
if (!isset($_SESSION['level'])){
	header('location:/kpku/index.php');
	exit;
}else{
	include('../../header.php');
}
?>

<!DOCTYPE html>
<html lang="id">
	<head>
		<title>Detail Inspeksi</title>
		<script>
			function del(){
				var x=window.confirm("Anda yakin ingin menghapus?");
				return x;
			}
		</script>
  </head>
	<body style="background-color:#FFF">
    <div id="wrapper">
			<div id="page-wrapper">
				<div class="row">
        	<div class="col-lg-12">
            <div>
              <a style="margin:10px 0px" class="btn btn-info btn-lg" href="print_inspeksi.php"><i class="fa fa-print"></i>  Cetak Inspeksi</a>
							&nbsp <a style="margin:10px 0px" class="btn btn-primary btn-outline btn-lg" href="cari_inspeksi.php"><i class="fa fa-search"></i>  Cari Inspeksi</a>
            </div>
						<label>Masukkan Tanggal:</label>
						<form action="index_luar.php" method="GET" autocomplete="on">
							<input type="date" name="tanggal1" required>
								<input type="date" name="tanggal2" required>
							<input type="submit" class="btn btn-primary" name="submit" value="CARI"></input>
						</form>
						<?php
						require_once ('../../config.php');
						//inisiasi database
						$db=new mysqli($db_host,$db_username,$db_password,$db_database) or
						die("Maaf Anda gagal koneksi.!");
						//mendeteksi apakah ada inputan
						if(isset($_GET['submit'])){
							//menentukan nilai variabel dari inputan
							$tanggal1 = $_GET['tanggal1'];
							$tanggal2 = $_GET['tanggal2'];
							//menghitung selisih hari antar tanggal
							$temp_tgl	 = $tanggal1;
							$selisih = ((abs(strtotime ($tanggal1) - strtotime ($tanggal2)))/(60*60*24));
						}else{
							//konsisi tanggal default (30 hari dari sekarang)
							$tanggal2 = date("Y-m-d");
							$tanggalsebelum = strtotime ( '-30 day' , strtotime ( $tanggal2 ) ) ;;
							$tanggal1 = date('Y-m-d', $tanggalsebelum);
							$temp_tgl	 = $tanggal1;
							$selisih = ((abs(strtotime ($tanggal1) - strtotime ($tanggal2)))/(60*60*24));
						}
							//peru;angan menghitung kerusakan perhari
							for ($i= 0; $i <= $selisih; $i++)
							{
								//query mencari inspeksi berdsarkan waktu kerussakn
								$query = " SELECT * FROM inspeksi	WHERE waktu_kerusakan='$temp_tgl' ";
								// Execute the query
								$result = $db->query($query);
								if (!$result){
									die ("Could not query the database: <br />". $db->error);
								}else{
								//menyimpan jumlah data kedalam array
								$row_k[$i] = $result->num_rows;
								}
								// mengubah tanggal 1 haru setelahnya
								$newdate = strtotime ( '+1 day' , strtotime ( $temp_tgl ) ) ;
								$temp_tgl = date ( 'Y-m-d' , $newdate );
							}

							//perulangan menghitung perbaikan perhari
							$temp_tgl = $tanggal1;
							for ($i= 0; $i <= $selisih; $i++)
							{
								//query mencari inspeksi berdsarkan waktu
								$query = " SELECT * FROM inspeksi	WHERE waktu_perbaikan='$temp_tgl' ";
								// Execute the query
								$result = $db->query($query);
								if (!$result){
									die ("Could not query the database: <br />". $db->error);
								}else{
								//menyimpan jumlah data kedalam array
								$row_p[$i] = $result->num_rows;
								}
								// mengubah tanggal 1 haru setelahnya
								$newdate = strtotime ( '+1 day' , strtotime ( $temp_tgl ) ) ;
								$temp_tgl = date ( 'Y-m-d' , $newdate );
							}
							// menampilkan grafik
							echo '<div id="grafik" style="min-width: 300px; height: 400px; margin: 0 auto"></div>';
						?>
					</div>
					<!-- /. col-md-12 -->
        </div>
				<!-- /. row -->
      </div>
      <!-- close Main -->
    </div>
    <!-- /#wrapper -->
		<!-- footer -->
		<div style="text-align:right; font-size:80%; height:40px; background:#0059B2; color:#cce6ff; position:relative; bottom:0px; width:100%; padding:5px 20px; margin:20px 0px" >
			Copyright Informatika Undip 2017
		</div>
		<!-- close footer -->
  </body>
</html>


<!--file untuk menampilkan grafik!-->
		<!-- <script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/1.8.2/jquery.min.js"></script> -->
		<!-- //import file javascript grafik -->
		<script src="/KPKU/Utility/js_grafik/highcharts.js"></script>
		<script src="/KPKU/Utility/js_grafik/exporting.js"></script>
		<script type="text/javascript">
			$(function () {
			  Highcharts.chart('grafik', {
			    title: {
			      text: 'Inspeksi <?php echo date('d M Y',strtotime($tanggal1));?> sd <?php echo date('d M Y',strtotime($tanggal2));?>',
			      x: -20 //center
			    },
			  	xAxis: {
			      categories: [
							<?php
								// memasukkan informasi grafik
								$temp_tgl =  $tanggal1;

								$temp_tgl2 = strtotime($tanggal1);
								$temp_tgl2 = date ( 'd M Y' , $temp_tgl2);
								echo "'.$temp_tgl2.'";
								for ($i= 1; $i <= $selisih; $i++)
								{
									$newdate = strtotime ( '+1 day' , strtotime ( $temp_tgl ) ) ;
									$temp_tgl = date ( 'Y-m-d' , $newdate );

									$temp_tgl2 = strtotime($temp_tgl);
									$temp_tgl2 = date ( 'd M Y' , $temp_tgl2 );
									echo ",'".$temp_tgl2."'";

								}
							?>
						]
			    },
			    yAxis: {
			      title: {
			        text: 'Jumlah'
			      },
			      plotLines: [{
			        value: 0,
			        width: 1,
			        color: '#808080'
			      }]
			    },
			    tooltip: {
			      valueSuffix: ''
			    },

			    legend: {
			      layout: 'vertical',
			      align: 'right',
			      verticalAlign: 'middle',
			      borderWidth: 0
			    },
					//menampilkan tanggal
			    series: [
						{
				      name: 'Kerusakan',
							color: '#ed3f3f',
				      data: [
								<?php
									echo $row_k[0];
							    for ($i= 1; $i <= $selisih; $i++)
							    {
							      echo ',';
										echo $row_k[$i];
							    }
							  ?>
							]
			    	},
						{
							name: 'Perbaikan',
							color: '#4CAF50',
						  data: [
								<?php
									echo $row_p[0];
									for ($i= 1; $i <= $selisih; $i++)
									{
										echo ',';
										echo $row_p[$i];
									}
								?>
							]
						}
					]
			  });
			});
		</script>
