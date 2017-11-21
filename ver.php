
<?php

$numeroIntegrantes = $_POST['numeroIntegrantes'];
$idCurso = $_POST['idCurso'];
$usuario = $_POST['usuario'];


if ($numeroIntegrantes == 1) {
	?>
<div class="form-group">
						 <label for="exampleSelect2">Seleccione Alumno</label>
			               <select class='form-control selectCurso' id='integrante1' name='integrante1'>
						        <?php
						        require_once('control/conexion.php');
						        $resultadoEstudiantes = mysqli_query($link, "SELECT rut, CONCAT(nombre, ' ',apellido_paterno) AS alumno FROM estudiante WHERE curso_id_curso = '$idCurso' AND rut <> '$usuario'");

						         while ($rowEstudiantes = mysqli_fetch_array($resultadoEstudiantes)) {
						                $rut = $rowEstudiantes['rut'];
						                $nombre = $rowEstudiantes['alumno'];
						                                       
						        ?>
						        <option value = "<?php echo $rut; ?>"><?php echo $nombre; ?></option> 
						        <?php
						                 }
						        ?>
					      </select>
					      
			  </div>
			
<?					      
}elseif ($numeroIntegrantes == 2){
	?>
<div class="form-group">
						 <label for="exampleSelect2">Seleccione Alumno</label>
			               <select class='form-control selectCurso' id='integrante1' name='integrante1'>
						        <?php
						        require_once('control/conexion.php');
						        $resultadoEstudiantes = mysqli_query($link, "SELECT rut, CONCAT(nombre, ' ',apellido_paterno) AS alumno FROM estudiante WHERE curso_id_curso = '$idCurso' AND rut <> '$usuario'");

						         while ($rowEstudiantes = mysqli_fetch_array($resultadoEstudiantes)) {
						                $rut = $rowEstudiantes['rut'];
						                $nombre = $rowEstudiantes['alumno'];
						                                       
						        ?>
						        <option value = "<?php echo $rut; ?>"><?php echo $nombre; ?></option> 
						        <?php
						                 }
						        ?>
					      </select>
					      
			  </div>
			
<?	
	?>
<div class="form-group">
						 <label for="exampleSelect2">Seleccione Alumno</label>
			               <select class='form-control' id='integrante2' name='integrante2'>
						        <?php
						        require_once('control/conexion.php');
						        $resultadoEstudiantes = mysqli_query($link, "SELECT rut, CONCAT(nombre, ' ',apellido_paterno) AS alumno FROM estudiante WHERE curso_id_curso = '$idCurso' AND rut <> '$usuario' ORDER BY rut DESC");

						         while ($rowEstudiantes = mysqli_fetch_array($resultadoEstudiantes)) {
						                $rut = $rowEstudiantes['rut'];
						                $nombre = $rowEstudiantes['alumno'];
						                                       
						        ?>
						        <option value = "<?php echo $rut; ?>"><?php echo $nombre; ?></option> 
						        <?php
						                 }
						        ?>
					      </select>
					      	
			  </div>
			
<?	
}
?>

