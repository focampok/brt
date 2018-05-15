<?php 	

require_once 'core.php';

$valid['success'] = array('success' => false, 'messages' => array());

function obtenerMes($numeroMes) {
    switch ($numeroMes) {
        case 1:
            return "Enero";
        case 2:
            return "Febrero";
        case 3:
            return "Marzo";
        case 4:
            return "Abril";
        case 5:
            return "Mayo";
        case 6:
            return "Junio";
        case 7:
            return "Julio";
        case 8:
            return "Agosto";
        case 9:
            return "Septiembre";
        case 10:
            return "Octubre";
        case 11:
            return "Noviembre";
        case 12:
            return "Diciembre";
    }
}

if($_POST) {	

	$codAdicion = $_POST['brandName'];
        $nombreAdicion = $_POST['brandStatus']; 

	$sql = "INSERT INTO FECHA (codigoFecha,nombreFecha) VALUES ('$codAdicion','$nombreAdicion')";

	if($connect->query($sql) === TRUE) {
	 	$valid['success'] = true;
		$valid['messages'] = "Fecha creada exitosamente.";	
	} else {
	 	$valid['success'] = false;
	 	$valid['messages'] = "Error no se ha podido crear la fecha.";
	}  
	 

	$connect->close();

	echo json_encode($valid);
 
} // /if $_POST