<?php 	

require_once 'core.php';

$valid['success'] = array('success' => false, 'messages' => array());

if($_POST) {	

	$codActa = $_POST['codActa'];
        $fechaActa = $_POST['fechaActa'];
        $horaActa = "NOW()";
        $estado = 1;

	$sql = "INSERT INTO acta (codigo_acta,fecha,hora,estado) VALUES ('$codActa','$fechaActa',$horaActa,$estado)";

	if($connect->query($sql) === TRUE) {
	 	$valid['success'] = true;
		$valid['messages'] = "Acta creado exitosamente.";	
	} else {
	 	$valid['success'] = false;
	 	$valid['messages'] = "Error no se ha podido crear el acta.";
	}
	$connect->close();
	echo json_encode($valid); 
} // /if $_POST