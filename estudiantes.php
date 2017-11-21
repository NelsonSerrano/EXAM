<?php
session_start();
if (!isset($_SESSION['usuario'])) {
    echo "acceso denegado";
    echo "<META HTTP-EQUIV='refresh' CONTENT='4; URL=index.php'>"; 
    exit;
}else{
require_once('./control/conexion.php');

$resultadoAlumnoSesion = mysqli_query($link, "SELECT * FROM estudiante WHERE rut = '".$_SESSION['usuario']."'");
$numeroLineasAlumnoSesion = mysqli_num_rows($resultadoAlumnoSesion);

  if ($numeroLineasAlumnoSesion != 0) {
                     
      while ($rowSesionAlumno = mysqli_fetch_array($resultadoAlumnoSesion)) {
            $id_estudiante = $rowSesionAlumno ['rut'];
            $nombre = $rowSesionAlumno['nombre'];
            $apellido_paterno = $rowSesionAlumno['apellido_paterno'];
            $apellido_materno = $rowSesionAlumno['apellido_materno'];
                        
        } /// se cierra el ciclo while
  
 $resultadoIdCursoAlumno = mysqli_query($link, "SELECT curso_id_curso FROM estudiante WHERE rut = '".$id_estudiante ."'");
 while ($rowSesionIdCursoAlumno = mysqli_fetch_array($resultadoIdCursoAlumno)) {
            $idCurso = $rowSesionIdCursoAlumno['curso_id_curso'];
                              
        } /// se cierra el ciclo while                
?>
<!DOCTYPE html>
<html lang="es-cl">
<head>
    <meta charset="UTF-8">
    <title>EXAMP Alumnos</title>
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <script src="./js/jquery-3.2.1.min.js"></script>
    <script src="./js/main.js"></script>
    <link rel="stylesheet" href="./css/normalize.css">
    <link rel="stylesheet" href="./css/bootstrap.min.css">
    <link rel="stylesheet" href="./css/style.css">
    <script>
      $(document).ready(function(){
              $('#informacionExamen').click(function(){
                    var examenCurso = $('#examenCurso').val();
                    if (examenCurso == 'Seleccione Exámen') {
                         alert("Seleccione un examen");
                       }else{
                           $.post('control/informacionExamen.php', {examenCurso:examenCurso}, function(data){
                           $('#resultadoInformacionExamen').fadeIn('slow').html(data);
                      
                   });
                 }
              });
        });
      </script>
      <style>
        .verExamen{
          padding-top: 1em;
          width: 100%;
        }
      </style>
</head>
<body>
<!-- comienzo de navegacion -->
<div class="container">
    <nav class="navbar navbar-toggleable-md navbar-light bg-faded">
        <button class="navbar-toggler navbar-toggler-right" type="button" data-toggle="collapse" data-target="#navbarTogglerDemo02" aria-controls="navbarTogglerDemo02" aria-expanded="false" aria-label="Toggle navigation">
          <span class="navbar-toggler-icon"></span>
        </button>
        <a class="navbar-brand" href="#">EXAMP Alumnos</a>

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
          <!--   <input class="form-control mr-sm-2" type="text" placeholder="Buscar">
            <button class="btn btn-outline-success my-2 my-sm-0" type="submit">Buscar</button> -->
          </form>
        </div>
    </nav>

</div>


<!-- Comienzo formulario Estudiante -->
<div class="container verExamen" id="">

  <div class="row">
      <div  class="col-md-2">
                  
      </div>
    
      <div class="col-md-8">
          <table class="table table-inverse table-responsive">
          <thead>
            <tr>
              <th>#</th>
              <th colspan="3">
                 <select class='form-control selectCurso' id='examenCurso' name='examenCurso'>
                    <option>Seleccione Exámen</option>
                    <?php
                    $resultadoExamenCurso = mysqli_query($link, "SELECT nombre_examen from examen INNER JOIN curso_examen ON curso_examen.examen_id_examen = examen.id_examen where curso_id_curso  = '".$idCurso."'");

                     while ($rowExamenesCurso = mysqli_fetch_array( $resultadoExamenCurso)) {
                            $examenesCurso = $rowExamenesCurso['nombre_examen'];
                             echo $examenesCurso;                 
                    ?>
                    <option value = "<?php echo $examenesCurso; ?>"><?php echo $examenesCurso; ?></option> 
                    <?php
                             }
                    ?>
                  </select>
              </th>
              <th>
                  <input type="button" value="Información Exámen"  id="informacionExamen" class="btn btn-outline-success my-2 my-sm-0">
              </th>
              <th></th>
              <th></th>
            </tr>
          </thead>
          <tbody id="resultadoInformacionExamen">
           
          
          </tbody>
        </table>
      </div>
          
      <div  class="col-md-2">
                  
      </div>
  </div>


<div class="container result"> 
        <div class="row">
              <div class="col-sm-2">
              </div>
               <div id="resultado" class="col-sm-8">
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
<?php

                }else{
                   
                    echo "el registro no existe este archivo es de estudiante.php";
                } 
?>
<?php } ?>