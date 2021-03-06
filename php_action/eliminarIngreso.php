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
    $cc = $_POST['codigoOrden'];

    //apago llaves
    $o = 'SET FOREIGN_KEY_CHECKS = 0';
    $connect->query($o);

    //elimino todos los productos que esten en esa bodega
    $sql = "DELETE FROM ORDEN WHERE codigo_orden = '$cc'";
    if ($connect->query($sql) === TRUE) {        
        $valid['success'] = true;
        $valid['messages'] = "Ingreso a bodega eliminado correctamente";
        
    } else {
        $valid['success'] = false;
        $valid['messages'] = "Error no se ha podido eliminar el ingreso a bodega";
    }
    //obtengo info del user
    $nit = $_SESSION["nit"];

    $XX = "SELECT nit,nombre,apellido FROM usuario WHERE nit = '$nit'";
    $sr = $connect->query($XX);
    $us = $sr->fetch_array();
    $nombre = $us[0] . ' - ' . $us[1] . ' ' . $us[2];

    //BITACORA
    $hoy = getdate();
    $fecha = $hoy['mday'] . ' de ' . obtenerMes($hoy['mon']) . ' del ' . $hoy['year'];
    $accion = "El usuario $nombre eliminó el ingreso a bodega $cc el $fecha";

    $bitacora = "INSERT INTO BITACORA(fecha,accion,USUARIO_nit)VALUES ('$fecha','$accion','$nit');";
    $connect->query($bitacora);


    $connect->close();

    echo json_encode($valid);
} // /if $_POST