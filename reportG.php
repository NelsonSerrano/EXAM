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
		
		require_once('control/conexion.php');
		$nombreProfesor = $_GET['nombreProfesor'];
		$apellido_paternoProf = $_GET['apellido_paternoProf'];
		$apellido_maternoProf = $_GET['apellido_maternoProf'];
		$idProfesor = $_SESSION['usuario'];
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
    <link rel="stylesheet" href="css/estil.css">
    <link rel="stylesheet" href="css/estilos.css">
    <script>
      $(document).ready(function(){
      		$('#idExamen').change(function(){
      			$('#idExamen option:selected').each(function(){
      				idExamen = $(this).val();
      				$.post('idExamen.php', {idExamen : idExamen}, function(data){
                    $('#idCurso').fadeIn('slow').html(data);
                	});
      			});

      		});
      		$('#reporteGlobal').click(function(){
      			var idExamen = $("#idExamen").val();
      			var idCurso = $("#idCurso").val();
      			if (idExamen == 'Seleccione') {
      					alert('Seleccione Exámen');
      		  			$('#idExamen').focus();
      			}else if (idCurso == 'Seleccione') {
      					alert('Seleccione Curso');
      		  			$('#idCurso').focus();
      			}else{
      				$.post('resultadoGlobal.php', {idExamen:idExamen,idCurso:idCurso}, function(data){
                    $('#resultadoGlobal').fadeIn('slow').html(data);
                	});
      			}

      		});
        });
     </script>
     <style>
     	.resultadoGlobal{
     		width: 100%;
     		margin: 0 auto;
     		font-size: .9em;
     	}
     	.excel{
     		width: 50px;
     		height: 50px;
     	}
     	.title-reporte{
     		padding: 1em;
     	}
     	.title{
     		width: 35%;
     	}
     	@media only screen and (max-width: 500px) {
			
			    .resultadoGlobal{
		     		width: 100%;
		     	
		     		font-size: .7em;
		     	}
		     	.input{
		     		width: 100%;
		     	}
		     	select{
		     		width: 50%
		     	}
			}
	 </style>
    </head>
<body>
<!-- comienzo de navegacion -->
<div class="container input">
    <nav class="navbar navbar-toggleable-md navbar-light bg-faded">
        <button class="navbar-toggler navbar-toggler-right" type="button" data-toggle="collapse" data-target="#navbarTogglerDemo02" aria-controls="navbarTogglerDemo02" aria-expanded="false" aria-label="Toggle navigation">
          <span class="navbar-toggler-icon"></span>
        </button>
         <a class="navbar-brand" href="exito.php"><img src="images/logo.jpg" class="logo" alt=""></a>

      	<div class="collapse navbar-collapse" id="navbarTogglerDemo02">
          <ul class="navbar-nav mr-auto mt-2 mt-md-0">
              <li class="nav-item active">
               <?php echo "<a class='nav-link' href='examen.php?nombreProfesor=$nombreProfesor&&apellido_paterno=$apellido_paternoProf'>Crear Examen<span class='sr-only'>(current)</span></a>";?>
              </li>
          </ul>
          <form class="form-inline my-2 my-lg-0 informacionUsuario">
              <!-- <input class="form-control mr-sm-2" type="text" placeholder="Buscar">
              <button class="btn btn-outline-success my-2 my-sm-0" type="submit">Buscar</button> -->
             <?php  echo "<strong>".$nombreProfesor."  ".$apellido_paternoProf."</strong>"." "."&nbsp&nbsp<a href='logout.php'><img class='exit' src='images/exit.png' alt=''></a> ";?>
          </form>
        </div>
  </nav>


	<div class="container">
		<div class="row">
			<!-- <div class="col-sm-2"></div> -->
			<div class="col-sm-12 input">
				<center><h4 class="title-reporte">Reporte Curso</h4></center>
				<table class="table table-striped table-bordered">
				  <thead>
				    <!-- <tr>
				      <th colspan="2">Seleccione Examen</th>
				    </tr> -->
				  </thead>
				  <tbody>
				    <tr>
				      <td class="title">Seleccione Examenes:</td>	
				      <td>
				      	<select class='form-control' id='idExamen' name='idExamen'>
		                    <option>Seleccione</option>
		                    <?php

		                    $sqlExamen = mysqli_query($link, "SELECT id_examen, nombre_examen FROM examen WHERE profesor_rut = '$idProfesor'");

		                     while ($rowExamen = mysqli_fetch_array($sqlExamen)) {
		                            $idExamen = $rowExamen['id_examen'];
		                            $examen = $rowExamen['nombre_examen'];
		                                             
		                    ?>
		                    <option value = "<?php echo $idExamen; ?>"><?php echo $examen; ?></option> 
		                    <?php
		                             }
		                    ?>
                 		</select>
				      </td>
				    </tr>
				    <!--  <tr>
				      <th>Seleccione Curso</th>
				    </tr> -->
				    <tr>
				      <td class="title"><label for="formGroupExampleInput">Seleccione Curso</label></td>
				      <td>
				      	<select class='form-control' id='idCurso' name='idCurso'>
		                   
		                 <option value = "Seleccione Curso">Seleccione Curso</option>
                 		</select>
				      </td>
				    </tr>
				    <tr>
				      <th colspan="2">
				      	<button type="button" id="reporteGlobal" class="btn btn-primary">Ver</button>
				      </th>
				    </tr>
				  </tbody>
				</table>
			</div>
			<!-- <div class="col-sm-2 "></div> -->
		</div>
	</div>
	<div class="container">
		<div class="row">
			<!-- <div class="col-sm-2"></div> -->
			<div class="col-sm-12 resultadoGlobal" id="resultadoGlobal">
			
					
					    
					
			</div>
			<!-- <div class="col-sm-2 esconder"></div> -->
		</div>
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