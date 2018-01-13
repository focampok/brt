<?php
$ruta = $_REQUEST['ruta'];
header('Content-type: application/pdf');
header('Content-Disposition: inline; filename="'.$ruta.'"');
readfile($ruta);
?>

