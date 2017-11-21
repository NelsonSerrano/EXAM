<?php
if ($_POST) {
error_reporting(E_ERROR | E_PARSE);
$idExamen = $_POST['idExamen'];
$idCurso = $_POST['idCurso'];
$count = 0;
require_once('control/conexion.php');
$sqlExamen = mysqli_query($link, "SELECT nombre_examen, fecha, tipo, curso, grupo, logro, nota  FROM examen INNER JOIN examen_estudiante ON examen_estudiante.examen_id_examen = examen.id_examen INNER JOIN estudiante ON estudiante.rut = examen_estudiante.estudiante_rut INNER JOIN curso ON curso.id_curso = estudiante.curso_id_curso  WHERE id_examen = '$idExamen' AND curso_id_curso = '$idCurso'");
while ($rowExamen = mysqli_fetch_array($sqlExamen)) {
			$nombreExamen = $rowExamen['nombre_examen'];
			$fecha = $rowExamen['fecha'];
			$curso = $rowExamen['curso'];
			$tipo = $rowExamen['tipo'];
			$integrantes = $rowExamen['grupo'];

}
$integran = $integrantes;
$integrantes = explode(",", $integrantes);
require_once('control/conexion.php');
$sqlGlobal = mysqli_query($link, "SELECT CONCAT(apellido_paterno, ' ',apellido_materno,' ' ,nombre) AS alumno,  nombre_examen, fecha,  curso, grupo,logro, nota  FROM examen INNER JOIN examen_estudiante ON examen_estudiante.examen_id_examen = examen.id_examen INNER JOIN estudiante ON estudiante.rut = examen_estudiante.estudiante_rut INNER JOIN curso ON curso.id_curso = estudiante.curso_id_curso  WHERE id_examen = '$idExamen' AND curso_id_curso = '$idCurso'");
$numeroGlobal = mysqli_num_rows($sqlGlobal);

if ($numeroGlobal > 0) {
		
?>
<table class="table">
  <thead>
    <tr>
      <th><? echo $nombreExamen;?></th>
      <th><? echo $fecha;?></th>
      <th><? echo $curso;?></th>
    </tr>
  </thead>
  <tbody>
  </tbody>
</table>
	<table class='table table-striped table-bordered'>
					  <thead>
					    <tr>
					      <th>#</th>
					      <th>NOMBRES</th>
					      <th>LOGRO</th>
					      <th>NOTA</th>
					    </tr>
					  </thead>
					  <tbody >
<?

	while ($rowGlobal = mysqli_fetch_array($sqlGlobal)) {
				$count++;
			    $nombre = $rowGlobal['alumno'];
			    // $apellido_paterno = $rowGlobal['apellido_paterno'];
			    // $apellido_materno = $rowGlobal['apellido_materno'];
			    $logro = $rowGlobal['logro'];
			    $integr = $rowGlobal['grupo'];
			    $nota = $rowGlobal['nota'];
			    echo "
					    <tr>
					      <th scope='row'>$count</th>";
					      if ($tipo != 2) {
								echo "<td>$nombre $apellido_paterno $apellido_materno</td>";
							}else{
								echo "<td>".$nombre.", ".$integr."<br>";
								// for ($i=0; $i <count($integrantes) ; $i++) { 
								// 	 	echo $integrantes[$i]."<br>";
								// }
								echo "</td>";
							}
					      
					     echo " <td width='10'><strong>$logro%</strong></td>
					      <td width='10'><strong>$nota</strong></td>
					    </tr>
					    
					     ";

			} // se cierra el while
			
				echo "<tr>
			        <td colspan='7'>
					    <a href='reporteExcelCurso.php?idExamen=$idExamen&idCurso=$idCurso&nombreExamen=$nombreExamen&curso=$curso'><img src='images/excel.png' class='excel' alt=''></a>
					</td>
			     </tr>
				</tbody>
				</table>	

			     ";

			}else{
				echo "no se encontraron registros";
			}
			
}else{
	echo "Acceso denegado";
	echo "<META HTTP-EQUIV='refresh' CONTENT='4; URL=login.php'>";
}

?>





