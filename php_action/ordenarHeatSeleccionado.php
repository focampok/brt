<?php 	

require_once 'core.php';
$id = $_POST['brandId'];
$sql = "SELECT * FROM HEAT WHERE codigoHEAT = '$id'";
$result = $connect->query($sql);

if($result->num_rows > 0) { 
 $row = $result->fetch_array();
} // if num_rows

$connect->close();

echo json_encode($row);