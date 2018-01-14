<?php 	

require_once 'core.php';

$valid['success'] = array('success' => false, 'messages' => array());

if($_POST) {	
	
        $cant = $_POST['cantidad'];        
        $id = $_POST['activoID'];
        
	$sql = "UPDATE producto SET cantidad = $cant WHERE codigo_producto = '$id'";
	if($connect->query($sql) === TRUE) {
	 	$valid['success'] = true;
		$valid['messages'] = "Producto editado correctamente";	
	} else {
	 	$valid['success'] = false;
	 	$valid['messages'] = "Error no se ha podido editar";
	}
	 
	$connect->close();

	echo json_encode($valid);
 
} // /if $_POST