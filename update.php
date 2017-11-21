
<?php
$pregunta = $_POST['pregunta'];
$opciones = $_POST['opciones'];
$idAlter = $_POST['idAlter'];
$idPregunta = $_POST['idPregunta'];
$idHabilidadUpdate = $_POST['habilidad'];
$idHabilidad = $_POST['idHabilidad'];
$nombreProfesor = $_POST['nombreProfesor'];
$apellidoPaterno = $_POST['apellidoPaterno'];
require_once('control/conexion.php');
// foreach ($opciones as $key => $value) {
// 			echo $value."<br>";
// }
if ($idHabilidadUpdate === 'Seleccione') {
		
		$idHabilidadUpdate = $idHabilidad;
}else{
	$idHabilidadUpdate =$idHabilidadUpdate;
}

?>
<!DOCTYPE html>
<html lang="es-cl">
	  <head>
		  <meta charset="UTF-8">
		  <title>EXAMP</title>
		  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
		  <script src="js/jquery-3.2.1.min.js"></script>
		  <script src="ckeditor/ckeditor.js"></script>
		  <script src="js/main.js"></script>
		  <script src="js/funcionAlert.js"></script>
		  <script src="lib/alertify.js"></script>
		  <link rel="stylesheet" href="./css/normalize.css">
		  <link rel="stylesheet" href="./css/bootstrap.min.css">
		  <link rel="stylesheet" href="css/style.css">
		  <link rel="stylesheet" href="css/estilos.css">
		  <link rel="stylesheet" href="css/alertify.core.css" />
		  <link rel="stylesheet" href="css/alertify.default.css"/>
		  <style>
		  		.update{
		  			text-align: center;
		  			margin-top: 2em;
		  		}
		  		.th{
		  			width: 10%;
		  		}
		  </style>
	  </head>
	<body>
	<div class="container">
	    <nav class="navbar navbar-toggleable-md navbar-light bg-faded">
	        <button class="navbar-toggler navbar-toggler-right" type="button" data-toggle="collapse" data-target="#navbarTogglerDemo02" aria-controls="navbarTogglerDemo02" aria-expanded="false" aria-label="Toggle navigation">
	          <span class="navbar-toggler-icon"></span>
	        </button>
	        <a class="navbar-brand" href="exito.php"><img src="images/logo.jpg" class="logo" alt=""></a>

	        <div class="collapse navbar-collapse" id="navbarTogglerDemo02">
	          <ul class="navbar-nav mr-auto mt-2 mt-md-0">
	            <li class="nav-item active">
	              <!-- <a class="nav-link" href="crearEcuentas.php">Exámen<span class="sr-only">(current)</span></a> -->
	            </li>
	            <li class="nav-item">
	              <!-- <a class="nav-link" href="crearPreguntas.php">Preguntas</a> -->
	            </li>
	            <li class="nav-item">
	              <!-- <a class="nav-link disabled" href="#">Resultados</a> -->
	            </li>
	          </ul>
	          <form class="form-inline my-2 my-lg-0">
	             <?php  echo "<strong>".$nombreProfesor."  ".$apellidoPaterno."</strong>"." "."&nbsp&nbsp<a class='btn btn-danger' href='logout.php'>Cerrar Sesión</a> ";?>
	          </form>
	        </div>
	    </nav>
	</div>
	<!-- 	fin de la navegacion  -->
		<div class="container">
			<div class="row">
				<div class="col-sm-2">
					
				</div>
				<div class="col-sm-8 update">
					<?

					if ($_POST) {
						 mysqli_query($link, "UPDATE preguntas SET  detalle_pregunta = '$pregunta', habilidades_id_habilidades = '$idHabilidadUpdate' WHERE id_preguntas = '$idPregunta'");
						for ($i=0; $i < count($opciones); $i++) { 

							 mysqli_query($link, "UPDATE alternativas SET detalle_alter = '$opciones[$i]' WHERE id_alter = '$idAlter[$i]'");
						}

						 	
						 	// echo '<tr><th> <a href="javascript:history.back(1)">Volver Atrás</a></th>';
						 	
						 	$resultadoPreguntas = mysqli_query($link, "SELECT id_preguntas, detalle_pregunta, altern_correcta, examen_id_exam, nombre_habilidad  FROM preguntas INNER JOIN habilidades ON habilidades.id_habilidades = preguntas.habilidades_id_habilidades  WHERE id_preguntas ='".$idPregunta."'");
							$row_cnt = mysqli_num_rows($resultadoPreguntas);
												  while($rowPreguntas = mysqli_fetch_array($resultadoPreguntas)){
												   	$pregunta = $rowPreguntas['detalle_pregunta'];
												   	$idPregunta = $rowPreguntas['id_preguntas'];
												   	$alterCorrecta = $rowPreguntas['altern_correcta'];
												   	$nombreHabilidad = $rowPreguntas['nombre_habilidad'];
												}
												?>
												<table class="table table-bordered">
												
												  <tbody>
												  	<tr>
												  		<th colspan="2"><?php echo "Se actualizo Correctamente";?></th>
												  	</tr>
												  	<tr>
												  		<th colspan="2"><?php echo "<a href='editarPregEx.php'>Volver</a>";?></th>
												  	</tr>
												    <tr>
												      	<th class="th">PREGUNTA</th>
												      	<td><? echo $pregunta;?></td>
												    </tr>
												    	    <?
												    $ResAlt = mysqli_query($link, "SELECT  id_alter, letra, detalle_alter FROM alternativas WHERE preguntas_id_preguntas = '".$idPregunta."'");
													      				   		 while ($rowAlter = mysqli_fetch_array($ResAlt)) {
													      				   		 		$idAlter = $rowAlter ['id_alter'];
													      				   		 		$letras = $rowAlter ['letra'];
													      				   				$alternativa = $rowAlter ['detalle_alter'];
													      				   				// $idPregunta = $rowAlter ['preguntas_id_preguntas'];
													      				   			 	echo "	
													      				   			 	  <tr>
																						     
																						   	 <td class='letras'>$letras</td>

																						     <td> $alternativa</td>

																						    </tr>
																					
																							";
									                        
									        									} /// se cierra el ciclo while
									        		?>	
												   	<tr>
												   	  	<th>ALTERNATIVA CORRECTA</th>
												      	<td><? echo $alterCorrecta;?></td>
												    </tr>
												    <tr>
												    	<th>HABILIDAD</th>  
												      	<td><? echo utf8_encode($nombreHabilidad); ?></td>
												    </tr>

												  </tbody>
												</table>
												<?
					}else{
						echo "error";
					}

					?>
					
				</div>
				<div class="col-sm-2">
					
				</div>
			</div>
		</div>
		

		<script src="https://cdnjs.cloudflare.com/ajax/libs/tether/1.4.0/js/tether.min.js" integrity="sha384-DztdAPBWPRXSA/3eYEEUWrWCy7G5KFbe8fFjk5JAIxUYHKkDx6Qin1DkWx51bBrb" crossorigin="anonymous"></script>
		<script src="../js/bootstrap.min.js"></script>
	</body>
</html>
