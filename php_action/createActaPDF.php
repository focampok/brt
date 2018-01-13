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
require_once("../classes/conversor.php");
//instancio el objeto de la clase sql
$conversor = new NumberToLetterConverter();

if ($_POST) {

    $codigoActa = $_POST['codActa'];
    $personasPDF = $_POST['personasPDF'];
    $fechaPDF = $_POST['fechaPDF'];
    $horaPDF = $_POST['horaPDF'];
    $horaFinPDF = $_POST['horaFinPDF'];




    //genero el pdf con html...
    $rs = $conexion->obtenerActivosActa($codigoActa);
    while ($activos[] = $rs->fetch_array());
    $banner = "../assests/images/banner/" . 'logo_mem.png';

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
                    <div id="project">
                    <br>
                    <br>
                      <div>
                        <font size="5">
                            <b>' . 'ACTA N° ' . $codigoActa . '</b> En la ciudad de Guatemala, siendo ' . $horaPDF . ' ' . $fechaPDF . ' constituidos en las  Bodegas del Ministerio de Energía y Minas,  ubicadas en la 24 calle 21-12 de la zona 12, las siguientes personas:
                            <br>
                            ' . $personasPDF . '
                            <br>                                
                            <br>
                            <b><u>PRIMERO: </u></b><br> El objeto de la presente, es realizar la baja de Bienes de consistencia ferrosa en mal estado, ubicados en la dirección antes mencionada, para iniciar el trámite de baja. 
                            
                            <br>
                            <br>
                            <b><u>SEGUNDO: </u></b><br> Se realizo inventario físico de los bienes ferrosos en mal estado que se solicita a la Comisión Especial de Contraloría General de Cuentas y la Dirección de Bienes del Estado, para su respectiva baja mediante los lineamientos que indica el Acuerdo Gubernativo numero doscientos diez y siete guion noventa y cuatro (217-94), Articulo número cuatro (4) de fecha once de mayo de mil novecientos noventa y cuatro.
                            
                            <br>
                            <br>
                            <b><u>TERCERO: </u></b><br> El  bien al cual se les dará de baja y que por su uso se encuentra inservible se detalla a continuación:
                      </font>
                      </div>        
                    </div>
                  </header>
                  <main>
                    <table>
                      <thead>
                        <tr>
                          <th class="service">COD. INVENTARIO </th>
                          <th class="desc"> DESCRIPCION </th>
                          <th> CANTIDAD </th>
                          <th> VALOR </th>
                          <th> SUBTOTAL </th>
                        </tr>
                      </thead>
                      <tbody>';


    $contador = 1;
    $tt = 0;
    foreach ($activos as $activo) {
        $contenidoHTML.= '<tr>
                                      <td class = "service">' . $activo['codigo_inventario'] . '</td>
                                      <td class = "desc">' . $activo['descripcion'] . '</td>
                                      <td>'.$activo['cantidad'].'</td>
                                      <td>'.'Q'. number_format($activo['precio_unitario'],2).'</td>
                                      <td class = "total">' . 'Q ' . number_format($activo['cantidad'] * $activo['precio_unitario'], 2) . '</td>
                                     </tr>';
        
        $tt += $activo['cantidad'] * $activo['precio_unitario'];
        
        $contador++;
        if ($contador == count($activos)) {
            break;
        }
    }

    //calculo el total de la certifacion...
    $totalCert = "call obtenerTotalActa('$codigoActa',@total)";
    $connect->query($totalCert);
    $c = "select @total as salida";
    $query4 = $connect->query($c);
    $rs = $query4->fetch_assoc();
    $totalActa = $rs['salida'];
    $totalActaF = number_format($tt, 2);

    $cadenaTotal = $conversor->to_word($totalActaF);
    
    
    $contenidoHTML.= '<tr>
                                    <td colspan = "4" class = "grand total"> TOTAL</td>
                                    <td class = "grand total">' . 'Q ' . $totalActaF . '</td>
                                    </tr>';                                    
    $contenidoHTML .= '
                                    </tbody>
                                    </table>
                                    <div id = "pie">
                                    <font size = "5">
                                    <b><u> CUARTO: </u></b><br>
                                    El total de bienes a los cuales se le dará de baja asciende a la cantidad de ' . $cadenaTotal . ' <b>(Q  ' . $totalActaF . ')</b> 
                                        
                                    <br>
                                    <br>
                                    <b><u>QUINTO:</u></b><br>
                                    No habiendo más que hacer constar, se da por finalizada la presente acta en el mismo lugar y fecha de inicio, siendo ' . $horaFinPDF . ', firmando de conformidad los que en ella intervinieron.
                                    </font>.
                                    </div>
                                    </main>
                                    </body>
                                    </html>';


    //una vez creada la cadena html la escribo...
    //defino el tamaño carta a4
    $myPDF = new mPDF('c', 'A4');
    //escribo la cadena html en el pdf
    $myPDF->WriteHTML($contenidoHTML);
    //genero el pdf, le agrego el email del dueño y el total.
    $nombre = "ACTA_" . $codigoActa . ".pdf";
    $salida = "actas/" . $nombre . "";
    $myPDF->Output("../" . $salida);

    //el banner se subio correctamente...                
    $valid['success'] = true;
    $valid['messages'] = 'Acta creado exitosamente <a href = "verPDF.php?ruta=' . $salida . '"> <b> VISUALIZAR </b> </a>';

    $connect->close();
    echo json_encode($valid);
} // /if $_POST