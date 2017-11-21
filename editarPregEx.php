<?php
session_start();
if (!isset($_SESSION['usuario'])) {
    echo "acceso denegado";
    echo "<META HTTP-EQUIV='refresh' CONTENT='4; URL=index.php'>"; 
    exit;
}else{
	require_once('control/conexion.php');
	$estudiante = mysqli_query($link, "SELECT * FROM estudiante WHERE rut ='".$_SESSION['usuario']."'");
  	mysqli_num_rows($estudiante);
  if (mysqli_num_rows($estudiante) > 0) {
	   	echo "acceso denegado";
	   	echo "<META HTTP-EQUIV='refresh' CONTENT='4; URL=student.php'>"; 
  }else{
  	if ($_GET) {
  		$nombreProfesor = $_GET['nombreProfesor'];
  		$apellido_paternoProf = $_GET['apellido_paterno'];
  		$idProfesor = $_SESSION['usuario'];
  	}else{
  		$sqlProfesor = mysqli_query($link, "SELECT rut, nombre, apellido_paterno, apellido_materno FROM profesor WHERE rut ='".$_SESSION['usuario']."'");
  		  while ($rowProfesor = mysqli_fetch_array($sqlProfesor)) {
			                            $nombreProfesor = $rowProfesor['nombre'];
			                            $apellido_paternoProf = $rowProfesor['apellido_paterno'];
		  		}		
  		$idProfesor = $_SESSION['usuario'];
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
		  
			      $(document).ready(function(){
			            $('#idExamen').change(function(){
			                 $('#idExamen option:selected').each(function(){
			      				idExamen = $(this).val();
			      				if (idExamen == 'Seleccione') {
			      					alert("Seleccione Examen");
			      				}else{
			      				var idProfesor = $('#idProfesor').val();
			      				var nombreProfesor = $('#nombreProfesor').val();
			      				var apellido_paternoProf  = $('#apellido_paternoProf').val();
			      				$.post('editaPregExam.php', {idExamen:idExamen,idProfesor:idProfesor,nombreProfesor:nombreProfesor,apellido_paternoProf:apellido_paternoProf}, function(data){
			                    $('#edit').fadeIn('slow').html(data);
			                	});
			                	}
			      			});
			            });
			              
		          });
		     </script>
		     <style>
		     	.numero{
		     		font-size: 1.2em;
		     		color:#08088A;
		     	}
		     	.alter{
		     		font-size: 1em;
		     		color:#8A4B08;
		     	}
		     	.error{
		     		color:red;
		     		text-align: center;
		     	
		     	}
		     	.errorDiv{
		     		width: 50%;
		     		margin:0 auto;
		     	}
		     	.link{
		     		padding-left: 6.5em;
		     	}
		     </style>	
		</head>
<body>
<div class="container">
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
		<div class="row">
		<div class="col-md-2"></div>
		<div class="col-md-8">
			<form action="">
			<table class="table">
				  <thead>
				    <tr>
				      <th>Seleccione Examen</th>
				    </tr>
				  </thead>
				  <tbody>
				    <tr>
				      	<td>
					      	<select class='form-control' id='idExamen' name='idExamen'>
					      		<option>Seleccione</option>
			                    <?php
			                    require_once('control/conexion.php');
			                    $resultadoExamen= mysqli_query($link, "SELECT id_examen, nombre_examen from examen WHERE profesor_rut = '".$_SESSION['usuario']."'");
			                     $numero = mysqli_num_rows($resultadoExamen);
			                     if ($numero > 0) {
			                     	
			                     }

			                     while ($rowExamen = mysqli_fetch_array($resultadoExamen)) {
			                            $id = $rowExamen['id_examen'];
			                            $examen = $rowExamen['nombre_examen'];
			                    ?>
			                    <option value = "<?php echo  $id; ?>"><?php echo $examen; ?></option> 
			                    <?php
			                             }
			                    ?>
		                  </select>
				      </td>
				    </tr>
				    	<?php  echo "<input type='hidden' id='idProfesor' name='idProfesor' value='".$idProfesor."'>";?>
				   		<?php  echo "<input type='hidden' id='nombreProfesor' name='nombreProfesor' value='".$nombreProfesor."'>";?>
				   		<?php  echo "<input type='hidden' id='apellido_paternoProf' name='apellido_paternoProf' value='".$apellido_paternoProf."'>";?>
				  </tbody>
				</table>
			</form>
		</div>
		<div class="col-md-2"></div>
	</div>
</div>
	<div class="container-fluid">
		<div class="row">
			<div class="col-sm-1"></div>
			<div class="col-sm-10" id="edit">
				
					     
			</div>
			<div class="col-sm-1"></div>
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