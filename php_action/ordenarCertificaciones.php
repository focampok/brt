<?php

require_once 'core.php';

$sql = "SELECT codigo_proyecto,fecha,estado FROM PROYECTO WHERE codigo_proyecto != '-1';";
$result = $connect->query($sql);

$output = array('data' => array());

if ($result->num_rows > 0) {
    $estado = "";
    $lista = "";
    while ($row = $result->fetch_array()) {
        //obtengo el id        
        $id = $row[0];
        //pintar el boton en base al estado
        // 0 anulada
        // 1 disponible

        $button = '<!-- Single button -->
	<div class="btn-group">
	  <button type="button" class="btn btn-default dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
	    Acción <span class="caret"></span>
	  </button>
	  <ul class="dropdown-menu">';

        if ($row[2] == 0) {
            // si esta anulada, no tiene opciones
            $estado = "<label class='label label-danger'> Anulado </label>";
            $button .= '</ul></div>';
        } else if ($row[2] == 1) {
            // disponible, tiene ambas opciones...
            $estado = "<label class='label label-success'>Disponible</label>";
            $button.= '<li><a type="button" data-toggle="modal" id="anularCertificacionBtn" data-target="#anularCertificacionModal" onclick="anularCertificacion(\'' . $id . '\')"> <i class="glyphicon glyphicon-ban-circle"></i> Anular </a></li>';
            $button.= '<li><a type="button" data-toggle="modal" id="generarCertificacionModalBtn" data-target="#generarCertificacionModal" onclick="generarCertificacion(\'' . $id . '\')"> <i class="glyphicon glyphicon-print"></i> Generar PDF </a></li>';
            $button .= '</ul></div>';
        }
        //calcular total de certificaciones
        //calcular los totales por cada adición
        $consultaAdicion = "call obtenerTotalProyecto('$id',@total)";
        $connect->query($consultaAdicion);
        $c = "select @total as salida";
        $query4 = $connect->query($c);
        $rs = $query4->fetch_assoc();
        $totalCertificacion = $rs['salida'];

        if ($totalCertificacion == 0) {
            $total = "<label class='label label-danger'>" . "Q " . number_format($totalCertificacion, 2) . "</label>";
        } else {
            $total = "<label class='label label-success'>" . "Q " . number_format($totalCertificacion, 2) . "</label>";
        }

        //busco los activos de esa cerf.
        $ac = "SELECT codigo_producto FROM producto WHERE PROYECTO_codigo_proyecto = '$id'";
        $rsac = $connect->query($ac);
        if ($rsac->num_rows > 0) {
            $activos = "";
            while ($rw = $rsac->fetch_array()) {
                $activos.= '<li><a type="button" data-toggle="modal" id="quitarActivoModalBtn" data-target="#quitarActivoModal" onclick="quitarActivo(\'' . $rw[0] . '\')"> <i class="glyphicon glyphicon-remove-circle"></i> Quitar ' . $rw[0] . ' </a></li>';
            }

            $lista .= '<div class="btn-group">
            <button type="button" class="btn btn-default dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
	    Activos <span class="caret"></span>
            </button>
            <ul class="dropdown-menu">' .
                    $activos .
                    '</ul></div>';
        }

        $output['data'][] = array(
            $row[0],
            $row[1],
            $estado,
            $lista,
            $total,
            $button
        );

        $lista = "";
    } // /while 
}// if num_rows

$connect->close();

echo json_encode($output);
