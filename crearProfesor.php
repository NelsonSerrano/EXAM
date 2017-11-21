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
</div>
<!-- 	fin de la navegacion  -->
<!-- Comienzo formulario Profesor -->
<div class="container" id="CrearProfesor">
 
    <div class="row">
        <div class="col-sm-2">
          
        </div>
          <div class="col-sm-8">
            <!-- inicio de inputs -->
              <form >
                <div class="form-group">
                    <label for="Nombre">Nombre</label>
                    <input type="text" class="form-control" id="nombre" name="nombre">
                    <!-- <small class="form-text text-muted">Ingrese su Nombre</small> -->
                </div>

                <div class="form-group">
                    <label for="Apellido">Apellido Paterno</label>
                    <input type="text" class="form-control" id="apellidoPaterno" name="apellidoPaterno">
                    <!-- <small class="form-text text-muted">Ingrese su Apellido Paterno</small> -->
                </div>

                <div class="form-group">
                    <label for="Apellido">Apellido Materno</label>
                    <input type="text" class="form-control" id="apellidoMaterno" name="apellidoMaterno">
                    <!-- <small class="form-text text-muted">Ingrese su Apellido Materno</small> -->
                </div>

                <div class="form-group">
                    <label for="Apellido">Ingrese su Asignatura</label>
                    <input type="text" class="form-control" id="asignatura" name="asignatura">
                  <!--   <small class="form-text text-muted">Ingrese su Asignatura</small> -->
                </div>

                <div class="form-group">
                    <label for="Apellido">Ingrese su Contraseña</label>
                    <input type="password" class="form-control" id="password" name="password">
                  <!--   <small class="form-text text-muted">Ingrese su Asignatura</small> -->
                </div>


                <div class="form-group">
                    <label for="Apellido">Ingrese Nombre de Examen</label>
                    <input type="text" class="form-control" id="nombreExamen" name="nombreExamen">
                    <small class="form-text text-muted">Nombre de Examen</small> 
                </div>

                    <button type="button" id="send" class="btn btn-primary">Agregar</button>
                    <!-- fin de inputs -->
          </div>
        
        <div  class="col-sm-2">
            
        </div>
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