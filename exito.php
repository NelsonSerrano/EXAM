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
$sqlProfesor = mysqli_query($link, "SELECT rut, nombre, apellido_paterno, apellido_materno, asignatura FROM profesor WHERE rut = '".$_SESSION['usuario']."'" );
mysqli_num_rows($sqlProfesor);
$rowProfesor = mysqli_fetch_array($sqlProfesor);
                            $idProfesor = $rowProfesor['rut'];
                            $nombreProfesor = $rowProfesor['nombre'];
                            $apellido_paternoProf = $rowProfesor['apellido_paterno'];
                            $apellido_maternoProf = $rowProfesor['apellido_materno'];
                            $asignaturaProf = $rowProfesor['asignatura'];

$resultado = mysqli_query($link, "SELECT id_examen, nombre_examen, fecha  FROM examen WHERE profesor_rut = '".$_SESSION['usuario']."'");
              $numeroLineas = mysqli_num_rows($resultado);
                 
                       while ($row = mysqli_fetch_array($resultado)) {
                            $BdidExamen = $row['id_examen'];
                            $fechaExamen = $row['fecha'];
                            $nombre_examen = $row['nombre_examen'];
                      } /// se cierra el ciclo while
?>
<!DOCTYPE html>
<html lang="es-cl">
<head>
  <meta charset="UTF-8">
  <title>EXAMP</title>
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <script src="./js/jquery-3.2.1.min.js"></script>
  <script src="./js/main.js"></script>
  <link rel="stylesheet" href="./css/normalize.css">
  <link rel="stylesheet" href="./css/bootstrap.min.css">
  <link rel="stylesheet" href="css/style.css">
 <link rel="stylesheet" href="css/estilos.css">
  
  <style>
   .centrar{
    padding-top: .4em;
    padding-left: .1em;
   }

  #cuerpo{
    padding: 2em;
  }
  .exit{
          width: 30px;
          height: 30px;
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
        <a class="navbar-brand" href="exito.php"><img src="images/logo.jpg" class="logo" alt=""></a>

      <div class="collapse navbar-collapse" id="navbarTogglerDemo02">
          <ul class="navbar-nav mr-auto mt-2 mt-md-0">
              <li class="nav-item active">
               
              </li>
             <!-- comienza el drop -->
              <li class="nav-item dropdown centrar">
                  <a href="#" class="dropdown-item dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    EXAMEN <b class="caret"></b>
                  </a>
                <ul class="dropdown-menu">
                  <li><?php echo "<a class='dropdown-item' href='hoja.php?nombreProfesor=$nombreProfesor&&apellido_paterno=$apellido_paternoProf'> CREAR HOJA RESPUESTAS<span class='sr-only'>(current)</span></a>";?>
                  </li>
                  <li><?php echo "<a class='dropdown-item' href='examen.php?nombreProfesor=$nombreProfesor&&apellido_paterno=$apellido_paternoProf'> CREAR EXAMEN<span class='sr-only'>(current)</span></a>";?>
                
                  <li><?php echo "<a class='dropdown-item' href='control/asignarE.php?idProfesor=$idProfesor&nombreProfesor=$nombreProfesor&apellido_paterno=$apellido_paternoProf'>ASIGNAR EXAMEN<span class='sr-only'>(current)</span></a>";?>
                  <li><?php echo "<a class='dropdown-item' href='activarExam.php?nombreProfesor=$nombreProfesor&&apellido_paterno=$apellido_paternoProf'>ACTIVAR EXAMEN<span class='sr-only'>(current)</span></a>";?>
                  </li>
                  </li>
                  <li><?php echo "<a class='dropdown-item' href='misExamenes.php?nombreProfesor=$nombreProfesor&&apellido_paterno=$apellido_paternoProf'>MIS EXAMENES<span class='sr-only'>(current)</span></a>";?>
                  </li>
                  <li><?php echo "<a class='dropdown-item' href='editarPregEx.php?nombreProfesor=$nombreProfesor&&apellido_paterno=$apellido_paternoProf'>EDITAR PREGUNTAS EXAMEN<span class='sr-only'>(current)</span></a>";?>
                  </li>
                   
                </ul>
              </li>
               <!-- termina el drop -->
                <!-- comienza el drop de REPORTES -->
              <li class="nav-item dropdown centrar">
                  <a href="#" class="dropdown-item dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    REPORTES <b class="caret"></b>
                  </a>
                <ul class="dropdown-menu">
                  <li>
                    <? echo "<a class='dropdown-item' href='reportG.php?nombreProfesor=$nombreProfesor&&apellido_paternoProf=$apellido_paternoProf&&apellido_maternoProf=$apellido_maternoProf'>REPORTE CURSO</a>";?>
                  </li>
                  <li>
                    <? echo "<a class='dropdown-item' href='reporteRespuesta.php?nombreProfesor=$nombreProfesor&&apellido_paternoProf=$apellido_paternoProf&&apellido_maternoProf=$apellido_maternoProf'>REPORTE RESPUESTAS</a>";?>
                  </li>
                  <li>
                    <? echo "<a class='dropdown-item' href='reporteHabilidades.php?nombreProfesor=$nombreProfesor&&apellido_paternoProf=$apellido_paternoProf&&apellido_maternoProf=$apellido_maternoProf'>REPORTES HABILIDADES</a>";?>
                  </li>
                </ul>
              </li>
               <!-- termina el drop -->
                <!-- comienza el drop -->
              <li class="nav-item dropdown centrar">
                  <a href="#" class="dropdown-item dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    HABILIDADES <b class="caret"></b>
                  </a>
                <ul class="dropdown-menu">
                  <li>
                    <? echo "<a class='dropdown-item' href='addHabilidad.php?nombreProfesor=$nombreProfesor&&apellido_paterno=$apellido_paternoProf&&apellido_materno=$apellido_maternoProf&idProfesor=$idProfesor'>AGREGAR HABILIDADES</a>";?>
                  </li>
                 
                </ul>
              </li>
               <!-- termina el drop -->
              <!-- comienza el drop CURSO -->
              <li class="nav-item dropdown centrar">
                  <a href="#" class="dropdown-item dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    CURSOS<b class="caret"></b>
                  </a>
                <ul class="dropdown-menu">
                  <li><?php echo "<a class='dropdown-item' href='control/cursos.php?nombreProfesor=$nombreProfesor&&apellido_paterno=$apellido_paternoProf&&apellido_materno=$apellido_maternoProf&idProfesor=$idProfesor'>ASIGNACIÓN DE ALUMNOS<span class='sr-only'>(current)</span></a>";?>
                  </li>
                   
                   <li><?php echo "<a class='dropdown-item' href='control/addNewCursos.php?nombreProfesor=$nombreProfesor&apellido_paterno=$apellido_paternoProf&apellido_materno=$apellido_maternoProf&idProfesor=$idProfesor'> AGREGAR NUEVO CURSO<span class='sr-only'>(current)</span></a>";?>
                  </li>
                 
                </ul>
              </li>
               <!-- termina el drop -->
       
          </ul>
          <form class="form-inline my-2 my-lg-0 informacionUsuario">
              <!-- <input class="form-control mr-sm-2" type="text" placeholder="Buscar">
              <button class="btn btn-outline-success my-2 my-sm-0" type="submit">Buscar</button> -->
             <?php  echo "<strong>".$nombreProfesor."  ".$apellido_paternoProf."</strong>"." "."&nbsp&nbsp<a href='logout.php'><img class='exit' src='images/exit.png' alt=''></a> ";?>
          </form>
        </div>
  </nav>

</div>
<!--  fin de la navegacion  -->

<!-- Comienzo info 1 de Profesor -->
<div class="container-fluid informacionProfesor">
  <div class="row">
    <div class="sm-2"></div>
    <div class="sm-8">
   
    </div>
    <div class="sm-2 nombres"></div>
  </div>
</div>

<!-- inicio del container de datos de profesor y cabecera -->
<div class="container" id="cuerpo">
  <div class="row">
    <div class="col-md-2"></div>
    <div class="col-md-8">
        <div class="encabezadoHojaRespuesta">
            <div class="encabezadoHojaRespuesta-title">
              <h1></h1>
              <h4>Bienvenido Profesor(a)</h4>
            </div>
            <div class="encabezadoHojaRespuesta-infoAlumno">
              <table class="table table-bordered">
                <thead>
                  <tr>
                    <th colspan="1">Nombres:</th>
                    <th colspan="4"><?php echo $nombreProfesor." ".$apellido_paternoProf." ".$apellido_maternoProf;?></th>
                  </tr>
                </thead>
                <tbody>
                 
                </tbody>
              </table>
            </div>
        </div>
    </div>
    <div class="col-md-2"></div>
    </div>
</div>
<!-- Fin del container de datos de alumno y cabecera -->
        
      
          
      <div  class="col-sm-2">
                  
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
} 
}
?>