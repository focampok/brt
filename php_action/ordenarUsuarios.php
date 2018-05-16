<?php

require_once 'core.php';

$sql = "SELECT nombre,apellido,username FROM USUARIO where tipo != 0";
$result = $connect->query($sql);

$output = array('data' => array());

if ($result->num_rows > 0) {
    while ($row = $result->fetch_array()) {
        //obtengo el nit      
        $nit = $row[2];
        //pintar el boton en base al estado
        // 0 anulada
        // 1 disponible

        $button = '<!-- Single button -->
	<div class="btn-group">
	  <button type="button" class="btn btn-default dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
	    Acción <span class="caret"></span>
	  </button>
	  <ul class="dropdown-menu">';
        $button.= '<li><a type="button" data-toggle="modal" id="eliminarUsuarioBtn" data-target="#eliminarUsuarioModal" onclick="eliminarUsuario(\'' . $nit . '\')"> <i class="glyphicon glyphicon-ban-circle"></i> Eliminar Usuario </a></li>';
        $button .= '</ul></div>';

        $output['data'][] = array(
            $row[0],
            $row[1],
            $row[2],            
            $button
        );
    } // /while 
}// if num_rows

$connect->close();

echo json_encode($output);
