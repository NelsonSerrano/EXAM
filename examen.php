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
              <link rel="stylesheet" href="css/style.css">
              <link rel="stylesheet" href="css/estil.css">
              <link rel="stylesheet" href="css/estilos.css">
          </head>
        <body>
        <script>
           $(document).ready(function(){
            $('#sendExamen').on("click",function(){
                var idProfesor = $('#idProfesor').val();
                var nombreProfesor = $('#nombreProfesor').val();
                var apellido_paternoProf = $('#apellido_paternoProf').val();
                var nombreExamen = $('#nombreExamen').val();
                var tipo = $('input:radio[name=tipo]:checked').val();
                 $( "#progressbar" ).addClass( "progres" );
                     $.post('control/insertarExamEd.php', {idProfesor:idProfesor,nombreProfesor:nombreProfesor,apellido_paternoProf:apellido_paternoProf,nombreExamen:nombreExamen,tipo:tipo}, function(data){
                    if (data == "Se insertaron Correctamente") {
                        // window.location.href = "exito.php";
                        
                         $('#desaparecer').fadeIn('slow').html(data);
                         $('#nombreExamen').val("");
                         $('#porcentaje_aprob').val("");
                    }else{
                      $('#nombreExamen').val("");
                      $('#porcentaje_aprob').val("");
                      $('#desaparecer').fadeIn('slow').html(data);

                      }
                  

                  });
            });
        });

        </script>
        <style>
          .radioText{
           color: #08088A;
           font-weight:800;
          }
          .nombreExamen {
         
            padding: .7em;

          }
          .check{
         
            padding: .3em;

          }
          .progres{
            width: 33%;
            background: green;
          }
          #progreso{
            margin: 1em;
          }
          .linea{
            width: 100%;
            height: 25px;
            border: 2px solid #B45F04;
            background: #F8ECE0;
            text-align: center;
            font-size: .8em;
            color:#B45F04;
            font-weight: 800;
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
             <?php  echo "<strong>".$nombreProfesor."  ".$apellido_paternoProf."</strong>"." "."&nbsp&nbsp<a href='logout.php'><img class='exit' src='images/exit.png' alt=''></a> ";?>
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
          <div class="container">
            <div class="row">
              <div class="col-sm-4 linea">
                informacion Básica
              </div>
              <div class="col-sm-4 linea">
                Crear Preguntas
              </div>
              <div class="col-sm-4 linea">
                 Asignación 
              </div>
               
            </div>
          </div>
             <div class="progress" id="progreso">
              <div class="progress-bar progress-bar-success" id="progressbar" role="progressbar"
                   aria-valuenow="40" aria-valuemin="0" aria-valuemax="100"
                   >
                
              </div>
            </div>
            <!-- inicio de inputs -->
                <div class="desaparecer" id="desaparecer">
                  <form action="control/insertarExamen.php" class="form-control" method="post">
                        <div class="form-group">
                            <?php  echo "<input type='hidden' id='idProfesor' name='idProfesor' value='".$idProfesor."'>";?>
                        </div>
                        <div class="form-group">
                            <?php  echo "<input type='hidden' id='nombreProfesor' name='nombreProfesor' value='".$nombreProfesor."'>";?>
                        </div>
                        <div class="form-group">
                            <?php  echo "<input type='hidden' id='apellido_paternoProf' name='apellido_paternoProf' value='".$apellido_paternoProf."'>";?>
                        </div>
                        <div id="n">
                          <div class="form-group nombreExamen">
                             
                              <input type="text" class="form-control" id="nombreExamen" name="nombreExamen">
                              <small class="form-text text-muted">Nombre de Examen</small> 
                          </div>
                        </div>
                     <!--   VAMOS A PROBAR CON UNOS RADIOS PARA RESCATAR EL VALOR QUE  -->
                    <div class="check">
                       <div class="form-check check">
                          <label class="form-check-label radioText">
                            <input class="form-check-input" type="radio"  name="tipo" id="tipo1" value="1" checked>
                            Seleccione si el examen es individual
                          </label>
                        </div>
                        <div class="form-check check">
                          <label class="form-check-label radioText">
                            <input class="form-check-input" type="radio"  name="tipo" id="tipo2" value="2">
                             Seleccione si el examen es grupal
                          </label>
                        </div>
                    </div>
                        <button type="button" id="sendExamen" class="btn btn-primary">Continuar</button>
                    <!-- fin de inputs -->
                    </form>
                </div>
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