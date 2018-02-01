<?php

require_once ("php_action/core.php");
//conexion a la BD para obtener la info
require_once("config/db.php");
/** Se agrega la libreria PHPExcel */
require_once("classes/lib/PHPExcel/PHPExcel.php");
//obtengo un array de lo que hay en la tabla actualmente
require_once("classes/conversor.php");
//conexion a la BD para obtener la info
// cargar la clase de login
require_once("classes/DBMaster.php");
//instancio el objeto de la clase sql
$conexion = new DBMaster();
//instancio el objeto de la clase sql
$conversor = new NumberToLetterConverter();


$consulta = "SELECT * FROM CONTENEDOR where codigo_contenedor != '-1';";
$resultado = $connect->query($consulta);

//obtengo la fecha actual.
$hoy = getdate();

if ($resultado->num_rows > 0) {
    date_default_timezone_set('America/Guatemala');
    // create new PHPExcel object
    $objPHPExcel = new PHPExcel;
    // create the writer
    $objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, "Excel2007");

    $hoja = $objPHPExcel->getActiveSheet();

    // Se asignan las propiedades del libro
    $objPHPExcel->getProperties()->setCreator("Codedrinks") //Autor
            ->setLastModifiedBy("Ocampo") //Ultimo usuario que lo modificó
            ->setTitle("Reporte Excel")
            ->setSubject("Reporte Excel")
            ->setDescription("Reporte de productos y contenedores")
            ->setKeywords("reporte productos contenedores")
            ->setCategory("Reporte excel");


    $titulosColumnas = array('FECHA', 'MARCA', 'MODELO', 'CODIGO', 'CANT', 'DESCRIPCION', 'SUBTOTAL', 'TOTAL', 'ESTADO', 'PRECIO UNITARIO', 'PROYECTO');


    // Se agregan los encabezados de la tabla
    $hoja
            ->setCellValue('A1', $titulosColumnas[0])
            ->setCellValue('B1', $titulosColumnas[1])
            ->setCellValue('C1', $titulosColumnas[2])
            ->setCellValue('D1', $titulosColumnas[3])
            ->setCellValue('E1', $titulosColumnas[4])
            ->setCellValue('F1', $titulosColumnas[5])
            ->setCellValue('G1', $titulosColumnas[6])
            ->setCellValue('H1', $titulosColumnas[7]);


    //letra roja y negrita para el folio...
    $hoja->getStyle('I2')->getFont()->setBold(true);
    $hoja->getStyle('I2')->getFont()->getColor()->setRGB('8A0808');
    // Se agrega info del mem
    $hoja
            ->setCellValue('F2', 'GUATE GAS')
            ->setCellValue('F3', 'SOCIEDAD ANONIMA')
            ->setCellValue('F4', 'COORDINADORA DE LOGISTICA')
            ->setCellValue('F5', obtenerMes($hoy['mon']) . ' ' . $hoy['year']);


    //Se agregan los datos de las adiciones
    $i = 6;
    while ($fila = $resultado->fetch_array()) {
        $codigoAdicion = $fila['codigo_contenedor'];
        $consultaAdicion = "call obtenerTotalContenedor('$codigoAdicion',@total)";
        $connect->query($consultaAdicion);
        $c = "select @total as salida";
        $query4 = $connect->query($c);
        $rs = $query4->fetch_assoc();
        $totalAdicion = $rs['salida'];

        if ($totalAdicion != 0) {
            $total = $totalAdicion;
        } else {
            $total = 0;
        }

        //escribo las adiciones
        $hoja->setCellValue('F' . $i, $fila['nombre_contenedor']);
        //seteo la celda tipo numerico.
        $hoja->getStyle('G' . $i)->getNumberFormat()->setFormatCode(PHPExcel_Style_NumberFormat::FORMAT_NUMBER_COMMA_SEPARATED1);
        $hoja->setCellValue('G' . $i, $total);
        $i++;
    }
    //ESTILO PARA EL ENCABEZADO DE LA TABLA.
    $estiloEncabezado = array(
        'font' => array(
            'name' => 'Arial',
            'bold' => TRUE,
            'size' => 9,
            'color' => array(
                'rgb' => '000000'
            )
        ),
        'fill' => array(
            'type' => PHPExcel_Style_Fill::FILL_SOLID,
            'color' => array('rgb' => 'bbbc5e')
        ),
        'borders' => array(
            'allborders' => array(
                'style' => PHPExcel_Style_Border::BORDER_THIN
            )
        ),
        'alignment' => array(
            'horizontal' => PHPExcel_Style_Alignment::HORIZONTAL_CENTER,
            'vertical' => PHPExcel_Style_Alignment::VERTICAL_CENTER,
            'wrap' => TRUE
    ));

    //ESTILO PARA DONDE DICE MEM...

    $estiloInformacion = new PHPExcel_Style();
    $estiloInformacion->applyFromArray(
            array(
                'font' => array(
                    'name' => 'Arial',
                    'bold' => TRUE,
                    'size' => 14
                ),
                'alignment' => array(
                    'horizontal' => PHPExcel_Style_Alignment::HORIZONTAL_CENTER,
                    'vertical' => PHPExcel_Style_Alignment::VERTICAL_CENTER,
                    'wrap' => TRUE
                )
    ));

    //estilo para el contenido 
    $estiloContenido = new PHPExcel_Style();
    $estiloContenido->applyFromArray(
            array(
                'font' => array(
                    'name' => 'Arial',
                    'size' => 12
                ),
                'alignment' => array(
                    'horizontal' => PHPExcel_Style_Alignment::HORIZONTAL_CENTER,
                    'vertical' => PHPExcel_Style_Alignment::VERTICAL_CENTER,
                    'wrap' => TRUE
                ),
                'borders' => array(
                    'allborders' => array(
                        'style' => PHPExcel_Style_Border::BORDER_THIN
                    )
                )
    ));

    //seteo el ancho de cada columna...
    $objPHPExcel->getActiveSheet()->getColumnDimension('A')->setWidth(10);
    $objPHPExcel->getActiveSheet()->getColumnDimension('B')->setWidth(10);
    $objPHPExcel->getActiveSheet()->getColumnDimension('C')->setWidth(13);
    $objPHPExcel->getActiveSheet()->getColumnDimension('D')->setWidth(14);
    $objPHPExcel->getActiveSheet()->getColumnDimension('E')->setWidth(10);
    $objPHPExcel->getActiveSheet()->getColumnDimension('F')->setWidth(110);
    $objPHPExcel->getActiveSheet()->getColumnDimension('G')->setWidth(10);
    $objPHPExcel->getActiveSheet()->getColumnDimension('H')->setWidth(10);
    $objPHPExcel->getActiveSheet()->getColumnDimension('I')->setWidth(10);
    $objPHPExcel->getActiveSheet()->getColumnDimension('J')->setWidth(10);


    //aplico los estilos...
    $hoja->getStyle('A1:H1')->applyFromArray($estiloEncabezado);
    $hoja->setSharedStyle($estiloInformacion, "F2:F5");

    //escribo el pie con total..
    $mes = obtenerMes($hoy['mon']);
    $totalInventario = "EL TOTAL DEL INVENTARIO AL " . $hoy['mday'] . " DE " . $mes . " DEL AÑO " . $hoy['year'] . " ES DE:";
    //seteo el valor y pinto la celda.
    $hoja->setCellValue('F' . ($i + 2), $totalInventario);
    $hoja->getStyle('F' . ($i + 2))->getFont()->setBold(TRUE);
    $hoja->getStyle('F' . ($i + 2))->getFill()->setFillType(PHPExcel_Style_Fill::FILL_SOLID)->getStartColor()->setRGB('e5e362');

    $consultaTotal = "call obtenerTotalIngresos(@total)";
    $connect->query($consultaTotal);
    $c = "select @total as salida";
    $query4 = $connect->query($c);
    $rs = $query4->fetch_assoc();
    $totalIngresos = $rs['salida'];
    $totalIng = number_format($totalIngresos, 2);
    $cadenaTotal = $conversor->to_word($totalIng);
    //seteo el valor y pinto la celda.
    $hoja->setCellValue('F' . ($i + 3), $cadenaTotal);
    $hoja->getStyle('F' . ($i + 3))->getFont()->setBold(TRUE);
    $hoja->getStyle('F' . ($i + 3))->getFill()->setFillType(PHPExcel_Style_Fill::FILL_SOLID)->getStartColor()->setRGB('e5e362');

    //seteo el valor y le doy formato.
    $hoja->getStyle('H' . ($i + 3))->getNumberFormat()->setFormatCode(PHPExcel_Style_NumberFormat::FORMAT_NUMBER_COMMA_SEPARATED1);
    $hoja->setCellValue('H' . ($i + 3), '=SUM(G6:G' . ($i - 1) . ')');

    //escribo los nombres y firmas...
