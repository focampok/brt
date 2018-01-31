<?php

require_once 'core.php';

$valid['success'] = array('success' => false, 'messages' => array());

if ($_POST) {

    $nit = $_POST['nit'];
    $comilla = "'";

    //apago llaves
    $o = 'SET FOREIGN_KEY_CHECKS = 0';
    $connect->query($o);

    //elimino el USUARIO
    $d = 'DELETE FROM USUARIO WHERE nit =' . $comilla . $nit . $comilla;
    $connect->query($d);

    //enciendo llaves
    $e = 'SET FOREIGN_KEY_CHECKS= 1 ';
    $connect->query($e);

    $valid['success'] = true;
    $valid['messages'] = "Usuario eliminado correctamente";

    $connect->close();
    echo json_encode($valid);
} // /if $_POST