<?php 	

require_once 'core.php';

$valid['success'] = array('success' => false, 'messages' => array());

if($_POST) {	

	$codCertificacion = $_POST['codCertificacion'];
        $fechaCertificacion = $_POST['fechaCertificacion']; 
        $estado = 1;

	$sql = "INSERT INTO proyecto (codigo_proyecto,fecha,estado) VALUES ('$codCertificacion','$fechaCertificacion',$estado)";

	if($connect->query($sql) === TRUE) {
	 	$valid['success'] = true;
		$valid['messages'] = "Proyecto creado exitosamente.";	
	} else {
	 	$valid['success'] = false;
	 	$valid['messages'] = "Error no se ha podido crear el proyecto.";
	}
	$connect->close();
	echo json_encode($valid); 
} // /if $_POST