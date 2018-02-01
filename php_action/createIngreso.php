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

    $codigo = $_POST['codigo'];
    $fecha = $_POST['fecha'];
    $factura = $_POST['factura'];
    $proveedor = $_POST['proveedor'];

    //creo una una nueva orden
    $consultaOrden = "INSERT INTO ORDEN(codigo_orden,fecha,factura,proveedor)VALUES ('$codigo','$fecha','$factura','$proveedor');";
    $connect->query($consultaOrden);
    
    
    //seteo los datos del producto 1
    
    

    //creo un nuevo detalle
    $codProd = $_POST['codProd1'];
    $cantidad = $_POST['cantidad1'];
    $precio = $_POST['precio1'];
    $st = $cantidad * $precio;

    $consultaDetalle = "INSERT INTO DETALLE_ORDEN(ORDEN_codigo_orden,PRODUCTO_codigo_producto,cantidad,precio_unitario,subtotal)VALUES ('$codigo','$codProd',$cantidad,$precio,$st);";
    $connect->query($consultaDetalle);

    
    
    
    
    //mensaje de exito
    $valid['success'] = true;
    $valid['messages'] = "exito";

    //usuario
    $nit = $_SESSION["nit"];
    $XX = "SELECT nit,nombre,apellido FROM USUARIO WHERE nit = '$nit'";
    $sr = $connect->query($XX);
    $us = $sr->fetch_array();
    $nombre = $us[0] . ' - ' . $us[1] . ' ' . $us[2];
    //BITACORA
    $hoy = getdate();
    $fecha = $hoy['mday'] . ' de ' . obtenerMes($hoy['mon']) . ' del ' . $hoy['year'];
    $accion = "El USUARIO $nombre registró el ingreso de Bodega $codigo el $fecha";
    $bitacora = "INSERT INTO BITACORA(fecha,accion,USUARIO_nit)VALUES ('$fecha','$accion','$nit');";
    $connect->query($bitacora);
    $connect->close();
    echo json_encode($valid);
} // /if $_POST