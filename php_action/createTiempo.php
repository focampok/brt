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

    $codigoHEAT = $_POST['codigoHEAT'];
    $contador = 1;

    while ($contador <= 10) {
        //creo un nuevo detalle
        $codPiloto = $_POST['codPiloto' . $contador];
        $vuelta = $_POST['vuelta' . $contador];
        $tiempo = $_POST['tiempo' . $contador];

        if ($vuelta !== '' && $tiempo !== '') {
            //nuevo registro
            $consultaDetalle = "INSERT INTO CARRERA(PILOTO_codigoPILOTO,HEAT_codigoHEAT,vuelta,tiempo)VALUES ('$codPiloto','$codigoHEAT','$vuelta','$tiempo');";
            $connect->query($consultaDetalle);
            $contador++;
        }
    }

    //mensaje de exito
    $valid['success'] = true;
    $valid['messages'] = "Registros creados correctamente.";




    $connect->close();
    echo json_encode($valid);
} // /if $_POST