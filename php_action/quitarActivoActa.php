<?php 	

require_once 'core.php';

$valid['success'] = array('success' => false, 'messages' => array());

if($_POST) {	

        //obtengo el codigo la certificacion
	$id = $_POST['codigoInventario'];
        
        //cambio el estado del activo
        $r = "UPDATE activo SET estado = 1 WHERE codigo_inventario = '$id'";
        $connect->query($r);        
        
        //antes de actualizarla, todos sus activos los libero.        
        $sql = "UPDATE activo SET ACTA_codigo_acta = '-1' WHERE codigo_inventario = '$id'";        
	if($connect->query($sql) === TRUE) {
	 	$valid['success'] = true;
		$valid['messages'] = "Activo quitado del acta correctamente.";	
	} else {
	 	$valid['success'] = false;
	 	$valid['messages'] = "Error no se ha podido quitar el activo del acta.";
	}
	 
	$connect->close();

	echo json_encode($valid);
 
} // /if $_POST