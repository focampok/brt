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


$consulta = "SELECT * FROM CONTENEDOR WHERE codigo_contenedor != '-1';";
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
            ->setDescription("Reporte de contenedores y adiciones")
            ->setKeywords("reporte de contenedores")
            ->setCategory("Reporte excel");


    $titulosColumnas = array('FECHA', 'MARCA', 'MODELO', 'CODIG', 'CANT', 'DESCRIPCION', 'SUBTOTAL', 'TOTAL');


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
            ->setCellValue('F5', obtenerMes($hoy['mon']) .' '. $hoy['year']);


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
    $hoja->setCellValue('H' . ($i + 3), '=SUM(G6:G'.($i-1).')');

    //centrado
    $hoja->getStyle('F48')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
    $hoja->getStyle('F49')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
    $hoja->getStyle('F50')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
    //busco todas las adiciones...
    $consulta = "SELECT * FROM CONTENEDOR WHERE codigo_contenedor != '-1';";
    $resultado = $connect->query($consulta);
    $objPHPExcel->getActiveSheet()->setTitle("CONTENEDORES");


    //Setting the header type
    $nombreArchivo = "CONTENEDORES_" . $hoy['mday'] . "." . $hoy['mon'] . "." . $hoy["year"] . "_" . $hoy['hours'] . "." . $hoy['minutes'] . "." . $hoy['seconds'] . ".xlsx";
    header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
    header('Content-Disposition: attachment;filename="' . $nombreArchivo . '"');
    header('Cache-Control: max-age=0');
    if (ob_get_length() > 0) {
        ob_end_clean();
    }
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

?>