//    $hoja->setCellValue('F48', "FRANCISCO JOSE OCAMPO GONZALEZ                                                                                                             ANA LETICIA ARAGON CASTILLO");
//    $hoja->getStyle('F48')->getFont()->setBold(TRUE);
//    $hoja->setCellValue('F49', "ENCARGADO DE INVENTARIOS                                                                                                                 JEFE DE DEPARTAMENTO FINANCIERO");
//    $hoja->getStyle('F49')->getFont()->setBold(TRUE);
//    $hoja->setCellValue('F50', "DIRECCION SUPERIOR                                                                                                                                                                    DIRECCION SUPERIOR");
//    $hoja->getStyle('F50')->getFont()->setBold(TRUE);

    //centrado
    $hoja->getStyle('F48')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
    $hoja->getStyle('F49')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
    $hoja->getStyle('F50')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
    //busco todas las adiciones...
    $consulta = "SELECT * FROM CONTENEDOR WHERE codigo_contenedor != '-1';";
    $resultado = $connect->query($consulta);

    $x = 53;
    $contador = 1;
    if ($resultado->num_rows > 0) {
        while ($adiciones[] = $resultado->fetch_array());
        //recorro las adiciones...
        foreach ($adiciones as $adicion) {
            $codAdicion = $adicion['codigo_contenedor'];
            //obtengo el total de cada adicion...
            $consultaAdicion = "call obtenerTotalContenedor('$codAdicion',@total)";
            $connect->query($consultaAdicion);
            $c = "select @total as salida";
            $query4 = $connect->query($c);
            $rs = $query4->fetch_assoc();
            $totalAdicion = $rs['salida'];

            //contador registros...           

            if ($totalAdicion != null) {
                $hoja->setCellValue('F' . ($x + $contador), "CONTADOR " . $codAdicion . ' - ' . $adicion['nombre_contenedor']);
                $hoja->getStyle('F' . ($x + $contador))->getFont()->setBold(TRUE);
                $hoja->getStyle('F' . ($x + $contador))->getFill()->setFillType(PHPExcel_Style_Fill::FILL_SOLID)->getStartColor()->setRGB('e5e362');
                $hoja->getStyle('F' . ($x + $contador))->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
                $contador++;

                //obtengo los activos por cada adicion...
                $rs = $conexion->obtenerActivosAdicion($codAdicion);

                while ($activo = $rs->fetch_array()) {
                    //escribo la info del activo y la centro.
                    $hoja->setCellValue('A' . ($x + $contador), $activo['fecha']);
                    $hoja->getStyle('A' . ($x + $contador))->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
                    //cuenta
                    $hoja->setCellValue('B' . ($x + $contador), $activo['marca']);
                    $hoja->getStyle('B' . ($x + $contador))->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
                    //subcuenta
                    $hoja->setCellValue('C' . ($x + $contador), $activo['modelo']);
                    $hoja->getStyle('C' . ($x + $contador))->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
                    //cod.inventario
                    $hoja->setCellValue('D' . ($x + $contador), $activo['codigo_producto']);
                    $hoja->getStyle('D' . ($x + $contador))->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
                    //cantidad
                    $hoja->setCellValue('E' . ($x + $contador), $activo['cantidad']);
                    $hoja->getStyle('E' . ($x + $contador))->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
                    $hoja->getStyle('E' . $i)->getNumberFormat()->setFormatCode(PHPExcel_Style_NumberFormat::FORMAT_NUMBER_COMMA_SEPARATED1);
                    //descripcion
                    $hoja->setCellValue('F' . ($x + $contador), $activo['descripcion']);
                    $hoja->getStyle('F' . ($x + $contador))->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
                    //estado
                    $hoja->setCellValue('G' . ($x + $contador), obtenerEstado($activo['estado']));
                    $hoja->getStyle('G' . ($x + $contador))->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
                    //precio unitario
                    $hoja->setCellValue('H' . ($x + $contador), $activo['precio_unitario']);
                    $hoja->getStyle('H' . ($x + $contador))->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
                    $hoja->getStyle('H' . $i)->getNumberFormat()->setFormatCode(PHPExcel_Style_NumberFormat::FORMAT_NUMBER_COMMA_SEPARATED1);
                    //total
                    $hoja->setCellValue('I' . ($x + $contador), '=' . 'E' . ($x + $contador) . '*' . 'H' . ($x + $contador));
                    $hoja->getStyle('I' . ($x + $contador))->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
                    $hoja->getStyle('I' . $i)->getNumberFormat()->setFormatCode(PHPExcel_Style_NumberFormat::FORMAT_NUMBER_COMMA_SEPARATED1);
                    //PROYECTO
                    $codP = $activo['PROYECTO_codigo_proyecto'];
                    $s = "SELECT codigo_proyecto FROM PROYECTO WHERE codigo_proyecto = '$codP'";
                    $rs = $connect->query($s);
                    $us = $rs->fetch_array();

                    if ($us[0] == '-1') {
                        $nombre = "";
                    } else {
                        $nombre = $us[0];
                    }
                    
                    $hoja->setCellValue('J' . ($x + $contador), $nombre);
                    $hoja->getStyle('J' . ($x + $contador))->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
                    $hoja->getStyle('J' . ($x + $contador))->getFont()->setBold(true);
                    $hoja->getStyle('J' . ($x + $contador))->getFont()->getColor()->setRGB('8A0808');

                    //incremento...
                    $x++;
                }
            }
        }
    }

    $inicio = 53;

    $hoja
            ->setCellValue('A' . ($inicio), $titulosColumnas[0])
            ->setCellValue('B' . ($inicio), $titulosColumnas[1])
            ->setCellValue('C' . ($inicio), $titulosColumnas[2])
            ->setCellValue('D' . ($inicio), $titulosColumnas[3])
            ->setCellValue('E' . ($inicio), $titulosColumnas[4])
            ->setCellValue('F' . ($inicio), $titulosColumnas[5])
            ->setCellValue('G' . ($inicio), 'ESTADO')
            ->setCellValue('H' . ($inicio), 'VALOR UNITARIO')
            ->setCellValue('I' . ($inicio), 'TOTAL')
            ->setCellValue('J' . ($inicio), 'PROYECTO');



    // Se agregan los encabezados de la tabla al finalizar los registros...
    $hoja
            ->setCellValue('A' . ($x + $contador + 1), $titulosColumnas[0])
            ->setCellValue('B' . ($x + $contador + 1), $titulosColumnas[1])
            ->setCellValue('C' . ($x + $contador + 1), $titulosColumnas[2])
            ->setCellValue('D' . ($x + $contador + 1), $titulosColumnas[3])
            ->setCellValue('E' . ($x + $contador + 1), $titulosColumnas[4])
            ->setCellValue('F' . ($x + $contador + 1), $titulosColumnas[5])
            ->setCellValue('G' . ($x + $contador + 1), 'ESTADO')
            ->setCellValue('H' . ($x + $contador + 1), 'VALOR UNITARIO')
            ->setCellValue('I' . ($x + $contador + 1), 'TOTAL')
            ->setCellValue('J' . ($x + $contador + 1), 'PROYECTO');

    //aplico los estilos...
    $hoja->getStyle('A' . $inicio . ':J' . $inicio)->applyFromArray($estiloEncabezado);
    $hoja->getStyle('A' . ($x + $contador + 1) . ':J' . ($x + $contador + 1))->applyFromArray($estiloEncabezado);

    $objPHPExcel->getActiveSheet()->setTitle("PRODUCTOS");

    //Setting the header type
    $nombreArchivo = "INVENTARIO_" . $hoy['mday'] . "." . $hoy['mon'] . "." . $hoy["year"] . "_" . $hoy['hours'] . "." . $hoy['minutes'] . "." . $hoy['seconds'] . ".xlsx";
    header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
    header('Content-Disposition: attachment;filename="' . $nombreArchivo . '"');
    header('Cache-Control: max-age=0');
    ob_clean();
    $objWriter->save('php://output');
    exit;
} else {
    print_r('No hay resultados para mostrar');
}

function obtenerMes($numeroMes) {
    switch ($numeroMes) {
        case 1:
            return "Enero";
        case 2:
            return "Febrero";
        case 3:
            return "Marzo";
        case 4:
            return "Abril";
        case 5:
            return "Mayo";
        case 6:
            return "Junio";
        case 7:
            return "Julio";
        case 8:
            return "Agosto";
        case 9:
            return "Septiembre";
        case 10:
            return "Octubre";
        case 11:
            return "Noviembre";
        case 12:
            return "Diciembre";
    }
}

function obtenerEstado($numeroEstado) {
    switch ($numeroEstado) {
        case 1:
            return "Disponible";
        case 2:
            return "Proyecto";
        case 3:
            return "Pendiente";
        case 0:
            return "No disponible";
    }
}

?>