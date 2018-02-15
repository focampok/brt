<?php

require_once 'core.php';
$estado = $_SESSION["estado"];

$sql = "SELECT codigo_contenedor, nombre_contenedor FROM CONTENEDOR WHERE codigo_contenedor != '-1';";
$result = $connect->query($sql);

$output = array('data' => array());

if ($result->num_rows > 0) {
    $total = "";

    while ($row = $result->fetch_array()) {
        $brandId = $row[0];

        //calcular los totales por cada adición
        $consultaAdicion = "call obtenerTotalContenedor('$brandId',@total)";
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

        if ($estado == 1) {
            $button = '<!-- Single button -->
	<div class="btn-group">
	  <button type="button" class="btn btn-default dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
	    Acción <span class="caret"></span>
	  </button>
	  <ul class="dropdown-menu">
	    <li><a type="button" data-toggle="modal" data-target="#editBrandModel" onclick="editarAdicion(\'' . $brandId . '\')"> <i class="glyphicon glyphicon-edit"></i> Editar </a></li>                           
                
                    <li><a type="button" data-toggle="modal" data-target="#eliminarBodegaModal" onclick="eliminarBodega(\'' . $brandId . '\')"> <i class="glyphicon glyphicon-trash"></i> Eliminar Bodega </a></li> 
	  </ul>
	</div>';
        } else {
            $button = '<!-- Single button -->
	<div class="btn-group">
	  <button type="button" class="btn btn-default dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
	    Acción <span class="caret"></span>
	  </button>
	  <ul class="dropdown-menu">
	    <li><a type="button" data-toggle="modal" data-target="#editBrandModel" onclick="editarAdicion(\'' . $brandId . '\')"> <i class="glyphicon glyphicon-edit"></i> Editar </a></li>                           
                
	  </ul>
	</div>';
        }


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
