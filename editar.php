<?php
$idPregunta = $_GET['idPregunta'];
$idHabilidad = $_GET['idHabilidad'];
$nombreProfesor = $_GET['nombreProfesor'];
$apellidoPaterno = $_GET['apellidoPaterno'];
require_once('control/conexion.php');

$resultadoPreguntas = mysqli_query($link, "SELECT id_preguntas, detalle_pregunta, altern_correcta, examen_id_exam, nombre_habilidad  FROM preguntas INNER JOIN habilidades ON habilidades.id_habilidades = preguntas.habilidades_id_habilidades  WHERE id_preguntas ='".$idPregunta."'");
$row_cnt = mysqli_num_rows($resultadoPreguntas);
while($rowPreguntas = mysqli_fetch_array($resultadoPreguntas)){
				$pregunta = $rowPreguntas['detalle_pregunta'];
				$idPregunta = $rowPreguntas['id_preguntas'];
			    $alterCorrecta = $rowPreguntas['altern_correcta'];
			    $habilidad = $rowPreguntas['nombre_habilidad'];
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
		  
		  	.letras{
		  		width: 10%;
		  	}
		  	.correcta{
		  		background: #298A08;
		  		font-size: 1em;
		  		color: white;
		  	}
		  	.pregunta{
		  		margin-top: 2em;
		  	}
		  </style>
	
	</head>
	<body>
	<div class="container">
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
		<div class="row">
			<div class="col-md-1"></div>
			<div class="col-md-10">
				<form action="update.php" method="post">
					<table class="table table-bordered pregunta">
					  <thead>
					    <tr>
					      <th colspan="2">Pregunta</th>
					    </tr>
					  </thead>
					  <tbody>
					    <tr>
					
					      <td colspan="2"><textarea name='pregunta' id='ckeditor' class='ckeditor'><?php echo $pregunta;?></textarea></td>
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

															     <td> <input type='text' class='form-control' id='opciones' name='opciones[]' value='$alternativa'></td>

															    </tr>
															 
															    	<input type='hidden' class='form-control' id='idAlter' name='idAlter[]' value='$idAlter'>
														
																";
		                        
		        									} /// se cierra el ciclo while
		        		?>							
						<tr>
							<td class="correcta"><p>Alternativa correcta</p></td>
							<td class="correcta"><? echo "<strong>".$alterCorrecta."<strong>";?></td>
						</tr>
						<tr>
							<td class="correcta"><p>Habilidad</p></td>
							<td class="correcta"><? echo "<strong>".utf8_encode($habilidad)."<strong>";?></td>
							
						</tr>
						<tr>
							
							<td><input type='hidden' class='form-control' id='idPregunta' name='idPregunta' Value='<? echo $idPregunta;?>'></td>
							<td><input type='hidden' class='form-control' id='idHabilidad' name='idHabilidad' Value='<? echo $idHabilidad;?>'></td>
							<td><input type='hidden' class='form-control' id='nombreProfesor' name='nombreProfesor' Value='<? echo $nombreProfesor;?>'></td>
							<td><input type='hidden' class='form-control' id='apellidoPaterno' name='apellidoPaterno' Value='<? echo $apellidoPaterno;?>'></td>
						</tr>
						<?php
						$resultadoHabilidadBd = mysqli_query($link, "SELECT id_habilidades, nombre_habilidad FROM habilidades");
								$numeroHabilidades = mysqli_num_rows($resultadoHabilidadBd);
								for ($x=0; $x < $numeroHabilidades ; $x++) { 
		                  		 			 $rowHabilidad = mysqli_fetch_array($resultadoHabilidadBd);
		                  		 			 $habilidadId[$x] = $rowHabilidad['id_habilidades'];
		                  		 			 $habilidadNombre[$x] = $rowHabilidad['nombre_habilidad'];
		                  		 		}
		                  		 		?>
								<tr>
		                  		 		<th>Seleccione Habilidad</th>
			                  		 		<td>
										   		<select class="form-control" id="habilidad" name="habilidad">
										   			<option>Seleccione</option>
										   		        <?php
										   			for ($x=0; $x < $numeroHabilidades ; $x++) { 
										   				?>
										   				<!-- echo "<option value = '$habilidadId[$x]'>$habilidadNombre[$x]</option> "; -->
													<option value = "<?php echo $habilidadId[$x]; ?>"><?php echo utf8_encode($habilidadNombre[$x]); ?></option> 
										   			<?php	
													}
										   		?>
										   		</select>
										   	</td>
										</tr>
						<tr>
							<td colspan="2">
								<button type="submit" id="enviar" class="btn btn-primary">Editar</button>
							</td>
						</tr>
					   
					  </tbody>
					</table>
				</form>
			</div>
			<div class="col-md-1"></div>
		</div>
	</div>
	
	
	  <script src="https://cdnjs.cloudflare.com/ajax/libs/tether/1.4.0/js/tether.min.js" integrity="sha384-DztdAPBWPRXSA/3eYEEUWrWCy7G5KFbe8fFjk5JAIxUYHKkDx6Qin1DkWx51bBrb" crossorigin="anonymous"></script>
    <script src="js/bootstrap.min.js"></script>
</body>
</html>

		 
