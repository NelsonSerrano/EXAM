<?php
session_start();
if (!isset($_SESSION['usuario'])) {
    echo "<META HTTP-EQUIV='refresh' CONTENT='4; URL=index.php'>"; 
    exit;
}else{
	$id_examen = $_GET['id_examen'];
	$rutEstudiante = $_SESSION['usuario'];
	require_once('./control/conexion.php');
	$resultadoFormulario = mysqli_query($link, "SELECT cantidad_preguntas, cantidad_alternativas, examen_id_examen FROM formulario WHERE  examen_id_examen ='".$id_examen."'"); // sacamos los valores de pregunta y opciones desde la tabla formulario
	$rowFormulario = mysqli_fetch_array($resultadoFormulario);
	$numeroAlternativas = $rowFormulario['cantidad_alternativas'];

	// sacamos el nombre del examen en esta consulta
	$resultadoExamen = mysqli_query($link, "SELECT nombre_examen FROM examen WHERE id_examen ='".$id_examen."'");
  	while ($rowExamen = mysqli_fetch_array($resultadoExamen)) {
           $nombreExamen = $rowExamen['nombre_examen'];
         
    }


// sacamos los datos del alumno que esta rindiendo el examen
$resultadoEstudiante = mysqli_query($link, "SELECT nombre, apellido_paterno, apellido_materno, sexo, edad  FROM estudiante WHERE rut ='".$_SESSION['usuario']."'");
  while ($rowEstudiante = mysqli_fetch_array($resultadoEstudiante)) {
          	$estudiante = array(
               	'nombre'             =>  $rowEstudiante['nombre'],
               	'apellido_paterno'   =>  $rowEstudiante['apellido_paterno'],
               	'apellido_materno'   =>  $rowEstudiante['apellido_materno'],
               	'sexo'               =>  $rowEstudiante['sexo'],
               	'edad'               =>  $rowEstudiante['edad'],

           	);
    }
$nombre = $estudiante['nombre'];
$apellido_paterno = $estudiante['apellido_paterno'];
$apellido_materno = $estudiante['apellido_materno'];
$sexo = $estudiante['sexo'];
$edad = $estudiante['edad'];

?>
<!DOCTYPE html>
<html lang="es-cl">
	<head>
	    <meta charset="UTF-8">
	    <title>EXAMP Alumnos</title>
	    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
	    <script src="./js/jquery-3.2.1.min.js"></script>
	    <script src="./js/main.js"></script>
	    <!-- <link rel="stylesheet" href="./css/estilo.css"> -->
	    <link rel="stylesheet" href="./css/normalize.css">
	    <link rel="stylesheet" href="./css/bootstrap.min.css">
	    <link rel="stylesheet" href="./css/style.css">
	    <script>
	    	$(document).ready(function(){
	    		var cant = $('select').length;
	    		var cont = 0;
			    $("#enviarExamen").click(function () 
			    {
			   	var arreglo = [];
				$('select').each(function(){
				   	arreglo.push($(this).val());
					 })
					var longitud = arreglo.length;
				    alert(arreglo);
				     var numeroPregunta = 0;
				     for (var i = 0; i < longitud; i++) {
				     	numeroPregunta++;
				     	if (arreglo[i] === 'Seleccione') {
				     			alert("Preguntas nº "+numeroPregunta+" sin responder");
				     			cont++;
				     	}else{
				     		cont= 0;
				     	}
						
					}
					// alert(cont);
					if (cont > 0) {
						// alert("Preguntas sin responder");
						$('#seleccion1').focus();
					}else{
						$("#respuestas").submit();
					}
					
				});
			});
	    </script>
	    <style>
	    	.enviar{
	    		padding-bottom:5em;
	    		padding-top: 2em;
	    	}
	    	.num{
	    		width: 10%;
	    		color: #0404B4;
	    	}
/*	    	.detalle{
	    		width: 90%;
	    	}*/
	/*    	.cabeza{
	    		font-size: 1em;
	    		color:#0B0B61;
	    	}*/
	    /*	.opciones{
	    		color: #8A4B08;
	    	}*/
	    	.examen{
	    		margin-top: 2em;
	    	}
	    	.nombreExamen{
	    		margin:1em;

	    	}
	    	.text-muted{
	    		font-size: 1em;
	    	}
	    </style>
    </head>
<body>

<!-- inicio navegacion alumno -->
<div class="container">
	<nav class="navbar navbar-toggleable-md navbar-light bg-faded">
	  <button class="navbar-toggler navbar-toggler-right" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
	    <span class="navbar-toggler-icon"></span>
	  </button>
	  <a class="navbar-brand" href="#"><?echo $nombre." ".$apellido_paterno." ".$apellido_materno;?></a>
	  <div class="collapse navbar-collapse" id="navbarNav">
	    <ul class="navbar-nav">
	      <li class="nav-item active">
	        <a class="nav-link" href="student.php">INICIO<span class="sr-only">(current)</span></a>
	      </li>
	      <li class="nav-item">
	        <a class="nav-link" href="#"></a>
	      </li>
	      <li class="nav-item">
	        <a class="nav-link" href="#"></a>
	      </li>
	      <li class="nav-item">
	        <a class="nav-link" href="#"></a>
	      </li>
	    </ul>
	  </div>
	</nav>
	<!-- fin navegacion alumno-->
	
	<!-- fin cabecera -->
	
		<div class="row">
			<div class="col-md-1"></div>
			<div class="col-md-10 examen">
					<div class="nombreExamen">
				 		<small class="form-text text-muted">Nombre de Examen: <?echo $nombreExamen;?></small>
				 	</div> 
				<?php
				// consulta para sacar las preguntas 
				$resultadoPreguntas = mysqli_query($link, "SELECT CONCAT(detalle_pregunta) AS pregunta, id_preguntas  FROM preguntas WHERE examen_id_exam ='".$id_examen."' ORDER BY rand() ");
				$row_cnt = mysqli_num_rows($resultadoPreguntas);
  				
  				// consulta para sacar las alternativas                  
  				// $resultadoAlternativas = mysqli_query($link, "SELECT CONCAT(letra, ') ',detalle_alter, ' ',id_alter, ' id Pregunta ', ' ',preguntas_id_preguntas) AS alternativa, preguntas_id_preguntas FROM preguntas INNER JOIN alternativas  ON alternativas.preguntas_id_preguntas = preguntas.id_preguntas WHERE examen_id_exam ='".$id_examen."'");
  				$num = 1;
  				$numero = 0;
  				$opcionesCorrectas = $numeroAlternativas;
  				// include('./control/select.php');
				?>
				<form id="respuestas" action="control/evaluar.php" method="post">
				<!-- <form id="respuestas"> -->
					<table class="table" id="datos">
					  <thead>
					   
					  </thead>
					  <tbody>
					      <?
					      
					      	for ($i=0; $i < $row_cnt; $i++) { 
					      		    $numero++;
					      			$rowPreguntas = mysqli_fetch_array($resultadoPreguntas);
					      			$preguntas[$i] = $rowPreguntas['pregunta'];
					      			$idPregunta[$i] = $rowPreguntas['id_preguntas'];
					      			// echo "id Pregunta".$idPregunta[$i]; // esta muestra los id que van cambiando en forma aleatoria
					      			// var_dump($idPregunta);
					      			echo "<tr>
					      					<th class='num' scope='row'><h5>$numero.</h5></th>
					      					<td class='detalle'>".$preguntas[$i]."</td>
					      				  </tr>
					      				   <tr>";
					      				   		$ResAlt = mysqli_query($link, "SELECT CONCAT( letra,') ', detalle_alter) AS alternativa FROM alternativas WHERE preguntas_id_preguntas = '".$idPregunta[$i]."'");
					      				   		 while ($rowAlter = mysqli_fetch_array($ResAlt)) {
					      				   				$alternativa = $rowAlter ['alternativa'];
					      				   				// $idPregunta = $rowAlter ['preguntas_id_preguntas'];
					      				   			 	echo "	<tr>
					     					 						<td class='opciones' colspan='2'>$alternativa</td>
					    				  						</tr>
					    				  				 	 ";
	                        
	        									} /// se cierra el ciclo while
				        						switch ($opcionesCorrectas) {
					                  				case 2:
														$select = "<select class='form-control select' id='respuesta".$numero."' name='respuesta[]'>
																		<option value='Seleccione' class= 'seleccionado' selected='selected'>Seleccione</option>
																		<option value='A'>A</option>
																		<option value='B'>B</option>
																	</select>";
														break;
													case 3:
														$select = "<select class='form-control select' id='respuesta".$numero."' name='respuesta[]'>
																		<option value='Seleccione' class= 'seleccionado' selected='selected'>Seleccione</option>
																		<option value='A'>A</option>
																		<option value='B'>B</option>
																		<option value='C'>C</option>
																	</select>";
														break;
													case 4:
														$select = "<select class='form-control select' id='respuesta".$numero."' name='respuesta[]'>
																		<option value='Seleccione' class= 'seleccionado' selected='selected'>Seleccione</option>
																		<option value='A'>A</option>
																		<option value='B'>B</option>
																		<option value='C'>C</option>
																		<option value='D'>D</option>
																	</select>";
														break;
													case 5:
														$select = "<select class='form-control select' id='respuesta".$numero."' name='respuesta[]'>
																		<option value='Seleccione' class= 'seleccionado' selected='selected'>Seleccione</option>
																		<option value='A'>A</option>
																		<option value='B'>B</option>
																		<option value='C'>C</option>
																		<option value='D'>D</option>
																		<option value='E'>E</option>
																	</select>";
														break;     
														}  

					    				  echo "<tr class='select'>
											      
											      <td colspan='2'>$select</td>
									      		</tr>
									      	
									      		<input type='hidden' id='idPregunta".$numero."' name='idPreguntas[]' value='".$idPregunta[$i]."'>
									     

					      			";
					      		} // cierra el for
					      					echo"	
										      			<input type='hidden' id='id_examen' name='id_examen' value='".$id_examen."'>
										      			<input type='hidden' id='rutEstudiante' name='rutEstudiante' value='".$rutEstudiante."'>
									      			";
					      ?>
					  </tbody>
					</table>
					<div class="enviar">
						<input type="button" value="Enviar Exámen"  id="enviarExamen" class="btn btn-outline-success my-2 my-sm-0">
					</div>
				</form>
			</div>
			<div class="col-md-1"></div>
		</div>
	</div>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/tether/1.4.0/js/tether.min.js" integrity="sha384-DztdAPBWPRXSA/3eYEEUWrWCy7G5KFbe8fFjk5JAIxUYHKkDx6Qin1DkWx51bBrb" crossorigin="anonymous"></script>
    <script src="js/bootstrap.min.js"></script>
</body>
</html>
<?
}// este cierra else que comprueba que hay una session abierta
?>
