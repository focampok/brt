<?php 	

require_once 'core.php';

$valid['success'] = array('success' => false, 'messages' => array());

if($_POST) {	

	$codAdicion = $_POST['brandName'];
        $nombreAdicion = $_POST['brandStatus']; 

	$sql = "INSERT INTO adicion (codigo_adicion,nombre_adicion) VALUES ('$codAdicion','$nombreAdicion')";

	if($connect->query($sql) === TRUE) {
	 	$valid['success'] = true;
		$valid['messages'] = "Adición creada exitosamente.";	
	} else {
	 	$valid['success'] = false;
	 	$valid['messages'] = "Error no se ha podido crear la adición.";
	}
	 

	$connect->close();

	echo json_encode($valid);
 
} // /if $_POST