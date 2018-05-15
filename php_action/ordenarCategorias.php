<?php

require_once 'core.php';

$tipoUser = $_SESSION["estado"];

$sql = "SELECT * FROM CATEGORIA;";
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
	    <li><a type="button" data-toggle="modal" data-target="#editCategoriaModal" onclick="editarCategoria(\'' . $row[0] . '\')"> <i class="glyphicon glyphicon-edit"></i> Editar Categoria</a></li>                           
                
                    <li><a type="button" data-toggle="modal" data-target="#eliminarCategoriaModal" onclick="eliminarCategoria(\'' . $row[0] . '\')"> <i class="glyphicon glyphicon-trash"></i> Eliminar Categoria </a></li> 
	  </ul>
	</div>';
        } else {
            $button = '<!-- Single button -->
	<div class="btn-group">
	  <button type="button" class="btn btn-default dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
	    Acción <span class="caret"></span>
	  </button>
	  <ul class="dropdown-menu">
	    <li><a type="button" data-toggle="modal" data-target="#editCategoriaModal" onclick="editarCategoria(\'' . $row[0] . '\')"> <i class="glyphicon glyphicon-edit"></i> Editar Categoria</a></li>                                       
	  </ul>
	</div>';
        }
        
        //busco los pilotos que esten en esa categoria
        $ac = "SELECT * FROM PILOTO WHERE CATEGORIA_codCategoria = '$id'";
        $rsac = $connect->query($ac);
        if ($rsac->num_rows > 0) {
            $activos = "";
            while ($rw = $rsac->fetch_array()) {
                $activos.= '<li><a type="button" data-toggle="modal" id="quitarActivoModalBtn" data-target="#quitarActivoModal"> <i class="glyphicon glyphicon-remove-circle"></i> ' . $rw[0] . ' </a></li>';
            }
            $lista .= '<div class="btn-group">
            <button type="button" class="btn btn-default dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
	    Pilotos <span class="caret"></span>
            </button>
            <ul class="dropdown-menu">' .
                    $activos .
                    '</ul></div>';
        }

        $output['data'][] = array(
            $row[0],
            $row[1],
            $row[2],
            $lista,
            $button
        );

        $lista = "";
    } // /while 
}// if num_rows

$connect->close();

echo json_encode($output);
