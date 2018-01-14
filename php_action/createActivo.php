<?php

require_once 'core.php';

$valid['success'] = array('success' => false, 'messages' => array());

if ($_POST) {

    $codProd = $_POST['codigoInventario'];    
    $fecha = $_POST['fecha'];    
    $cantidad = $_POST['cantidad'];
    $marca = $_POST['marca'];
    $modelo = $_POST['modelo'];
    $serie = $_POST['serie'];
    $descripcion = $_POST['descripcion'];
    $precio_unitario = $_POST['precio_unitario'];
    $subTotal = $cantidad * $precio_unitario; 
    $codContenedor = $_POST['codigoAdicion'];

    //inserto en la tabla activo
    $sql = "INSERT INTO producto(codigo_producto,fecha,estado,cantidad,marca,modelo,serie,descripcion,precio_unitario,subtotal,CONTENEDOR_codigo_contenedor,PROYECTO_codigo_proyecto)
            VALUES ('$codProd','$fecha',1,$cantidad,'$marca','$modelo','$serie','$descripcion',$precio_unitario,$subTotal,'$codContenedor','-1');";

    if ($connect->query($sql) === TRUE) {
        $valid['success'] = true;
        $valid['messages'] = "Producto agregado exitosamente.";
    } else {
        $valid['success'] = false;
        $valid['messages'] = "Error no se ha podido agregar el producto.";
    }

    $connect->close();

    echo json_encode($valid);
} // /if $_POST