<?php
session_start();
if (!isset($_SESSION['usuario'])) {
    echo "acceso denegado";
    echo "<META HTTP-EQUIV='refresh' CONTENT='4; URL=index.php'>"; 
    exit;
}else{
$id_examen = $_GET['id_examen'];
$rutEstudiante = $_SESSION['usuario'];
echo $rutEstudiante;
require_once('./control/conexion.php');

$resultadoFormulario = mysqli_query($link, "SELECT cantidad_preguntas, cantidad_alternativas, examen_id_examen FROM formulario WHERE  examen_id_examen ='".$id_examen."'");

$resultadoExamen = mysqli_query($link, "SELECT nombre_examen FROM examen WHERE id_examen ='".$id_examen."'");
  while ($rowExamen = mysqli_fetch_array($resultadoExamen)) {
                            $nombreExamen = array(
                                 'nombre_examen'   =>  $rowExamen['nombre_examen'],
                             );
                          
                          }
$nombreExamen = $nombreExamen['nombre_examen'];

$resultadoEstudiante = mysqli_query($link, "SELECT nombre, apellido_paterno, apellido_materno, sexo, edad  FROM estudiante WHERE rut ='".$_SESSION['usuario']."'");
  while ($rowEstudiante = mysqli_fetch_array($resultadoEstudiante)) {
                            $estudiante = array(
                                 'nombre'             =>  $rowEstudiante['nombre'],
                                 'apellido_paterno'   =>  $rowEstudiante['apellido_paterno'],
                                 'apellido_materno'   =>  $rowEstudiante['apellido_materno'],
                                 'sexo'               =>  $rowEstudiante['sexo'],
                                 'edad'               =>  $rowEstudiante['edad'],

                             );
                          }
$nombre = $estudiante['nombre'];
$apellido_paterno = $estudiante['apellido_paterno'];
$apellido_materno = $estudiante['apellido_materno'];
$sexo = $estudiante['sexo'];
$edad = $estudiante['edad'];

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
              $('#enviarExamen').click(function(){
                // alert('Hola esto esta funcionando');
                  var seleccionOpciones = $('#seleccionOpciones').val();
                  var id_examen = $('#id_examen').val();
                  var rutEstudiante = $('#rutEstudiante').val();
                    if (seleccionOpciones == 'Seleccione') {
                           alert("Seleccione la Opción Correcta");
                       }else{
                           $.post('./control/enviarExamen.php', {seleccionOpciones:seleccionOpciones,id_examen:id_examen,rutEstudiante:rutEstudiante}, function(data){
                           $('#ResultadoEnviarExamen').fadeIn('slow').html(data);
                      
                   });
                 }
              });
        });
      </script>
      <style>
      .encabezadoHojaRespuesta{
        width: 100%;
        height: auto;
        padding-top: 1em;
        /*border:1px solid black;*/
        }
        .encabezadoHojaRespuesta-title{
          text-align: center;
            
        }
        h1{
          font-size: 2em;
          font-weight: 700;
        }
        .encabezadoHojaRespuesta-infoAlumno{
          padding-top: 1.5em;
        }
        .tdCurso{
          width: 25%;

        }
      .formulario-examen{
        width: 100%;
        height: auto;
     /*   border: 1px solid black;*/
        margin-top: 1em;
      }
      </style>
