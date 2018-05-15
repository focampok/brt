<?php

require_once 'core.php';

$tipoUser = $_SESSION["estado"];

$sql = "SELECT * FROM HEAT;";
$result = $connect->query($sql);

$output = array('data' => array());

if ($result->num_rows > 0) {
    $estado = "";
    $lista = "";
    while ($row = $result->fetch_array()) {
        //obtengo el id        
        $id = $row[0];

        if ($tipoUser == 1) {
            $button = '<!-- Single button -->
	<div class="btn-group">
	  <button type="button" class="btn btn-default dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
	    Acción <span class="caret"></span>
	  </button>
	  <ul class="dropdown-menu">
	    <li><a type="button" data-toggle="modal" data-target="#editHeatModal" onclick="editarHeat(\'' . $row[0] . '\')"> <i class="glyphicon glyphicon-edit"></i> Editar Heat</a></li>                           
                
                    <li><a type="button" data-toggle="modal" data-target="#eliminarHeatModal" onclick="eliminarHeat(\'' . $row[0] . '\')"> <i class="glyphicon glyphicon-trash"></i> Eliminar Heat </a></li> 
	  </ul>
	</div>';
        } else {
            $button = '<!-- Single button -->
	<div class="btn-group">
	  <button type="button" class="btn btn-default dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
	    Acción <span class="caret"></span>
	  </button>
	  <ul class="dropdown-menu">
	    <li><a type="button" data-toggle="modal" data-target="#editHeatModal" onclick="editarHeat(\'' . $row[0] . '\')"> <i class="glyphicon glyphicon-edit"></i> Editar Categoria</a></li>                                       
	  </ul>
	</div>';
        }

        //busco la fecha asociada a la categoria.

        $XX = "SELECT FECHA_codigoFecha FROM CATEGORIA where codCategoria = '$row[3]'";
        $sr = $connect->query($XX);
        $us = $sr->fetch_array();
        $fecha = $us[0];

        $output['data'][] = array(
            $row[0],
            $row[1],
            $row[2],
            $row[3],
            $fecha,
            $button
        );
    } // /while 
}// if num_rows

$connect->close();

echo json_encode($output);
