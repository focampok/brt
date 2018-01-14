<?php

require_once 'core.php';

$valid['success'] = array('success' => false, 'messages' => array());

if ($_POST) {

    //obtengo el codigo la certificacion
    $codigoCertificacion = $_POST['codigoCertificacion'];

    //cambio el estado del activo
    $r = "UPDATE producto SET estado = 1 WHERE PROYECTO_codigo_proyecto = '$codigoCertificacion'";
    $connect->query($r);

    //obtengo la cantidad que esta en ese proyecto
    $mm = "SELECT cantidad_cert FROM producto WHERE PROYECTO_codigo_proyecto = '$codigoCertificacion';";
    $ret = $connect->query($mm);

    $rst = $ret->fetch_array();
    $cantidad_cert = $rst["cantidad_cert"];

    //obtengo la cant
    //obtengo la cantidad de dicho activo
    $sx = "SELECT cantidad FROM producto WHERE PROYECTO_codigo_proyecto = '$codigoCertificacion';";
    $result = $connect->query($sx);

    $rs = $result->fetch_array();
    $cantidad = $rs["cantidad"];

    $suma = $cantidad + $cantidad_cert;

    //regreso cantidades a estado anterior
    $y = "UPDATE producto SET cantidad = $suma WHERE PROYECTO_codigo_proyecto = '$codigoCertificacion'";
    $connect->query($y);

    //nuevo subtotal
    $sl = "SELECT precio_unitario FROM producto WHERE PROYECTO_codigo_proyecto = '$codigoCertificacion';";
    $rstt = $connect->query($sl);

    $rpr = $rstt->fetch_array();
    $precio_unitario = $rpr["precio_unitario"];

    $nst = $suma * $precio_unitario;
    $zz = "UPDATE producto SET subtotal = $nst WHERE PROYECTO_codigo_proyecto = '$codigoCertificacion'";
    $connect->query($zz);






    //antes de actualizarla, todos sus activos los libero.        
    $s = "UPDATE producto SET PROYECTO_codigo_proyecto = '-1', cantidad_cert = 0 WHERE PROYECTO_codigo_proyecto = '$codigoCertificacion'";
    $connect->query($s);

    $sql = "UPDATE proyecto SET estado = 0 WHERE codigo_proyecto = '$codigoCertificacion'";
    if ($connect->query($sql) === TRUE) {
        $valid['success'] = true;
        $valid['messages'] = "Proyecto anulado correctamente";
    } else {
        $valid['success'] = false;
        $valid['messages'] = "Error no se ha podido anular el proyecto";
    }

    $connect->close();

    echo json_encode($valid);
} // /if $_POST