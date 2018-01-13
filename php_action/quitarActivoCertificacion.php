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
        $sql = "UPDATE activo SET CERTIFICACION_codigo_certificacion = '-1' WHERE codigo_inventario = '$id'";        
	if($connect->query($sql) === TRUE) {
	 	$valid['success'] = true;
		$valid['messages'] = "Activo quitado de la certificación correctamente.";	
	} else {
	 	$valid['success'] = false;
	 	$valid['messages'] = "Error no se ha podido quitar el activo.";
	}
	 
	$connect->close();

	echo json_encode($valid);
 
} // /if $_POST