</head>
<body>
<!-- inicio del container de datos de alumno y cabecera -->
<div class="container">
  <div class="row">
    <div class="col-md-2"></div>
    <div class="col-md-8">
        <div class="encabezadoHojaRespuesta">
            <div class="encabezadoHojaRespuesta-title">
              <h1><?php echo $nombreExamen; ?></h1>
              <h4>Hoja de Respuestas</h4>
            </div>
            <div class="encabezadoHojaRespuesta-infoAlumno">
              <table class="table table-bordered">
                <thead>
                  <tr>
                    <th colspan="1">Nombre Alumno:</th>
                    <th colspan="4"><?php echo $nombre." ".$apellido_paterno." ".$apellido_materno;?></th>
                  </tr>
                </thead>
                <tbody>
                  <tr>
                    <td colspan="1"><strong>Establecimiento:</strong></td>
                    <td colspan="4"></td>
                  </tr>
                  <tr>
                    <td class="tdCurso"><strong>Curso:</strong></td>
                    <td><strong>Sexo:</strong></td>
                    <td><?php echo "  ".$sexo;?></td>
                    <td><strong>Edad:</strong></td>
                    <td><?php echo $edad;?></td>
                  </tr>
              </tbody>
              </table>
            </div>
        </div>
    </div>
    <div class="col-md-2"></div>
    </div>
</div>
<!-- Fin del container de datos de alumno y cabecera -->
<div class="container-fluid">
  <form action="./control/enviarExamen.php" method="post">
  <div class="row">
    <div class="col-md-2"></div>

    <div class="col-md-8 formulario-examen">
  
      <table class="table table-bordered">
          <thead>
            <tr>
              <th>Nº</th>
              <th>Pregunta</th>
              <th colspan="4">Seleccione la Opción</th>
             
            </tr>
          </thead>
          <tbody>
          <?php
          while ($rowFormulario = mysqli_fetch_array($resultadoFormulario)) {
                            $formularioExamen = array(
                                 'cantidad_preguntas'     =>  $rowFormulario['cantidad_preguntas'],
                                 'cantidad_alternativas'  =>  $rowFormulario['cantidad_alternativas'],
                                  );
                          
                          }
                       $cantidadPreguntas = $formularioExamen['cantidad_preguntas']."<br>";
                       $opcionesCorrectas = $formularioExamen['cantidad_alternativas'];
                       include('./control/select.php');

                          
              $contadorInput = 0;
              for ($i=0; $i < $cantidadPreguntas; $i++) { 
                  $contadorInput++;
                 echo"<tr>
                        <th scope='row'>#</th>
                        <td>$contadorInput</td>
                        <td colspan='4'>$select</td>
                      </tr>
                    ";   
              }
            ?>
          </tbody>
        </table>
         <?php  echo "<input type='hidden' id='id_examen' name='id_examen' value='".$id_examen."'>";?>
         <?php  echo "<input type='hidden' id='rutEstudiante' name='rutEstudiante' value='".$rutEstudiante."'>";?>
         <!-- datos agregados recientemente -->
         <?php  echo "<input type='hidden' id='nombre' name='nombre' value='".$nombre."'>";?>
         <?php  echo "<input type='hidden' id='apellido_paterno' name='apellido_paterno' value='".$apellido_paterno."'>";?>
         <?php  echo "<input type='hidden' id='apellido_materno' name='apellido_materno' value='".$apellido_materno."'>";?>
         <?php  echo "<input type='hidden' id='sexo' name='sexo' value='".$sexo."'>";?>
         <?php  echo "<input type='hidden' id='edad' name='edad' value='".$edad."'>";?>
         <?php  echo "<input type='hidden' id='nombreExamen' name='nombreExamen' value='".$nombreExamen."'>";?>
        </form>
          <input type="submit" value="Enviar Exámen"  id="enviarExamen" class="btn btn-outline-success my-2 my-sm-0">
      </div>
    

    <div class="col-md-2">
      
    </div>
  </div>
</div>
<div class="container">
  <div class="row">
    <div class="col-md 2"></div>
    <div class="col-md 8" id="ResultadoEnviarExamen">
      
    </div>
    <div class="col-md 2"></div>
  </div>
</div>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/tether/1.4.0/js/tether.min.js" integrity="sha384-DztdAPBWPRXSA/3eYEEUWrWCy7G5KFbe8fFjk5JAIxUYHKkDx6Qin1DkWx51bBrb" crossorigin="anonymous"></script>
    <script src="js/bootstrap.min.js"></script>
</body>
</html>
<?php

 } ?>