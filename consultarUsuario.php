<?php
session_start();

if (!isset($_SESSION['idProfesor'])) {
    echo "acceso denegado";
    echo "<META HTTP-EQUIV='refresh' CONTENT='4; URL=index.php'>"; 
    exit;
}else{

    $link = mysqli_connect("localhost", "root", "root", "examen");

            /* comprobar la conexión */
            if (mysqli_connect_errno()) {
                printf("Falló la conexión: %s\n", mysqli_connect_error());
                exit();
            }

            $query = mysqli_query($link, "SELECT id_examen FROM examen WHERE  profesor_id_profesor = '".$_SESSION['idProfesor']."'");
            $numero = mysqli_num_rows($query);

                   while ($row = mysqli_fetch_array($query)) {
                            $idExamen = $row['id_examen'];
                                                  
                        } /// se cierra el ciclo while


              $resultado = mysqli_query($link, "SELECT id_examen, nombre_examen, fecha, detalle_pregunta, nombre, apellido_paterno, apellido_materno FROM examen INNER JOIN profesor ON profesor.id_profesor = examen.profesor_id_profesor INNER JOIN preguntas ON preguntas.encuestas_id_encuestas = examen.id_examen where id_profesor = '".$_SESSION['idProfesor']."'and id_examen = '".$idExamen."'");
              $numeroLineas = mysqli_num_rows($resultado);

                  if ($numeroLineas != 0) {
                     
                     while ($row = mysqli_fetch_array($resultado)) {
                            $BdidExamen = $row['id_examen'];
                            $fechaExamen = $row['fecha'];
                            $nombre_examen = $row['nombre_examen'];
                            $detalle_pregunta = $row['detalle_pregunta'];
                            $nombre_profesor = $row['nombre'];
                            $apellido_paterno = $row['apellido_paterno'];
                            $apellido_materno = $row['apellido_materno'];
                              echo "Estas son las preguntas:  ".$detalle_pregunta."<br>";

                            } /// se cierra el ciclo while

                            echo "id del Examen: ".$BdidExamen."<br>";
                            echo "fecha del Examen: ".$fechaExamen."<br>";
                            echo "Nombre del Examen:  ".$nombre_examen."<br>";
                          
                            echo "Nombre del Profesor:  ".$nombre_profesor."<br>";
                            echo "Apellido Paterno del Profesor:  ".$apellido_paterno."<br>";
                            echo "Apellido Materno del Profesor:  ".$apellido_materno."<br>";
                         


?>

<!DOCTYPE html>
<html lang="es-cl">
<head>
  <meta charset="UTF-8">
  <title>Crear Examen</title>
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <script src="./js/jquery-3.2.1.min.js"></script>
  <script src="./js/main.js"></script>
  <link rel="stylesheet" href="./css/normalize.css">
  <link rel="stylesheet" href="./css/bootstrap.min.css">
  <link rel="stylesheet" href="./css/style.css">
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
              <a class="nav-link" href="crearEcuentas.php">Exámen<span class="sr-only">(current)</span></a>
            </li>
            <li class="nav-item">
            <?php echo "<a class='nav-link' href='crearPreguntas.php?nombre_examen=$nombre_examen'>Preguntas</a>";?> 
            </li>
            <li class="nav-item">
              <a class="nav-link disabled" href="consultarUsuario.php">Ver Exámen</a>
            </li>
          </ul>
          <form class="form-inline my-2 my-lg-0">
            <input class="form-control mr-sm-2" type="text" placeholder="Buscar">
            <button class="btn btn-outline-success my-2 my-sm-0" type="submit">Buscar</button>
          </form>
        </div>
    </nav>

</div>
<!--  fin de la navegacion  -->
<!-- Comienzo formulario Profesor -->
<div class="container" id="">
 <?php  echo "Agregar Preguntas a  <br>   ".$nombre_examen."<br> "."Fecha:  ".$fechaExamen."<br></h3><a href='logout.php'>Cerrar Sesión</a> ";;?>
  <div class="row">
      <div  class="col-sm-2">
                  
      </div>
    
      <div class="col-sm-9">

         <!--  <button type="button" id="" class="btn btn-primary">Agregar</button> -->
                        <!-- fin de inputs -->
      </div>
          
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

  }else{
                   
     echo "el registro no existe este archivo es de exito.php";
        } 
?>
<?php } ?>
