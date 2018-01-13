<?php

require_once 'core.php';

$valid['success'] = array('success' => false, 'messages' => array());

if ($_POST) {

    $codActa = $_POST['codigoActa'];
    $id = $_POST['activoID'];


    //cambio el estado del activo
    $s = "UPDATE activo SET estado = 2 WHERE codigo_inventario = '$id'";
    $connect->query($s);

    //cambio el codigo del acta
    $sql = "UPDATE activo SET ACTA_codigo_acta = '$codActa' WHERE codigo_inventario = '$id'";

    if ($connect->query($sql) === TRUE) {
        $valid['success'] = true;
        $valid['messages'] = "Activo a la espera de la aprobación del acta.";
    } else {
        $valid['success'] = false;
        $valid['messages'] = "Error no se ha podido dar de baja el activo.";
    }

    $connect->close();
    echo json_encode($valid);
} // /if $_POST