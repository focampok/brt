<?php 
session_start();
require_once 'db_connect.php' ;
$estado = $_SESSION['estado'];
//si no es usuario, no entra al dashboard.
if (isset($estado) != 2) {
    header("location: index.php");
}
?>