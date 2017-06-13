<?php
session_start();
error_reporting(0);
if (!isset($_SESSION['level'])){
	header('location:/kpku/index.php');
	exit;
}elseif($_SESSION['level']!="dgm_fn"){
	header('location:/kpku/unauthorized.php');
}else{
	include('../../header.php');
}
?>

<!DOCTYPE HTML>
<!--php untuk menampilkan dropdown pilihan tahun!-->
<html>
	<head>
		<title>View Grafik Laporan Anggaran Laba Rugi</title>
	</head>
	<body>
		<div id="wrapper">
			<div  id="page-wrapper" >
				<div class="row">
					<div class="col-lg-12">
						<form method="GET" autocomplete="on">
							<table align="center">
								<tr>
									<td valign="top">Tahun</td>
									<td valign="top">:</td>
									<td valign="top"><select class="form-control" name="tahun" required>
										<?php
												require_once('../../config.php');
												$db = new mysqli($db_host, $db_username, $db_password, $db_database);
												if($db->connect_errno){
													die("Tidak dapat terkoneksi dengan database: </br>". $db->connect_errno);
												}
												$query = "SELECT * FROM tahun ORDER BY nama_tahun";
												$result = $db->query($query);
												if(!$result){
													die("Query tidak terkoneksi dengan database: </br>" .$db->error);
												}
												echo "<option value=''>-- Pilih Tahun --</option>";
												while($row = $result->fetch_object()){
													$nama_tahun = $row->nama_tahun;
													$id_tahun = $row->id_tahun;
													echo " <option value='$id_tahun'>$nama_tahun</option>";
												}
										?>
									</select>
									</td>
								</tr>
								<tr>
									<td valign="top" align="center"  colspan="3"><input type="submit" class="btn btn-default" name="submit" value="Browse"</td>
								</tr>
							</table>
						</form>
						<?php
								require_once('../../config.php');
								$db = new mysqli($db_host, $db_username, $db_password, $db_database);
								if($db->connect_errno){
									die("Tidak dapat terkoneksi dengan database: </br>". $db->connect_errno);
								}
								if(isset($_GET['submit'])){
											$id_tahun = $_GET['tahun'];
											$jan=0;$jul=0;	$jan1=0; $jul1=0;
											$feb=0;	$agu=0; $feb1=0; $agu1=0;
											$mar=0;	$sep=0; $mar1=0; $sep1=0;
											$apr=0;	$okt=0;	$apr1=0;  $okt1=0;
											$mei=0;	$nov=0; $mei1=0; $nov1=0;
											$jun=0;	$des=0;	$jun1=0; $des1=0;
											//ambil bulan januari
											$queryjan= " SELECT * FROM labarugi  where tahun =".$id_tahun." and bulan='1'";
											$resultjan = $db->query($queryjan);
											if (!$resultjan){
												echo "Query tidak terkoneksi dengan database: " .$db->error;
											}
											else
											{
												while ($rowjan = $resultjan->fetch_object())
												{
													if($rowjan->flag=="Kurang"){
														$jan=$jan-$rowjan->anggaran;
													}
													else{
														 $jan=$jan+$rowjan->anggaran;
													}
												}
											}
											$queryjan1= " SELECT * FROM labarugi  where tahun =".$id_tahun." and bulan='1'";
											$resultjan1 = $db->query($queryjan1);
											if (!$resultjan1){
												echo "Query tidak terkoneksi dengan database: " .$db->error;
											}
											else
											{
												while ($rowjan1 = $resultjan1->fetch_object())
												{
													if($rowjan1->tipe_anggaran==9 || $rowjan1->tipe_anggaran==11){
														$jan1=$jan1+$rowjan1->anggaran;
													}
													else{

													}
												}
												$jan1=$jan1+$jan;
											}
											//ambil bulan febuari
											$queryfeb= " SELECT * FROM labarugi  where tahun =".$id_tahun." and bulan='2'";
											$resultfeb = $db->query($queryfeb);
											if (!$resultfeb){
												echo "Query tidak terkoneksi dengan database: " .$db->error;
											}
											else
											{
												while ($rowfeb = $resultfeb->fetch_object())
												{
													if($rowfeb->flag=="Kurang"){
														$feb=$feb-$rowfeb->anggaran;
													}
													else{
														 $feb=$feb+$rowfeb->anggaran;
													}
												}
											}
											$queryfeb1= " SELECT * FROM labarugi  where tahun =".$id_tahun." and bulan='2'";
											$resultfeb1 = $db->query($queryfeb1);
											if (!$resultfeb1){
												echo "Query tidak terkoneksi dengan database: " .$db->error;
											}
											else
											{
												while ($rowfeb1 = $resultfeb1->fetch_object())
												{
													if($rowfeb1->tipe_anggaran==9 || $rowfeb1->tipe_anggaran==11){
														$feb1=$feb1+$rowfeb1->anggaran;
													}
													else{

													}
												}
												$feb1=$feb1+$feb;
											}
											//ambil bulan maret
											$querymar= " SELECT * FROM labarugi  where tahun =".$id_tahun." and bulan='3'";
											$resultmar = $db->query($querymar);
											if (!$resultmar){
												echo "Query tidak terkoneksi dengan database: " .$db->error;
											}
											else
											{
												while ($rowmar = $resultmar->fetch_object())
												{
													if($rowmar->flag=="Kurang"){
														$mar=$mar-$rowmar->anggaran;
													}
													else{
														 $mar=$mar+$rowmar->anggaran;
													}
												}
											}
											$querymar1= " SELECT * FROM labarugi  where tahun =".$id_tahun." and bulan='3'";
											$resultmar1 = $db->query($querymar1);
											if (!$resultmar1){
												echo "Query tidak terkoneksi dengan database: " .$db->error;
											}
											else
											{
												while ($rowmar1 = $resultmar1->fetch_object())
												{
													if($rowmar1->tipe_anggaran==9 || $rowmar1->tipe_anggaran==11){
														$mar1=$mar1+$rowmar1->anggaran;
													}
													else{

													}
												}
												$mar1=$mar1+$mar;
											}
											//ambil bulan april
											$queryapr= " SELECT * FROM labarugi  where tahun =".$id_tahun." and bulan='4'";
											$resultapr = $db->query($queryapr);
											if (!$resultapr){
												echo "Query tidak terkoneksi dengan database: " .$db->error;
											}
											else
											{
												while ($rowapr = $resultapr->fetch_object())
												{
													if($rowapr->flag=="Kurang"){
														$apr=$apr-$rowapr->anggaran;
													}
													else{
														 $apr=$apr+$rowapr->anggaran;
													}
												}
											}
											$queryapr1= " SELECT * FROM labarugi  where tahun =".$id_tahun." and bulan='4'";
											$resultapr1 = $db->query($queryapr1);
											if (!$resultapr1){
												echo "Query tidak terkoneksi dengan database: " .$db->error;
											}
											else
											{
												while ($rowapr1 = $resultapr1->fetch_object())
												{
													if($rowapr1->tipe_anggaran==9 || $rowapr1->tipe_anggaran==11){
														$apr1=$apr1+$rowapr1->anggaran;
													}
													else{

													}
												}
												$apr1=$apr1+$apr;
											}
											//ambil bulan mei
											$querymei= " SELECT * FROM labarugi  where tahun =".$id_tahun." and bulan='5'";
											$resultmei = $db->query($querymei);
											if (!$resultmei){
												echo "Query tidak terkoneksi dengan database: " .$db->error;
											}
											else
											{
												while ($rowmei = $resultmei->fetch_object())
												{
													if($rowmei->flag=="Kurang"){
														$mei=$mei-$rowmei->anggaran;
													}
													else{
														 $mei=$mei+$rowmei->anggaran;
													}
												}
											}
											$querymei1= " SELECT * FROM labarugi  where tahun =".$id_tahun." and bulan='5'";
											$resultmei1 = $db->query($querymei1);
											if (!$resultmei1){
												echo "Query tidak terkoneksi dengan database: " .$db->error;
											}
											else
											{
												while ($rowmei1 = $resultmei1->fetch_object())
												{
													if($rowmei1->tipe_anggaran==9 || $rowmei1->tipe_anggaran==11){
														$mei1=$mei1+$rowmei1->anggaran;
													}
													else{

													}
												}
												$mei1=$mei1+$mei;
											}
											//ambil bulan juni
											$queryjun= " SELECT * FROM labarugi  where tahun =".$id_tahun." and bulan='6'";
											$resultjun = $db->query($queryjun);
											if (!$resultjun){
												echo "Query tidak terkoneksi dengan database: " .$db->error;
											}
											else
											{
												while ($rowjun = $resultjun->fetch_object())
												{
													if($rowjun->flag=="Kurang"){
														$jun=$jun-$rowjun->anggaran;
													}
													else{
														 $jun=$jun+$rowjun->anggaran;
													}
												}
											}
											$queryjun1= " SELECT * FROM labarugi  where tahun =".$id_tahun." and bulan='6'";
											$resultjun1 = $db->query($queryjun1);
											if (!$resultjun1){
												echo "Query tidak terkoneksi dengan database: " .$db->error;
											}
											else
											{
												while ($rowjun1 = $resultjun1->fetch_object())
												{
													if($rowjun1->tipe_anggaran==9 || $rowjun1->tipe_anggaran==11){
														$jun1=$jun1+$rowjun1->anggaran;
													}
													else{

													}
												}
												$jun1=$jun1+$jun;
											}
											//ambil bulan juli
											$queryjul= " SELECT * FROM labarugi  where tahun =".$id_tahun." and bulan='7'";
											$resultjul = $db->query($queryjul);
											if (!$resultjul){
												echo "Query tidak terkoneksi dengan database: " .$db->error;
											}
											else
											{
												while ($rowjul = $resultjul->fetch_object())
												{
													if($rowjul->flag=="Kurang"){
														$jul=$jul-$rowjul->anggaran;
													}
													else{
														 $jul=$jul+$rowjul->anggaran;
													}
												}
											}
											$queryjul1= " SELECT * FROM labarugi  where tahun =".$id_tahun." and bulan='7'";
											$resultjul1 = $db->query($queryjul1);
											if (!$resultjul1){
												echo "Query tidak terkoneksi dengan database: " .$db->error;
											}
											else
											{
												while ($rowjul1 = $resultjul1->fetch_object())
												{
													if($rowjul1->tipe_anggaran==9 || $rowfeb1->tipe_anggaran==11){
														$jul1=$jul1+$rowjul1->anggaran;
													}
													else{

													}
												}
												$jul1=$jul1+$jul;
											}
											//ambil bulan agustus
											$queryagu= " SELECT * FROM labarugi  where tahun =".$id_tahun." and bulan='8'";
											$resultagu = $db->query($queryagu);
											if (!$resultagu){
												echo "Query tidak terkoneksi dengan database: " .$db->error;
											}
											else
											{
												while ($rowagu = $resultagu->fetch_object())
												{
													if($rowagu->flag=="Kurang"){
														$agu=$agu-$rowagu->anggaran;
													}
													else{
														 $agu=$agu+$rowagu->anggaran;
													}
												}
											}
											$queryagu1= " SELECT * FROM labarugi  where tahun =".$id_tahun." and bulan='8'";
											$resultagu1 = $db->query($queryagu1);
											if (!$resultagu1){
												echo "Query tidak terkoneksi dengan database: " .$db->error;
											}
											else
											{
												while ($rowagu1 = $resultagu1->fetch_object())
												{
													if($rowagu1->tipe_anggaran==9 || $rowagu1->tipe_anggaran==11){
														$agu1=$agu1+$rowagu1->anggaran;
													}
													else{

													}
												}
												$agu1=$agu1+$agu;
											}
											//ambil bulan september
											$querysep= " SELECT * FROM labarugi  where tahun =".$id_tahun." and bulan='9'";
											$resultsep = $db->query($querysep);
											if (!$resultsep){
												echo "Query tidak terkoneksi dengan database: " .$db->error;
											}
											else
											{
												while ($rowsep = $resultsep->fetch_object())
												{
													if($rowsep->flag=="Kurang"){
														$sep=$sep-$rowsep->anggaran;
													}
													else{
														 $sep=$sep+$rowsep->anggaran;
													}
												}
											}
											$querysep1= " SELECT * FROM labarugi  where tahun =".$id_tahun." and bulan='9'";
											$resultsep1 = $db->query($querysep1);
											if (!$resultsep1){
												echo "Query tidak terkoneksi dengan database: " .$db->error;
											}
											else
											{
												while ($rowsep1 = $resultsep1->fetch_object())
												{
													if($rowsep1->tipe_anggaran==9 || $rowsep1->tipe_anggaran==11){
														$sep1=$sep1+$rowsep1->anggaran;
													}
													else{

													}
												}
												$sep1=$sep1+$sep;
											}
											//ambil bulan oktober
											$queryokt= " SELECT * FROM labarugi  where tahun =".$id_tahun." and bulan='10'";
											$resultokt = $db->query($queryokt);
											if (!$resultokt){
												echo "Query tidak terkoneksi dengan database: " .$db->error;
											}
											else
											{
												while ($rowokt = $resultokt->fetch_object())
												{
													if($rowokt->flag=="Kurang"){
														$okt=$okt-$rowokt->anggaran;
													}
													else{
														 $okt=$okt+$rowokt->anggaran;
													}
												}
											}
											$queryokt1= " SELECT * FROM labarugi  where tahun =".$id_tahun." and bulan='10'";
											$resultokt1 = $db->query($queryokt1);
											if (!$resultokt1){
												echo "Query tidak terkoneksi dengan database: " .$db->error;
											}
											else
											{
												while ($rowokt1 = $resultokt1->fetch_object())
												{
													if($rowokt1->tipe_anggaran==9 || $rowokt1->tipe_anggaran==11){
														$okt1=$okt1+$rowokt1->anggaran;
													}
													else{

													}
												}
												$okt1=$okt1+$okt;
											}
											//ambil bulan november
											$querynov= " SELECT * FROM labarugi  where tahun =".$id_tahun." and bulan='11'";
											$resultnov = $db->query($querynov);
											if (!$resultnov){
												echo "Query tidak terkoneksi dengan database: " .$db->error;
											}
											else
											{
												while ($rownov = $resultnov->fetch_object())
												{
													if($rownov->flag=="Kurang"){
														$nov=$nov-$rownov->anggaran;
													}
													else{
														 $nov=$nov+$rownov->anggaran;
													}
												}
											}
											$querynov1= " SELECT * FROM labarugi  where tahun =".$id_tahun." and bulan='11'";
											$resultnov1 = $db->query($querynov1);
											if (!$resultnov1){
												echo "Query tidak terkoneksi dengan database: " .$db->error;
											}
											else
											{
												while ($rownov1 = $resultnov1->fetch_object())
												{
													if($rownov1->tipe_anggaran==9 || $rownov1->tipe_anggaran==11){
														$nov1=$nov1+$rownov1->anggaran;
													}
													else{

													}
												}
												$nov1=$nov1+$nov;
											}
											//ambil bulan desember
											$querydes= " SELECT * FROM labarugi  where tahun =".$id_tahun." and bulan='12'";
											$resultdes = $db->query($querydes);
											if (!$resultdes){
												echo "Query tidak terkoneksi dengan database: " .$db->error;
											}
											else
											{
												while ($rowdes = $resultdes->fetch_object())
												{
													if($rowdes->flag=="Kurang"){
														$des=$des-$rowdes->anggaran;
													}
													else{
														 $des=$des+$rowdes->anggaran;
													}
												}
											}
											$querydes1= " SELECT * FROM labarugi  where tahun =".$id_tahun." and bulan='12'";
											$resultdes1 = $db->query($querydes1);
											if (!$resultdes1){
												echo "Query tidak terkoneksi dengan database: " .$db->error;
											}
											else
											{
												while ($rowdes1 = $resultdes1->fetch_object())
												{
													if($rowdes1->tipe_anggaran==9 || $rowdes1->tipe_anggaran==11){
														$des1=$des1+$rowdes1->anggaran;
													}
													else{

													}
												}
												$des1=$des1+$des;
											}
										}
						?>
						<div id="container" style="min-width: 300px; height: 400px; margin: 0 auto"></div>
						<a style="margin:10px 0px" class="btn btn-outline btn-primary btn-block" href="index.php">Kembali</a>
					</div>
					<!-- /. col-lg-12 -->
				</div>
				<!-- /. row -->
			</div>
			<!-- /. page wrapper -->
		</div>
		<!-- /. wrapper -->
		<!-- footer -->
		<div style="text-align:right; font-size:80%; height:40px; background:#0059B2; color:#cce6ff; position:relative; bottom:0px; width:100%; padding:5px 20px; margin:20px 0px" >
			Copyright Informatika Undip 2017
		</div>
		<!-- close footer -->
	</body>
