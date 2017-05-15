<?php
session_start();
error_reporting(0);
if (!isset($_SESSION['level'])){
	header('location:/kpku/index.php');
	exit;
}elseif($_SESSION['level']!="ptg_fn"){
	header('location:/kpku/unauthorized.php');
}else{
	include('../../header.php');
}
?>

<!DOCTYPE html>
<!--php untuk menampilkan dropdown pilihan bulan dan tahun!-->
<html>
	<head>
	</head>
		<body>
			<div id="wrapper">
	      <!-- Main -->
				<div id="page-wrapper">
					<div class ="row">
				  	<div class="col-lg-12">
							<h3><center> LAPORAN LABA RUGI	</center></h3>
							<form  method="GET" autocomplete="on">
								<table align="center">
									<tr>
										<td valign="top">Bulan</td>
										<td valign="top">:</td>
										<td valign="top"><select class="form-control" name="bulan" required>
											<?php
												require_once('../../config.php');
												$db = new mysqli($db_host, $db_username, $db_password, $db_database);
												if($db->connect_errno){
													die("Tidak dapat terkoneksi dengan database: </br>". $db->connect_errno);
												}
												$query = "SELECT * FROM bulan";
												$result = $db->query($query);
												if(!$result){
													die("Query tidak terkoneksi dengan database: </br>" .$db->error);
												}
												echo "<option value=''>-- Pilih Bulan --</option>";
												while($row = $result->fetch_object()){
													$nama_bulan = $row->nama_bulan;
													$id_bulan = $row->id_bulan;
													echo " <option value='$id_bulan'>$nama_bulan</option>";
												}
											?>
										</select>
										</td>
										<td valign="top"></td>
									</tr>
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
								<a href="add_anggaran.php" class="btn btn-info"><i class="fa fa-plus"></i> Tambah Laporan Anggaran </a>
							</form>
						</div>
						<!-- /. col-lg-12 -->
						<?php
							require_once('../../config.php');
							$db = new mysqli($db_host, $db_username, $db_password, $db_database);
							if ($db->connect_errno){
								die ("Could not connect to the database: <br />". $db->connect_error);
							}
							if(isset($_GET['submit'])){ //klo udah ngeklik bulan dan tahunnya
								if($_GET['bulan']=='' || $_GET['tahun']==''){
								echo("<center>Masukkan bulan dan tahun terlebih dahulu</center>");
								}
								else{
									$id_bulan = $_GET['bulan'];
									$id_tahun = $_GET['tahun'];
									$pusaha=0; $ptol=0; $pntol=0;
									$pbusaha=0;
									$pbsdm=0; $pgt=0; $pbonus=0; $pkes=0; $plem=0;$pkeslain=0;
									$pbebanops=0; $ppengumpulan=0; $ppelayanan=0; $ppemeliharaan=0;
									$ppbb=0; $ppenyusutan=0; $pbebanumum=0;
									$pbebanoverlay=0;
									$ppbunga=0; $pplain=0; $pbebanlain=0;
									$labausaha=0;
									$ebtida=0;

									$id2=0;$id3=0;$id4=0;$id5=0;$id6=0;$id7=0;$id8=0;$id9=0;
									$id10=0;$id11=0;$id12=0;$id13=0;$id14=0;$id15=0;$id16=0;
									$id17=0;$id18=0;
									//pendapatan tol
									$query2 = " SELECT * FROM labarugi where bulan=".$id_bulan." and tahun =".$id_tahun." and nama_anggaran='Pendapatan Tol' ";
									$result2 = $db->query($query2);
									if (!$result2){
										echo "Query tidak terkoneksi dengan database: " .$db->error;
									}
									else
									{
											while ($row2 = $result2->fetch_object()){
												$ptol=$ptol +$row2->anggaran;
												$id2=$row2->no_anggaran;
											}
									}

									//pendapatan non tol
									$query3 = " SELECT * FROM labarugi where bulan=".$id_bulan." and tahun =".$id_tahun." and nama_anggaran='Pendapatan Non Tol' ";
									$result3 = $db->query($query3);
									if (!$result3){
										echo "Query tidak terkoneksi dengan database: " .$db->error;
									}
									else
									{
											while ($row3 = $result3->fetch_object()){
												$pntol=$pntol +$row3->anggaran;
												$id3=$row3->no_anggaran;
											}
									}
									//pendapatan Usaha
									$pusaha=$ptol+$pntol;

									//gaji dan tunjangan
									$query4 = " SELECT * FROM labarugi where bulan=".$id_bulan." and tahun =".$id_tahun." and nama_anggaran='Gaji dan Tunjangan' ";
									$result4 = $db->query($query4);
									if (!$result4){
										echo "Query tidak terkoneksi dengan database: " .$db->error;
									}
									else
									{
											while ($row4 = $result4->fetch_object()){
												$pgt=$pgt +$row4->anggaran;
												$id4=$row4->no_anggaran;
											}
									}

									//bonus isentif dan pesangon
									$query5 = " SELECT * FROM labarugi where bulan=".$id_bulan." and tahun =".$id_tahun." and nama_anggaran='Bonus Insentif dan Pesangon' ";
									$result5 = $db->query($query5);
									if (!$result5){
										echo "Query tidak terkoneksi dengan database: " .$db->error;
									}
									else
									{
											while ($row5 = $result5->fetch_object()){
												$pbonus=$pbonus +$row5->anggaran;
												$id5=$row5->no_anggaran;
											}
									}

									//kesehatan
									$query6 = " SELECT * FROM labarugi where bulan=".$id_bulan." and tahun =".$id_tahun." and nama_anggaran='Kesehatan' ";
									$result6 = $db->query($query6);
									if (!$result6){
										echo "Query tidak terkoneksi dengan database: " .$db->error;
									}
									else
									{
											while ($row6 = $result6->fetch_object()){
												$pkes=$pkes +$row6->anggaran;
												$id6=$row6->no_anggaran;
											}
									}

									//lembur
									$query7 = " SELECT * FROM labarugi where bulan=".$id_bulan." and tahun =".$id_tahun." and nama_anggaran='Lembur' ";
									$result7 = $db->query($query7);
									if (!$result7){
										echo "Query tidak terkoneksi dengan database: " .$db->error;
									}
									else
									{
											while ($row7 = $result7->fetch_object()){
												$plem=$plem +$row7->anggaran;
												$id7=$row7->no_anggaran;
											}
									}

									//Kesejahteraan lainnya
									$query8 = " SELECT * FROM labarugi where bulan=".$id_bulan." and tahun =".$id_tahun." and nama_anggaran='Kesejahteraan Lainnya' ";
									$result8 = $db->query($query8);
									if (!$result8){
										echo "Query tidak terkoneksi dengan database: " .$db->error;
									}
									else
									{
											while ($row8= $result8->fetch_object()){
												$pkeslain=$pkeslain +$row8->anggaran;
												$id8=$row8->no_anggaran;
											}
									}

									//beban SDM
									$pbsdm= $pgt+$pbonus+ $pkes+ $plem+$pkeslain;

									//pengumpulan tol
									$query9 = " SELECT * FROM labarugi where bulan=".$id_bulan." and tahun =".$id_tahun." and nama_anggaran='Pengumpulan Tol' ";
									$result9 = $db->query($query9);
									if (!$result9){
										echo "Query tidak terkoneksi dengan database: " .$db->error;
									}
									else
									{
											while ($row9= $result9->fetch_object()){
												$ppengumpulan=$ppengumpulan +$row9->anggaran;
												$id9=$row9->no_anggaran;
											}
									}

									//pelayanan pemakai jalan tol
									$query10 = " SELECT * FROM labarugi where bulan=".$id_bulan." and tahun =".$id_tahun." and nama_anggaran='Pelayanan Pemakai Jalan Tol' ";
									$result10 = $db->query($query10);
									if (!$result10){
										echo "Query tidak terkoneksi dengan database: " .$db->error;
									}
									else
									{
											while ($row10= $result10->fetch_object()){
												$ppelayanan=$ppelayanan +$row10->anggaran;
												$id10=$row10->no_anggaran;
											}
									}

									//pemeliharaan jalan tol
									$query11 = " SELECT * FROM labarugi where bulan=".$id_bulan." and tahun =".$id_tahun." and nama_anggaran='Pemeliharaan Jalan Tol' ";
									$result11 = $db->query($query11);
									if (!$result11){
										echo "Query tidak terkoneksi dengan database: " .$db->error;
									}
									else
									{
											while ($row11= $result11->fetch_object()){
												$ppemeliharaan=$ppemeliharaan +$row11->anggaran;
												$id11=$row11->no_anggaran;
											}
									}

									//beban Operasi
									$pbebanops=$ppengumpulan+$ppelayanan+$ppemeliharaan;

									//pajak bumi dan Bangunan
									$query12 = " SELECT * FROM labarugi where bulan=".$id_bulan." and tahun =".$id_tahun." and nama_anggaran='Pajak Bumi dan Bangunan' ";
									$result12 = $db->query($query12);
									if (!$result12){
										echo "Query tidak terkoneksi dengan database: " .$db->error;
									}
									else
									{
											while ($row12= $result12->fetch_object()){
												$ppbb=$ppbb +$row12->anggaran;
												$id12=$row12->no_anggaran;
											}
									}

									//penyusutan dan Amortisasi
									$query13 = " SELECT * FROM labarugi where bulan=".$id_bulan." and tahun =".$id_tahun." and nama_anggaran='Penyusutan dan Amortisasi' ";
									$result13 = $db->query($query13);
									if (!$result13){
										echo "Query tidak terkoneksi dengan database: " .$db->error;
									}
									else
									{
											while ($row13= $result13->fetch_object()){
												$ppenyusutan=$ppenyusutan +$row13->anggaran;
												$id13=$row13->no_anggaran;
											}

									}

									//beban umum dan administrasi
									$query14 = " SELECT * FROM labarugi where bulan=".$id_bulan." and tahun =".$id_tahun." and nama_anggaran='Beban Umum dan Administrasi' ";
									$result14 = $db->query($query14);
									if (!$result14){
										echo "Query tidak terkoneksi dengan database: " .$db->error;
									}
									else
									{
											while ($row14= $result14->fetch_object()){
												$pbebanumum=$pbebanumum +$row14->anggaran;
												$id14=$row14->no_anggaran;
											}
									}

									//beban overlay
									$query15 = " SELECT * FROM labarugi where bulan=".$id_bulan." and tahun =".$id_tahun." and nama_anggaran='Beban Overlay' ";
									$result15 = $db->query($query15);
									if (!$result15){
										echo "Query tidak terkoneksi dengan database: " .$db->error;
									}
									else
									{
											while ($row15= $result15->fetch_object()){
												$pbebanoverlay=$pbebanoverlay +$row15->anggaran;
												$id15=$row15->no_anggaran;
											}
									}

									//beban Usaha
									$pbusaha=$pbsdm+$pbebanops+$ppbb+$ppenyusutan+$pbebanumum+$pbebanoverlay;

									//penghasilan bunga
									$query16 = " SELECT * FROM labarugi where bulan=".$id_bulan." and tahun =".$id_tahun." and nama_anggaran='Penghasilan Bunga' ";
									$result16 = $db->query($query16);
									if (!$result16){
										echo "Query tidak terkoneksi dengan database: " .$db->error;
									}
									else
									{
											while ($row16= $result16->fetch_object()){
												$ppbunga=$ppbunga +$row16->anggaran;
												$id16=$row16->no_anggaran;
											}
									}

									//penghasilan lain lain
									$query17 = " SELECT * FROM labarugi where bulan=".$id_bulan." and tahun =".$id_tahun." and nama_anggaran='Penghasilan Lain-Lain' ";
									$result17 = $db->query($query17);
									if (!$result17){
										echo "Query tidak terkoneksi dengan database: " .$db->error;
									}
									else
									{
											while ($row17= $result17->fetch_object()){
												$pplain=$pplain +$row17->anggaran;
												$id17=$row17->no_anggaran;
											}
									}

									//beban lain lain
									$query18 = " SELECT * FROM labarugi where bulan=".$id_bulan." and tahun =".$id_tahun." and nama_anggaran='Beban Lain-Lain' ";
									$result18 = $db->query($query18);
									if (!$result18){
										echo "Query tidak terkoneksi dengan database: " .$db->error;
									}
									else
									{
											while ($row18= $result18->fetch_object()){
												$pbebanlain=$pbebanlain +$row18->anggaran;
												$id18=$row18->no_anggaran;
											}
									}

									//laba usaha
									$labausaha=+($pusaha-$pbusaha)+$ppbunga+$pplain+$pbebanlain;
									//ebtida
									$ebtida=+$ppenyusutan+$pbebanoverlay+$labausaha;
							}
						}
							if(isset($_GET['submit'])){
								echo'<div class="row">';
									echo'<div class="col-lg-12">';
										echo'<div style="border:0px " class="panel panel-default">';
											echo '<div  class="panel-body">';
													echo'<table width="1000px" class="table table-striped table-bordered table-hover" id="dataTables-example" align="center">';
														echo'<th colspan="3" style="text-align:center">'."TABEL LABA RUGI".'</th>';
														echo '<p align="center"><b>'."Bulan=".$_GET['bulan'].'</b></p>';
														echo '<p align="center"><b>'."Tahun=".$_GET['tahun'].'</b></p>';
														echo'<tr>';
															echo'<th style="text-align:center">'."Deskripsi".'</th>';
															echo'<th style="text-align:center">'."Anggaran".'</th>';
															echo'<th style="text-align:center">'."Action".'</th>';
														echo'</tr>';
														echo'<tr>';
															echo'<th>Pendapat Usaha</th>';
															echo'<th style="text-align:right">'."Rp.".$pusaha.'</th>';
															echo'<td style="text-align:right">'."".'</td>';
														echo'</tr>';
														echo'<tr>';
														if($id2==0){
																echo'<td>Pendapatan Tol</td>';
																echo'<td style="text-align:right">'."Data Belum Diisi".'</td>';
																echo'<td style="text-align:right">'."".'</td>';
														}
														else{
															echo'<td>Pendapatan Tol</td>';
															echo'<td style="text-align:right">'."Rp.".$ptol.'</td>';
															echo '<td style="text-align:center"><a href="edit_anggaran.php?id='.$id2.' "class="btn btn-warning btn-sm"><i class="fa fa-edit"></i> Edit</a></td>';
														}
														echo'</tr>';
														echo'<tr>';
														if($id3==0){
															echo'<td>Pendapatan Non Tol</td>';
															echo'<td style="text-align:right">'."Data Belum Diisi".'</td>';
															echo'<td style="text-align:right">'."".'</td>';
														}
														else{
															echo'<td>Pendapatan Non Tol</td>';
															echo'<td style="text-align:right">'."Rp.".$pntol.'</td>';
															echo '<td style="text-align:center"><a href="edit_anggaran.php?id='.$id3.' "class="btn btn-warning btn-sm"><i class="fa fa-edit"></i> Edit</a></td>';
														}
														echo'</tr>';
														echo'<tr>';
															echo'<th>Beban Usaha</th>';
															echo'<th style="text-align:right">'."Rp.".$pbusaha.'</th>';
															echo'<td style="text-align:right">'."".'</td>';
														echo'</tr>';
														echo'<tr>';
															echo'<td>Beban SDM</td>';
															echo'<th style="text-align:right">'."Rp.".$pbsdm.'</th>';
															echo'<td style="text-align:right">'."".'</td>';
														echo'</tr>';
														echo'<tr>';
														if($id4==0){
															echo'<td>Gaji dan Tunjangan</td>';
															echo'<td style="text-align:right">'."Data Belum Diisi".'</td>';
															echo'<td style="text-align:right">'."".'</td>';
														}
														else{
															echo'<td>Gaji dan Tunjangan</td>';
															echo'<td style="text-align:right">'."Rp.".$pgt.'</td>';
															echo '<td style="text-align:center"><a href="edit_anggaran.php?id='.$id4.' "class="btn btn-warning btn-sm"><i class="fa fa-edit"></i> Edit</a></td>';
														}
														echo'</tr>';
														echo'<tr>';
														if($id5==0){
															echo'<td>Bonus Insentif dan Pesangon</td>';
															echo'<td style="text-align:right">'."Data Belum Diisi".'</td>';
															echo'<td style="text-align:right">'."".'</td>';
														}
														else{
															echo'<td>Bonus Insentif dan Pesangon</td>';
															echo'<td style="text-align:right">'."Rp.".$pbonus.'</td>';
															echo '<td style="text-align:center"><a href="edit_anggaran.php?id='.$id5.' "class="btn btn-warning btn-sm"><i class="fa fa-edit"></i> Edit</a></td>';
														}
														echo'</tr>';
														echo'<tr>';
														if($id6==0){
															echo'<td>Kesehatan</td>';
															echo'<td style="text-align:right">'."Data Belum Diisi".'</td>';
															echo'<td style="text-align:right">'."".'</td>';
														}
														else{
															echo'<td>Kesehatan</td>';
															echo'<td style="text-align:right">'."Rp.".$pkes.'</td>';
															echo '<td style="text-align:center"><a href="edit_anggaran.php?id='.$id6.' "class="btn btn-warning btn-sm"><i class="fa fa-edit"></i> Edit</a></td>';
														}
														echo'</tr>';
														echo'<tr>';
														if($id7==0){
															echo'<td>Lembur</td>';
															echo'<td style="text-align:right">'."Data Belum Diisi".'</td>';
															echo'<td style="text-align:right">'."".'</td>';
														}
														else{
															echo'<td>Lembur</td>';
															echo'<td style="text-align:right">'."Rp.".$plem.'</td>';
															echo '<td style="text-align:center"><a href="edit_anggaran.php?id='.$id7.' "class="btn btn-warning btn-sm"><i class="fa fa-edit"></i> Edit</a></td>';
														}
														echo'</tr>';
														echo'<tr>';
														if($id8==0){
															echo'<td>Kesejahteraan Lainnya</td>';
															echo'<td style="text-align:right">'."Data Belum Diisi".'</td>';
															echo'<td style="text-align:right">'."".'</td>';
														}
														else{
															echo'<td>Kesejahteraan Lainnya</td>';
															echo'<td style="text-align:right">'."Rp.".$pkeslain.'</td>';
															echo '<td style="text-align:center"><a href="edit_anggaran.php?id='.$id8.' "class="btn btn-warning btn-sm"><i class="fa fa-edit"></i> Edit</a></td>';
														}
														echo'</tr>';
														echo'<tr>';
															echo'<th>Beban Operasi</th>';
															echo'<th style="text-align:right">'."Rp.".$pbebanops.'</th>';
															echo'<td style="text-align:right">'."".'</td>';
														echo'</tr>';
														echo'<tr>';
														if($id9==0){
															echo'<td>Pengumpulan Tol</td>';
															echo'<td style="text-align:right">'."Data Belum Diisi".'</td>';
															echo'<td style="text-align:right">'."".'</td>';
														}
														else{
															echo'<td>Pengumpulan Tol</td>';
															echo'<td style="text-align:right">'."Rp.".$ppengumpulan.'</td>';
															echo '<td style="text-align:center"><a href="edit_anggaran.php?id='.$id9.' "class="btn btn-warning btn-sm"><i class="fa fa-edit"></i> Edit</a></td>';
														}
														echo'</tr>';
														echo'<tr>';
														if($id10==0){
															echo'<td>Pelayanan Pemakai Jalan Tol</td>';
															echo'<td style="text-align:right">'."Data Belum Diisi".'</td>';
															echo'<td style="text-align:right">'."".'</td>';
														}
														else{
															echo'<td>Pelayanan Pemakai Jalan Tol</td>';
															echo'<td style="text-align:right">'."Rp.".$ppelayanan.'</td>';
															echo '<td style="text-align:center"><a href="edit_anggaran.php?id='.$id10.' "class="btn btn-warning btn-sm"><i class="fa fa-edit"></i> Edit</a></td>';
														}
														echo'</tr>';
														echo'<tr>';
														if($id11==0){
															echo'<td>Pemeliharaan Jalan Tol</td>';
															echo'<td style="text-align:right">'."Data Belum Diisi".'</td>';
															echo'<td style="text-align:right">'."".'</td>';
														}
														else{
															echo'<td>Pemeliharaan Jalan Tol</td>';
															echo'<td style="text-align:right">'."Rp.".$ppemeliharaan.'</td>';
															echo '<td style="text-align:center"><a href="edit_anggaran.php?id='.$id11.' "class="btn btn-warning btn-sm"><i class="fa fa-edit"></i> Edit</a></td>';
														}
														echo'</tr>';
														echo'<tr>';
														if($id12==0){
															echo'<td>Pajak Bumi dan Bangunan</td>';
															echo'<td style="text-align:right">'."Data Belum Diisi".'</td>';
															echo'<td style="text-align:right">'."".'</td>';
														}
														else{
															echo'<th>Pajak Bumi dan Bangunan</th>';
															echo'<th style="text-align:right">'."Rp.".$ppbb.'</th>';
															echo '<td style="text-align:center"><a href="edit_anggaran.php?id='.$id12.' "class="btn btn-warning btn-sm"><i class="fa fa-edit"></i> Edit</a></td>';
														}
														echo'</tr>';
														echo'<tr>';
														if($id13==0){
															echo'<td>Penyusutan dan Amortisasi</td>';
															echo'<td style="text-align:right">'."Data Belum Diisi".'</td>';
															echo'<td style="text-align:right">'."".'</td>';
														}
														else{
															echo'<th>Penyusutan dan Amortisasi</th>';
															echo'<th style="text-align:right">'."Rp.".$ppenyusutan.'</th>';
															echo '<td style="text-align:center"><a href="edit_anggaran.php?id='.$id13.' "class="btn btn-warning btn-sm"><i class="fa fa-edit"></i> Edit</a></td>';
														}
														echo'</tr>';
														echo'<tr>';
														if($id14==0){
															echo'<td>Beban Umum dan Administrasi</td>';
															echo'<td style="text-align:right">'."Data Belum Diisi".'</td>';
															echo'<td style="text-align:right">'."".'</td>';
														}
														else{
															echo'<td>Beban Umum dan Administrasi</td>';
															echo'<th style="text-align:right">'."Rp.".$pbebanumum.'</th>';
															echo '<td style="text-align:center"><a href="edit_anggaran.php?id='.$id14.' "class="btn btn-warning btn-sm"><i class="fa fa-edit"></i> Edit</a></td>';
														}
														echo'</tr>';
														echo'<tr>';
														if($id15==0){
															echo'<td>Beban Overlay</td>';
															echo'<td style="text-align:right">'."Data Belum Diisi".'</td>';
															echo'<td style="text-align:right">'."".'</td>';
														}
														else{
															echo'<th>Beban Overlay</th>';
															echo'<th style="text-align:right">'."Rp.".$pbebanoverlay.'</th>';
															echo '<td style="text-align:center"><a href="edit_anggaran.php?id='.$id15.' "class="btn btn-warning btn-sm"><i class="fa fa-edit"></i> Edit</a></td>';
														}
														echo'</tr>';
														echo'<tr>';
														if($id16==0){
															echo'<td>Penghasilan Bunga</td>';
															echo'<td style="text-align:right">'."Data Belum Diisi".'</td>';
															echo'<td style="text-align:right">'."".'</td>';
														}
														else{
															echo'<td>Penghasilan Bunga</td>';
															echo'<th style="text-align:right">'."Rp.".$ppbunga.'</th>';
															echo '<td style="text-align:center"><a href="edit_anggaran.php?id='.$id16.' "class="btn btn-warning btn-sm"><i class="fa fa-edit"></i> Edit</a></td>';
														}
														echo'</tr>';
														echo'<tr>';
														if($id17==0){
															echo'<td>Penghasilan Lain-Lain</td>';
															echo'<td style="text-align:right">'."Data Belum Diisi".'</td>';
															echo'<td style="text-align:right">'."".'</td>';
														}
														else{
															echo'<td>Penghasilan Lain-Lain</td>';
															echo'<th style="text-align:right">'."Rp.".$pplain.'</th>';
															echo '<td style="text-align:center"><a href="edit_anggaran.php?id='.$id17.' "class="btn btn-warning btn-sm"><i class="fa fa-edit"></i> Edit</a></td>';
														}
														echo'</tr>';
														echo'<tr>';
														if($id18==0){
															echo'<td>Beban Lain-Lain</td>';
															echo'<td style="text-align:right">'."Data Belum Diisi".'</td>';
															echo'<td style="text-align:right">'."".'</td>';
														}
														else{
															echo'<td>Beban Lain-Lain</td>';
															echo'<th style="text-align:right">'."Rp.".$pbebanlain.'</th>';
															echo '<td style="text-align:center"><a href="edit_anggaran.php?id='.$id18.' "class="btn btn-warning btn-sm"><i class="fa fa-edit"></i> Edit</a></td>';
														}
														echo'</tr>';
														echo'<tr>';
															echo'<th>Laba Usaha</th>';
															echo'<th style="text-align:right">'."Rp.".$labausaha.'</th>';
															echo'<td style="text-align:right">'."".'</td>';
														echo'</tr>';
														echo'<tr>';
															echo'<th>Ebtida</th>';
															echo'<th style="text-align:right">'."Rp.".$ebtida.'</th>';
															echo'<td style="text-align:right">'."".'</td>';
														echo'</tr>';
													echo'</table>';
											echo '</div>';
										echo '</div>';
									echo '</div>';
								echo '</div>';

									echo'<div class="col-lg-12">';
												echo '<div style="padding:0px 15px" class="panel-body">';
													echo'<a href="print_anggaran_excel.php?id_bulan='.$id_bulan.' & id_tahun='.$id_tahun.'" class="btn btn-success"> Print Excel </a>';
													echo'<a style="margin:10px 0px" class="btn btn-outline btn-primary btn-block" href="index.php">Kembali</a>';
												echo '</div>';

									echo '</div>';
							echo '</div>';
						}

						?>
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
	</head>
</html>
