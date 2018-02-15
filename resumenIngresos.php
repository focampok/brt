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


$consulta = "SELECT * FROM PRODUCTO WHERE ORDEN_codigo_orden != '-1';";
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


    $titulosColumnas = array('CODIGO', 'FECHA', 'ESTADO', 'CANTIDAD', 'MARCA', 'MODELO', 'SERIE', 'DESCRIPCION', 'PRECIO', 'SUBTOTAL', 'ORDEN');


    // Se agregan los encabezados de la tabla
    $hoja
            ->setCellValue('A1', $titulosColumnas[0])
            ->setCellValue('B1', $titulosColumnas[1])
            ->setCellValue('C1', $titulosColumnas[2])
            ->setCellValue('D1', $titulosColumnas[3])
            ->setCellValue('E1', $titulosColumnas[4])
            ->setCellValue('F1', $titulosColumnas[5])
            ->setCellValue('G1', $titulosColumnas[6])
            ->setCellValue('H1', $titulosColumnas[7])
            ->setCellValue('I1', $titulosColumnas[8])
            ->setCellValue('J1', $titulosColumnas[9])
            ->setCellValue('K1', $titulosColumnas[10]);
    //Se agregan los datos de las adiciones
    $i = 3;
    while ($fila = $resultado->fetch_array()) {
        //escribo los productos
        $hoja->setCellValue('A' . $i, $fila['codigo_producto']);
        $hoja->setCellValue('B' . $i, $fila['fecha']);
        $hoja->setCellValue('C' . $i, obtenerEstado($fila['estado']));
        $hoja->setCellValue('D' . $i, $fila['cantidad']);
        $hoja->setCellValue('E' . $i, $fila['marca']);
        $hoja->setCellValue('F' . $i, $fila['modelo']);
        $hoja->setCellValue('G' . $i, $fila['serie']);
        $hoja->setCellValue('H' . $i, $fila['descripcion']);
        $hoja->setCellValue('I' . $i, $fila['precio_unitario']);
        $hoja->setCellValue('J' . $i, '=D'.$i.'*'.'I'.$i);
        $hoja->setCellValue('K' . $i, $fila['ORDEN_codigo_orden']);

        //seteo la celda tipo numerico.
        $hoja->getStyle('I' . $i)->getNumberFormat()->setFormatCode(PHPExcel_Style_NumberFormat::FORMAT_NUMBER_COMMA_SEPARATED1);
        $hoja->getStyle('J' . $i)->getNumberFormat()->setFormatCode(PHPExcel_Style_NumberFormat::FORMAT_NUMBER_COMMA_SEPARATED1);        
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
    $objPHPExcel->getActiveSheet()->getColumnDimension('B')->setWidth(13);
    $objPHPExcel->getActiveSheet()->getColumnDimension('C')->setWidth(13);
    $objPHPExcel->getActiveSheet()->getColumnDimension('D')->setWidth(10);
    $objPHPExcel->getActiveSheet()->getColumnDimension('E')->setWidth(10);
    $objPHPExcel->getActiveSheet()->getColumnDimension('F')->setWidth(10);
    $objPHPExcel->getActiveSheet()->getColumnDimension('G')->setWidth(10);
    $objPHPExcel->getActiveSheet()->getColumnDimension('H')->setWidth(110);
    $objPHPExcel->getActiveSheet()->getColumnDimension('I')->setWidth(10);
    $objPHPExcel->getActiveSheet()->getColumnDimension('J')->setWidth(10);
    $objPHPExcel->getActiveSheet()->getColumnDimension('K')->setWidth(10);


    //aplico los estilos...
    $hoja->getStyle('A1:K1')->applyFromArray($estiloEncabezado);    

       
    //seteo estilos
    $hoja->setSharedStyle($estiloContenido, "A3:K".$i);    
    $objPHPExcel->getActiveSheet()->setTitle("INGRESOS");

    //Setting the header type
    $nombreArchivo = "INGRESOS_" . $hoy['mday'] . "." . $hoy['mon'] . "." . $hoy["year"] . "_" . $hoy['hours'] . "." . $hoy['minutes'] . "." . $hoy['seconds'] . ".xlsx";
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

function obtenerEstado($estado) {
    switch ($estado) {
        case 1:
            return "Disponible";
        case 0:
            return "No disponible";
        case 3:
            return "En proyecto";        
    }
}

?>