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
    $sql = "SELECT cantidad FROM PRODUCTO WHERE codigo_producto = '$id';";
    $result = $connect->query($sql);

    $rs = $result->fetch_array();
    $cantidad = $rs["cantidad"];

    if ($cant <= $cantidad) {

        //cambio el estado
        $s = "UPDATE PRODUCTO SET estado = 2 WHERE codigo_producto = '$id'";
        $connect->query($s);


        //resto la cantidades.
        $z = $cantidad - $cant;

        //se acabaron existencias, por lo tanto PRODUCTO no disponible
        if ($z == 0) {
            $n = "UPDATE PRODUCTO SET estado = 0 WHERE codigo_producto = '$id'";
            $connect->query($n);
        }

        //seteo la nueva cantidad.
        $y = "UPDATE PRODUCTO SET cantidad = $z WHERE codigo_producto = '$id'";
        $connect->query($y);
        
        $consultaAdicion = "call obtenerPrecioProducto('$id',@total)";
        $connect->query($consultaAdicion);
        $c = "select @total as salida";
        $query4 = $connect->query($c);
        $rs = $query4->fetch_assoc();
        $precio = $rs['salida'];
        $st = $precio*$cant;
        
        //inserto en la asignacion.
        $sql = "INSERT INTO ASIGNACION(PRODUCTO_codigo_producto,cantidad,precio_unitario,subtotal,PROYECTO_codigo_proyecto)values('$id',$cant,$precio,$st,'$codCertificacion')";
        if ($connect->query($sql) === TRUE) {
            $valid['success'] = true;
            $valid['messages'] = "Producto agregado al PRODUCTO correctamente";
        } else {
            $valid['success'] = false;
            $valid['messages'] = "Error no se ha podido asignar el PRODUCTO.";
        }
    } else {
        $valid['success'] = false;
        $valid['messages'] = "Cantidad incorrecta.";
    }

    //obtengo info del user
    $nit = $_SESSION["nit"];

    $XX = "SELECT nit,nombre,apellido FROM USUARIO WHERE nit = '$nit'";
    $sr = $connect->query($XX);
    $us = $sr->fetch_array();
    $nombre = $us[0] . ' - ' . $us[1] . ' ' . $us[2];

    //BITACORA
    $hoy = getdate();
    $fecha = $hoy['mday'] . ' de ' . obtenerMes($hoy['mon']) . ' del ' . $hoy['year'];
    $accion = "El USUARIO $nombre agregó $cant del PRODUCTO $id al proyecto $codCertificacion el $fecha";

    $bitacora = "INSERT INTO BITACORA(fecha,accion,USUARIO_nit)VALUES ('$fecha','$accion','$nit');";
    $connect->query($bitacora);





    $connect->close();

    echo json_encode($valid);
} // /if $_POST