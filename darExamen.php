<?php
session_start();
if (!isset($_SESSION['usuario'])) {
    echo "<META HTTP-EQUIV='refresh' CONTENT='4; URL=index.php'>"; 
    exit;
}else{
$id_examen = $_GET['id_examen'];
$rutEstudiante = $_SESSION['usuario'];
// echo $rutEstudiante;
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
    <link rel="stylesheet" href="./css/estilo.css">
    <link rel="stylesheet" href="./css/normalize.css">
    <link rel="stylesheet" href="./css/bootstrap.min.css">
    <link rel="stylesheet" href="./css/style.css">
    <script>
      $(document).ready(function(){
              $('#enviarExamen').click(function(){
                // alert('Hola esto esta funcionando');
                  // var seleccionOpciones = $('#seleccionOpciones').val();
                  // var id_examen = $('#id_examen').val();
                  // var rutEstudiante = $('#rutEstudiante').val();
                                          
                  //          $.post('./control/enviarExamen.php', {seleccionOpciones:seleccionOpciones,id_examen:id_examen,rutEstudiante:rutEstudiante}, function(data){
                           $('#ResultadoEnviarExamen').fadeIn('slow').html(data);
                      
                   });
              
              });
        });
      </script>
</head>
<body>

<!-- nuevo cabecera -->
<div class="encabezado-examen">
  <div class="nombre-examen">
    <h1><?php echo $nombreExamen; ?></h1>
    <h4>Hoja de Respuestas</h4>
  </div>
  <div class="nombre-alumno">
    <h4><strong>Nombre Alumno:</strong></h4>
    <h4><?php echo $nombre." ".$apellido_paterno." ".$apellido_materno?></h4>
  </div>
  <div class="establecimiento">
    <h4><strong>Establecimiento:</strong></h4>
   k
  </div>
  <div class="nombre-alumno">
    <h4><strong>Curso:</strong></h4>
    <h4>4 Medio B</h4>
  </div>
</div>
<!-- fin cabecera -->

  <form action="./control/enviarExamen.php" method="post">
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
  echo "
        <div class='preguntas'>
        <div class='container-formulario'>
          <div class='numero'>
          <strong>Pregunta $contadorInput</strong>   
          </div>
          <div class='opcion'>
             $select
          </div>
        </div>
        </div>
       ";
}
?>

    
         <?php  echo "<input type='hidden' id='id_examen' name='id_examen' value='".$id_examen."'>";?>
         <?php  echo "<input type='hidden' id='rutEstudiante' name='rutEstudiante' value='".$rutEstudiante."'>";?>
         <!-- datos agregados recientemente -->
         <?php  echo "<input type='hidden' id='nombre' name='nombre' value='".$nombre."'>";?>
         <?php  echo "<input type='hidden' id='apellido_paterno' name='apellido_paterno' value='".$apellido_paterno."'>";?>
         <?php  echo "<input type='hidden' id='apellido_materno' name='apellido_materno' value='".$apellido_materno."'>";?>
         <?php  echo "<input type='hidden' id='sexo' name='sexo' value='".$sexo."'>";?>
         <?php  echo "<input type='hidden' id='edad' name='edad' value='".$edad."'>";?>
         <?php  echo "<input type='hidden' id='nombreExamen' name='nombreExamen' value='".$nombreExamen."'>";?>
          <div class="enviar-examen">
              <input type="submit" value="Enviar Exámen"  id="enviarExamen" class="btn btn-outline-success my-2 my-sm-0">
         </div>
  </form>
          
 
    
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

 }
?>