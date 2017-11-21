<?php
$lastIdExam = $_POST["idExamen"];
$idProfesor = $_POST["idProfesor"];
$nombreProfesor = $_POST["nombreProfesor"];
$apellido_paterno = $_POST["apellido_paternoProf"];
if ($lastIdExam == 'Seleccione') {
	 echo "hola";
}

require_once('control/conexion.php');
$resultadoExamen = mysqli_query($link, "SELECT  nombre_examen FROM examen WHERE id_examen ='".$lastIdExam."'");
	 while ($row = mysqli_fetch_array($resultadoExamen)) {
                            $nombreExamen = $row['nombre_examen'];
				  
		   }

$resultadoPreguntas = mysqli_query($link, "SELECT CONCAT(detalle_pregunta) AS pregunta, id_preguntas, habilidades_id_habilidades  FROM preguntas WHERE examen_id_exam ='".$lastIdExam."'");
	$row_cnt = mysqli_num_rows($resultadoPreguntas);
	if ($row_cnt > 0) {
			echo "
			<table class='table'>
			  <thead>
				 <th>Nº</th>
				 <th>PREGUNTA</th>
				 <th>HABILIDAD</th>
				 <th>EDITAR</th>
			  </thead>
			  <tbody>";
			   

			      
			      $numero = 0;
			      for ($i=0; $i < $row_cnt; $i++) { 
					      		    $numero++;
					      			$rowPreguntas = mysqli_fetch_array($resultadoPreguntas);
					      			$preguntas[$i] = $rowPreguntas['pregunta'];
					      			$idPregunta[$i] = $rowPreguntas['id_preguntas'];
					      			$idHabilidad[$i] = $rowPreguntas['habilidades_id_habilidades'];
					      			echo "<tr>
					      					<td class='numero'><strong>$numero.</strong></td>
					      					<td>".$preguntas[$i]."</td>";
					      					$resultadoHabilidadBd = mysqli_query($link, "SELECT id_habilidades, nombre_habilidad FROM habilidades WHERE id_habilidades = '$idHabilidad[$i]'");
					      					$rowHabilidad = mysqli_fetch_array($resultadoHabilidadBd);
					      					 $nombreHabilidad = utf8_encode($rowHabilidad['nombre_habilidad']);
					      					echo"<td>$nombreHabilidad </td>";

											echo "<td><a href='editar.php?idPregunta=$idPregunta[$i]&idHabilidad=$idHabilidad[$i]&nombreProfesor=$nombreProfesor&apellidoPaterno=$apellido_paterno'>Editar</a></td>
											
					      				 </tr>"; // esta muestra los id que van 

									$ResAlt = mysqli_query($link, "SELECT CONCAT( letra,') ', detalle_alter) AS alternativa FROM alternativas WHERE preguntas_id_preguntas = '".$idPregunta[$i]."'");
					      				   		 while ($rowAlter = mysqli_fetch_array($ResAlt)) {
					      				   				$alternativa = $rowAlter ['alternativa'];
					      				   				// $idPregunta = $rowAlter ['preguntas_id_preguntas'];
					      				   			 	echo "	<tr>
					     					 						<td class='alter' colspan='3'>
					     					 						$alternativa
					     					 						</td>
					    				  						</tr>
					    				  				 	 ";
	                        
	        									} /// se cierra el ciclo while





					      	}
			     
			    
	  echo "</tbody>
			</table>
			";
			
	}else{
		echo "
			<div class='errorDiv'>
			<table class='table table-bordered' width= '300'>
			  <thead>
			    <tr>
			      	<th class='error'>Examen no tiene Preguntas Creadas</th>
			    </tr>
			    <tr>
			     	<th><a class='link' href='control/crearPreguntasEd.php?lastIdExam=$lastIdExam&nombreExamen=$nombreExamen&nombreProfesor=$nombreProfesor&apellido_paterno=$apellido_paterno'>Crear Preguntas</a></th>
			    </tr>
			  </thead>
			</table>
			</div>

		";
	}
	

					      	
  				

?>
