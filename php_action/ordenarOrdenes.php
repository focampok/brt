<?php

require_once 'core.php';
$tipoUser = $_SESSION["estado"];

$sql = "SELECT codigo_orden,factura,proveedor FROM ORDEN where codigo_orden != '-1';";
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


        if ($tipoUser == 1) {
            $button = '<!-- Single button -->
	<div class="btn-group">
	  <button type="button" class="btn btn-default dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
	    Acción <span class="caret"></span>
	  </button>
	  <ul class="dropdown-menu">';
            $button.= '<li><a type="button" data-toggle="modal" id="eliminarIngresoModalBtn" data-target="#eliminarIngresoModal" onclick="eliminarIngreso(\'' . $id . '\')"> <i class="glyphicon glyphicon-trash"></i> Eliminar ingreso </a></li>';
            $button .= '</ul></div>';
        } else {
            $button = '<!-- Single button -->
                       <div class="btn-group">	  
                       </div>';
        }

        //obtengo el total
        $consultaAdicion = "call obtenerTotalOrden('$id',@total)";
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

        $output['data'][] = array(
            $row[0],
            $row[1],
            $row[2],
            $total,
            $button
        );

        $lista = "";
    } // /while 
}// if num_rows

$connect->close();

echo json_encode($output);
