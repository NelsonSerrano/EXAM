<?php
$idProfesor = $_GET['id'];
$nombres = $_GET['nombres'];
// echo $idProfesor;
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
				require_once('control/conexion.php');
				mysqli_query($link, "DELETE FROM profesor WHERE rut = '$idProfesor'");
				echo "Se elimino correctamente";
				echo "<META HTTP-EQUIV='refresh' CONTENT='4; URL=admin.php'>"; 
			?>
		</div>
		<div class="col-sm-2"></div>
	</div>
</div>
	</script>
	    <script src="https://cdnjs.cloudflare.com/ajax/libs/tether/1.4.0/js/tether.min.js" integrity="sha384-DztdAPBWPRXSA/3eYEEUWrWCy7G5KFbe8fFjk5JAIxUYHKkDx6Qin1DkWx51bBrb" crossorigin="anonymous"></script>
    <script src="js/bootstrap.min.js"></script>
</body>
</html>