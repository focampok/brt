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
    $codigoCertificacion = $_POST['codigoCertificacion'];

    //cambio el estado del activo
    $r = "UPDATE PRODUCTO SET estado = 1 WHERE PROYECTO_codigo_proyecto = '$codigoCertificacion'";
    $connect->query($r);

    //obtengo la cantidad que esta en ese PROYECTO
    $mm = "SELECT cantidad_cert FROM PRODUCTO WHERE PROYECTO_codigo_proyecto = '$codigoCertificacion';";
    $ret = $connect->query($mm);

    $rst = $ret->fetch_array();
    $cantidad_cert = $rst["cantidad_cert"];

    //obtengo la cant
    //obtengo la cantidad de dicho activo
    $sx = "SELECT cantidad FROM PRODUCTO WHERE PROYECTO_codigo_proyecto = '$codigoCertificacion';";
    $result = $connect->query($sx);

    $rs = $result->fetch_array();
    $cantidad = $rs["cantidad"];

    $suma = $cantidad + $cantidad_cert;

    //regreso cantidades a estado anterior
    $y = "UPDATE PRODUCTO SET cantidad = $suma WHERE PROYECTO_codigo_proyecto = '$codigoCertificacion'";
    $connect->query($y);

    //nuevo subtotal
    $sl = "SELECT precio_unitario FROM PRODUCTO WHERE PROYECTO_codigo_proyecto = '$codigoCertificacion';";
    $rstt = $connect->query($sl);

    $rpr = $rstt->fetch_array();
    $precio_unitario = $rpr["precio_unitario"];

    $nst = $suma * $precio_unitario;
    $zz = "UPDATE PRODUCTO SET subtotal = $nst WHERE PROYECTO_codigo_proyecto = '$codigoCertificacion'";
    $connect->query($zz);






    //antes de actualizarla, todos sus activos los libero.        
    $s = "UPDATE PRODUCTO SET PROYECTO_codigo_proyecto = '-1', cantidad_cert = 0 WHERE PROYECTO_codigo_proyecto = '$codigoCertificacion'";
    $connect->query($s);

    $sql = "UPDATE PROYECTO SET estado = 0 WHERE codigo_proyecto = '$codigoCertificacion'";
    if ($connect->query($sql) === TRUE) {
        $valid['success'] = true;
        $valid['messages'] = "Proyecto anulado correctamente";
    } else {
        $valid['success'] = false;
        $valid['messages'] = "Error no se ha podido anular el PROYECTO";
    }
    //obtengo info del user
    $nit = $_SESSION["nit"];

    $XX = "SELECT nit,nombre,apellido FROM usuario WHERE nit = '$nit'";
    $sr = $connect->query($XX);
    $us = $sr->fetch_array();
    $nombre = $us[0] . ' - ' . $us[1] . ' ' . $us[2];

    //BITACORA
    $hoy = getdate();
    $fecha = $hoy['mday'].' de '.obtenerMes($hoy['mon']).' del '.$hoy['year'];
    $accion = "El usuario $nombre anuló el PROYECTO $codigoCertificacion el $fecha";

    $bitacora = "INSERT INTO BITACORA(fecha,accion,USUARIO_nit)VALUES ('$fecha','$accion','$nit');";
    $connect->query($bitacora);


    $connect->close();

    echo json_encode($valid);
} // /if $_POST