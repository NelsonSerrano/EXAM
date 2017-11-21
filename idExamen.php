<?php
$idExamen = $_POST['idExamen'];
require_once('control/conexion.php');
echo $idExamen;
$sqlCurso = mysqli_query($link, "SELECT id_curso, curso FROM curso INNER JOIN curso_examen ON curso_examen.curso_id_curso = curso.id_curso INNER JOIN examen ON examen.id_examen = curso_examen.examen_id_examen WHERE id_examen = '$idExamen'");
// $html = "<option value = 'Seleccione Curso'>Seleccione Curso</option>";
		while ($rowCurso = mysqli_fetch_array($sqlCurso )) {
		            $idCurso = $rowCurso['id_curso'];
		            $curso = $rowCurso['curso'];
		                                             
		       
$html = "<option value = '".$idCurso."'>".$curso."</option>";
		   
		   echo $html;             	
		                   
		}
?>