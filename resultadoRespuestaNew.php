<?php
// if ($_POST) {
$idExamen = 71;
$idCurso = 3;
// 		$idExamen = $_POST['idExamen'];
// 		$idCurso = $_POST['idCurso'];
// 		$count = 0;
		// sacamos los datos del examen a sacar los datos 
		require_once('control/conexion.php');
		$sqlExamen = mysqli_query($link, "SELECT nombre_examen, fecha, tipo FROM examen WHERE  id_examen = '$idExamen'");
		$rowExamen = mysqli_fetch_array($sqlExamen);
		$examen = $rowExamen['nombre_examen'];
		$fechaExamen = $rowExamen['fecha'];
		$tipo = $rowExamen['tipo'];
		// $tipo = 0;
		// sacamos el nombre del curso a sacar los datos
		$sqlCurso = mysqli_query($link, "SELECT curso FROM curso WHERE id_curso = '$idCurso'");
		$rowCurso = mysqli_fetch_array($sqlCurso);
		$curso = $rowCurso['curso'];

		$sqlCantidadPreguntas = mysqli_query($link, "SELECT  cantidad_preguntas FROM formulario WHERE examen_id_examen = '$idExamen'");
		$rowCantidadPreguntas = mysqli_fetch_array($sqlCantidadPreguntas);
		$cantidadPreguntas = $rowCantidadPreguntas['cantidad_preguntas'];


		if ($tipo === 0) {
			  	$sqlRespuestas = mysqli_query($link, "SELECT rut_estudiante, concat(nombre,' ', apellido_paterno,' ', apellido_materno) AS alumno, id_respuestas, detalle_respuesta, numero, id_preguntas_examen FROM respuestas INNER JOIN detalle_resp_estu ON detalle_resp_estu.respuestas_id_respuestas = respuestas.id_respuestas INNER JOIN estudiante ON estudiante.rut = detalle_resp_estu.estudiante_rut WHERE examen_id_examen = '$idExamen' AND id_cur = '$idCurso'");
				$numeroRespuestas = mysqli_num_rows($sqlRespuestas);
				if ($numeroRespuestas > 0) {
					?>
					<table class='table table-striped'>
					  <thead>
					    <tr>
					      <th>NOMBRES</th>
					      <th>EXÁMEM</th>
					      <th>CURSO</th>
					      <th>FECHA</th>
					      
					       <?
					      $numero = 0;
					      for ($i=0; $i < $cantidadPreguntas; $i++) { 
					      	$numero++;
					      	echo "<th>$numero</th>";
					      }
					      
					      ?>
					    </tr>
					  </thead>
					  <tbody>
					  <?
					 	 while ($rowRespuestas = mysqli_fetch_array($sqlRespuestas)) {
									$count++;
								    $rut = $rowRespuestas['rut_estudiante'];
								    $alumno = $rowRespuestas['alumno'];
								    $idRespuestas = $rowRespuestas['id_respuestas'];
								    $detalle = $rowRespuestas['detalle_respuesta'];
								    $idPreguntas = $rowRespuestas['id_preguntas_examen'];
								    $numero = $rowRespuestas['numero'];
								    if ($count > $cantidadPreguntas) {
								    	$count = 0;
								    	$count++;
								    }
								    $arrayRespuestas = explode(",", $detalle);
									$largo = count($arrayRespuestas);
									 echo "
									    	<tr>
										      <th>$alumno</th>
										      <td>$examen</td>
										      <td>$curso</td> 
										      <td>$fechaExamen</td>
									       ";
									       	 for ($i=0; $i < $largo; $i++) { 
									      		echo "<td>$arrayRespuestas[$i]</td>";
										 	} 
										 	echo "<td><a class='' href='verExamenAlumno.php?idPreguntas=$idPreguntas&detalle=$detalle&alumno=$alumno&examen=$examen&curso=$curso'>Ver</a></td>";
										 		 ?>
										    </tr>
										    <?

						}	 
					echo "</tbody>
					      </table>";
					      echo "<tr>
						        <td colspan='6'>
								    <a href='exportResp.php?idExamen=$idExamen&&idCurso=$idCurso&&examen=$examen&&fechaExamen=$fechaExamen&&curso=$curso&&cantidadPreguntas=$cantidadPreguntas'><img src='images/excel.png' class='excel' alt=''></a>
								</td>
						     </tr>";
				}else{
					echo "No se encontraron registros";
				}
		}else{
				$sqlRespuestas = mysqli_query($link, "SELECT rut_estudiante, concat(nombre,' ', apellido_paterno,' ', apellido_materno) AS alumno, id_respuestas, detalle_respuesta, numero, id_preguntas_examen FROM respuestas INNER JOIN detalle_resp_estu ON detalle_resp_estu.respuestas_id_respuestas = respuestas.id_respuestas INNER JOIN estudiante ON estudiante.rut = detalle_resp_estu.estudiante_rut WHERE examen_id_examen = '$idExamen' AND id_cur = '$idCurso'");
				$numeroRespuestas = mysqli_num_rows($sqlRespuestas);
				if ($numeroRespuestas > 0) {
					?>
					<table class='table table-striped'>
					  <thead>
					    <tr>
					      <th>NOMBRES</th>
					      <th>EXÁMEM</th>
					      <th>CURSO</th>
					      <th>FECHA</th>
					      
					       <?
					      $numero = 0;
					      for ($i=0; $i < $cantidadPreguntas; $i++) { 
					      	$numero++;
					      	echo "<th>$numero</th>";
					      }
					      
					      ?>
					    </tr>
					  </thead>
					  <tbody>
					  <?
					 	 while ($rowRespuestas = mysqli_fetch_array($sqlRespuestas)) {
							
								    $rut = $rowRespuestas['rut_estudiante'];
								    $alumno = $rowRespuestas['alumno'];
								    $idRespuestas = $rowRespuestas['id_respuestas'];
								    $detalle = $rowRespuestas['detalle_respuesta'];
								    $idPreguntas = $rowRespuestas['id_preguntas_examen'];
								    $numero = $rowRespuestas['numero'];
								
								    $arrayRespuestas = explode(",", $detalle);
								    $arrayId = explode(",", $idPreguntas);
								    $largo = count($arrayId);

								
									 echo "
									    	<tr>
										      <th>$alumno</th>
										      <td>$examen</td>
										      <td>$curso</td> 
										      <td>$fechaExamen</td>
									       ";
									           for ($i=0; $i < $largo; $i++) { 
												$arreglo[$arrayId[$i]]=$arrayRespuestas[$i];
												ksort($arreglo);
												$arregloLargo = count($arreglo);
												// echo $arregloLargo;
												echo "<td>$arreglo[$i]</td>";
												}	
									   //     	 for ($i=0; $i < $largo; $i++) { 
									      		
										 	// } 
										 	echo "<td><a class='' href='verExamenAlumno.php?idPreguntas=$idPreguntas&detalle=$detalle&alumno=$alumno&examen=$examen&curso=$curso'>Ver</a></td>";
										 		 ?>
										    </tr>
										    <?

						}	 
					echo "</tbody>
					      </table>";
					      echo "<tr>
						        <td colspan='6'>
								    <a href='exportResp.php?idExamen=$idExamen&&idCurso=$idCurso&&examen=$examen&&fechaExamen=$fechaExamen&&curso=$curso&&cantidadPreguntas=$cantidadPreguntas'><img src='images/excel.png' class='excel' alt=''></a>
								</td>
						     </tr>";
				}else{
					echo "No se encontraron registros";
				}
		}
// }
?>