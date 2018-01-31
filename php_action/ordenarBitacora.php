<?php

require_once 'core.php';

$sql = "SELECT * FROM BITACORA";
$result = $connect->query($sql);

$output = array('data' => array());

if ($result->num_rows > 0) {
    $total = "";

    while ($row = $result->fetch_array()) {
        $bitacoraID = $row[0];

        $s = "SELECT nit,nombre,apellido FROM USUARIO WHERE nit = '$row[3]'";
        $rs = $connect->query($s);
        $us = $rs->fetch_array();
        $nombre = $us[0] . ' - ' . $us[1].' '.$us[2];
        $output['data'][] = array(
            $row[0],
            $row[1],
            $row[2],
            $nombre
        );
    } // /while 
} // if num_rows

$connect->close();

echo json_encode($output);
