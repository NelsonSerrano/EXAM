<?php
require_once('control/conexion.php');
$rut = $_POST['rut'];
$nombreProfesor = $_POST['nombreProfesor'];
$ApellidoPaterno = $_POST['ApellidoPaterno'];
$ApellidoMaterno = $_POST['ApellidoMaterno'];
$asignatura = $_POST['asignatura'];
$contrasena = $_POST['contrasena'];
		  $sqlProfesor = mysqli_query($link, "SELECT rut, nombre, apellido_paterno, apellido_materno FROM profesor WHERE rut ='".$rut."'");
  		  mysqli_num_rows($sqlProfesor);
  		if ( mysqli_num_rows($sqlProfesor) > 0) {
  				echo '<p class="incorrecto">Usuario se encuentra registrado</p>';
  		}else{
  			$habilidades = mysqli_query($link, "INSERT INTO profesor(rut, nombre, apellido_paterno, apellido_materno, asignatura, edad, contrasena) VALUES ('$rut','$nombreProfesor', '$ApellidoPaterno','$ApellidoMaterno','$asignatura',0, '$contrasena')");
			echo "<p class='correcto'>Se registro correctamente</p>";
			
  		}
// echo "Hola profesor";
?>
