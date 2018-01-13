<?php

require_once 'core.php';

$sql = "SELECT codigo_inventario,folio,fecha,CUENTA_codigo_cuenta,codigo_subcuenta,estado,cantidad,descripcion,precio_unitario,subtotal,ADICION_codigo_adicion FROM activo";
$result = $connect->query($sql);

$output = array('data' => array());

if ($result->num_rows > 0) {
    $estado = "";
    while ($row = $result->fetch_array()) {
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

        if ($row[5] == 0) {
            // no disponible
            $estado = "<label class='label label-danger'> Dado de baja </label>";
            $button.= '<li><a type="button" data-toggle="modal" id="verActivoModalBtn" data-target="#verActivoModal" onclick="verActivo(\'' . $id . '\')"> <i class="glyphicon glyphicon-eye-open"></i> Detalle </a></li>';
            $button .= '</ul></div>';
        } else if ($row[5] == 1) {
            //disponible
            $estado = "<label class='label label-success'>Disponible</label>";
            $button.= '<li><a type="button" data-toggle="modal" id="verActivoModalBtn" data-target="#verActivoModal" onclick="verActivo(\'' . $id . '\')"> <i class="glyphicon glyphicon-eye-open"></i> Detalle </a></li>';
            $button.= '<li><a type="button" data-toggle="modal" id="editActivoModalBtn" data-target="#editActivoModal" onclick="editarActivo(\'' . $id . '\')"> <i class="glyphicon glyphicon-edit"></i> Editar </a></li>';
            $button.= '<li><a type="button" data-toggle="modal" id="certificarModalBtn" data-target="#certificarActivoModal" onclick="certificarActivo(\'' . $id . '\')"> <i class="glyphicon glyphicon-pencil"></i> Certificar </a></li>';
            $button.= '<li><a type="button" data-toggle="modal" id="bajarModalBtn" data-target="#bajarActivoModal" onclick="bajarActivo(\'' . $id . '\')"> <i class="glyphicon glyphicon-circle-arrow-down"></i> Dar de baja </a></li>';
            $button .= '</ul></div>';
        } else if ($row[5] == 2) {
            //pendiente de baja
            $estado = "<label class='label label-warning'> Pendiente de baja </label>";
            $button.= '<li><a type="button" data-toggle="modal" id="verActivoModalBtn" data-target="#verActivoModal" onclick="verActivo(\'' . $id . '\')"> <i class="glyphicon glyphicon-eye-open"></i> Detalle </a></li>';
            $button.= '<li><a type="button" data-toggle="modal" id="editActivoModalBtn" data-target="#editActivoModal" onclick="editarActivo(\'' . $id . '\')"> <i class="glyphicon glyphicon-edit"></i> Editar </a></li>';
            $button.= '<li><a type="button" data-toggle="modal" id="certificarModalBtn" data-target="#certificarActivoModal" onclick="certificarActivo(\'' . $id . '\')"> <i class="glyphicon glyphicon-pencil"></i> Certificar </a></li>';
            $button .= '</ul></div>';
        } else if ($row[5] == 3) {
            //certificado
            $estado = "<label class='label label-info'> Certificado </label>";
            $button.= '<li><a type="button" data-toggle="modal" id="verActivoModalBtn" data-target="#verActivoModal" onclick="verActivo(\'' . $id . '\')"> <i class="glyphicon glyphicon-eye-open"></i> Detalle </a></li>';
            $button.= '<li><a type="button" data-toggle="modal" id="editActivoModalBtn" data-target="#editActivoModal" onclick="editarActivo(\'' . $id . '\')"> <i class="glyphicon glyphicon-edit"></i> Editar </a></li>';
            $button.= '<li><a type="button" data-toggle="modal" id="certificarModalBtn" data-target="#certificarActivoModal" onclick="certificarActivo(\'' . $id . '\')"> <i class="glyphicon glyphicon-pencil"></i> Certificar </a></li>';
            $button.= '<li><a type="button" data-toggle="modal" id="bajarModalBtn" data-target="#bajarActivoModal" onclick="bajarActivo(\'' . $id . '\')"> <i class="glyphicon glyphicon-circle-arrow-down"></i> Dar de baja </a></li>';
            $button .= '</ul></div>';
        }
        
        $output['data'][] = array(
            $row[0],
            $row[1],
            $row[2],
            $row[3],
            $row[4],
            $estado,
            $row[6],
            $row[7],
            number_format($row[8], 2),
            number_format($row[9], 2),
            $row[10],
            $button
        );
    } // /while 
}// if num_rows

$connect->close();

echo json_encode($output);
