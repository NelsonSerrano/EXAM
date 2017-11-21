<?php
require_once('control/conexionOb.php');
$idExamen = $_GET['idExamen'];
$idCurso = $_GET['idCurso'];
$examen = $_GET['examen'];
$fechaExamen = $_GET['fechaExamen'];
$curso = $_GET['curso'];
$cantidadPreguntas = $_GET['cantidadPreguntas'];
$titulo = "Reporte Respuestas: ".$curso." "."Exámen: ".$examen;

$sqlRespuestaCurso = "SELECT rut_estudiante, concat(nombre,' ', apellido_paterno,' ', apellido_materno) AS alumno, id_respuestas, detalle_respuesta FROM respuestas INNER JOIN detalle_resp_estu ON detalle_resp_estu.respuestas_id_respuestas = respuestas.id_respuestas INNER JOIN estudiante ON estudiante.rut = detalle_resp_estu.estudiante_rut WHERE examen_id_examen = '$idExamen' AND id_cur = '$idCurso'";
$resultado = $mysqli->query($sqlRespuestaCurso);
if($resultado->num_rows > 0 ){
/** Se agrega la libreria PHPExcel */
require_once 'lib/PHPExcel/PHPExcel.php';
// Se crea el objeto PHPExcel
$objPHPExcel = new PHPExcel();
// Se asignan las propiedades del libro
$objPHPExcel->getProperties()->setCreator("Codedrinks") //Autor
               ->setLastModifiedBy("Codedrinks") //Ultimo usuario que lo modificó
               ->setTitle("Reporte Excel con PHP y MySQL")
               ->setSubject("Reporte Excel con PHP y MySQL")
               ->setDescription("Reporte de Alumnos")
               ->setKeywords("reporte alumnos carreras")
               ->setCategory("Reporte excel");
$tituloReporte = $titulo;
$numero = 0;
$titulosColumnas = array('NOMBRES','EXÁMEN', 'CURSO','FECHA', 'RESPUESTAS');

$letraTitulo = "E1";
$letraCelda =  "E3";
$objPHPExcel->getActiveSheet()->insertNewRowBefore(7, 2);
$objPHPExcel->setActiveSheetIndex(0)
                ->mergeCells('A1:'.$letraTitulo); // LINEA VE EL TITULO DE LA HOJA DE EXCEL
// Se agregan los titulos del reporte
$objPHPExcel->setActiveSheetIndex(0)
          ->setCellValue('A1',$tituloReporte)
                ->setCellValue('A3',  $titulosColumnas[0])
                ->setCellValue('B3',  $titulosColumnas[1])
                ->setCellValue('C3',  $titulosColumnas[2])
                ->setCellValue('D3',  $titulosColumnas[3])
                ->setCellValue($letraCelda,  $titulosColumnas[4]);
               
    $i = 5; // es de donde comienza a imprimirse las filas con la informacion 
    $count = 0;
    while ($fila = $resultado->fetch_array()) {
      $count++;
      $objPHPExcel->setActiveSheetIndex(0)
                ->setCellValue('A'.$i, $fila['alumno'])
                ->setCellValue('B'.$i, $examen)
                ->setCellValue('C'.$i, $curso)
                ->setCellValue('D'.$i,  $fechaExamen)
                ->setCellValue('E'.$i,  $fila['detalle_respuesta']);
          $i++;
    }
    
$estiloTituloReporte = array(
          'font' => array(
            'name'      => 'Verdana',
              'bold'      => true,
              'italic'    => false,
                'strike'    => false,
                'size' =>16,
                'color'     => array(
                    'rgb' => 'FFFFFF'
                  )
            ),
          'fill' => array(
        'type'  => PHPExcel_Style_Fill::FILL_SOLID,
        'color' => array('argb' => 'FF220835')
      ),
            'borders' => array(
                'allborders' => array(
                  'style' => PHPExcel_Style_Border::BORDER_NONE                    
                )
            ), 
            'alignment' =>  array(
              'horizontal' => PHPExcel_Style_Alignment::HORIZONTAL_CENTER,
              'vertical'   => PHPExcel_Style_Alignment::VERTICAL_CENTER,
              'rotation'   => 0,
              'wrap'          => TRUE
        )
        );

    $estiloTituloColumnas = array(
            'font' => array(
                'name'      => 'Arial',
                'bold'      => true,                          
                'color'     => array(
                    'rgb' => 'FFFFFF'
                )
            ),
            'fill'  => array(
        'type'    => PHPExcel_Style_Fill::FILL_GRADIENT_LINEAR,
        'rotation'   => 90,
            'startcolor' => array(
                'rgb' => 'c47cf2'
            ),
            'endcolor'   => array(
                'argb' => 'FF431a5d'
            )
      ),
            'borders' => array(
              'top'     => array(
                    'style' => PHPExcel_Style_Border::BORDER_MEDIUM ,
                    'color' => array(
                        'rgb' => '143860'
                    )
                ),
                'bottom'     => array(
                    'style' => PHPExcel_Style_Border::BORDER_MEDIUM ,
                    'color' => array(
                        'rgb' => '143860'
                    )
                )
            ),
      'alignment' =>  array(
              'horizontal' => PHPExcel_Style_Alignment::HORIZONTAL_CENTER,
              'vertical'   => PHPExcel_Style_Alignment::VERTICAL_CENTER,
              'wrap'          => TRUE
        ));
      
    $estiloInformacion = new PHPExcel_Style();
    $estiloInformacion->applyFromArray(
      array(
              'font' => array(
                'name'      => 'Arial',               
                'color'     => array(
                    'rgb' => '000000'
                )
            ),
            'fill'  => array(
        'type'    => PHPExcel_Style_Fill::FILL_SOLID,
        'color'   => array('argb' => 'FFd9b7f4')
      ),
            'borders' => array(
                'left'     => array(
                    'style' => PHPExcel_Style_Border::BORDER_THIN ,
                  'color' => array(
                    'rgb' => '3a2a47'
                    )
                )             
            )
        ));
     
    $objPHPExcel->getActiveSheet()->getStyle('A1:E1')->applyFromArray($estiloTituloReporte);
    $objPHPExcel->getActiveSheet()->getStyle('A3:E3')->applyFromArray($estiloTituloColumnas);   
    $objPHPExcel->getActiveSheet()->setSharedStyle($estiloInformacion, "A4:E".($i-1));
        
    for($i = 'A'; $i <= 'E'; $i++){
      $objPHPExcel->setActiveSheetIndex(0)      
        ->getColumnDimension($i)->setAutoSize(TRUE);
    }
    
    // Se asigna el nombre a la hoja
    $objPHPExcel->getActiveSheet()->setTitle('Respuestas');

    // Se activa la hoja para que sea la que se muestre cuando el archivo se abre
    $objPHPExcel->setActiveSheetIndex(0);
    // Inmovilizar paneles 
    //$objPHPExcel->getActiveSheet(0)->freezePane('A4');
    $objPHPExcel->getActiveSheet(0)->freezePaneByColumnAndRow(0,4);

    // Se manda el archivo al navegador web, con el nombre que se indica (Excel2007)
    header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
    header('Content-Disposition: attachment;filename="ReporteRespuestas.xlsx"');
    header('Cache-Control: max-age=0');

    $objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel2007');
    $objWriter->save('php://output');
    exit;   

}else{
  echo "no hay resultados para mostrar";
}