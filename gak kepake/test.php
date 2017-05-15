<!--File		: view_customer.php
    Deskripsi	: menampilkan data customers
-->
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN"
"http://www.w3.org/TR/html401/loose.dtd">
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
    <title>Displaying in an HTML table</title>
	<script>
		function del(){
			var x=window.confirm("Are you sure to delete this?");
			return x;
		}
	</script>
</head>
<body>
<h2>Customers Data</h2>
<p><a href="add_customer.php?id='.$row->customerid.'">  Add Customers  </a></p>
<table border="1">
    <tr>
	<th>No</th>
	<th>Name</th>
      <th>Address</th>
	<th>City</th>
	<th>Action</th>
    </tr>

<?php
// connect database
require_once('db_login.php');
$db = new mysqli($db_host, $db_username, $db_password, $db_database);
if ($db->connect_errno){
    die ("Could not connect to the database: <br />". $db->connect_error);
}
//Asign a query
$query = " SELECT * FROM customers ORDER BY customerid ";
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
    	echo '<td>'.$row->name.'</td> ';
	echo '<td>'.$row->address.'</td> ';
    	echo '<td>'.$row->city.'</td>';
	echo '<td><a href="edit_customer.php?id='.$row->customerid.'">  Edit  </a>';
	echo '<a href="detail_customer.php?id='.$row->customerid.'">  Detail  </a>';
	echo '<a href="delete_customer.php?id='.$row->customerid.'" onclick="return del()"">  Delete  </a></td>';
	echo '</tr>';
	$i++;
}
echo '</table>';
echo '<br />';
echo 'Total Rows = '.$result->num_rows;
$result->free();
$db->close();
?>
</table>
</body>
</html>
