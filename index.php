<?php
session_start();
if(!isset($_SESSION['usuario'])) { header("location: login.php"); header('Content-Type: text/html; charset=utf-8'); 
// echo "<META HTTP-EQUIV='refresh' CONTENT='; URL=index.php'>"; 
exit;
}else{
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
        </head>
        <body>
<?php 
require_once('control/conexion.php');

$profesor = mysqli_query($link, "SELECT * FROM profesor WHERE rut = '".$_SESSION['usuario']."'" );
mysqli_num_rows($profesor);


$administrador = mysqli_query($link, "SELECT * FROM administrador WHERE id_administrador = '".$_SESSION['usuario']."'");
mysqli_num_rows($administrador);


$estudiante = mysqli_query($link, "SELECT * FROM estudiante WHERE rut ='".$_SESSION['usuario']."'");
mysqli_num_rows($estudiante);

  if (mysqli_num_rows($profesor) > 0) {
         echo "<META HTTP-EQUIV='refresh' CONTENT='1; URL=exito.php'>"; 
         // header("location: exito.php");


  }elseif (mysqli_num_rows($administrador) > 0) {
          echo "<META HTTP-EQUIV='refresh' CONTENT='1; URL=admin.php'>"; 
         // header("location: administrador.php");
     

  }elseif(mysqli_num_rows($estudiante) > 0){
          echo "<META HTTP-EQUIV='refresh' CONTENT='1; URL=student.php'>"; 
       // header("location: estudiantes.php");
  }
?>
<!-- comienzo de navegacion -->
<!-- <div class="container">
    <nav class="navbar navbar-toggleable-md navbar-light bg-faded">
        <button class="navbar-toggler navbar-toggler-right" type="button" data-toggle="collapse" data-target="#navbarTogglerDemo02" aria-controls="navbarTogglerDemo02" aria-expanded="false" aria-label="Toggle navigation">
          <span class="navbar-toggler-icon"></span>
        </button>
        <a class="navbar-brand" href="#">EXAMP</a>

        <div class="collapse navbar-collapse" id="navbarTogglerDemo02">
          <ul class="navbar-nav mr-auto mt-2 mt-md-0">
            <li class="nav-item active">
              <a class="nav-link" href="crearEcuentas.php">Exámen<span class="sr-only">(current)</span></a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="crearPreguntas.php">Preguntas</a>
            </li>
            <li class="nav-item">
              <a class="nav-link disabled" href="#">Resultados</a>
            </li>
          </ul>
          <form class="form-inline my-2 my-lg-0">
            <input class="form-control mr-sm-2" type="text" placeholder="Buscar">
            <button class="btn btn-outline-success my-2 my-sm-0" type="submit">Buscar</button>
          </form>
        </div>
    </nav>
</div> -->
<!-- 	fin de la navegacion  -->
<!-- Comienzo Login de Ingreso Profesor -->
  <div class="container form_exam">
        <div class="row">
            <div class="col-md-3">
            
              </div>
                  <div id="resultado" class="col-md-6">
                       
                  </div>
       
                  <div class="col-md-3">
                
                  </div>
            </div>
        </div>
  </div>

<!-- Fin Login de Ingreso Profesor -->

    <script src="https://cdnjs.cloudflare.com/ajax/libs/tether/1.4.0/js/tether.min.js" integrity="sha384-DztdAPBWPRXSA/3eYEEUWrWCy7G5KFbe8fFjk5JAIxUYHKkDx6Qin1DkWx51bBrb" crossorigin="anonymous"></script>
    <script src="js/bootstrap.min.js"></script>

</body>
</html>
<?php } ?>

