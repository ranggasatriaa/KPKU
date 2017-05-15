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

// Fungsi header dengan mengirimkan raw data excel
header("Content-type: application/vnd-ms-excel");

// Mendefinisikan nama file ekspor "hasil-export.xls"
header("Content-Disposition: attachment; filename=laporanlabarugi.xls");

// Tambahkan table
require_once('../../config.php');
$db = new mysqli($db_host, $db_username, $db_password, $db_database);
if ($db->connect_errno){
  die ("Could not connect to the database: <br />". $db->connect_error);
}
$id_bulan = $_GET['id_bulan'];
$id_tahun = $_GET['id_tahun'];
$pusaha=0; $ptol=0; $pntol=0;
$pbusaha=0;
$pbsdm=0; $pgt=0; $pbonus=0; $pkes=0; $plem=0;$pkeslain=0;
$pbebanops=0; $ppengumpulan=0; $ppelayanan=0; $ppemeliharaan=0;
$ppbb=0; $ppenyusutan=0; $pbebanumum=0;
$pbebanoverlay=0;
$ppbunga=0; $pplain=0; $pbebanlain=0;
$labausaha=0;
$ebtida=0;
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
    }
}

//bonus isentif dan pesangon
$query4 = " SELECT * FROM labarugi where bulan=".$id_bulan." and tahun =".$id_tahun." and nama_anggaran='Bonus Insentif dan Pesangon' ";
$result4 = $db->query($query4);
if (!$result4){
  echo "Query tidak terkoneksi dengan database: " .$db->error;
}
else
{
    while ($row4 = $result4->fetch_object()){
      $pbonus=$pbonus +$row4->anggaran;
    }
}

//kesehatan
$query5 = " SELECT * FROM labarugi where bulan=".$id_bulan." and tahun =".$id_tahun." and nama_anggaran='Kesehatan' ";
$result5 = $db->query($query5);
if (!$result5){
  echo "Query tidak terkoneksi dengan database: " .$db->error;
}
else
{
    while ($row5 = $result5->fetch_object()){
      $pkes=$pkes +$row5->anggaran;
    }
}

//lembur
$query6 = " SELECT * FROM labarugi where bulan=".$id_bulan." and tahun =".$id_tahun." and nama_anggaran='Lembur' ";
$result6 = $db->query($query6);
if (!$result6){
  echo "Query tidak terkoneksi dengan database: " .$db->error;
}
else
{
    while ($row6 = $result6->fetch_object()){
      $plem=$plem +$row6->anggaran;
    }
}

//Kesejahteraan lainnya
$query7 = " SELECT * FROM labarugi where bulan=".$id_bulan." and tahun =".$id_tahun." and nama_anggaran='Kesejahteraan Lainnya' ";
$result7 = $db->query($query7);
if (!$result7){
  echo "Query tidak terkoneksi dengan database: " .$db->error;
}
else
{
    while ($row7= $result7->fetch_object()){
      $pkeslain=$pkeslain +$row7->anggaran;
    }
}

//beban SDM
$pbsdm= $pgt+$pbonus+ $pkes+ $plem+$pkeslain;

//pengumpulan tol
$query8 = " SELECT * FROM labarugi where bulan=".$id_bulan." and tahun =".$id_tahun." and nama_anggaran='Pengumpulan Tol' ";
$result8 = $db->query($query8);
if (!$result8){
  echo "Query tidak terkoneksi dengan database: " .$db->error;
}
else
{
    while ($row8= $result8->fetch_object()){
      $ppengumpulan=$ppengumpulan +$row8->anggaran;
    }
}

//pelayanan pemakai jalan tol
$query9 = " SELECT * FROM labarugi where bulan=".$id_bulan." and tahun =".$id_tahun." and nama_anggaran='Pelayanan Pemakai Jalan Tol' ";
$result9 = $db->query($query9);
if (!$result9){
  echo "Query tidak terkoneksi dengan database: " .$db->error;
}
else
{
    while ($row9= $result9->fetch_object()){
      $ppelayanan=$ppelayanan +$row9->anggaran;
    }
}

