<?php
//koneksi ke database
$db_host='localhost';
$db_database='pkl';
$db_username='root';
$db_password='';

$db = new mysqli($db_host, $db_username, $db_password, $db_database);
	if ($db->connect_errno){
		die ("Could not connect to the database: <br />". $db->connect_error);
	}

require('fpdf17/fpdf.php');
$id_bulan = $_GET['id_bulan'];
$id_tahun = $_GET['id_tahun'];
$jumlah=0;
$query = " SELECT * FROM labarugi join tipe_anggaran on labarugi.tipe_anggaran =tipe_anggaran.id_tipe where labarugi.bulan=".$id_bulan." and labarugi.tahun =".$id_tahun." ORDER BY labarugi.tipe_anggaran ";
$result = mysqli_query($db,$query);
$query1 = " SELECT * FROM labarugi join tipe_anggaran on labarugi.tipe_anggaran =tipe_anggaran.id_tipe where labarugi.bulan=".$id_bulan." and labarugi.tahun =".$id_tahun." and tipe_anggaran.flag='hitung'";
$result1 = mysqli_query($db,$query1);
	while ($row1 = mysqli_fetch_array($result1)){
		$jumlah=$jumlah +$row1["anggaran"];
	}
$column_bulan = "";
$column_tahun = "";
$column_bulan = $column_bulan.$id_bulan."\n";
$column_tahun = $column_tahun.$id_tahun."\n";
$column_nama_anggaran = "";
$column_tipe_anggaran = "";
$column_anggaran = "";
$column_jumlah = "";
while($row = mysqli_fetch_array($result))
{
		$nama_anggaran = $row["nama_anggaran"];
		$tipe_anggaran = $row["nama_tipe"];
		$anggaran = $row["anggaran"];

		$column_nama_anggaran = $column_nama_anggaran.$nama_anggaran."\n";
		$column_tipe_anggaran = $column_tipe_anggaran.$tipe_anggaran."\n";
		$column_anggaran = $column_anggaran.$anggaran."\n";
}
		$column_jumlah=$column_jumlah.$jumlah."\n";
//Create a new PDF file
ob_start();
$pdf = new FPDF('P','mm',array(210,297)); //L For Landscape / P For Portrait
$pdf->AddPage('P','A4');

//Menambahkan Gambar
$pdf->Image('logo-jm.jpg',10,5,30);

$pdf->SetFont('Arial','B',16);
$pdf->Cell(80);
$pdf->Cell(30,10,'LAPORAN LABA RUGI',0,0,'C');
$pdf->Ln();
$pdf->Cell(80);
$pdf->Cell(30,10,'PT.JASA MARGA (PERSERO) Cabang Semarang',0,0,'C');
$pdf->Ln();
$pdf->SetFont('Arial','B',12);
$pdf->Cell(24,10,'Bulan:',0,0,'C');
$pdf->Cell(15,10,$column_bulan,0,0,'C');
$pdf->Ln();
$pdf->Cell(24,0,'Tahun:',0,0,'C');
$pdf->Cell(15,0,$column_tahun,0,0,'C');
$pdf->Ln();
$pdf->Cell(47,10,'LABA USAHA(Rp):',0,0,'C');
$pdf->Cell(40,10,$column_jumlah,0,0,'C');
$pdf->Ln();
//Fields Name position
$Y_Fields_Name_position = 50;

//First create each Field Name
//Gray color filling each Field Name box
$pdf->SetFillColor(110,180,230);
//Bold Font for Field Name
$pdf->SetFont('Arial','B',10);
$pdf->SetY($Y_Fields_Name_position);
$pdf->SetX(15);
$pdf->Cell(90,5,'URMA',1,0,'C',1);
$pdf->SetX(105);
$pdf->Cell(55,5,'Tipe',1,0,'C',1);
$pdf->SetX(160);
$pdf->Cell(40,5,'Anggaran(Rp)',1,0,'C',1);

//Table position, under Fields Name
$Y_Table_Position = 55;

//Now show the columns
$pdf->SetFont('Arial','',10);

$pdf->SetY($Y_Table_Position);
$pdf->SetX(15);
$pdf->MultiCell(90,6,$column_nama_anggaran,1,'C');

$pdf->SetY($Y_Table_Position);
$pdf->SetX(105);
$pdf->MultiCell(55,6,$column_tipe_anggaran,1,'C');

$pdf->SetY($Y_Table_Position);
$pdf->SetX(160);
$pdf->MultiCell(40,6,$column_anggaran,1,'C');


$pdf->Cell(0,-100,'Halaman '.$pdf->PageNo().'',0,0,'R');
$pdf->Output();
 ob_end_flush();
?>
