<?php
require_once('control/conexion.php');
$idPreguntas = $_GET['idPreguntas'];
$detalle = $_GET['detalle'];
$alumno = $_GET['alumno'];
$examen = $_GET['examen'];
$curso = $_GET['curso'];

// convertimos el texto que contiene las respuesta del alumno y lo convertimos en un array
$arrayRespuestas = explode(",", $detalle);

// convertimos el texto que contiene las id de las preguntas del examen y lo convertimos en un array
$arrayIdPreguntas = explode(",", $idPreguntas);
$largo = count($arrayIdPreguntas);

// var_dump($arrayIdPreguntas);
// for ($i=0; $i < $largo; $i++) { 
// 		echo $arrayRespuestas[$i]." id pregunta ".$arrayIdPreguntas[$i]." <br>";
// 	}
?>
<!DOCTYPE html>
<html lang="es-cl">
		<head>
			<meta charset="UTF-8">
			<title>ExamP</title>
			<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
		    <script src="js/jquery-3.2.1.min.js"></script>
		    <script src="js/main.js"></script>
			<link rel="stylesheet" href="css/normalize.css">
		    <link rel="stylesheet" href="css/bootstrap.min.css">
		    <link rel="stylesheet" href="css/style.css">
		    <style>
		    	.exam{
		    		padding: 1em;
		    	}
		    	.title{
		    		font-size: 1em;
		    		color: #08088A;
		    	}
		    	.alter{
		    		font-size: 1em;
		    		color:#5F04B4;
		    	}
		    	.correcta{
		    		font-size: 1em;
		    		color:#04B431;
		    	}
		    	.pregunta{
		    		background: #CEECF5;
		    	}
		    </style>
	    </head>
	<body>
	<div class="container">
		<div class="row">
			<div class="col-md-2"></div>
			<div class="col-md-8 exam">
				<table class="table table-bordered">
				  <thead>
				  
				    <tr>	  
				      <th class="title" colspan="2">EXAMEN: <? echo $examen;?></th>
				    </tr>
				    <tr>
				      <th class="title" colspan="2">NOMBRES: <? echo $alumno;?></th>
				    </tr>
				    <tr>  
				      <th class="title" colspan="2">CURSO: <? echo $curso;?></th>
				   </tr>
				    
				  </thead>
				  <tbody>
				  <?
				$numero = 0;
	 			for ($i=0; $i < $largo; $i++) { 
	 				$numero++;
	 					
							$sqlPreguntas = mysqli_query($link, "SELECT  id_preguntas, detalle_pregunta, altern_correcta, examen_id_exam FROM preguntas WHERE id_preguntas = '$arrayIdPreguntas[$i]'");
							$rowPreguntas = mysqli_fetch_array($sqlPreguntas);
							$idPreguntas = $rowPreguntas['id_preguntas'];
							$detallePregunta = $rowPreguntas['detalle_pregunta'];
							$alternativaCorrecta = $rowPreguntas['altern_correcta'];
							?>
							<tr>
								<td class='pregunta' width="50">
									<? echo "<strong>".$numero."<strong>";?>
								</td>
								<td class='pregunta'>
									<? echo $detallePregunta;?>
								</td>
							</tr>
							<?
								    	$ResAlt = mysqli_query($link, "SELECT CONCAT( letra,') ', detalle_alter) AS alternativa FROM alternativas WHERE preguntas_id_preguntas = '".$arrayIdPreguntas[$i]."'");
					      				   		 while ($rowAlter = mysqli_fetch_array($ResAlt)) {
					      				   				$alternativa = $rowAlter ['alternativa'];
					      				   				// $idPregunta = $rowAlter ['preguntas_id_preguntas'];
					      				   			 	echo "	<tr>
					     					 						<td class='alter' colspan='2'>$alternativa</td>
					    				  						</tr>
					    				  				 	 ";
	                        
	        									} /// se cierra el ciclo while
									echo "<tr>
								      <th scope='row' class='correcta'>Correcta</th>
								      <td class='correcta'><strong>$alternativaCorrecta</strong></td>
								     
								    </tr>
								    <tr>
								      <th scope='row'>Alumno</th>
								      <td><strong>$arrayRespuestas[$i]</strong></td>
								     
								    </tr>


								    ";

							}

				  ?>
				   
				  </tbody>
				</table>
			</div>
			<div class="col-md-2"></div>
		</div>
	</div>
	
	

		<script src="https://cdnjs.cloudflare.com/ajax/libs/tether/1.4.0/js/tether.min.js" integrity="sha384-DztdAPBWPRXSA/3eYEEUWrWCy7G5KFbe8fFjk5JAIxUYHKkDx6Qin1DkWx51bBrb" crossorigin="anonymous"></script>
		<script src="js/bootstrap.min.js"></script>
	</body>
</html>




