<?php 	

require_once 'core.php';

$valid['success'] = array('success' => false, 'messages' => array());

if($_POST) {	

	$codDepto = $_POST['editCodigoDepartamento'];
        $nit = $_POST['editCodigoNit']; 
        
        $s = "SELECT nombre,apellido FROM usuario WHERE nit = '$nit'";
        $rs = $connect->query($s);
        $us = $rs->fetch_array();                
        $nombre = $us[0].' '.$us[1]; 
        
        $id = $_POST['activoID'];
        
	$sql = "UPDATE activo SET DEPARTAMENTO_codigo_departamento = '$codDepto', nit = '$nit', nombre = '$nombre' WHERE codigo_inventario = '$id'";
	if($connect->query($sql) === TRUE) {
	 	$valid['success'] = true;
		$valid['messages'] = "Activo editado correctamente";	
	} else {
	 	$valid['success'] = false;
	 	$valid['messages'] = "Error no se ha podido actualizar";
	}
	 
	$connect->close();

	echo json_encode($valid);
 
} // /if $_POST