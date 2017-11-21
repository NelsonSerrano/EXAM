<?php
require_once('control/conexion.php');
$idProfesor = $_GET['rut'];
$nombres = $_GET['nombres'];
// echo $idProfesor;
$profesor = mysqli_query($link, "SELECT rut, nombre, apellido_paterno, apellido_materno, asignatura FROM profesor WHERE rut = '$idProfesor'");
while ($rowProfesor = mysqli_fetch_array($profesor)) {
                      $nombreProfesor = utf8_encode($rowProfesor['nombre']);
                      $apellidoPaterno = $rowProfesor['apellido_paterno'];
                      $apellidoMaterno = $rowProfesor['apellido_materno'];
                      $asignatura = $rowProfesor['asignatura'];
      }
?>
<!DOCTYPE html>
<html lang="es-cl">
	<head>
		  <meta charset="UTF-8">
		  <title>EXAMP</title>
		  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
		  <script src="./js/jquery-3.2.1.min.js"></script>
		  <script src="./js/main.js"></script>
		  <script src="./js/jquery.rut.chileno.min.js"></script>
		  <script src="js/validation.js"></script>
		  <link rel="stylesheet" href="./css/normalize.css">
		  <link rel="stylesheet" href="./css/bootstrap.min.css">
		  <link rel="stylesheet" href="css/style.css">
		  <link rel="stylesheet" href="css/estilos.css">
       <script>
          $(document).ready(function(){
              $('#actualizar').click(function(){
                    var rut = $("#idProfesor").val();
                    var nombre = $("#nombre").val();
                    var apellidoPaterno = $("#apellidoPaterno").val();
                    var apellidoMaterno = $("#apellidoMaterno").val();
                    var asignatura = $("#asignatura").val();
                    $.post('editarProfesor.php', {rut:rut,nombre:nombre,apellidoPaterno:apellidoPaterno,apellidoMaterno:apellidoMaterno,asignatura:asignatura}, function(data){
                      $('#resultado').fadeIn('slow').html(data);
                    });
          
              });
            });
        </script>
      <style>
        .updateProf{
          margin-top: 2em;
          padding: 1em;
        }
      </style>
   </head>
<body>
	<!-- comienzo de navegacion -->
<div class="container-fluid" >
    <nav class="navbar navbar-toggleable-md navbar-light bg-faded">
       
        <button class="navbar-toggler navbar-toggler-right" type="button" data-toggle="collapse" data-target="#navbarTogglerDemo02" aria-controls="navbarTogglerDemo02" aria-expanded="false" aria-label="Toggle navigation">
          <span class="navbar-toggler-icon"></span>
        </button>
        <a class="navbar-brand" href="#"><img src="images/logo.jpg" class="logo" alt=""></a>

      <div class="collapse navbar-collapse" id="navbarTogglerDemo02">
          <ul class="navbar-nav mr-auto mt-2 mt-md-0">
              <li class="nav-item active">
               
              </li>
             <!-- comienza el drop -->
              <li class="nav-item dropdown centrar">
                  <a href="#" class="dropdown-item dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    PROFESORES<b class="caret"></b>
                  </a>
                <ul class="dropdown-menu">
                  <li><?php echo "<a class='dropdown-item' href='#'>PROFESORES<span class='sr-only'>(current)</span></a>";?>
                  </li>
                  <li><?php echo "<a class='dropdown-item' href='#'>PROFESORES<span class='sr-only'>(current)</span></a>";?>
               
                </ul>
              </li>
       
          </ul>
          <form class="form-inline my-2 my-lg-0 informacionUsuario">
              <!-- <input class="form-control mr-sm-2" type="text" placeholder="Buscar">
              <button class="btn btn-outline-success my-2 my-sm-0" type="submit">Buscar</button> -->
             <?php  echo "<strong>".$nombres."</strong>"." "."&nbsp&nbsp<a class='btn btn-danger' href='logout.php'>Cerrar Sesión</a> ";?>
          </form>
        </div>
  </nav>
<!--   fin de la navegacion  -->
<div class="container">
	<div class="row">
		<div class="col-sm-2"></div>
		<div class="col-sm-8">
			<?php
				
				// mysqli_query($link, "DELETE FROM profesor WHERE rut = '$idProfesor'");
				// echo "Se elimino correctamente";
				// echo "<META HTTP-EQUIV='refresh' CONTENT='4; URL=admin.php'>"; 
			?>
        <form class="form-control updateProf" id="resultado">
          <div class="form-group row">
            <label for="example-text-input" class="col-2 col-form-label">Nombre</label>
            <div class="col-10">
              <input class="form-control" type="text" value="<?php echo  $nombreProfesor;?>" name="nombre" id="nombre">
            </div>
          </div>
            <div class="form-group row">
            <label for="example-text-input" class="col-2 col-form-label">Apellido Paterno</label>
            <div class="col-10">
              <input class="form-control" type="text" value="<?php echo  $apellidoPaterno;?>" name="apellidoPaterno" id="apellidoPaterno">
            </div>
          </div>
            <div class="form-group row">
            <label for="example-text-input" class="col-2 col-form-label">Apellido Materno</label>
            <div class="col-10">
              <input class="form-control" type="text" value="<?php echo  $apellidoMaterno;?>" name="apellidoMaterno" id="apellidoMaterno">
            </div>
          </div>
            <div class="form-group row">
            <label for="example-text-input" class="col-2 col-form-label">Asignatura</label>
            <div class="col-10">
              <input class="form-control" type="text" value="<?php echo  $asignatura;?>" name="asignatura" id="asignatura">
              <input class="form-control" type="hidden" value="<?php echo  $idProfesor;?>" name="idProfesor" id="idProfesor">
            </div>
           
          </div>
            <div class="form-group row">
             <div class="col-10">
              <button type="button" class="btn btn-primary" id="actualizar">Actualizar</button>
            </div>
          </div>
        </form>
		</div>
		<div class="col-sm-2"></div>
	</div>
</div>
	</script>
	    <script src="https://cdnjs.cloudflare.com/ajax/libs/tether/1.4.0/js/tether.min.js" integrity="sha384-DztdAPBWPRXSA/3eYEEUWrWCy7G5KFbe8fFjk5JAIxUYHKkDx6Qin1DkWx51bBrb" crossorigin="anonymous"></script>
    <script src="js/bootstrap.min.js"></script>
</body>
</html>