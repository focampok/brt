<?php 	

require_once 'core.php';

$valid['success'] = array('success' => false, 'messages' => array());

if($_POST) {
        $nombreAdicion = $_POST['editBrandStatus']; 
        $id = $_POST['brandId'];

	$sql = "UPDATE adicion SET nombre_adicion = '$nombreAdicion' WHERE codigo_adicion = '$id'";

	if($connect->query($sql) === TRUE) {
	 	$valid['success'] = true;
		$valid['messages'] = "Adición editada exitosamente";	
	} else {
	 	$valid['success'] = false;
	 	$valid['messages'] = "Error no se ha podido editar";
	}
	 
	$connect->close();

	echo json_encode($valid);
 
} // /if $_POST