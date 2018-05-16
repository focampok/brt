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

    $codigoPiloto = $_POST['codigoPiloto'];
    $nombrePiloto = $_POST['nombrePiloto'];
    $carro = $_POST['carro'];
    $codCategoria = $_POST['codigoCategoria']; 

    $sql = "INSERT INTO PILOTO(codigoPILOTO,nombre,carro,CATEGORIA_codCategoria) VALUES ('$codigoPiloto','$nombrePiloto','$carro','$codCategoria')";

    if ($connect->query($sql) === TRUE) {
        $valid['success'] = true;
        $valid['messages'] = "Piloto creado exitosamente.";
    } else {
        $valid['success'] = false;
        $valid['messages'] = "Error no se ha podido crear el piloto.";
    }
    $connect->close();
    echo json_encode($valid);
} // /if $_POST