//pemeliharaan jalan tol
$query10 = " SELECT * FROM labarugi where bulan=".$id_bulan." and tahun =".$id_tahun." and nama_anggaran='Pemeliharaan Jalan Tol' ";
$result10 = $db->query($query10);
if (!$result10){
  echo "Query tidak terkoneksi dengan database: " .$db->error;
}
else
{
    while ($row10= $result10->fetch_object()){
      $ppemeliharaan=$ppemeliharaan +$row10->anggaran;
    }
}

//beban Operasi
$pbebanops=$ppengumpulan+$ppelayanan+$ppemeliharaan;

//pajak bumi dan Bangunan
$query11 = " SELECT * FROM labarugi where bulan=".$id_bulan." and tahun =".$id_tahun." and nama_anggaran='Pajak Bumi dan Bangunan' ";
$result11 = $db->query($query11);
if (!$result11){
  echo "Query tidak terkoneksi dengan database: " .$db->error;
}
else
{
    while ($row11= $result11->fetch_object()){
      $ppbb=$ppbb +$row11->anggaran;
    }
}

//penyusutan dan Amortisasi
$query12 = " SELECT * FROM labarugi where bulan=".$id_bulan." and tahun =".$id_tahun." and nama_anggaran='Penyusutan dan Amortisasi' ";
$result12 = $db->query($query12);
if (!$result12){
  echo "Query tidak terkoneksi dengan database: " .$db->error;
}
else
{
    while ($row12= $result12->fetch_object()){
      $ppenyusutan=$ppenyusutan +$row12->anggaran;
    }

}

//beban umum dan administrasi
$query13 = " SELECT * FROM labarugi where bulan=".$id_bulan." and tahun =".$id_tahun." and nama_anggaran='Beban Umum dan Administrasi' ";
$result13 = $db->query($query13);
if (!$result13){
  echo "Query tidak terkoneksi dengan database: " .$db->error;
}
else
{
    while ($row13= $result13->fetch_object()){
      $pbebanumum=$pbebanumum +$row13->anggaran;
    }
}

//beban overlay
$query14 = " SELECT * FROM labarugi where bulan=".$id_bulan." and tahun =".$id_tahun." and nama_anggaran='Beban Overlay' ";
$result14 = $db->query($query14);
if (!$result14){
  echo "Query tidak terkoneksi dengan database: " .$db->error;
}
else
{
    while ($row14= $result14->fetch_object()){
      $pbebanoverlay=$pbebanoverlay +$row14->anggaran;
    }
}

//beban Usaha
$pbusaha=$pbsdm+$pbebanops+$ppbb+$ppenyusutan+$pbebanumum+$pbebanoverlay;

//penghasilan bunga
$query15 = " SELECT * FROM labarugi where bulan=".$id_bulan." and tahun =".$id_tahun." and nama_anggaran='Penghasilan Bunga' ";
$result15 = $db->query($query15);
if (!$result15){
  echo "Query tidak terkoneksi dengan database: " .$db->error;
}
else
{
    while ($row15= $result15->fetch_object()){
      $ppbunga=$ppbunga +$row15->anggaran;
    }
}

//penghasilan lain lain
$query16 = " SELECT * FROM labarugi where bulan=".$id_bulan." and tahun =".$id_tahun." and nama_anggaran='Penghasilan Lain-Lain' ";
$result16 = $db->query($query16);
if (!$result16){
  echo "Query tidak terkoneksi dengan database: " .$db->error;
}
else
{
    while ($row16= $result16->fetch_object()){
      $pplain=$pplain +$row16->anggaran;
    }
}

//beban lain lain
$query17 = " SELECT * FROM labarugi where bulan=".$id_bulan." and tahun =".$id_tahun." and nama_anggaran='Beban Lain-Lain' ";
$result17 = $db->query($query17);
if (!$result17){
  echo "Query tidak terkoneksi dengan database: " .$db->error;
}
else
{
    while ($row17= $result17->fetch_object()){
      $pbebanlain=$pbebanlain +$row17->anggaran;
    }
}

