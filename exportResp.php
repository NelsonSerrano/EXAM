<?php
header("Content-Type: application/vnd.ms-excel");
header("Expires: 0");
header("Cache-Control: must-revalidate, post-check=0, pre-check=0");
header("content-disposition: attachment;filename=reporteRespuestas.xls");
$idExamen = $_GET['idExamen'];
$idCurso = $_GET['idCurso'];
$count = 0;

require_once('control/conexion.php');
$sqlExamen = mysqli_query($link, "SELECT nombre_examen, fecha FROM examen WHERE  id_examen = '$idExamen'");
$rowExamen = mysqli_fetch_array($sqlExamen);
$examen = $rowExamen['nombre_examen'];
$fechaExamen = $rowExamen['fecha'];

$sqlCurso = mysqli_query($link, "SELECT curso FROM curso WHERE id_curso = '$idCurso'");
$rowCurso = mysqli_fetch_array($sqlCurso);
$curso = $rowCurso['curso'];

$sqlCantidadPreguntas = mysqli_query($link, "SELECT  cantidad_preguntas FROM formulario WHERE examen_id_examen = '$idExamen'");
$rowCantidadPreguntas = mysqli_fetch_array($sqlCantidadPreguntas);
$cantidadPreguntas = $rowCantidadPreguntas['cantidad_preguntas'];
		
$large = count($cantidadPreguntas);
$sqlRespuestas = mysqli_query($link, "SELECT rut_estudiante, concat(apellido_paterno,' ', apellido_materno,' ',nombre) AS alumno, id_respuestas, detalle_respuesta FROM respuestas INNER JOIN detalle_resp_estu ON detalle_resp_estu.respuestas_id_respuestas = respuestas.id_respuestas INNER JOIN estudiante ON estudiante.rut = detalle_resp_estu.estudiante_rut WHERE examen_id_examen = '$idExamen' AND id_cur = '$idCurso'");
$numeroRespuestas = mysqli_num_rows($sqlRespuestas);
// $rowNumeroDetalle = mysqli_fetch_array($sqlRespuestas);
// $deta = $rowNumeroDetalle['detalle_respuesta'];
// $arrayResp = explode(",", $deta);
// $largoD = count($arrayResp);
if ($numeroRespuestas > 0) {
	?>
					<table class='table table-striped'>
					  <thead>
					  <tr>
					  	<th colspan="4">Reporte de Respuestas Curso <? echo $curso;?></th>
					  </tr>
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
						 } ?>
					    </tr>
					    <?
					 

			} ?>
					 </tbody>
				</table>

			<?
			
			}else{
				echo "no se encontraron registros";
			}



?>



