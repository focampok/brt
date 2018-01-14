<?php

require_once 'core.php';

$valid['success'] = array('success' => false, 'messages' => array());

if ($_POST) {

    $codCertificacion = $_POST['codigoCertificacion'];
    $id = $_POST['activoID'];
    $cant = $_POST['cantidad'];


    //obtengo la cantidad de dicho activo
    $sql = "SELECT cantidad FROM producto WHERE codigo_producto = '$id';";
    $result = $connect->query($sql);

    $rs = $result->fetch_array();
    $cantidad = $rs["cantidad"];
    
    //obtengo precio
    $sl = "SELECT precio_unitario FROM producto WHERE codigo_producto = '$id';";
    $rst = $connect->query($sl);

    $rpr = $rst->fetch_array();
    $precio_unitario = $rpr["precio_unitario"];

    if ($cant <= $cantidad) {

        //cambio el estado
        $s = "UPDATE producto SET estado = 2 WHERE codigo_producto = '$id'";
        $connect->query($s);

        //cambio cantidad cert

        $x = "UPDATE producto SET cantidad_cert = $cant WHERE codigo_producto = '$id'";
        $connect->query($x);

        $z = $cantidad - $cant;

        //se acabaron existencias, por lo tanto producto no disponible
        if ($z == 0) {
            $n= "UPDATE producto SET estado = 0 WHERE codigo_producto = '$id'";
            $connect->query($n);
        }

        //resto cantidades
        $y = "UPDATE producto SET cantidad = $z WHERE codigo_producto = '$id'";
        $connect->query($y);
        
        //nuevo subtotal
       // $nst = $z * $precio_unitario;
       // $zz = "UPDATE producto SET subtotal = $nst WHERE codigo_producto = '$id'";
       // $connect->query($zz);

        //enlazo producto con proyecto

        $sql = "UPDATE producto SET PROYECTO_codigo_proyecto = '$codCertificacion' WHERE codigo_producto = '$id'";
        if ($connect->query($sql) === TRUE) {
            $valid['success'] = true;
            $valid['messages'] = "Producto agregado al producto correctamente";
        } else {
            $valid['success'] = false;
            $valid['messages'] = "Error no se ha podido asignar el producto.";
        }
    } else {
        $valid['success'] = false;
        $valid['messages'] = "Cantidad incorrecta.";
    }



    $connect->close();

    echo json_encode($valid);
} // /if $_POST