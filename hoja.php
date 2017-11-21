<?php
session_start();
if(!isset($_SESSION['usuario'])) { header("location: login.php"); header('Content-Type: text/html; charset=utf-8'); 
exit;
}else{
// var_dump($_SESSION['usuario']);
$idProfesor = $_SESSION['usuario'];
$nombreProfesor = $_GET['nombreProfesor'];
$apellido_paternoProf = $_GET['apellido_paterno'];
?>
<!DOCTYPE html>
<html lang="es-cl">
          <head>
            	<meta charset="UTF-8">
            	<title>Nombre Examen</title>
            	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
              <script src="./js/jquery-3.2.1.min.js"></script>
              <script src="./js/main.js"></script>
            	<link rel="stylesheet" href="./css/normalize.css">
              <link rel="stylesheet" href="./css/bootstrap.min.css">
              <link rel="stylesheet" href="./css/style.css">
              <link rel="stylesheet" href="css/estilos.css">
          </head>
        <body>
        <script>
           $(document).ready(function(){
            $('#sendExamen').click(function(){
                var idProfesor = $('#idProfesor').val();
                var nombreProfesor = $('#nombreProfesor').val();
                var apellido_paternoProf = $('#apellido_paternoProf').val();
                var nombreExamen = $('#nombreExamen').val();
                var porcentaje_aprob = $('#porcentaje_aprob').val();
                     $.post('control/insertarExamenJ.php', {idProfesor:idProfesor,nombreProfesor:nombreProfesor,apellido_paternoProf:apellido_paternoProf,nombreExamen:nombreExamen,porcentaje_aprob:porcentaje_aprob}, function(data){
                    if (data == "Se insertaron Correctamente") {
                        // window.location.href = "exito.php";
                         $('#resultadoExamen').fadeIn('slow').html(data);
                         $('#nombreExamen').val("");
                         $('#porcentaje_aprob').val("");
                    }else{
                      $('#nombreExamen').val("");
                      $('#porcentaje_aprob').val("");
                      $('#resultadoExamen').fadeIn('slow').html(data);

                      }
                  

                  });
            });
        });

        </script>
        <style>
          .exit{
          width: 30px;
          height: 30px;
        }
 
        </style>

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
             <?php  echo "<strong>".$nombreProfesor."  ".$apellido_paternoProf."</strong>"." "."&nbsp&nbsp<a href='logout.php'><a href='logout.php'><img class='exit' src='images/exit.png' alt=''></a></a> ";?>
          </form>
        </div>
    </nav>
</div>
<!-- 	fin de la navegacion  -->
<!-- Comienzo formulario Profesor -->
<div class="container" id="CrearProfesor">
 
    <div class="row">
        <div class="col-sm-2">
          
        </div>
           <div class="col-sm-8">
            <!-- inicio de inputs -->
            <h4>Crear Hoja de Respuestas</h4>
                  <form class="form-control" action="control/insertarExamen.php" method="post">
                        <div class="form-group">
                            <?php  echo "<input type='hidden' id='idProfesor' name='idProfesor' value='".$idProfesor."'>";?>
                        </div>
                        <div class="form-group">
                            <?php  echo "<input type='hidden' id='nombreProfesor' name='nombreProfesor' value='".$nombreProfesor."'>";?>
                        </div>
                        <div class="form-group">
                            <?php  echo "<input type='hidden' id='apellido_paternoProf' name='apellido_paternoProf' value='".$apellido_paternoProf."'>";?>
                        </div>
                        <div class="form-group">
                            <label for="Apellido">Ingrese Nombre de Examen</label>
                            <input type="text" class="form-control" id="nombreExamen" name="nombreExamen">
                            <small class="form-text text-muted">Nombre de Examen</small> 
                        </div>

                        <button type="button" id="sendExamen" class="btn btn-primary">Continuar</button>
                    <!-- fin de inputs -->
                    </form>
              </div>
        
        <div class="col-sm-2">
            
        </div>
    </div>

</div>
<div class="container result"> 
        <div class="row">
              <div class="col-sm-2">
              </div>
               
               <div id="resultadoExamen" class="col-sm-8">
              </div>
              
               <div class="col-sm-2">
              </div>
        </div>
    </div>



<!-- Fin formulario Profesor -->

    <script src="https://cdnjs.cloudflare.com/ajax/libs/tether/1.4.0/js/tether.min.js" integrity="sha384-DztdAPBWPRXSA/3eYEEUWrWCy7G5KFbe8fFjk5JAIxUYHKkDx6Qin1DkWx51bBrb" crossorigin="anonymous"></script>
    <script src="js/bootstrap.min.js"></script>

</body>
</html>
<?php } ?>