//laba usaha
$labausaha=+($pusaha-$pbusaha)+$ppbunga+$pplain+$pbebanlain;
//ebtida
$ebtida=+$ppenyusutan+$pbebanoverlay+$labausaha;
echo'<table class="table table-bordered" align="center">';
echo'<th colspan="2" style="text-align:center">'."TABEL LABA RUGI".'</th>';
echo'<tr>';
echo'<th style="text-align:center">'."Deskripsi".'</th>';
echo'<th style="text-align:center">'."Anggaran".'</th>';
echo'</tr>';
echo'<tr>';
echo'<th>Pendapat Usaha</th>';
echo'<th style="text-align:right">'.$pusaha.'</th>';
echo'</tr>';
echo'<tr>';
echo'<td>Pendapatan Tol</td>';
echo'<td style="text-align:right">'.$ptol.'</td>';
echo'</tr>';
echo'<tr>';
echo'<td>Pendapatan Non Tol</td>';
echo'<td style="text-align:right">'.$pntol.'</td>';
echo'</tr>';

echo'<tr>';
echo'<th>Beban Usaha</th>';
echo'<th style="text-align:right">'.$pbusaha.'</th>';
echo'</tr>';
echo'<tr>';
echo'<td>Beban SDM</td>';
echo'<th style="text-align:right">'.$pbsdm.'</th>';
echo'</tr>';
echo'<tr>';
echo'<td>Gaji dan Tunjangan</td>';
echo'<td style="text-align:right">'.$pgt.'</td>';
echo'</tr>';
echo'<tr>';
echo'<td>Bonus Insentif dan Pesangon</td>';
echo'<td style="text-align:right">'.$pbonus.'</td>';
echo'</tr>';
echo'<tr>';
echo'<td>Kesehatan</td>';
echo'<td style="text-align:right">'.$pkes.'</td>';
echo'</tr>';
echo'<tr>';
echo'<td>Lembur</td>';
echo'<td style="text-align:right">'.$plem.'</td>';
echo'</tr>';
echo'<tr>';
echo'<td>Kesejahteraan Lainnya</td>';
echo'<td style="text-align:right">'.$pkeslain.'</td>';
echo'</tr>';
echo'<tr>';
echo'<th>Beban Operasi</th>';
echo'<th style="text-align:right">'.$pbebanops.'</th>';
echo'</tr>';
echo'<tr>';
echo'<td>Pengumpulan Tol</td>';
echo'<td style="text-align:right">'.$ppengumpulan.'</td>';
echo'</tr>';
echo'<tr>';
echo'<td>Pelayanan Pemakai Jalan Tol</td>';
echo'<td style="text-align:right">'.$ppelayanan.'</td>';
echo'</tr>';
echo'<tr>';
echo'<td>Pemeliharaan Jalan Tol</td>';
echo'<td style="text-align:right">'.$ppemeliharaan.'</td>';
echo'</tr>';
echo'<tr>';
echo'<th>Pajak Bumi dan Bangunan</th>';
echo'<th style="text-align:right">'.$ppbb.'</th>';
echo'</tr>';
echo'<tr>';
echo'<th>Penyusutan dan Amortisasi</th>';
echo'<th style="text-align:right">'.$ppenyusutan.'</th>';
echo'</tr>';
echo'<tr>';
echo'<td>Beban Umum dan Administrasi</td>';
echo'<th style="text-align:right">'.$pbebanumum.'</th>';
echo'</tr>';
echo'<tr>';
echo'<th>Beban Overlay</th>';
echo'<th style="text-align:right">'.$pbebanoverlay.'</th>';
echo'</tr>';
echo'<tr>';
echo'<td>Penghasilan Bunga</td>';
echo'<th style="text-align:right">'.$ppbunga.'</th>';
echo'</tr>';
echo'<tr>';
echo'<td>Penghasilan Lain-Lain</td>';
echo'<th style="text-align:right">'.$pplain.'</th>';
echo'</tr>';
echo'<tr>';
echo'<td>Beban Lain-Lain</td>';
echo'<th style="text-align:right">'.$pbebanlain.'</th>';
echo'</tr>';
echo'<tr>';
echo'<th>Laba Usaha</th>';
echo'<th style="text-align:right">'.$labausaha.'</th>';
echo'</tr>';
echo'<th>Ebtida</th>';
echo'<th style="text-align:right">'.$ebtida.'</th>';
echo'</tr>';
echo'</table>';

?>
