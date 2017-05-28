<?php
  require_once ('../config.php');
  require_once ('maintenance/PHPWord/PHPWord.php');

  // New Word Document
  $PHPWord = new PHPWord();

  // New portrait section
  $section = $PHPWord->createSection();

  $tanggal		= $_GET['tanggal'];
  $tanggaldmy = date('Y-m-d', strtotime($tanggal));

  $db=new mysqli($db_host,$db_username,$db_password,$db_database);
  if($db->connect_errno){
    die("Tidak dapat terkoneksi dengan database: </br>". $db->connect_errno);
  }
    // query penampil kerusakan
    $query_kerusakan = "SELECT * FROM inspeksi
              LEFT JOIN petugas ON inspeksi.npp=petugas.npp
              LEFT JOIN jenis_inspeksi ON inspeksi.idjenis_inspeksi=jenis_inspeksi.idjenis_inspeksi
              LEFT JOIN jenis_kerusakan ON inspeksi.idjenis_kerusakan=jenis_kerusakan.idjenis_kerusakan
              WHERE waktu_kerusakan='$tanggal'";
    // Execute the query kerusakan
    $result_k = $db->query($query_kerusakan);
    // query penampil perbaikan
    $query_perbaikan = "SELECT * FROM inspeksi
              LEFT JOIN petugas ON inspeksi.npp=petugas.npp
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
      if(!$jumlah_k==0){
        //top text
        $fontStyle      = array('bold'=>true, 'size'=>16);
        $paragraphStyle = array('align'=>'center', 'spaceAfter'=>100);
        $section->addText('Kerusakan pada tanggal '.$tanggaldmy, $fontStyle, $paragraphStyle);
        //table style
        $styleTable = array( 'cellMargin'=>0);
        $menuStyle  = array('bold'=>true, 'align'=>'center');
        $styleCell  = array('valign'=>'center');

        $PHPWord->addTableStyle('TableStyle', $styleTable, null);

        while ($row_k = $result_k->fetch_object()){
          $table = $section->addTable('TableStyle');
          if ($row_k->status==1){
            $table->addRow();
              $table->addCell(4000, $styleCell)->addImage('maintenance/'.$row_k->direktori_kerusakan, array('width'=>200, 'height'=>170, 'align'=>'center'));
              $table->addCell(200, $styleCell);
              $table->addCell(4000, $styleCell)->addImage('maintenance/'.$row_k->direktori_perbaikan, array('width'=>200, 'height'=>170, 'align'=>'center'));
            $table->addRow();
              $table->addCell(4000, $styleCell)->addText('Kondisi Sebelum Diperbaiki ('.$row_k->waktu_kerusakan.')', $menuStyle);
              $table->addCell(200, $styleCell);
              $table->addCell(4000, $styleCell)->addText('Kondisi Setelah Diperbaiki ('.$row_k->waktu_perbaikan.')', $menuStyle);
          }else{
            $table->addRow();
              $table->addCell(4000, $styleCell)->addImage('maintenance/'.$row_k->direktori_kerusakan, array('width'=>200, 'height'=>200, 'align'=>'center'));
              $table->addCell(200, $styleCell);
              $table->addCell(4000, $styleCell);
            $table->addRow();
              $table->addCell(4000, $styleCell)->addText('Kondisi Sebelum Diperbaiki ('.$row_k->waktu_kerusakan.')', $menuStyle);
              $table->addCell(200, $styleCell);
              $table->addCell(4000, $styleCell)->addText('Belum Diperbaiki', $menuStyle);
          }
          $table->addRow();
            $table->addCell(4000, $styleCell)->addText('Id Inspeksi', $menuStyle);
            $table->addCell(200, $styleCell)->addText(':', $menuStyle);
            $table->addCell(4000, $styleCell)->addText($row_k->idinspeksi);
          $table->addRow();
            $table->addCell(4000, $styleCell)->addText('Petugas Pelapor', $menuStyle);
            $table->addCell(200, $styleCell)->addText(':', $menuStyle);
            $table->addCell(4000, $styleCell)->addText($row_k->nama);
          $table->addRow();
            $table->addCell(4000, $styleCell)->addText('Jenis Inspeksi', $menuStyle);
            $table->addCell(200, $styleCell)->addText(':', $menuStyle);
            $table->addCell(4000, $styleCell)->addText($row_k->nama_inspeksi);
          $table->addRow();
            $table->addCell(4000, $styleCell)->addText('Jenis Kerusakan', $menuStyle);
            $table->addCell(200, $styleCell)->addText(':', $menuStyle);
            $table->addCell(4000, $styleCell)->addText($row_k->nama_kerusakan);
          $table->addRow();
            $table->addCell(4000, $styleCell)->addText('Keterangan', $menuStyle);
            $table->addCell(200, $styleCell)->addText(':', $menuStyle);
            $table->addCell(4000, $styleCell)->addText($row_k->keterangan);
          $table->addRow();
            $table->addCell(4000, $styleCell)->addText('Lokasi', $menuStyle);
            $table->addCell(200, $styleCell)->addText(':', $menuStyle);
            $table->addCell(4000, $styleCell)->addText($row_k->lokasi);
          $table->addRow();
            $table->addCell(4000, $styleCell);
            $table->addCell(200, $styleCell);
            $table->addCell(4000, $styleCell);

        }
      }
      // close if !jumlah_k==0
      if(!$jumlah_p==0){
        $section->addPageBreak();
        //top text
        $fontStyle      = array('bold'=>true, 'size'=>16);
        $paragraphStyle = array('align'=>'center', 'spaceAfter'=>100);
        $section->addText('Perbaikan pada tanggal '.$tanggaldmy, $fontStyle, $paragraphStyle);
        //table style
        $styleTable = array( 'cellMargin'=>0);
        $menuStyle  = array('bold'=>true, 'align'=>'center');
        $styleCell  = array('valign'=>'center');

        $PHPWord->addTableStyle('TableStyle', $styleTable, null);

        while ($row_p = $result_p->fetch_object()){
          $table = $section->addTable('TableStyle');
          $table->addRow();
            $table->addCell(4000, $styleCell)->addImage('maintenance/'.$row_p->direktori_kerusakan, array('width'=>200, 'height'=>170, 'align'=>'center'));
            $table->addCell(200, $styleCell);
            $table->addCell(4000, $styleCell)->addImage('maintenance/'.$row_p->direktori_perbaikan, array('width'=>200, 'height'=>170, 'align'=>'center'));
          $table->addRow();
            $table->addCell(4000, $styleCell)->addText('Kondisi Sebelum Diperbaiki ('.$row_p->waktu_kerusakan.')', $menuStyle);
            $table->addCell(200, $styleCell);
            $table->addCell(4000, $styleCell)->addText('Kondisi Setelah Diperbaiki ('.$row_p->waktu_perbaikan.')', $menuStyle);
          $table->addRow();
            $table->addCell(4000, $styleCell)->addText('Id Inspeksi', $menuStyle);
            $table->addCell(200, $styleCell)->addText(':', $menuStyle);
            $table->addCell(4000, $styleCell)->addText($row_p->idinspeksi);
          $table->addRow();
            $table->addCell(4000, $styleCell)->addText('Petugas Pelapor', $menuStyle);
            $table->addCell(200, $styleCell)->addText(':', $menuStyle);
            $table->addCell(4000, $styleCell)->addText($row_p->nama);
          $table->addRow();
            $table->addCell(4000, $styleCell)->addText('Jenis Inspeksi', $menuStyle);
            $table->addCell(200, $styleCell)->addText(':', $menuStyle);
            $table->addCell(4000, $styleCell)->addText($row_p->nama_inspeksi);
          $table->addRow();
            $table->addCell(4000, $styleCell)->addText('Jenis Kerusakan', $menuStyle);
            $table->addCell(200, $styleCell)->addText(':', $menuStyle);
            $table->addCell(4000, $styleCell)->addText($row_p->nama_kerusakan);
          $table->addRow();
            $table->addCell(4000, $styleCell)->addText('Keterangan', $menuStyle);
            $table->addCell(200, $styleCell)->addText(':', $menuStyle);
            $table->addCell(4000, $styleCell)->addText($row_p->keterangan);
          $table->addRow();
            $table->addCell(4000, $styleCell)->addText('Lokasi', $menuStyle);
            $table->addCell(200, $styleCell)->addText(':', $menuStyle);
            $table->addCell(4000, $styleCell)->addText($row_p->lokasi);
          $table->addRow();
            $table->addCell(4000, $styleCell);
            $table->addCell(200, $styleCell);
            $table->addCell(4000, $styleCell);
        }
      }
      // close if !jumlah_p==0
    }


    $objWriter = PHPWord_IOFactory::createWriter($PHPWord, 'Word2007');

    $filename = 'Inspeksi '.$tanggaldmy.'.docx';

    $objWriter->save($filename);

    header('Content-Description: File Transfer');
    header('Content-Type: application/octet-stream');
    header('Content-Disposition: attachment; filename='.$filename);
    header('Content-Transfer-Encoding: binary');
    header('Expires: 0');
    header('Cache-Control: must-revalidate, post-check=0, pre-check=0');
    header('Pragma: public');
    header('Content-Length: ' . filesize($filename));
    flush();
    readfile($filename);
    unlink($filename); // deletes the temporary file
    exit;
?>
