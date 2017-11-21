<?php
require_once('control/conexionOb.php');
$idExamen = $_GET['idExamen'];
$idCurso = $_GET['idCurso'];
$nombreExamen = $_GET['nombreExamen'];
$curso = $_GET['curso'];
$titulo = "Reporte: ".$curso." "."Exámen: ".$nombreExamen;


$sqlGlobal = "SELECT concat(apellido_paterno,' ', apellido_materno,' ',nombre) AS alumno,  nombre_examen, fecha, curso, grupo, logro, nota FROM examen INNER JOIN examen_estudiante ON examen_estudiante.examen_id_examen = examen.id_examen INNER JOIN estudiante ON estudiante.rut = examen_estudiante.estudiante_rut INNER JOIN curso ON curso.id_curso = estudiante.curso_id_curso  WHERE id_examen = '$idExamen' AND curso_id_curso = '$idCurso'";
$resultado = $mysqli->query($sqlGlobal);
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
$titulosColumnas = array('Nº','NOMBRES', 'EXAMEN','FECHA', 'CURSO', 'PORCENTAJE DE LOGRO %', 'NOTA');

$objPHPExcel->setActiveSheetIndex(0)
        		    ->mergeCells('A1:G1');
// Se agregan los titulos del reporte
$objPHPExcel->setActiveSheetIndex(0)
					->setCellValue('A1',$tituloReporte)
        		    ->setCellValue('A3',  $titulosColumnas[0])
		            ->setCellValue('B3',  $titulosColumnas[1])
        		    ->setCellValue('C3',  $titulosColumnas[2])
            		->setCellValue('D3',  $titulosColumnas[3])
            		->setCellValue('E3',  $titulosColumnas[4])
                ->setCellValue('F3',  $titulosColumnas[5])
            		->setCellValue('G3',  $titulosColumnas[6]);
		$i = 5;
		$count = 0;
		while ($fila = $resultado->fetch_array()) {
			$count++;
			$objPHPExcel->setActiveSheetIndex(0)
        		    ->setCellValue('A'.$i,  $count)
		            ->setCellValue('B'.$i,  $fila['alumno'].' ,'.$fila['grupo'])
        		    ->setCellValue('C'.$i,  $fila['nombre_examen'])
        		    ->setCellValue('D'.$i,  $fila['fecha'])
            		->setCellValue('E'.$i,  $fila['curso'])
                ->setCellValue('F'.$i,  $fila['logro'])
            		->setCellValue('G'.$i,  $fila['nota']);
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
				'type'	=> PHPExcel_Style_Fill::FILL_SOLID,
				'color'	=> array('argb' => 'FF220835')
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
            'fill' 	=> array(
				'type'		=> PHPExcel_Style_Fill::FILL_GRADIENT_LINEAR,
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
           	'fill' 	=> array(
				'type'		=> PHPExcel_Style_Fill::FILL_SOLID,
				'color'		=> array('argb' => 'FFd9b7f4')
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
		 
		$objPHPExcel->getActiveSheet()->getStyle('A1:G1')->applyFromArray($estiloTituloReporte);
		$objPHPExcel->getActiveSheet()->getStyle('A3:G3')->applyFromArray($estiloTituloColumnas);		
		$objPHPExcel->getActiveSheet()->setSharedStyle($estiloInformacion, "A4:G".($i-1));
				
		for($i = 'A'; $i <= 'G'; $i++){
			$objPHPExcel->setActiveSheetIndex(0)			
				->getColumnDimension($i)->setAutoSize(TRUE);
		}
		
		// Se asigna el nombre a la hoja
		$objPHPExcel->getActiveSheet()->setTitle('Alumnos');

		// Se activa la hoja para que sea la que se muestre cuando el archivo se abre
		$objPHPExcel->setActiveSheetIndex(0);
		// Inmovilizar paneles 
		//$objPHPExcel->getActiveSheet(0)->freezePane('A4');
		$objPHPExcel->getActiveSheet(0)->freezePaneByColumnAndRow(0,4);

		// Se manda el archivo al navegador web, con el nombre que se indica (Excel2007)
		header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
		header('Content-Disposition: attachment;filename="ReporteCurso.xlsx"');
		header('Cache-Control: max-age=0');

		$objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel2007');
		$objWriter->save('php://output');
		exit;		

}else{
	echo "no hay resultados para mostrar";
}