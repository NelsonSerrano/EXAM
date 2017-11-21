<?php
error_reporting(E_ERROR | E_WARNING | E_PARSE);
$integrante1 = $_POST['integrante1'];
$integrante2 = $_POST['integrante2'];
$id_examen = $_POST['id_examen'];
?>
<!DOCTYPE html>
<html lang="es-cl">
	<head>
	    <meta charset="UTF-8">
	    <title>EXAMP Alumnos</title>
	    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
	    <script src="./js/jquery-3.2.1.min.js"></script>
	    <script src="./js/main.js"></script>
	    <script src="js/alertAddAlumnos.js"></script>
		<script src="lib/alertify.js"></script>

	    <link rel="stylesheet" href="./css/normalize.css">
	    <link rel="stylesheet" href="./css/bootstrap.min.css">
	   
	    <link rel="stylesheet" href="css/alertify.core.css" />
		<link rel="stylesheet" href="css/alertify.default.css" />
		<style>
			.ok{
				margin-top: 5em;
				padding:1em;
				color: white;
				font-size: 1em;
				font-weight: 800;
				text-align: center;
				background: #0000FF;
			}
			.oka{
				color: #F8FBEF;
			}
			.oka:hover{
				color: white;

			}
		</style>
	</head>
<body>
<div class="container">
	<div class="row">
		<div class="col-md-3"></div>
		<div class="col-md-6">
			<?
			if ($integrante1 === $integrante2) {
				echo '
						
						<script> javascript:history.back(alert("Debe Seleccionar integrantes distintos "));</script>
					 
				';
			}else{
				if (isset($integrante1) && isset($integrante2)) {
						$nombres[0] = $integrante1;
						$nombres[1] = $integrante2;
				}else{
					$nombres[0] = $integrante1;
				}
				

			$largo = count($nombres);
				
				require_once('./control/conexion.php');
				for ($i=0; $i < $largo; $i++) { 
						$resultadoAlumnoSesion = mysqli_query($link, "SELECT rut, CONCAT(nombre, ' ',apellido_paterno, ' ',apellido_materno) AS nombres FROM estudiante WHERE rut = '".$nombres[$i]."'");
						$numeroLineasAlumnoSesion = mysqli_num_rows($resultadoAlumnoSesion);
					  	if ($numeroLineasAlumnoSesion != 0) {
					      		$rowSesionAlumno = mysqli_fetch_array($resultadoAlumnoSesion);
					            $id_estudiante = $rowSesionAlumno ['rut'];
					            $nombres[$i] = $rowSesionAlumno['nombres'];
					             // echo $nombres[$i]." <br>";
					     
				}
			}
			$nombres = implode(",", $nombres);
			echo "<div class='ok'>";
			echo "<a class='oka' href='darExamenGroup.php?nombres=$nombres&id_examen=$id_examen'>Dar Examen</a>";
			echo "</div>";

			}
			?>
		</div>
		<div class="col-md-3"></div>
	</div>
</div>

	 <script src="https://cdnjs.cloudflare.com/ajax/libs/tether/1.4.0/js/tether.min.js" integrity="sha384-DztdAPBWPRXSA/3eYEEUWrWCy7G5KFbe8fFjk5JAIxUYHKkDx6Qin1DkWx51bBrb" crossorigin="anonymous"></script>
    <script src="js/bootstrap.min.js"></script>
</body>
</html>