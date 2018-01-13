<?php

require_once 'core.php';

$sql = "SELECT codigo_adicion, nombre_adicion FROM adicion";
$result = $connect->query($sql);

$output = array('data' => array());

if ($result->num_rows > 0) {
    $total = "";

    while ($row = $result->fetch_array()) {
        $brandId = $row[0];

        //calcular los totales por cada adición
        $consultaAdicion = "call obtenerTotalAdicion('$brandId',@total)";
        $connect->query($consultaAdicion);
        $c = "select @total as salida";
        $query4 = $connect->query($c);
        $rs = $query4->fetch_assoc();
        $totalAdicion = $rs['salida'];

        if ($totalAdicion == 0) {
            $total = "<label class='label label-danger'>" . "Q " . number_format($totalAdicion, 2) . "</label>";
        } else {
            $total = "<label class='label label-success'>" . "Q " . number_format($totalAdicion, 2) . "</label>";
        }


        $button = '<!-- Single button -->
	<div class="btn-group">
	  <button type="button" class="btn btn-default dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
	    Acción <span class="caret"></span>
	  </button>
	  <ul class="dropdown-menu">
	    <li><a type="button" data-toggle="modal" data-target="#editBrandModel" onclick="editarAdicion(' . $brandId . ')"> <i class="glyphicon glyphicon-edit"></i> Editar </a></li>                           
	  </ul>
	</div>';

        //si es admin, agregar la opcion de eliminar adicion.
        //<li><a type="button" data-toggle="modal" data-target="#removeMemberModal" onclick="removeBrands(' . $brandId . ')"> <i class="glyphicon glyphicon-trash"></i> Eliminar</a></li>
        $output['data'][] = array(
            $row[0],
            $row[1],
            $total,
            $button
        );
    } // /while 
} // if num_rows

$connect->close();

echo json_encode($output);
