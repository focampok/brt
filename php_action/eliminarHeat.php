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

if ($_POST) {

    //obtengo el codigo la certificacion
    $cc = $_POST['codigoBodega'];

    //apago llaves
    $o = 'SET FOREIGN_KEY_CHECKS = 0';
    $connect->query($o);

    //elimino todos los registros referentes al heat que esten en esa fecha
    $r = "DELETE FROM CARRERA WHERE HEAT_codigoHEAT = '$cc'";
    $connect->query($r);

    //enciendo llaves
    $e = 'SET FOREIGN_KEY_CHECKS= 1 ';
    $connect->query($e);

    //elimino la bodega
    $sql = "DELETE FROM HEAT WHERE codigoHEAT = '$cc'";
    if ($connect->query($sql) === TRUE) {
        $valid['success'] = true;
        $valid['messages'] = "Heat eliminado correctamente";
    } else {
        $valid['success'] = false;
        $valid['messages'] = "Error no se ha podido eliminar la categoria";
    }
    $connect->close();
    echo json_encode($valid);
} // /if $_POST