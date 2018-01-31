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

    $codProd = $_POST['codigoInventario'];    
    $marca = $_POST['marca'];
    $modelo = $_POST['modelo'];
    $serie = $_POST['serie'];
    $descripcion = $_POST['descripcion'];
    $codContenedor = $_POST['codigoAdicion'];
    
    //inserto en la tabla activo
    $sql = "INSERT INTO PRODUCTO(codigo_producto,fecha,estado,cantidad,marca,modelo,serie,descripcion,precio_unitario,subtotal,CONTENEDOR_codigo_contenedor,PROYECTO_codigo_proyecto)
               VALUES ('$codProd','',1,0,'$marca','$modelo','$serie','$descripcion',0,0,'$codContenedor','-1');";
    
    if ($connect->query($sql) === TRUE) {
        $valid['success'] = true;
        $valid['messages'] = "Producto registrado correctamente";
    } else {
        $valid['success'] = false;
        $valid['messages'] = "Error al registrar PRODUCTO.";
    }
    
    //obtengo info del user
    $nit = $_SESSION["nit"];

    $XX = "SELECT nit,nombre,apellido FROM USUARIO WHERE nit = '$nit'";
    $sr = $connect->query($XX);
    $us = $sr->fetch_array();
    $nombre = $us[0] . ' - ' . $us[1] . ' ' . $us[2];

    //BITACORA
    $hoy = getdate();
    $fecha = $hoy['mday'].' de '.obtenerMes($hoy['mon']).' del '.$hoy['year'];
    $accion = "El USUARIO $nombre registró el PRODUCTO $codProd cuyo contenedor es el $codContenedor el $fecha";

    $bitacora = "INSERT INTO BITACORA(fecha,accion,USUARIO_nit)VALUES ('$fecha','$accion','$nit');";
    $connect->query($bitacora);
    
    $connect->close();
    echo json_encode($valid);
    
    
    
    
} // /if $_POST