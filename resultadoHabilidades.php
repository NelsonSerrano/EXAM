<?php
if ($_POST) {
	error_reporting(E_ERROR | E_WARNING | E_PARSE);
	$idExamen = $_POST['idExamen'];
	$idCurso = $_POST['idCurso'];
	require_once('control/conexion.php');

	$sqlHabilidadCorrecta = mysqli_query($link, "SELECT id_preguntas, altern_correcta, habilidades_id_habilidades, nombre_habilidad FROM preguntas INNER JOIN habilidades ON habilidades.id_habilidades = preguntas.habilidades_id_habilidades WHERE examen_id_exam = '$idExamen'");
	$numeroLineas = mysqli_num_rows($sqlHabilidadCorrecta);
	
	for ($i=1; $i <= $numeroLineas; $i++) { 
			 		$rowHabilidadCorrecta = mysqli_fetch_array($sqlHabilidadCorrecta);
			 		$IdHabilidadCorrecta[$i] = $rowHabilidadCorrecta['habilidades_id_habilidades'];
			 		$nombreHabilidadCorrecta[$i] = $rowHabilidadCorrecta['nombre_habilidad'];
	}
   $IdHabilidadCorrecta = array_unique($IdHabilidadCorrecta); // con esta linea eliminamos las valores duplicados del array...

   foreach ($IdHabilidadCorrecta as $key1 => $value1) {
   			 $arreglo[$value1] = $key1;
   }
     foreach ($arreglo as $key2 => $value2) {
   			 $arreglo[$key2] = $key2;
   }
   // ORDENAMOS EL INDICE DEL ARREGLO DE MAYOR A MENOR
  ksort($arreglo);
  // var_dump($arreglo);
 $largo = count($IdHabilidadCorrecta); // este es el largo o numero de habilidades que se le asigno al examen
   // CONULTAMOS DATOS DE TABLA DE EXAMEN
 $sqlExamen = mysqli_query($link, "SELECT nombre_examen, fecha, curso  FROM examen INNER JOIN examen_estudiante ON examen_estudiante.examen_id_examen = examen.id_examen INNER JOIN estudiante ON estudiante.rut = examen_estudiante.estudiante_rut INNER JOIN curso ON curso.id_curso = estudiante.curso_id_curso  WHERE id_examen = '$idExamen' AND curso_id_curso = '$idCurso'");
 $rowExamen = mysqli_fetch_array($sqlExamen);
 $examen = $rowExamen['nombre_examen'];
 $fecha = $rowExamen['fecha'];
 $curso = $rowExamen['curso'];
  
   // ESTA ES LA CONSULTA QUE TRAE LOS RESULTADOS OBTENIDO POR EL ALUMNO EN EL EXAMEN
	$sqlHabilidades = mysqli_query($link, "SELECT concat(apellido_paterno,' ', apellido_materno,' ', nombre) AS alumno,  nombre_examen, fecha, curso, nota, habilidad, porcentaje_habilidad  FROM examen INNER JOIN examen_estudiante ON examen_estudiante.examen_id_examen = examen.id_examen INNER JOIN estudiante ON estudiante.rut = examen_estudiante.estudiante_rut INNER JOIN curso ON curso.id_curso = estudiante.curso_id_curso  WHERE id_examen = '$idExamen' AND curso_id_curso = '$idCurso'");
	$numeroLineasHabilidades = mysqli_num_rows($sqlHabilidades);
	 // $rowExamen = mysqli_fetch_array($sqlHabilidades);
	 // 			$examen = $rowExamen['nombre_examen'];
	 // 			echo $examen;
	 // }	
		

        
        if ($numeroLineasHabilidades > 0) {
        	?>
        	  <div class="container">
		          <div class="row">
		            <div class="col-sm-3"></div>
		            <div class="col-sm-6">
		              <table class="table table-bordered">
		                <thead>
		                  <tr class="info">
		                    <th>EXAMEN: <? echo $examen;?></th>
		                    </tr>
		                    <tr>
		                    <th>FECHA: <? echo $fecha;?></th>
		                    </tr>
		                    <tr>
		                    <th>CURSO: <? echo $curso;?></th>
		                    </tr>
		                     <tr>
		                    <th><? echo "<a href='reporteExcelHabilidad.php?idExamen=$idExamen&idCurso=$idCurso'>EXPORTAR A EXCEL</a>";?></th>
		                    </tr>
		                </thead>
		               
		              </table>
		            </div>
		            <div class="col-sm-3"></div>
		          </div>
		        </div>
        		<table class="table table-bordered table-hover">
				  <thead>
				    <tr>
				      <th>NOMBRES</th>
				      
				         <?
					    foreach ($arreglo as $key => $value) {
							$sqlHabilidad = mysqli_query($link, "SELECT * FROM habilidades WHERE id_habilidades = '$value'");
							$rowHabilidad = mysqli_fetch_array($sqlHabilidad);
							$habilidad = utf8_encode($rowHabilidad['nombre_habilidad']);
							echo "<th>".strtoupper($habilidad)."</th>";

							}
					      ?>
				    </tr>
				  </thead>
				  <tbody>
				    
				    <? 
				    while ($rowHabilidad = mysqli_fetch_array($sqlHabilidades)) {
					    	   $alumno = $rowHabilidad['alumno'];
					    	   $examen = $rowHabilidad['nombre_examen'];
					    	   $fecha = $rowHabilidad['fecha'];
					    	   $curso = $rowHabilidad['curso'];
				    	   
				    	   $porcentaje = $rowHabilidad['porcentaje_habilidad'];
				    	   $arrayPorcentaje = explode(",", $porcentaje);
				    	   // var_dump($arrayPorcentaje);
				    	   $largo = count($arrayPorcentaje);
				    	   echo "
				    	     <tr>
						    	<th scope='row'>$alumno</th>
						      ";
						      	
								for ($i=0; $i < $largo; $i++) { 
								
					      				echo "<td><strong>$arrayPorcentaje[$i]%</strong></td>";
						 			}
						 			?>
						     </tr>
						
				     			<? 		
				      			} 
				     			?>
				    
				  	</tbody>
				</table>
	    <?			
        }else{
        	echo "no se encuentran registros de este examen";
        }
}else{
	echo "se quiso entrar por la url";
}
?>