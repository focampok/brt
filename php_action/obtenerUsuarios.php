<?php
$codigo = $_REQUEST['codigoDepartamento'];
//obtengo el producto en base al codigo 
require_once("../config/db.php");
//cargar la clase de login
require_once("../classes/DBMaster.php");
//instancio el objeto de la clase sql
$conexion = new DBMaster();
$conexion->obtenerUsuarios($codigo);
$cadenaUsuarios = $conexion->usuarios;
echo $cadenaUsuarios
?>