<?php 	

require_once 'core.php';

$valid['success'] = array('success' => false, 'messages' => array());

if($_POST) {	

        //obtengo el codigo la certificacion
	$codigoCertificacion = $_POST['codigoCertificacion']; 
        
        //cambio el estado del activo
        $r = "UPDATE activo SET estado = 1 WHERE CERTIFICACION_codigo_certificacion = '$codigoCertificacion'";
        $connect->query($r); 
        
        //antes de actualizarla, todos sus activos los libero.        
        $s = "UPDATE activo SET CERTIFICACION_codigo_certificacion = '-1', cantidad_cert = 0 WHERE CERTIFICACION_codigo_certificacion = '$codigoCertificacion'";
        $connect->query($s); 
        
	$sql = "UPDATE certificacion SET estado = 0 WHERE codigo_certificacion = '$codigoCertificacion'";
	if($connect->query($sql) === TRUE) {
	 	$valid['success'] = true;
		$valid['messages'] = "Certificacion anulada correctamente";	
	} else {
	 	$valid['success'] = false;
	 	$valid['messages'] = "Error no se ha podido anular la certificación";
	}
	 
	$connect->close();

	echo json_encode($valid);
 
} // /if $_POST