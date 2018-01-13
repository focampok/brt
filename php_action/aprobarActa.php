<?php 	

require_once 'core.php';

$valid['success'] = array('success' => false, 'messages' => array());

if($_POST) {	

        //obtengo el codigo la certificacion
	$codigoActa = $_POST['codigoActa']; 
        
        //cambio el estado del activo.
        $r = "UPDATE activo SET estado = 0 WHERE ACTA_codigo_acta = '$codigoActa'";
        $connect->query($r); 
        
        //antes de actualizarla, todos sus activos los libero.        
        $s = "UPDATE activo SET ACTA_codigo_acta = '-1' WHERE ACTA_codigo_acta = '$codigoActa'";
        $connect->query($s);
        
	$sql = "UPDATE acta SET estado = 2 WHERE codigo_acta = '$codigoActa'";
	if($connect->query($sql) === TRUE) {
	 	$valid['success'] = true;
		$valid['messages'] = "Acta arobado correctamente";	
	} else {
	 	$valid['success'] = false;
	 	$valid['messages'] = "Error no se ha podido anular el acta";
	}
	 
	$connect->close();

	echo json_encode($valid);
 
} // /if $_POST