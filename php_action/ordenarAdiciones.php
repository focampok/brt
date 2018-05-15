<?php

require_once 'core.php';
$estado = $_SESSION["estado"];

$sql = "SELECT * FROM FECHA;";
$result = $connect->query($sql);

$output = array('data' => array());

if ($result->num_rows > 0) {
    $total = "";

    while ($row = $result->fetch_array()) {
        $brandId = $row[0];
        
        
        //si es admin puedo eliminar la fecha
        if ($estado == 1) {
            $button = '<!-- Single button -->
	<div class="btn-group">
	  <button type="button" class="btn btn-default dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
	    Acción <span class="caret"></span>
	  </button>
	  <ul class="dropdown-menu">
	    <li><a type="button" data-toggle="modal" data-target="#editBrandModel" onclick="editarAdicion(\'' . $brandId . '\')"> <i class="glyphicon glyphicon-edit"></i> Editar Fecha</a></li>                           
                
                    <li><a type="button" data-toggle="modal" data-target="#eliminarBodegaModal" onclick="eliminarBodega(\'' . $brandId . '\')"> <i class="glyphicon glyphicon-trash"></i> Eliminar Fecha </a></li> 
	  </ul>
	</div>';
        } else {
            $button = '<!-- Single button -->
	<div class="btn-group">
	  <button type="button" class="btn btn-default dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
	    Acción <span class="caret"></span>
	  </button>
	  <ul class="dropdown-menu">
	    <li><a type="button" data-toggle="modal" data-target="#editBrandModel" onclick="editarAdicion(\'' . $brandId . '\')"> <i class="glyphicon glyphicon-edit"></i> Editar Fecha</a></li>                           
                
	  </ul>
	</div>';
        }
        $output['data'][] = array(
            $row[0],
            $row[1],
            $button
        );
    } // /while 
} // if num_rows

$connect->close();

echo json_encode($output);
