<?php

require_once 'core.php';
$id = $_POST['id'];
$sql = "SELECT cantidad,PROYECTO_codigo_proyecto FROM ASIGNACION WHERE PRODUCTO_codigo_producto = '$id';";
$result = $connect->query($sql);
if ($result->num_rows > 0) {
    $salida=" ";
    while ($row = $result->fetch_array()) {
        $salida .= $row[0].' - '.$row[1].'; ';
    }
}
// if num_rows
$connect->close();
echo json_encode($salida);
