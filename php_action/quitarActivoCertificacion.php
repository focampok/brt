<?php

require_once 'core.php';

$valid['success'] = array('success' => false, 'messages' => array());

if ($_POST) {

    //obtengo el codigo la certificacion
    $id = $_POST['codigoInventario'];

    //obtengo la cantidad de dicho activo
    $sx = "SELECT cantidad FROM producto WHERE codigo_producto = '$id';";
    $result = $connect->query($sx);

    $rs = $result->fetch_array();
    $cantidad = $rs["cantidad"];

    $mm = "SELECT cantidad_cert FROM producto WHERE codigo_producto = '$id';";
    $ret = $connect->query($mm);

    $rst = $ret->fetch_array();
    $cantidad_cert = $rst["cantidad_cert"];

    $suma = $cantidad + $cantidad_cert;

    //regreso cantidades a estado anterior
    $y = "UPDATE producto SET cantidad = $suma WHERE codigo_producto = '$id'";
    $connect->query($y);

    $r = "UPDATE producto SET cantidad_cert = 0 WHERE codigo_producto = '$id'";
    $connect->query($r);

    //nuevo subtotal
    $sl = "SELECT precio_unitario FROM producto WHERE codigo_producto = '$id';";
    $rstt = $connect->query($sl);

    $rpr = $rstt->fetch_array();
    $precio_unitario = $rpr["precio_unitario"];

    $nst = $suma * $precio_unitario;
    $zz = "UPDATE producto SET subtotal = $nst WHERE codigo_producto = '$id'";
    $connect->query($zz);


    //cambio el estado del activo
    $r = "UPDATE producto SET estado = 1 WHERE codigo_producto = '$id'";
    $connect->query($r);

    //antes de actualizarla, todos sus activos los libero.        
    $sql = "UPDATE producto SET PROYECTO_codigo_proyecto = '-1' WHERE codigo_producto = '$id'";
    if ($connect->query($sql) === TRUE) {
        $valid['success'] = true;
        $valid['messages'] = "Producto quitado del proyecto correctamente.";
    } else {
        $valid['success'] = false;
        $valid['messages'] = "Error no se ha podido quitar el producto.";
    }

    $connect->close();

    echo json_encode($valid);
} // /if $_POST