</html>

<!--file untuk menampilkan grafik!-->
<script src="/KPKU/Utility/js_grafik/highcharts.js"></script>
<script src="/KPKU/Utility/js_grafik/exporting.js"></script>
		<script type="text/javascript">
			$(function () {
			    Highcharts.chart('container', {
			        title: {
			            text: 'Laba Usaha Tahunan',
			            x: -20 //center
			        },
			        xAxis: {
			            categories: ['Jan', 'Feb','Mar','Apr','Mei','Jun','Jul','Ag','Sep','Okt','Nov','Des']
			        },
			        yAxis: {
			            title: {
			                text: 'Laba(Rp)'
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
			        series: [{
			            name: 'Laba Usaha',
			            data: [<?php echo $jan;?>,<?php echo $feb;?>,<?php echo $mar;?>,<?php echo $apr;?>,<?php echo $mei;?>,
									<?php echo $jun;?>,<?php echo $jul;?>,<?php echo $agu;?>,<?php echo $sep;?>,<?php echo $okt;?>,<?php echo $nov;?>,<?php echo $des;?>]
			        },{
					name: 'Ebtida',
					data: [<?php echo $jan1;?>, <?php echo $feb1;?>, <?php echo $mar1;?>,<?php echo $apr1;?>,<?php echo $mei1;?>,<?php echo $jun1;?>, <?php echo $jul1;?>, <?php echo $agu1;?>,<?php echo $sep1;?>,<?php echo $okt1;?>,<?php echo $nov1;?>,<?php echo $des1;?>]}]
			    });
			});
		</script>
