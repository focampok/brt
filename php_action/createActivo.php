<?php

require_once 'core.php';

$valid['success'] = array('success' => false, 'messages' => array());

if ($_POST) {

    $codInv = $_POST['codigoInventario'];
    $folio = $_POST['folio'];
    $fecha = $_POST['fecha'];
    $codCuenta = $_POST['codigoCuenta'];
    $codSubcuenta = $_POST['codigoSubCuenta'];
    $cantidad = $_POST['cantidad'];
    $marca = $_POST['marca'];
    $modelo = $_POST['modelo'];
    $serie = $_POST['serie'];
    $descripcion = $_POST['descripcion'];
    $precio_unitario = $_POST['precio_unitario'];
    $subTotal = $cantidad * $precio_unitario;
    $codDepartamento = $_POST['codigoDepartamento'];
    $codNit = $_POST['codigoNit'];

    $s = "SELECT nombre,apellido FROM usuario WHERE nit = '$codNit'";
    $rs = $connect->query($s);

    if ($rs->num_rows > 0) {
        $us = $rs->fetch_array();
        $nombre = $us[0] . " " . $us[1];
    }

    $codAdicion = $_POST['codigoAdicion'];

    //inserto en la tabla activo
    $sql = "INSERT INTO ACTIVO(codigo_inventario,folio,fecha,CUENTA_codigo_cuenta,codigo_subcuenta,estado,cantidad,marca,modelo,serie,descripcion,precio_unitario,subtotal,DEPARTAMENTO_codigo_departamento,nit,nombre,ADICION_codigo_adicion,ACTA_codigo_acta,CERTIFICACION_codigo_certificacion)
            VALUES ('$codInv',$folio,'$fecha','$codCuenta','$codSubcuenta',1,$cantidad,'$marca','$modelo','$serie','$descripcion',$precio_unitario,$subTotal,'$codDepartamento','$codNit','$nombre','$codAdicion','-1','-1');";

    if ($connect->query($sql) === TRUE) {
        $valid['success'] = true;
        $valid['messages'] = "Activo agregado exitosamente.";
    } else {
        $valid['success'] = false;
        $valid['messages'] = "Error no se ha podido agregar el activo.";
    }

    $connect->close();

    echo json_encode($valid);
} // /if $_POST