<?php

require_once 'core.php';

$valid['success'] = array('success' => false, 'messages' => array());

if ($_POST) {

    $cant = $_POST['cantidad'];
    $id = $_POST['activoID'];

    //obtengo precio
    $sl = "SELECT precio_unitario FROM producto WHERE codigo_producto = '$id';";
    $rst = $connect->query($sl);

    $rpr = $rst->fetch_array();
    $precio_unitario = $rpr[0];
    
    //nuevo subtotal
    $sub = $cant * $precio_unitario;
    
    $sx = "UPDATE producto SET subtotal = $sub WHERE codigo_producto = '$id'";
    $connect->query($sx);
    

    $sql = "UPDATE producto SET cantidad = $cant WHERE codigo_producto = '$id'";



    if ($connect->query($sql) === TRUE) {
        $valid['success'] = true;
        $valid['messages'] = "Producto editado correctamente";
    } else {
        $valid['success'] = false;
        $valid['messages'] = "Error no se ha podido editar";
    }

    $connect->close();

    echo json_encode($valid);
} // /if $_POST