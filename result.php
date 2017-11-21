<?php
session_start();
require_once('control/conexion.php');
$estudiante = mysqli_query($link, "SELECT * FROM estudiante WHERE rut ='".$_SESSION['usuario']."'");
mysqli_num_rows($estudiante);

if (mysqli_num_rows($estudiante) > 0) {
	 echo "acceso denegado";
	 echo "<META HTTP-EQUIV='refresh' CONTENT='4; URL=estudiantes.php'>"; 
}else{
	if (!isset($_SESSION['usuario'])) {
	    echo "acceso denegado";
	    echo "<META HTTP-EQUIV='refresh' CONTENT='4; URL=index.php'>"; 
	    exit;
	}else{
$sqlProfesor = mysqli_query($link, "SELECT id_profesor,nombre, apellido_paterno, apellido_materno, asignatura FROM profesor WHERE id_profesor = '".$_SESSION['usuario']."'" );
mysqli_num_rows($sqlProfesor);
     while ($rowProfesor = mysqli_fetch_array($sqlProfesor)) {
     						$idProfesor = $rowProfesor['id_profesor'];
                            $nombreProfesor = $rowProfesor['nombre'];
                            $apellido_paternoProf = $rowProfesor['apellido_paterno'];
                            $apellido_maternoProf = $rowProfesor['apellido_materno'];
                            $asignaturaProf = $rowProfesor['asignatura'];
    }
?>
<!DOCTYPE html>
<html lang="es-cl">
<head>
	<meta charset="UTF-8">
	<title>ExamP</title>
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <script src="./js/jquery-3.2.1.min.js"></script>
    <script src="./js/main.js"></script>
	<link rel="stylesheet" href="./css/normalize.css">
    <link rel="stylesheet" href="./css/bootstrap.min.css">
    <link rel="stylesheet" href="./css/style.css">
    <script>
      $(document).ready(function(){
      		  $('#idExamen').focus();
              $('#search').on('keyup', function(){
              		var idExamen = $('#idExamen').val();
              		if (idExamen == "Seleccione Exámen") {
              			alert('Seleccione Exámen');
      		  			$('#idExamen').focus();

              		}else{
                    var search = $('#search').val();
                    
                           $.post('control/search.php', {search:search,idExamen:idExamen}, function(data){
                           $('#result').fadeIn('slow').html(data);
                    });
                         }
              });
        });
     </script>
</head>
<body>
<!-- comienzo de navegacion -->
<div class="container">
    <nav class="navbar navbar-toggleable-md navbar-light bg-faded">
        <button class="navbar-toggler navbar-toggler-right" type="button" data-toggle="collapse" data-target="#navbarTogglerDemo02" aria-controls="navbarTogglerDemo02" aria-expanded="false" aria-label="Toggle navigation">
          <span class="navbar-toggler-icon"></span>
        </button>
        <a class="navbar-brand" href="#">EXAMP</a>

      <div class="collapse navbar-collapse" id="navbarTogglerDemo02">
          <ul class="navbar-nav mr-auto mt-2 mt-md-0">
              <li class="nav-item active">
               
              </li>
              <li class="nav-item">
                <a class="nav-link" href="agregarHabilidad.php">Agregar Habilidad</a>
              </li>
              <li class="nav-item">
                  <a class="nav-link" href="result.php">Resultados Exámenes</a>
              </li>
          </ul>
          <form class="form-inline my-2 my-lg-0 informacionUsuario">
              <!-- <input class="form-control mr-sm-2" type="text" placeholder="Buscar">
              <button class="btn btn-outline-success my-2 my-sm-0" type="submit">Buscar</button> -->
             <?php  echo "<strong>".$nombreProfesor."  ".$apellido_paternoProf."</strong>"." "."&nbsp&nbsp<a class='btn btn-danger' href='logout.php'>Cerrar Sesión</a> ";?>
          </form>
        </div>
  </nav>

</div>
<!--  fin de la navegacion  -->
<div class="container">
	<div class="row">
		<div class="col-sm-2"></div>
		<div class="col-sm-8">
			<h4>Resultados de Exámenes</h4>
			<table class="table table-bordered">
			  <thead>
			    <tr>
			       <th colspan="2">Buscar Alumno</th>
			    </tr>
			  </thead>
			  <tbody>
			    <tr>
			     <td colspan="2">
				     <select class='form-control' id='idExamen' name='idExamen'>
                    <option>Seleccione Exámen</option>
                    <?php
                    $sqlExamen = mysqli_query($link, "SELECT id_examen, nombre_examen FROM examen WHERE profesor_id_profesor = '$idProfesor'");

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
                  <tr>

                  </td>
			      <td>
				      <input type="text" class="form-control" id="search" name="search" placeholder="nombre Alumno">
                  </td>
                  <td>
				      <input type="text" class="form-control" id="apellido_paterno" name="apellido_paterno" placeholder="Apellido Paterno">
                  </td>
                 
			    </tr>
			  </tbody>
			</table>
		</div>
		<div class="col-sm-2">
			
		</div>
	</div>

	<div class="row">
		<div class="col-sm-2"></div>
		<div class="col-sm-8">
			<h4>Resultados</h4>
			<table class="table table-bordered">
			  <thead>
			    <tr>
			      <th>Nombre Alumno</th>
			      <th>ver</th>
			    </tr>
			  </thead>
			  <tbody id="result">
			   
			  </tbody>
			</table>
		</div>
		<div class="col-sm-2">
			
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

