<?php
session_start();
if (!isset($_SESSION['usuario'])) {
    echo "acceso denegado";
    echo "<META HTTP-EQUIV='refresh' CONTENT='4; URL=index.php'>"; 
    exit;
}else{
	$usuario = $_SESSION['usuario'];
	$id_examen = $_REQUEST['id_examen'];
	$nombre = $_REQUEST['nombre'];
	$apellido_paterno = $_REQUEST['apellido_paterno'];
	require_once('control/conexion.php');
	$resultadoCurso = mysqli_query($link, "SELECT id_curso FROM curso INNER JOIN estudiante ON estudiante.curso_id_curso = curso.id_curso WHERE rut = '$usuario'");
			while ($row = mysqli_fetch_array($resultadoCurso)) {
						$idCurso = $row['id_curso'];
					}
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
		<link rel="stylesheet" href="css/estilos.css">
	
		    <script type="text/javascript">
			   $(document).ready(function(){
		            $('#agregar').on("click",function(){
		                var numeroIntegrantes = $('input:radio[name=integrante]:checked').val();
		                var idCurso = $('#idCurso').val();
		                var usuario = $("#usuario").val();
		                     $.post('ver.php', {numeroIntegrantes:numeroIntegrantes,idCurso:idCurso,usuario:usuario}, function(data){
		                        // window.location.href = "exito.php";
		                         $('#ver').fadeIn('slow').html(data);
		                         $("#agregar").remove();
		                         $("#check").remove();
		                         	$("#ver").append("<input type='button' value='insertar' id='insertar' class='btn btn-outline-success my-2 my-sm-0'>");
		                   
		                  });
		            });
		             $('body').on("click", "#insertar",function(){
		              				// var integrante1 = $('#integrante1').val();
		                  //    		var integrante2 = $('#integrante2').val();
		                  //    $.post('integrantes.php', {integrante1:integrante1,integrante2:integrante2}, function(data){
		                  //       	// window.location.href = "exito.php";
		                  //        	$('#desaparecer').fadeIn('slow').html(data);
		                         	
		                   
		                  // });

		                $('#desaparecer').submit();
		            });
		       	 });

		   </script>
		   <style>
		   .numeroIntegrantes{
		   		margin-top: 2em;
		   		margin-bottom: 1em;
		   		padding: 1.5em;
		   		color: #8A4B08; /*color naranjo*/
		   		font-weight: 800;
		   }
		
		
		   </style>
</head>
<body>
<div class="container">
			<!-- comienzo seccion navegacion -->
  			<nav class="navbar navbar-toggleable-md navbar-light bg-faded">
		        <button class="navbar-toggler navbar-toggler-right" type="button" data-toggle="collapse" data-target="#navbarTogglerDemo02" aria-controls="navbarTogglerDemo02" aria-expanded="false" aria-label="Toggle navigation">
		          <span class="navbar-toggler-icon"></span>
		        </button>
		      <!--   <a class="navbar-brand" href="student.php">LEXAM Alumnos</a> -->
		        <a class="navbar-brand" href="student.php"><img src="images/logo.jpg" class="logo" alt=""></a>

		        <div class="collapse navbar-collapse" id="navbarTogglerDemo02">
		          <ul class="navbar-nav mr-auto mt-2 mt-md-0">
		            <li class="nav-item active">
		              <a class="nav-link" href="#">Bienvenido Alumno<span class="sr-only">(current)</span></a>
		            </li>
		            <li class="nav-item">
		            <?php 
		            // echo "<a class='nav-link' href='crearPreguntas.php?nombre_examen=$nombre_examen'>Preguntas</a>";
		            ?> 
		            </li>
		            <li class="nav-item">
		             <!--  <a class="nav-link disabled" href="consultarUsuario.php">Ver Exámen</a> -->
		            </li>
		          </ul>
		          <form class="form-inline my-2 my-lg-0">
		           <?php  echo "<h5> ".$nombre."  ".$apellido_paterno."  </h><a href='logout.php'>Cerrar Sesión</a> ";?>
		          </form>
		        </div>
		    </nav>
			<!-- fin seccion navegacion -->
	<div class="row">
		<div class="col-md-3"></div>
		<div class="col-md-6">
			<form action="integrantes.php" class="form-control numeroIntegrantes" id="desaparecer" method="post">
			<?php  echo "<input type='hidden' id='id_examen' name='id_examen' value='".$id_examen."'>";?>
			<?php  echo "<input type='hidden' id='idCurso' name='idCurso' value='".$idCurso."'>";?>
			<?php  echo "<input type='hidden' id='usuario' name='usuario' value='".$usuario."'>";?>
                    <!--   VAMOS A PROBAR CON UNOS RADIOS PARA RESCATAR EL VALOR QUE  -->
                    <div class="check" id="check">
                       <div class="form-check check">
                          <label class="form-check-label radioText">
                            <input class="form-check-input" type="radio" name="integrante" id="integrante1" value="1" checked>
                            Agregar un integrante ("La Prueba la realizará UD y otra persona")
                          </label>
                        </div>
                        <div class="form-check check">
                          <label class="form-check-label radioText">
                            <input class="form-check-input" type="radio" name="integrante" id="integrante2" value="2">
                            Agregar dos integrantes("La Prueba la realizara UD y dos personas más")
                          </label>
                        </div>
                    </div>
			
			<div id="ver">
				
			</div>
		</form>
		<input type="button" value="Continuar"  id="agregar" class="btn btn-outline-success my-2 my-sm-0">
		</div>
		<div class="col-md-3"></div>
	</div>
</div>

  <script src="https://cdnjs.cloudflare.com/ajax/libs/tether/1.4.0/js/tether.min.js" integrity="sha384-DztdAPBWPRXSA/3eYEEUWrWCy7G5KFbe8fFjk5JAIxUYHKkDx6Qin1DkWx51bBrb" crossorigin="anonymous"></script>
    <script src="js/bootstrap.min.js"></script>
</body>
</html>
<?}?>