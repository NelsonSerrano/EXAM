
<!DOCTYPE html>
<html lang="es-cl">
<head>
	<meta charset="UTF-8">
	<title>ExamP</title>
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <script src="./js/jquery-3.2.1.min.js"></script>
    <script src="./js/main.js"></script>
    <!-- <script src="./js/jquery.rut.chileno.min.js"></script> -->
	  <link rel="stylesheet" href="./css/normalize.css">
    <link rel="stylesheet" href="./css/bootstrap.min.css">
    <link rel="stylesheet" href="./css/style.css">
    <link rel="stylesheet" href="css/estilos.css">
    <script>
      $(document).ready(function(){
            // $('#rut').rut();
            $('#sendRole').click(function(){
                 var usuario = $('#rut').val();
                 var password = $('#password').val();         
                 $.post('role.php', {usuario:usuario,password:password}, function(data){
                    
                    if (data == "profesor") {
                       
                        window.location.href = "exito.php";

                    }else if(data == "administrador"){

                        window.location.href = "admin.php";

                    }else if (data == "estudiante") {

                        window.location.href = "student.php";

                    }else{

                      
                      $('#resultado').fadeIn('slow').html(data);

                      }
                  

              });

          });
      });      
    </script>
    <style>
      .error{
        background: red;
        text-align: center;
      }
      .registrar{
         text-align: center; 
      }
      .rut-error{
          width: 100%;  
          color: #fff;
          text-align: center;
          margin-top: .3em;
          font-weight: bold;
          background-color: red;
          padding: .5em;
          display: inline-block;
        }
    </style>
</head>
<body>
  <!-- inicio de navegacion  -->
<nav class="navbar navbar-toggleable-md navbar-light bg-faded">
    <button class="navbar-toggler navbar-toggler-right" type="button" data-toggle="collapse" data-target="#navbarText" aria-controls="navbarText" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
         <a class="navbar-brand" href="#"><img src="images/logo.jpg" class="logo" alt=""></a>
    <div class="collapse navbar-collapse" id="navbarText">
        <ul class="navbar-nav mr-auto">
          <li class="nav-item active">
          <a class="nav-link" href="index.php">Inicio<span class="sr-only">(current)</span></a>
          </li>
      
          <li class="nav-item">
          <a class="nav-link" href="acerca.php">Acerca de Lexam</a>
          </li>
        </ul>
      <span class="navbar-text">
         
      </span>
    </div>
</nav>
<!-- termino de navegacion -->

<div class="container form_exam">
<div class="row">
      <div class="col-md-3">
        
      </div>
        <div class="col-md-6">
          <form class="form-horizontal">
              <div class="form-group">
                      <label for="inputEmail3" class="col-sm-2 control-label">RUT</label>
                  <div class="col-sm-12">
                      <input type="text" class="form-control" id="rut" name="rut" placeholder="Ingrese Rut">
                  </div>
              </div>

              <div class="form-group">
                    <label for="inputPassword3" class="col-sm-2 control-label">contraseña</label>
                <div class="col-sm-12">
                   <input type="password" class="form-control" id="password" name="password" placeholder="Password">
                </div>
              </div>
           
            <div class="form-group">
                <div class="col-sm-offset-2 col-sm-10">
                  <button type="button" id="sendRole" class="btn btn-success">Ingresar</button>
                </div>
            </div>
          </form>
        </div>
      </div>
      <div class="col-md-3">
        
      </div>
     <div class="row">
        <div class="col-md-3">
        
        </div>
        <div id="resultado" class="col-md-6">
          <table class='table table-bordered'>
            <thead>
              <tr>
                <th>Registrarse Alumno</th>
                <th><a class='btn btn-info' href='registrarEstudiante.php'>Registrarse</a></th>
               </tr>
            </thead>
            </table>
        </div>
   
        <div class="col-md-3">
          
        </div>
    </div>
</div>


<!-- Fin Login de Ingreso Profesor -->

    <script src="https://cdnjs.cloudflare.com/ajax/libs/tether/1.4.0/js/tether.min.js" integrity="sha384-DztdAPBWPRXSA/3eYEEUWrWCy7G5KFbe8fFjk5JAIxUYHKkDx6Qin1DkWx51bBrb" crossorigin="anonymous"></script>
    <script src="js/bootstrap.min.js"></script>

</body>
</html>
