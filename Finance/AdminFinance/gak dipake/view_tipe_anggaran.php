<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN"
"http://www.w3.org/TR/html401/loose.dtd">
<html>
  <head>
  <meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
      <title>Displaying in an HTML table</title>
  	<script>
  		function del(){
  			var x=window.confirm("Anda yakin ingin menghapus?");
  			return x;
  		}
  	</script>
  </head>
  <body>
    <h2>Data Tipe Anggaran</h2>
    <p><a href="add_tipe_anggaran.php">  Tambah Tipe Anggaran  </a></p>
    <table border="1">
      <tr>
  	     <th>No</th>
  	     <th>Nama Tipe</th>
         <th>Aksi</th>
      </tr>
      <?php
        // connect database
          require_once('db_login.php');
          $db = new mysqli($db_host, $db_username, $db_password, $db_database);
          if ($db->connect_errno){
            die ("Could not connect to the database: <br />". $db->connect_error);
          }
        //Asign a query
          $query = " SELECT * FROM tipe_anggaran ORDER BY id_tipe ";
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
              	echo '<td>'.$row->nama_tipe.'</td> ';
          	    echo '<td><a href="edit_tipe_anggaran.php?id='.$row->id_tipe.'">  Edit  </a></td>';
          	echo '</tr>';
          	$i++;
          }
          $result->free();
          $db->close();
          ?>
      </table>
  </body>
</html>
