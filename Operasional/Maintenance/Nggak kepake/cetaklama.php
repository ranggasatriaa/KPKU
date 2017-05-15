<?php
  require_once ('../../config.php');
  // Fungsi header dengan mengirimkan raw data excel
	header("Content-type: application/vnd-ms-word");

// Mendefinisikan nama file ekspor "hasil-export.xls"
	header("Content-Disposition: attachment; filename=laporan.doc");

  // $docx = new Phpdocx\Create\CreateDocx();
  // $text = 'Phpdocx. Easily create Word and PDF document online';
  // $docx->addText($text);
  // $docx->createDocx('tutorial_2');

  $tanggal		= $_GET['tanggal'];
  $tanggaldmy = date('Y-m-d', strtotime($tanggal));
  $jumlah			= 0;

  // // Fungsi header dengan mengirimkan raw data word
  // header("Content-type: application/vnd-ms-word");
  //
  // // Mendefinisikan nama file ekspor
  // header("Content-Disposition: attachment; filename=Laporan Inspeksi '.$tanggaldmy.'.doc");

  // header('Content-Disposition: attachment; filename="'. $tanggaldmy.'.'.$this->_extension.'"');
  // header('Content-Type: application/vnd.openxmlformats-officedocument.'.'wordprocessingml.document');
  // header('Content-Transfer-Encoding: binary');
  // header('Content-Length: '.filesize($fileName.'.'.$this->_extension));
  // readfile($fileName.'.'.$this->_extension);

  $db=new mysqli($db_host,$db_username,$db_password,$db_database);
  if($db->connect_errno){
    die("Tidak dapat terkoneksi dengan database: </br>". $db->connect_errno);
  }
    // query penampil kerusakan
    $query_kerusakan = "SELECT * FROM inspeksi
              LEFT JOIN petugas ON inspeksi.idpetugas=petugas.idpetugas
              LEFT JOIN jenis_inspeksi ON inspeksi.idjenis_inspeksi=jenis_inspeksi.idjenis_inspeksi
              LEFT JOIN jenis_kerusakan ON inspeksi.idjenis_kerusakan=jenis_kerusakan.idjenis_kerusakan
              WHERE waktu_kerusakan='$tanggal'";
    // Execute the query kerusakan
    $result_k = $db->query($query_kerusakan);
    // query penampil perbaikan
    $query_perbaikan = "SELECT * FROM inspeksi
              LEFT JOIN petugas ON inspeksi.idpetugas=petugas.idpetugas
              LEFT JOIN jenis_inspeksi ON inspeksi.idjenis_inspeksi=jenis_inspeksi.idjenis_inspeksi
              LEFT JOIN jenis_kerusakan ON inspeksi.idjenis_kerusakan=jenis_kerusakan.idjenis_kerusakan
              WHERE waktu_perbaikan='$tanggal'";
    // Execute the query perbaikan
    $result_p = $db->query($query_perbaikan);
    if (!$result_k || !$result_p){
      die ("Could not query the database: <br />". $db->error);
    }else{
      $jumlah_k = $result_k->num_rows;
      $jumlah_p = $result_p->num_rows;
      if($jumlah_k==0 && $jumlah_p==0){
        die ('<br/><div class="alert alert-danger" style="font-size:150%; text-align:center">Tidak ada inspeksi pada tanggal '.$tanggaldmy.'</div>
        <a class="btn btn-outline btn-primary btn-block" href="index.php">Kembali</a>');
      }elseif(!$jumlah_k==0){
        echo '<h3 align="center">Kerusakan pada tanggal '.$tanggaldmy.'</h3>';
        echo '<table border=1px>';
        while ($row_k = $result_k->fetch_object()){
          echo '<tr>';
            echo '<td rowspan="5">';
            // echo '<w:pict>';
            //   echo '<v:shapetype id="_x0000_t75">';
            //   echo '</v:shapetype>';
            //   echo '<w:binData w:name="wordml://"';
            // echo '</w:pic>';
            echo '<img width="200px" src="'.$row_k->direktori_kerusakan.'">';
            echo '</td>';
            echo '<th>Id Inspeksi</th>';
            echo '<th>:</th>';
            echo '<td>'.$row_k->idinspeksi.'</td>';
          echo '</tr>';
          echo '<tr>';
            echo '<th>Jenis Inspeksi</th>';
            echo '<th>:</th>';
            echo '<td>'.$row_k->nama_inspeksi.'</td>';
          echo '</tr>';
          echo '<tr>';
            echo '<th>Jenis Kerusakan</th>';
            echo '<th>:</th>';
            echo '<td>'.$row_k->nama_kerusakan.'</td>';
          echo '</tr>';
          echo '<tr>';
            echo '<th>Lokasi Inspeksi</th>';
            echo '<th>:</th>';
            echo '<td>'.$row_k->lokasi.'</td>';
          echo '</tr>';
          echo '<tr>';
            echo '<th>Petugas Pelapor</th>';
            echo '<th>:</th>';
            echo '<td>'.$row_k->nama.'</td>';
          echo '</tr>';
          echo '<tr><td colspan="4"></td></tr>';
        }
        echo '</table>';
      }
      // close if !jumlah_k==0
      if(!$jumlah_p==0){
        echo '<h3 align="center">Perbaikan pada tanggal '.$tanggaldmy.'</h3>';
        echo '<table class="table">';
        while ($row_p = $result_p->fetch_object()){
          echo '<tr>';
          echo '<td rowspan="5"><img width="200px" src="'.$row_p->direktori_kerusakan.'"></td>';
            echo '<th>Id Inspeksi</th>';
            echo '<th>:</th>';
            echo '<td>'.$row_p->idinspeksi.'</td>';
          echo '</tr>';
          echo '<tr>';
            echo '<th>Jenis Inspeksi</th>';
            echo '<th>:</th>';
            echo '<td>'.$row_p->nama_inspeksi.'</td>';
          echo '</tr>';
          echo '<tr>';
            echo '<th>Jenis Kerusakan</th>';
            echo '<th>:</th>';
            echo '<td>'.$row_p->nama_kerusakan.'</td>';
          echo '</tr>';
          echo '<tr>';
            echo '<th>Lokasi Inspeksi</th>';
            echo '<th>:</th>';
            echo '<td>'.$row_p->lokasi.'</td>';
          echo '</tr>';
          echo '<tr>';
            echo '<th>Petugas Pelapor</th>';
            echo '<th>:</th>';
            echo '<td>'.$row_p->nama.'</td>';
          echo '</tr>';
          echo '<tr><td colspan="4"></td></tr>';
        }
        echo '</table>';
      }
      // close if !jumlah_p==0

    }
?>
