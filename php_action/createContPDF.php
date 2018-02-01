<?php

require_once 'core.php';
$valid['success'] = array('success' => false, 'messages' => array());

require_once("../classes/pdf/mpdf.php");
//conexion a la BD para obtener la info
require_once("../config/db.php");
// cargar la clase de login
require_once("../classes/DBMaster.php");
//instancio el objeto de la clase sql
$conexion = new DBMaster();
//obtengo un array de lo que hay en la tabla actualmente

if ($_POST) {

    $codigoCertificacion = $_POST['codCertificacion'];
    $encabezadoPDF = $_POST['encabezadoPDF'];
    $fechaPDF = $_POST['fechaPDF'];



    //genero el pdf con html...
    $rs = $conexion->obtenerActivosContenedor($codigoCertificacion);
    while ($activos[] = $rs->fetch_array());
    $banner = "../assests/images/banner/" . 'logo_guategas.png';

    //cadena html de la cotizacion
    $contenidoHTML = '<html lang="en">
                <head>
                  <meta charset="utf-8">
                  <title>Example 1</title>
                  <link rel="stylesheet" href="../certificacionStyle/css/style.css" media="all" />
                </head>
                <body>
                  <header class="clearfix">
                    <div id="logo">
                      <a href="../certificaciones.php"><img src="' . $banner . '" border="1" width="400" height="175"></a>
                    </div>
                    <h1></h1>
                    <div id="company" class="clearfix">
                      <div><font size="5"><b>' . 'CONTENEDOR ' . $codigoCertificacion . '</b></font></div>
                      <div><font size="5"><b>' . $fechaPDF . '</b></font></div>
                    </div>
                    <div id="project">
                    <br>
                    <br>
                      <div><font size="5"><b>' . $encabezadoPDF . '</b></font></div>        
                    </div>
                  </header>
                  <main>
                    <table>
                      <thead>
                        <tr>
                          <th class="service">COD. Producto </th>
                          <th class="desc"> DESCRIPCION </th>
                          <th> CANTIDAD </th>
                          <th> PRECIO UNITARIO</th>
                          <th> SUBTOTAL </th>
                        </tr>
                      </thead>
                      <tbody>';


    $contador = 1;
    foreach ($activos as $activo) {
        $contenidoHTML.= '<tr>
                                      <td class = "service">' . $activo['codigo_producto'] . '</td>
                                      <td class = "desc">' . $activo['descripcion'] . '</td>
                                      <td>' . $activo['cantidad'] . '</td>
                                      <td>' . 'Q ' . number_format($activo['precio_unitario'], 2) . '</td>                                      
                                      <td class = "total">' . 'Q ' . number_format($activo['cantidad'] * $activo['precio_unitario'], 2) . '</td>
                                     </tr>';
        $contador++;
        if ($contador == count($activos)) {
            break;
        }
    }

    //calculo el total de la certifacion...
    $totalCert = "call obtenerTotalContenedor('$codigoCertificacion',@total)";
    $connect->query($totalCert);
    $c = "select @total as salida";
    $query4 = $connect->query($c);
    $rs = $query4->fetch_assoc();
    $totalCertificacion = $rs['salida'];

    $contenidoHTML .= '<tr>
                                    <td colspan = "4" class = "grand total"> TOTAL</td>
                                    <td class = "grand total">' . 'Q ' . number_format($totalCertificacion, 2) . '</td>
                                    </tr>
                                    </tbody>
                                    </table>
                                    <div id = "pie">
                                    <font size = "5"><b> ' . $fechaPDF . '<b></font>.
                                    </div>
                                    </main>
                                    <footer>
                                    <center><font size = "4">GuateGas Sociedad Anonima PBX:12345678 / pagina / correo</font></center>
                                    </footer>
                                    </body>
                                    </html>';

    //una vez creada la cadena html la escribo...
    //defino el tamaño carta a4
    $myPDF = new mPDF('c', 'A4');
    //escribo la cadena html en el pdf
    $myPDF->WriteHTML($contenidoHTML);
    //genero el pdf, le agrego el email del dueño y el total.
    $nombre = "CONTENEDOR_" . $codigoCertificacion . ".pdf";
    $salida = "contenedores/" . $nombre . "";
    $myPDF->Output("../" . $salida);

    //el banner se subio correctamente...                
    $valid['success'] = true;
    $valid['messages'] = 'PDF generado exitosamente <a href = "verPDF.php?ruta=' . $salida . '"> <b> VISUALIZAR </b> </a>';

    $connect->close();
    echo json_encode($valid);
} // /if $_POST