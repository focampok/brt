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
    $id = $_POST['codigoInventario'];

    //obtengo la suma de cantidades de dicho producto en el proyecto
    $sx = "SELECT sum(cantidad)as cantidad FROM ASIGNACION WHERE PRODUCTO_codigo_producto = '$id';";
    $rt = $connect->query($sx);
    $rrr = $rt->fetch_array();
    $cantidadProyecto = $rrr["cantidad"];
    
    $sxy = "SELECT cantidad FROM PRODUCTO WHERE codigo_producto = '$id';";
    $rty = $connect->query($sxy);
    $rrry = $rty->fetch_array();
    $cantidadOriginal = $rrry["cantidad"];
    
    $suma = $cantidadOriginal + $cantidadProyecto;
    //a la cantidad actual del proyecto le sumo la cantidad del proyecto
    $y = "UPDATE PRODUCTO SET cantidad = $suma WHERE codigo_producto = '$id'";
    $connect->query($y);

    //nuevo subtotal
    $sl = "SELECT precio_unitario FROM PRODUCTO WHERE codigo_producto = '$id';";
    $rstt = $connect->query($sl);

    $rpr = $rstt->fetch_array();
    $precio_unitario = $rpr["precio_unitario"];

    $nst = $suma * $precio_unitario;
    $zz = "UPDATE PRODUCTO SET subtotal = $nst WHERE codigo_producto = '$id'";
    $connect->query($zz);
    
    //elimino el producto de la tabla de ASIGNACION
    $zzx = "delete from ASIGNACION where PRODUCTO_codigo_producto = '$id'";
    $connect->query($zzx);
    

    //cambio el estado del activo
    $r = "UPDATE PRODUCTO SET estado = 1 WHERE codigo_producto = '$id'";
    $connect->query($r);

    //antes de actualizarla, todos sus activos los libero.        
    $sql = "UPDATE PRODUCTO SET PROYECTO_codigo_proyecto = '-1' WHERE codigo_producto = '$id'";
    if ($connect->query($sql) === TRUE) {
        $valid['success'] = true;
        $valid['messages'] = "Producto quitado del proyecto correctamente.";
    } else {
        $valid['success'] = false;
        $valid['messages'] = "Error no se ha podido quitar el PRODUCTO.";
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
    $accion = "El USUARIO $nombre eliminó el PRODUCTO $id del proyecto el $fecha";

    $bitacora = "INSERT INTO BITACORA(fecha,accion,USUARIO_nit)VALUES ('$fecha','$accion','$nit');";
    $connect->query($bitacora);

    $connect->close();

    echo json_encode($valid);
} // /if $_POST