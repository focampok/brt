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
    
    //obtengo info del user
    $nit = $_SESSION["nit"];

    $XX = "SELECT nit,nombre,apellido FROM usuario WHERE nit = '$nit'";
    $sr = $connect->query($XX);
    $us = $sr->fetch_array();
    $nombre = $us[0] . ' - ' . $us[1] . ' ' . $us[2];

    //BITACORA
    $hoy = getdate();
    $fecha = $hoy['mday'].' de '.obtenerMes($hoy['mon']).' del '.$hoy['year'];
    $accion = "El usuario $nombre agregó el producto $id al proyecto $codCertificacion el $fecha";

    $bitacora = "INSERT INTO BITACORA(fecha,accion,USUARIO_nit)VALUES ('$fecha','$accion','$nit');";
    $connect->query($bitacora);
    
    



    $connect->close();

    echo json_encode($valid);
} // /if $_POST