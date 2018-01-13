<?php

require_once 'core.php';

$valid['success'] = array('success' => false, 'messages' => array());

if ($_POST) {

    $codCertificacion = $_POST['codigoCertificacion'];
    $id = $_POST['activoID'];
    $cant = $_POST['cantidad'];


    //obtengo la cantidad de dicho activo
    $sql = "SELECT cantidad FROM activo WHERE codigo_inventario = '$id';";
    $result = $connect->query($sql);

    $rs = $result->fetch_array();
    $cantidad = $rs["cantidad"];

    if ($cant <= $cantidad) {

        //cambio el estado
        $s = "UPDATE activo SET estado = 3 WHERE codigo_inventario = '$id'";
        $connect->query($s);

        //cambio cantidad cert

        $x = "UPDATE activo SET cantidad_cert = $cant WHERE codigo_inventario = '$id'";
        $connect->query($x);

        $sql = "UPDATE activo SET CERTIFICACION_codigo_certificacion = '$codCertificacion' WHERE codigo_inventario = '$id'";
        if ($connect->query($sql) === TRUE) {
            $valid['success'] = true;
            $valid['messages'] = "Activo agregado a la certifación correctamente";
        } else {
            $valid['success'] = false;
            $valid['messages'] = "Error no se ha podido certificar el activo.";
        }
    } else {
        $valid['success'] = false;
        $valid['messages'] = "Cantidad incorrecta.";
    }



    $connect->close();

    echo json_encode($valid);
} // /if $_POST