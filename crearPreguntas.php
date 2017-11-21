<?php
session_start();
if(!isset($_SESSION['usuario'])) { header("location: login.php"); header('Content-Type: text/html; charset=utf-8'); 
exit;
}else{
$id_examen = $_GET['lastIdExam'];
$nombreExamen = $_GET['nombreExamen'];
$nombreProfesor = $_GET['nombreProfesor'];
$apellido_paterno = $_GET['apellido_paterno'];
?>
<!DOCTYPE html>
<html lang="es-cl">
    <head>
	  <meta charset="UTF-8">
	  <title>Crear Preguntas</title>
	  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <script src="./js/jquery-3.2.1.min.js"></script>
    <script src="./js/main.js"></script>
	  <link rel="stylesheet" href="./css/normalize.css">
    <link rel="stylesheet" href="./css/bootstrap.min.css">
    <link rel="stylesheet" href="./css/style.css">
    <link rel="stylesheet" href="css/estilos.css">
      <script>
         $(document).ready(function(){
            $('#insertarFormulario').click(function(){
                var id_examen = $('#id_examen').val();
                var nombreExamen = $('#nombreExamen').val();
                var seleccionNumeroPreguntas = $('#seleccionNumeroPreguntas').val();  // numero de opciones
                var seleccionOpciones = $('#seleccionOpciones').val();
                var nombreProfesor = $('#nombreProfesor').val();
                var apellido_paterno = $('#apellido_paterno').val();                // numero de preguntas
                       $.post('control/agregarPreguntas.php', {id_examen:id_examen,nombreExamen:nombreExamen,seleccionNumeroPreguntas:seleccionNumeroPreguntas,seleccionOpciones:seleccionOpciones, nombreProfesor:nombreProfesor, apellido_paterno:apellido_paterno }, function(data){
                    if (data == "Se creo correctamente el fomulario") {
                        // window.location.href = "exito.php";
                         $('#resultadoFormulario').fadeIn('slow').html(data);
                         // $('#nombreExamen').val("");
                         // $('#id_examen').val("");
                         // $('#seleccionNumeroPreguntas').val("Seleccione");
                         // $('#seleccionOpciones').val("Seleccione");
                    }else{
                        // $('#nombreExamen').val("");
                        // $('#id_examen').val("");
                        // $('#seleccionNumeroPreguntas').val("Seleccione");
                        // $('#seleccionOpciones').val("Seleccione");
                        $('#resultadoFormulario').fadeIn('slow').html(data);

                      }
                  

                  });
            });
        });
      </script>
      <style>
          #inputs{
            width: 250px;
            display: inline;
          }
          #enviar{
            display: block;
          }
          #opciones{
            width: 100%;
            height: auto;
          }
          .opcion{
            display: inline;
          }

          .exit{
          width: 30px;
          height: 30px;
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
        <a class="navbar-brand" href="exito.php"><img src="images/logo.jpg" class="logo" alt=""></a>

        <div class="collapse navbar-collapse" id="navbarTogglerDemo02">
          <ul class="navbar-nav mr-auto mt-2 mt-md-0">
            <li class="nav-item active">
             
            </li>
            <li class="nav-item">

            </li>
            <li class="nav-item">
      
            </li>
          </ul>
          <form class="form-inline my-2 my-lg-0">
            <?php  echo "<strong>".$nombreProfesor."  ".$apellido_paterno."</strong>"." "."&nbsp&nbsp<a  href='logout.php'><img class='exit' src='images/exit.png' alt=''></a> ";?>
          </form>
        </div>
    </nav>
</div>
<!-- 	fin de la navegacion  -->


<div id="check" class="container">
  <div class="row">
      <div class="col-sm-2">
        
      </div>
    <div class="col-sm-8">
    <?php echo '<h4>Crear Preguntas a exámen: '.$nombreExamen.'</h4>';?>
        <form id="datos" action="control/agregarPreguntas.php" class="form-control" method="post">
              <div id="opciones" class="opciones">
                      <div class="form-group ">
                         <?php  echo "<input type='hidden' id='id_examen' name='id_examen' value='".$id_examen."'>";?>
                         <?php  echo "<input type='hidden' id='nombreExamen' name='nombreExamen' value='".$nombreExamen."'>";?>
                          <?php  echo "<input type='hidden' id='nombreProfesor' name='nombreProfesor' value='".$nombreProfesor."'>";?>
                           <?php  echo "<input type='hidden' id='apellido_paterno' name='apellido_paterno' value='".$apellido_paterno."'>";?>
                      </div>
                    <div class="form-group">
                      <label for="exampleSelect1">Nº de Preguntas</label>
                          <select class="form-control" id="seleccionNumeroPreguntas" name="seleccionNumeroPreguntas">
                              <option>Seleccione</option>
                            <?
                              for ($i=1; $i <=60 ; $i++) { 
                                  echo "<option>$i</option>";
                              }

                              ?>
                          </select>
                    </div>

                    <div class="form-group ">
                      <label for="exampleSelect1">Nº de Opciones</label>
                      <select class="form-control" id="seleccionOpciones" name="seleccionOpciones">
                          <option>Seleccione</option>
                          <option>2</option>
                          <option>3</option>
                          <option>4</option>
                          <option>5</option>
                      </select>
                    </div>
                    <div class="container">
                      <div class="row">
                        <div  class="col-sm-12">
                          
                        </div>
                      </div>
                    </div>
              </div>
               <input type="button" class="space_butto btn btn-primary" id="insertarFormulario" value="Crear" />
        </form>

    </div>
      <div class="col-sm-2">
        
      </div>
  </div>
</div>
<div class="container">
  <div class="row">
    <div class="col-sm-2"></div>
    <div id="resultadoFormulario" class="col-sm-8">
      
    </div>
    <div class="col-sm-2"></div>
  </div>
</div>
<script src="https://cdnjs.cloudflare.com/ajax/libs/tether/1.4.0/js/tether.min.js" integrity="sha384-DztdAPBWPRXSA/3eYEEUWrWCy7G5KFbe8fFjk5JAIxUYHKkDx6Qin1DkWx51bBrb" crossorigin="anonymous"></script>
    <script src="js/bootstrap.min.js"></script>
</body>
</html>
<?php } ?>