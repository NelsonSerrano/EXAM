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
	   	echo "<META HTTP-EQUIV='refresh' CONTENT='4; URL=estudiantes.php'>"; 
  }else{
  	$nombreProfesor = $_GET['nombreProfesor'];
  	$apellido_paternoProf = $_GET['apellido_paterno'];
?>
<!DOCTYPE html>
<html lang="es-cl">
	  <head>
		  <meta charset="UTF-8">
		  <title>EXAMP</title>
		  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
		  <script src="js/jquery-3.2.1.min.js"></script>
		  <script src="js/main.js"></script>
		  <script src="js/funcionAlert.js"></script>
		  <script src="lib/alertify.js"></script>
		  <link rel="stylesheet" href="./css/normalize.css">
		  <link rel="stylesheet" href="./css/bootstrap.min.css">
		  <link rel="stylesheet" href="css/style.css">
		  <link rel="stylesheet" href="css/estilos.css">
		  <link rel="stylesheet" href="css/estil.css">
		  <link rel="stylesheet" href="css/alertify.core.css" />
		  <link rel="stylesheet" href="css/alertify.default.css" />
			  <script>
			      $(document).ready(function(){
			              $('#mostrarExamen').click(function(){
			                    var idExamen = $('#idExamen').val();
			                    if (idExamen == 'Seleccione Exámen') {
			                         alert("No tiene examenes inactivos!");
			                         $("idExamen").focus();
			                       }else{
			                           $.post('mostrarExamen.php', {idExamen:idExamen}, function(data){
			                           $('#resultadoExamen').fadeIn('slow').html(data);
			                           var button = '<input type="button" value="activar" id="activar" class="btn btn-outline-success my-2 my-sm-0"/>';
										$('#lastTd').append(button);
			                      
			                   });
			                 }
			              });
			              
			              	$("#resultadoExamen").on('click', '#activar', function() {
			                   		 var idExamen = $('#idExamen').val();
			                         $.post('activEx.php', {idExamen:idExamen}, function(data){
			                         $('#ResActiva').fadeIn('slow').html(data);
			                      
			                   });
			            
			              });
		        });
		     </script>
		     <style>
		     	.ipServer{
		     		border: 1px solid black;
		     		text-align: center;
		     		padding: 1em;
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
             <?php  echo "<strong>".$nombreProfesor."  ".$apellido_paternoProf."</strong>"." "."&nbsp&nbsp<a href='logout.php'><img class='exit' src='images/exit.png' alt=''></a> ";?>
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
			                    <option>Seleccione Exámen</option>
			                    <?php
			                    require_once('control/conexion.php');
			                    $resultadoExamen= mysqli_query($link, "SELECT id_examen, nombre_examen from examen WHERE profesor_rut = '".$_SESSION['usuario']."' AND estado = 'inactivo'");
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
				    <tr>
				    	<td>
				    		<input type="button" value="Ver Examen"  id="mostrarExamen" class="btn btn-outline-success my-2 my-sm-0">
				    	</td>
				    </tr>
				  </tbody>
				</table>
			</form>
		</div>
		<div class="col-md-2"></div>
	</div>
</div> <!-- contenedor principal -->
<div class="container">
	<form>
	<div class="row">
		<div class="col-md-12">
			<table class="table" id="resultadoExamen">
			  
			</table>
		</div>
	</div>
	<div class="row">
		<div class="col-md-12"  id="ResActiva">
			
		</div>
	</div>
	</form>
</div>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/tether/1.4.0/js/tether.min.js" integrity="sha384-DztdAPBWPRXSA/3eYEEUWrWCy7G5KFbe8fFjk5JAIxUYHKkDx6Qin1DkWx51bBrb" crossorigin="anonymous"></script>
    <script src="js/bootstrap.min.js"></script>
</body>
</html>
<?
	} // else que confirma que no es estudiante
} // else que confirma que se encuentra activa la sesion
?>


