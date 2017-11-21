
<!DOCTYPE html>
<html lang="es-cl">
<head>
	<meta charset="UTF-8">
	<title>ExamP</title>
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <script src="./js/jquery-3.2.1.min.js"></script>
    <script src="./js/main.js"></script>
    <script src="./js/jquery.rut.chileno.min.js"></script>
    <script src="./js/validation.js"></script>
	<link rel="stylesheet" href="./css/normalize.css">
    <link rel="stylesheet" href="./css/bootstrap.min.css">
    <link rel="stylesheet" href="./css/style.css">
  		<script type="text/javascript">
 	jQuery(document).ready(function($){
			$('#rut').rut();
			// $(function(){
   //              //Para escribir solo letras
                $('#nombreEstudiante').validation(' abcdefghijklmnñopqrstuvwxyzáéiou');
                $('#apellidoPaternoE').validation(' abcdefghijklmnñopqrstuvwxyzáéiou');
                $('#apellidoMaternoE').validation(' abcdefghijklmnñopqrstuvwxyzáéiou');
   //              //Para escribir solo numeros    
   //              // $('#apellidoMaternoE').validation('0123456789');    
   //          });
            $("#registrarEstudiante").click(function(){
            	var texto = $('.rut-error').text();
               	// alert(texto);
               	var rut = $("#rut").val();
		            	// var nombre = $("#nombreEstudiante").val();
		            	// var apellidoPaterno = $("#apellidoPaternoE").val();
		            	// var apellidoMaterno = $("#apellidoMaternoE").val();
		            	// var curso = $("#curso").val();
		            	// var sexo = $("#sexo").val();
		            	// var contrasena = $("#contrasena").val();
				if (texto == "Rut incorrecto") {
					alert("rut incorrecto");
					$("#rut").focus();
				}else{
					// alert("rut correcto");
					if ($("#nombreEstudiante").val()==0) {
						alert("Ingrese su nombre");
						$("#nombreEstudiante").focus();
					}
					else if ($("#apellidoPaternoE").val()==0) {
						alert("Ingrese su apellido paterno");
						$("#apellidoPaternoE").focus();
					}
					else if ($("#apellidoMaternoE").val()==0) {
						alert("Ingrese su apellido materno");
						$("#apellidoMaternoE").focus();
					}
					else if ($("#curso").val()== "Seleccione") {
						alert("Ingrese su Curso");
						$("#curso").focus();
					}
					else if ($("#sexo").val()== "Seleccione") {
						alert("Ingrese su genero");
						$("#sexo").focus();
					}
					else if ($("#contrasena").val()==0) {
						alert("Ingrese una contrasena");
						$("#contrasena").focus();
					}else{
						$('#datos').submit();
						
		            	// $.post('control/insertarAlumno.php', {rut:rut,nombreEstudiante:nombreEstudiante,apellidoPaterno:apellidoPaterno,apellidoMaterno:apellidoMaterno,curso:curso,sexo:sexo,contrasena:contrasena}, function(data){
                    
               //        		$('#resultado').fadeIn('slow').html(data);

             		// 	 });
					}
				}
			});

	});
		</script>
		<style>	
		.rut-error{
		width: 100%;	
		color: #fff;
		text-align: center;
		margin-top: .3em;
		font-weight: bold;
		background-color: red;
		padding: .5em;
		display: inline-block;
		
		}		

		</style>
</head>
<body>
<!-- inicio de navegacion  -->
<nav class="navbar navbar-toggleable-md navbar-light bg-faded">
	  <button class="navbar-toggler navbar-toggler-right" type="button" data-toggle="collapse" data-target="#navbarText" aria-controls="navbarText" aria-expanded="false" aria-label="Toggle navigation">
	    <span class="navbar-toggler-icon"></span>
	  </button>
  		   <a class="navbar-brand" href="#">Registro Alumno</a>
  	<div class="collapse navbar-collapse" id="navbarText">
        <ul class="navbar-nav mr-auto">
	        <li class="nav-item active">
	           <a class="nav-link" href="#">Inicio<span class="sr-only">(current)</span></a>
	        </li>
	        <li class="nav-item">
	           <a class="nav-link" href="#">Características</a>
	        </li>
	        <li class="nav-item">
	           <a class="nav-link" href="#">Acerca de ExamP</a>
	        </li>
        </ul>
	    <span class="navbar-text">
	       <a href="login.php">Iniciar Sesion</a>
	    </span>
  	</div>
