<?php
session_start();
if (!isset($_SESSION['usuario'])) {
    echo "acceso denegado";
    echo "<META HTTP-EQUIV='refresh' CONTENT='4; URL=index.php'>"; 
    exit;
}else{
	require_once('control/conexion.php');
	$estudiante = mysqli_query($link, "SELECT * FROM estudiante WHERE rut ='".$_SESSION['usuario']."'");
  	$numeroLineasEstudiante = mysqli_num_rows($estudiante);
  	if ($numeroLineasEstudiante > 0) {
  			echo "eres estudiante";
  	}else{
  		if ($_GET) {
  		$nombreProfesor = $_GET['nombreProfesor'];
  		$apellido_paternoProf = $_GET['apellido_paterno'];
  		
  	}else{
  		$sqlProfesor = mysqli_query($link, "SELECT rut, nombre, apellido_paterno, apellido_materno FROM profesor WHERE rut ='".$_SESSION['usuario']."'");
  		  while ($rowProfesor = mysqli_fetch_array($sqlProfesor)) {
			                            $nombreProfesor = $rowProfesor['nombre'];
			                            $apellido_paternoProf = $rowProfesor['apellido_paterno'];
		  		}		
  		
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
			  <link rel="stylesheet" href="css/alertify.default.css" />
			  <script>
			  	function confirmSubmit()
				{
				var agree=confirm("Está seguro de eliminar este Examen y todos sus registros? Este proceso es irreversible.");
				if (agree)
					return true ;
				else
					return false ;
				}
			  </script>
			  <style>
			  	.examen{
			  		padding-top: 2em;
			  	}
			  	.delete{
			  		width: 30px;
			  		height: 30px;
			  	}

			  </style>

		  	</head>
		  	<body>
		  	
		  		<!-- comienzo de navegacion -->
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
				             <?php  echo "<strong>".$nombreProfesor."  ".$apellido_paternoProf."</strong>"." "."&nbsp&nbsp<a class='btn btn-danger' href='logout.php'>Cerrar Sesión</a> ";?>
				          </form>
				        </div>
				    </nav>
				</div>
				<!-- 	fin de la navegacion  -->
		  	<div class="container">
		  		<div class="row">
		  			<div class="col-sm-2"></div>
		  			<div class="col-sm-8 examen">
		  		<table class="table table-bordered">
		  		 <thead>
				    <tr>
				      <th>ID</th>
				      <th>EXAMEN</th>
				      <th>FECHA</th>
				      <th>ELIMINAR</th>
				    </tr>
				  </thead>
				  <tbody>
		  		<?php 
		  			 require_once('control/conexion.php');
			                    $resultadoExamen= mysqli_query($link, "SELECT id_examen, nombre_examen, fecha from examen WHERE profesor_rut = '".$_SESSION['usuario']."'");
			                     $numero = mysqli_num_rows($resultadoExamen);
			                      while ($rowExamen = mysqli_fetch_array($resultadoExamen)) {
			                            $id = $rowExamen['id_examen'];
			                            $examen = $rowExamen['nombre_examen'];
			                            $fecha = $rowExamen['fecha'];
			                            echo "
											  <tr>
											      <th scope='row'>$id</th>
											      <td>$examen</td>
											      <td>$fecha</td>

			                            ";	
			                            	?>

									      	  <td width='30'> <a onclick="return confirmSubmit()" href="deleteExamen.php?id=<?php echo $id;?>&nombreProfesor=<?php echo $nombreProfesor;?>"><img class="delete" src="images/delete.png"></a></td>
									      	 
									    	</tr>
									  		<?
			                           echo "<input type='hidden' id='id' name='id' value='".$id."'>";


			                        }


		  		?>
				  </a>
				  </tbody>
				</table>
		  			</div>
		  			<div class="col-sm-2"></div>
		  		</div>
		  	</div>


				  <script src="https://cdnjs.cloudflare.com/ajax/libs/tether/1.4.0/js/tether.min.js" integrity="sha384-DztdAPBWPRXSA/3eYEEUWrWCy7G5KFbe8fFjk5JAIxUYHKkDx6Qin1DkWx51bBrb" crossorigin="anonymous"></script>
			    <script src="js/bootstrap.min.js"></script>
			</body>
		</html>
  		<?

  	}

}



?>