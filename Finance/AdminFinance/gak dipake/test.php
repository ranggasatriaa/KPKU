<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN"
"http://www.w3.org/TR/html401/loose.dtd">
<!--php untuk menampilkan dropdown pilihan bulan dan tahun!-->
<html>
	<head>
		<meta charset="utf-8">
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<meta name="description" content="">
		<meta name="author" content="">
		<title>View Laporan Anggaran Laba Rugi</title>
		<!-- Bootstrap Core CSS -->
		<link href="../vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
		<!-- MetisMenu CSS -->
		<link href="../vendor/metisMenu/metisMenu.min.css" rel="stylesheet">
		<!-- DataTables CSS -->
		<link href="../vendor/datatables-plugins/dataTables.bootstrap.css" rel="stylesheet">
		<!-- DataTables Responsive CSS -->
		<link href="../vendor/datatables-responsive/dataTables.responsive.css" rel="stylesheet">
		<!-- Custom CSS -->
		<link href="../dist/css/sb-admin-2.css" rel="stylesheet">
		<!-- Custom Fonts -->
		<link href="../vendor/font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css">
	</head>
	<script>
		function del(){
			var x=window.confirm("Anda yakin ingin menghapus?");
			return x;
		}
	</script>
		<body>
			<h3><center> LAPORAN LABA RUGI	</center></h3>
			<form  method="GET" autocomplete="on">
				<table align="center">
					<tr>
						<td valign="top">Tahun</td>
						<td valign="top">:</td>
						<td valign="top"><select class="form-control" name="tahun">
							<?php
								require_once('db_login.php');
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
				<a href="add_anggaran.php" class="btn btn-info"> Tambah Laporan Anggaran </a>
			</form>
		</body>
	</head>
</html>

<!--php untuk menampilkan tabel!-->

<?php
	require_once('db_login.php');
	$db = new mysqli($db_host, $db_username, $db_password, $db_database);
	if ($db->connect_errno){
		die ("Could not connect to the database: <br />". $db->connect_error);
	}

	//kondisi kalau submit bulan dan tahun
	if(isset($_GET['submit'])){ //klo udah ngeklik bulan dan tahunnya
		if($_GET['tahun']==''){
		echo("<center>Masukkan bulan dan tahun terlebih dahulu</center>");
	}
	else{
		$id_tahun = $_GET['tahun'];
		$jumlah=0;
		$jumlah1=0;
		//Asign a query
		$query = " SELECT * FROM labarugi join tipe_anggaran on labarugi.tipe_anggaran =tipe_anggaran.id_tipe where  labarugi.tahun =".$id_tahun." ORDER BY labarugi.tipe_anggaran ";
		$result = $db->query($query);

		$query2 = " SELECT * FROM labarugi join tipe_anggaran on labarugi.tipe_anggaran =tipe_anggaran.id_tipe where labarugi.tahun =".$id_tahun." ORDER BY labarugi.tipe_anggaran ";
		$result2 = $db->query($query2);

		if (!$result){
			echo "Query tidak terkoneksi dengan database: " .$db->error;
		}
		else
		{
				$query1 = " SELECT * FROM labarugi join tipe_anggaran on labarugi.tipe_anggaran =tipe_anggaran.id_tipe where labarugi.tahun =".$id_tahun." ";
				$result1 = $db->query($query1);
				if (!$result1){
					echo "Query tidak terkoneksi dengan database: " .$db->error;
				}
				else{
					while ($row1 = $result1->fetch_object()){
						$jumlah=$jumlah +$row1->anggaran;
					}
				}
				while ($row2 = $result2->fetch_object()){
					$jumlah1=$jumlah1 +$row2->anggaran;
				}
				if($jumlah1==0){
					echo"<p align='center'> Data Tidak Tersedia</p>";
				}else{
				echo '<p align="center"><b>'."Tahun=".$_GET['tahun'].'</b></p>';
				echo'<br>';
					echo'<div class="row">';
						echo'<div class="col-lg-12">';
							echo'<div class="panel panel-default">';
								echo '<div class="panel-body">';
									echo'<table width="100%" class="table table-striped table-bordered table-hover" id="dataTables-example">';
										echo'<th> URMA	</th>';
										echo'<th> Tipe	</th>';
										echo'<th> Actual	</th>';
										echo'<th> Bulan	</th>';
										echo'<th colspan="2"> Option	</th>';
										while ($row = $result->fetch_object()){
											echo '<tr>';
													echo '<td>'.$row->nama_anggaran.'</td>';
												echo '<td>'.$row->nama_tipe.'</td>';
												echo '<td>'."Rp.". $row->anggaran.'</td>';
												echo '<td>'.$row->bulan.'</td>';
												echo '<td colspan="2"><a href="edit_anggaran.php?id='.$row->no_anggaran.' "class="fa fa-edit">Edit</a>';
												echo '<a href="delete_anggaran.php?id='.$row->no_anggaran.'"class="fa fa-eraser" onclick="return del()"> Delete</a></td>';
											echo '</tr>';
										}
											echo '<tr>';
												echo'<td colspan="2"> LABA USAHA </td>';
												echo '<td colspan="3">'."Rp.".$jumlah.'</td>';
											echo '</tr>';
										}
								echo '</table>';
							echo '</div>';
						echo '</div>';
					echo '</div>';
				echo '</div>';
				echo'<div class="row">';
					echo'<div class="col-lg-12">';
						echo'<div class="panel panel-default">';
							echo '<div class="panel-body">';
									echo'</p>';
								echo'<a href="print_anggaran_pdf.php?id_bulan='.$id_bulan.'&id_tahun='.$id_tahun.'"class="btn btn-warning"> Print PDF </a>';
								echo'<a href="print_anggaran_excel.php?id_bulan='.$id_bulan.'&id_tahun='.$id_tahun.'" class="btn btn-success"> Print Excel </a>';
								echo'</p>';
							echo '</div>';
						echo '</div>';
					echo '</div>';
				echo '</div>';
			}
			$result->free();
			$db->close();
		}
	}

?>
		</body>
</html>
