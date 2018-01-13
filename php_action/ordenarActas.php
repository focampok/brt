<?php

require_once 'core.php';

$sql = "SELECT codigo_acta,fecha,estado FROM acta WHERE codigo_acta != '-1';";
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
        // 2 aprobada

        $button = '<!-- Single button -->
	<div class="btn-group">
	  <button type="button" class="btn btn-default dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
	    Acción <span class="caret"></span>
	  </button>
	  <ul class="dropdown-menu">';

        if ($row[2] == 0) {
            // si esta anulada, no tiene opciones
            $estado = "<label class='label label-danger'> Anulada </label>";
            $button .= '</ul></div>';
        } else if ($row[2] == 1) {
            // disponible, tiene todas las opciones...
            $estado = "<label class='label label-success'> Disponible </label>";
            $button.= '<li><a type="button" data-toggle="modal" id="anularActaModalBtn" data-target="#anularActaModal" onclick="anularActa(\'' . $id . '\')"> <i class="glyphicon glyphicon-ban-circle"></i> Anular </a></li>';
            $button.= '<li><a type="button" data-toggle="modal" id="aprobarActaModalBtn" data-target="#aprobarActaModal" onclick="aprobarActa(\'' . $id . '\')"> <i class="glyphicon glyphicon-ok"></i> Aprobar </a></li>';
            $button.= '<li><a type="button" data-toggle="modal" id="generarActaModalBtn" data-target="#generarActaModal" onclick="generarActa(\'' . $id . '\')"> <i class="glyphicon glyphicon-print"></i> Generar PDF </a></li>';
            $button .= '</ul></div>';
        }
        else if ($row[2] == 2) {
            // aprobada, la puedo anular o pdf 
            $estado = "<label class='label label-warning'> Aprobada </label>";
            $button.= '<li><a type="button" data-toggle="modal" id="anularActaModalBtn" data-target="#anularActaModal" onclick="anularActa(\'' . $id . '\')"> <i class="glyphicon glyphicon-ban-circle"></i> Anular </a></li>';            
            $button.= '<li><a type="button" data-toggle="modal" id="generarActaModalBtn" data-target="#generarActaModal" onclick="generarActa(\'' . $id . '\')"> <i class="glyphicon glyphicon-print"></i> Generar PDF </a></li>';
            $button .= '</ul></div>';
        }
        
        //calcular total de certificaciones
        //calcular los totales por cada adición
        $consultaAdicion = "call obtenerTotalActa('$id',@total)";
        $connect->query($consultaAdicion);
        $c = "select @total as salida";
        $query4 = $connect->query($c);
        $rs = $query4->fetch_assoc();
        $totalActa = $rs['salida'];

        if ($totalActa == 0) {
            $total = "<label class='label label-danger'>" . "Q " . number_format($totalActa, 2) . "</label>";
        } else {
            $total = "<label class='label label-success'>" . "Q " . number_format($totalActa, 2) . "</label>";
        }

        //busco los activos de ese acta.
        $ac = "SELECT codigo_inventario FROM activo WHERE ACTA_codigo_acta = '$id'";
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