</nav>
<!-- termino de navegacion -->
	<div class="container">
		<div class="row">
			<div class="col-md-3"></div>
			<div class="col-md-6">
				<form id="datos" class="form-horizontal" action="control/insertarAlumno.php" method="post">
				
				       	<div class="form-group">
		                      <label for="" class="col-sm-2 control-label"><strong>Rut</strong></label>
		                  <div class="col-sm-12">
		                      <input type="test" class="form-control" id="rut" name="rut" placeholder="Rut Estudiante">
		                  </div>
		              	</div>

		               	<div class="form-group">
		                      <label for="" class="col-sm-2 control-label"><strong>Nombre</strong></label>
		                  <div class="col-sm-12">
		                      <input type="text" class="form-control" id="nombreEstudiante" name="nombreEstudiante" placeholder="Nombre Estudiante">
		                  </div>
		              	</div>

		              	<div class="form-group">
		                      <label for="" class="col-sm-2 control-label"><strong>Apellido Paterno</strong></label>
		                  <div class="col-sm-12">
		                      <input type="text" class="form-control" id="apellidoPaternoE" name="apellidoPaternoE" placeholder="Apellido Paterno">
		                  </div>
		              	</div>

		              	<div class="form-group">
		                      <label for="" class="col-sm-2 control-label"><strong>Apellido Materno</strong></label>
		                  <div class="col-sm-12">
		                      <input type="text" class="form-control" id="apellidoMaternoE" name="apellidoMaternoE" placeholder="Apellido Materno">
		                  </div>
		              	</div>

		              	<div class="form-group">
		                      <label for="" class="col-sm-2 control-label"><strong>Curso</strong></label>
		                  <div class="col-sm-12">
		                     	<select class='form-control selectCurso' id='curso' name='curso'>
										<option>Seleccione</option>
										<?php
										require_once('control/conexion.php');
										$resultadoCurso = mysqli_query($link, "SELECT id_curso, curso, anio FROM curso");
											while ($row = mysqli_fetch_array($resultadoCurso)) {
						                  			     $curso = array(
						                  			     'id_curso'	    =>  $row['id_curso'],
						                  			     'curso'      	=>	$row['curso'],
						                  			     'anio'      	=>	$row['anio'],
						                   	              );
						                ?>
										<option value = "<?php echo $curso['id_curso']; ?>"><?php echo utf8_encode($curso['curso']); ?></option> 
										<?php
						           			 }
						           			mysqli_close($link);  
										?>
								</select>
		                  </div>
		              	</div>

		              	  <div class="form-group">
		                      <label for="" class="col-sm-2 control-label"><strong>Sexo</strong></label>
			                  <div class="col-sm-12">
			                     	<select class="form-control" id="sexo" name="sexo">
										<option>Seleccione</option>
										<option value="Femenino">Femenino</option>
										<option value="Masculino">Masculino</option> 
									</select>
			                  </div>
		              	</div>

		              	<div class="form-group">
		                      <label for="" class="col-sm-2 control-label"><strong>Contraseña</strong></label>
		                  <div class="col-sm-12">
		                      <input type="password" class="form-control" id="contrasena" name="contrasena" placeholder="Contraseña">
		                  </div>
		              	</div>
		              	 <button type="button" id="registrarEstudiante" class="btn btn-primary">Registrarse</button>
				</form>
			</div>
			<div id="resultado" class="col-md-3">
				
			</div>
		</div>
	</div>
    <!-- Fin formulario de registro de alumno-->

<script src="https://cdnjs.cloudflare.com/ajax/libs/tether/1.4.0/js/tether.min.js" integrity="sha384-DztdAPBWPRXSA/3eYEEUWrWCy7G5KFbe8fFjk5JAIxUYHKkDx6Qin1DkWx51bBrb" crossorigin="anonymous"></script>
<script src="js/bootstrap.min.js"></script>

</body>
</html>