<?php

require_once 'core.php';

$sql = "SELECT codigo_producto,fecha,estado,cantidad,descripcion,precio_unitario,subtotal,CONTENEDOR_codigo_contenedor,ORDEN_codigo_orden FROM PRODUCTO";
$result = $connect->query($sql);

$output = array('data' => array());


if ($result->num_rows > 0) {
    $estado = "";
    while ($row = $result->fetch_array()) {
        $proyecto = "";
        $id = $row[0];
        //pintar el boton en base al estado
        // 0 no disponible
        // 1 disponible
        // 2 pendiente de baja
        // 3 certificado

        $button = '<!-- Single button -->
	<div class="btn-group">
	  <button type="button" class="btn btn-default dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
	    Acción <span class="caret"></span>
	  </button>
	  <ul class="dropdown-menu">';

        if ($row[2] == 0) {
            // no disponible
            $estado = "<label class='label label-danger'> No disponible </label>";
            $button.= '<li><a type="button" data-toggle="modal" id="verActivoModalBtn" data-target="#verActivoModal" onclick="verActivo(\'' . $id . '\')"> <i class="glyphicon glyphicon-eye-open"></i> Detalle </a></li>';
            $button .= '</ul></div>';
        } else if ($row[2] == 1) {
            //disponible
            $estado = "<label class='label label-success'>Disponible</label>";
            $button.= '<li><a type="button" data-toggle="modal" id="verActivoModalBtn" data-target="#verActivoModal" onclick="verActivo(\'' . $id . '\')"> <i class="glyphicon glyphicon-eye-open"></i> Detalle </a></li>';
            $button.= '<li><a type="button" data-toggle="modal" id="editarActivoModalBtn" data-target="#editActivoModal" onclick="editarActivo(\'' . $id . '\')"> <i class="glyphicon glyphicon-pencil"></i> Ver proyectos </a></li>';
            $button.= '<li><a type="button" data-toggle="modal" id="certificarModalBtn" data-target="#certificarActivoModal" onclick="certificarActivo(\'' . $id . '\')"> <i class="glyphicon glyphicon-briefcase"></i> Asignar a proyecto </a></li>';
            $button .= '</ul></div>';
        } else if ($row[2] == 2) {
            //asignado a un proyecto
            $estado = "<label class='label label-info'> Asignado a proyecto </label>";
            $button.= '<li><a type="button" data-toggle="modal" id="verActivoModalBtn" data-target="#verActivoModal" onclick="verActivo(\'' . $id . '\')"> <i class="glyphicon glyphicon-eye-open"></i> Detalle </a></li>';
            $button.= '<li><a type="button" data-toggle="modal" id="editarActivoModalBtn" data-target="#editActivoModal" onclick="editarActivo(\'' . $id . '\')"> <i class="glyphicon glyphicon-pencil"></i> Ver proyectos </a></li>';
            $button.= '<li><a type="button" data-toggle="modal" id="certificarModalBtn" data-target="#certificarActivoModal" onclick="certificarActivo(\'' . $id . '\')"> <i class="glyphicon glyphicon-briefcase"></i> Asignar a proyecto </a></li>';
            $button .= '</ul></div>';
        }
        
        $output['data'][] = array(            
            $row[0],
            $row[1],
            $estado,
            $row[3],
            $row[4],
            number_format($row[5], 2),
            number_format($row[6], 2),
            $row[7],            
            $row[8],
            $button
        );
    } // /while 
}// if num_rows

$connect->close();

echo json_encode($output);
