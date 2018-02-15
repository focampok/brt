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

    $contador = 1;
    while ($contador <= 10) {
        //creo un nuevo detalle
        $codProd = $_POST['codProd' . $contador];
        $cantidad = $_POST['cantidad' . $contador];
        $precio = $_POST['precio' . $contador];
        $st = $cantidad * $precio;

        if ($cantidad !== '' && $precio !== '') {
            //seteo la info de ese PRODUCTO...
            //obtengo la cantidad y precio actual.
            $consultaProducto = "SELECT cantidad,subtotal FROM PRODUCTO WHERE codigo_producto = '$codProd'";
            $cc = $connect->query($consultaProducto);
            $prod = $cc->fetch_array();
            //cantidad actual + cantidad nueva
            $nuevaCantidad = $prod[0] + $cantidad;
            //subtotal actual + nuevo st            
            $nuevoSubtotal = $prod[1] + ($nuevaCantidad * $precio);

            //actualizo el PRODUCTO con la nueva info.
            $actualizar = "UPDATE PRODUCTO SET fecha='$fecha',cantidad = $nuevaCantidad,precio_unitario=$precio,subtotal = $nuevoSubtotal,ORDEN_codigo_orden='$codigo' WHERE codigo_producto = '$codProd'";
            $connect->query($actualizar);            
            //nuevo detalle
            $consultaDetalle = "INSERT INTO DETALLE_ORDEN(ORDEN_codigo_orden,PRODUCTO_codigo_producto,cantidad,precio_unitario,subtotal)VALUES ('$codigo','$codProd',$cantidad,$precio,$st);";
            $connect->query($consultaDetalle);
        }
        $contador++;
    }

    //mensaje de exito
    $valid['success'] = true;
    $valid['messages'] = "Ingreso a bodega creado correctamente.";

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