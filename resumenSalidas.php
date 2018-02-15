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


$consulta = "SELECT * FROM ASIGNACION;";
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


    $titulosColumnas = array('CODIGO', 'CANTIDAD', 'PRECIO', 'SUBTOTAL', 'PROYECTO/ORDEN');


    // Se agregan los encabezados de la tabla
    $hoja
            ->setCellValue('A1', $titulosColumnas[0])
            ->setCellValue('B1', $titulosColumnas[1])
            ->setCellValue('C1', $titulosColumnas[2])
            ->setCellValue('D1', $titulosColumnas[3])
            ->setCellValue('E1', $titulosColumnas[4]);
    
    //Se agregan los datos de las adiciones
    $i = 3;
    while ($fila = $resultado->fetch_array()) {
        //escribo los productos
        $hoja->setCellValue('A' . $i, $fila['PRODUCTO_codigo_producto']);
        $hoja->setCellValue('B' . $i, $fila['cantidad']);
        $hoja->setCellValue('C' . $i, $fila['precio_unitario']);
        $hoja->setCellValue('D' . $i, '=B'.$i.'*'.'C'.$i);
        $hoja->setCellValue('E' . $i, $fila['PROYECTO_codigo_proyecto']);

        //seteo la celda tipo numerico.
        $hoja->getStyle('C' . $i)->getNumberFormat()->setFormatCode(PHPExcel_Style_NumberFormat::FORMAT_NUMBER_COMMA_SEPARATED1);
        $hoja->getStyle('D' . $i)->getNumberFormat()->setFormatCode(PHPExcel_Style_NumberFormat::FORMAT_NUMBER_COMMA_SEPARATED1);        
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
    $objPHPExcel->getActiveSheet()->getColumnDimension('C')->setWidth(10);
    $objPHPExcel->getActiveSheet()->getColumnDimension('D')->setWidth(10);
    $objPHPExcel->getActiveSheet()->getColumnDimension('E')->setWidth(15);


    //aplico los estilos...
    $hoja->getStyle('A1:E1')->applyFromArray($estiloEncabezado);    

       
    //seteo estilos
    $hoja->setSharedStyle($estiloContenido, "A3:E".$i);    
    $objPHPExcel->getActiveSheet()->setTitle("SALIDAS");

    //Setting the header type
    $nombreArchivo = "SALIDAS_" . $hoy['mday'] . "." . $hoy['mon'] . "." . $hoy["year"] . "_" . $hoy['hours'] . "." . $hoy['minutes'] . "." . $hoy['seconds'] . ".xlsx";
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