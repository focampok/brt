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

    //elimino todos los productos que esten en esa bodega
    $r = "DELETE FROM PRODUCTO WHERE CONTENEDOR_codigo_contenedor = '$cc'";
    $connect->query($r);

    //enciendo llaves
    $e = 'SET FOREIGN_KEY_CHECKS= 1 ';
    $connect->query($e);

    //elimino la bodega
    $sql = "DELETE FROM CONTENEDOR WHERE codigo_contenedor = '$cc'";
    if ($connect->query($sql) === TRUE) {
        $valid['success'] = true;
        $valid['messages'] = "Bodega eliminada correctamente";
    } else {
        $valid['success'] = false;
        $valid['messages'] = "Error no se ha podido eliminar la bodega";
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
    $accion = "El usuario $nombre eliminó la bodega $cc el $fecha";

    $bitacora = "INSERT INTO BITACORA(fecha,accion,USUARIO_nit)VALUES ('$fecha','$accion','$nit');";
    $connect->query($bitacora);


    $connect->close();

    echo json_encode($valid);
} // /if $_POST