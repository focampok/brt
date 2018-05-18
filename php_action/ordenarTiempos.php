<?php

require_once 'core.php';
$tipoUser = $_SESSION["estado"];

$sql = "SELECT * FROM CARRERA;";
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
	  <ul class="dropdown-menu">
	    <li><a type="button" data-toggle="modal" data-target="#editTiempoModal" onclick="editarTiempo(\'' . $row[0] . '\')"> <i class="glyphicon glyphicon-edit"></i> Editar Registro</a></li>                           
                
                    <li><a type="button" data-toggle="modal" data-target="#eliminarTiempoModal" onclick="eliminarTiempo(\'' . $row[0] . '\')"> <i class="glyphicon glyphicon-trash"></i> Eliminar Registro </a></li> 
	  </ul>
	</div>';
        } else {
            $button = '<!-- Single button -->
	<div class="btn-group">
	  <button type="button" class="btn btn-default dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
	    Acción <span class="caret"></span>
	  </button>
	  <ul class="dropdown-menu">
	    <li><a type="button" data-toggle="modal" data-target="#editTiempoModal" onclick="editarTiempo(\'' . $row[0] . '\')"> <i class="glyphicon glyphicon-edit"></i> Editar Registro</a></li>                                       
	  </ul>
	</div>';
        }
        
        //nombre del piloto
        $XX = "SELECT nombre FROM PILOTO where codigoPILOTO = '$row[1]'";
        $sr = $connect->query($XX);
        $us = $sr->fetch_array();
        $nombrePiloto = $us[0];
        
        //nombre del heat
        $yy = "SELECT nombreHEAT,CATEGORIA_codCategoria FROM HEAT where codigoHEAT = '$row[2]'";
        $sry = $connect->query($yy);
        $usy = $sry->fetch_array();
        $nombreHeat = $usy[0];
        $codCat = $usy[1];
        
        
        //nombre de la categoria
        $aa = "SELECT nombreCategoria FROM CATEGORIA where codCategoria = '$codCat'";
        $sra = $connect->query($aa);
        $usa = $sra->fetch_array();
        $nombreCategoria = $usa[0];
           
        
        //obtengo la fecha a partir de la categoria
        $zz = "SELECT FECHA_codigoFecha FROM CATEGORIA where codCategoria = '$codCat'";
        $srz = $connect->query($zz);
        $usz = $srz->fetch_array();        
        $codFecha = $usz[0];        

        $output['data'][] = array(
            $row[1],
            $nombrePiloto,
            $codFecha,
            $nombreCategoria,
            $nombreHeat,            
            $row[3],
            $row[4],
            $button
        );

        $lista = "";
    } // /while 
}// if num_rows

$connect->close();

echo json_encode($output);
