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
	  	$profesor = mysqli_query($link, "SELECT * FROM profesor WHERE rut ='".$_SESSION['usuario']."'");
	  	mysqli_num_rows($profesor);
	  	if (mysqli_num_rows($estudiante) > 0) {
	   	echo "acceso denegado";
	   	echo "<META HTTP-EQUIV='refresh' CONTENT='4; URL=student.php'>"; 
	   }elseif (mysqli_num_rows($profesor) > 0) {
	   		  	echo "acceso denegado";
	   			echo "<META HTTP-EQUIV='refresh' CONTENT='4; URL=exito.php'>"; 
	   }else{
	   	require_once('control/conexion.php');
	   	$sqlAdmin = mysqli_query($link, " SELECT id_administrador, CONCAT(nombre, ' ',apellido_paterno) AS nombresAdmin FROM administrador  WHERE id_administrador = '".$_SESSION['usuario']."'" );
		mysqli_num_rows($sqlAdmin);
		$rowAdmin = mysqli_fetch_array($sqlAdmin);
                            $idAdmin = $rowAdmin['id_administrador'];
                            $nombreAdmin = $rowAdmin['nombresAdmin'];
?>
<!DOCTYPE html>
<html lang="es-cl">
	<head>
		  <meta charset="UTF-8">
		  <title>EXAMP</title>
		  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
		  <script src="./js/jquery-3.2.1.min.js"></script>
		  <script src="./js/main.js"></script>
		  <script src="./js/jquery.rut.chileno.min.js"></script>
		  <script src="js/validation.js"></script>
		  <link rel="stylesheet" href="./css/normalize.css">
		  <link rel="stylesheet" href="./css/bootstrap.min.css">
		  <link rel="stylesheet" href="css/style.css">
		  <link rel="stylesheet" href="css/estilos.css">

	
	<script type="text/javascript">
			function confirmSubmit()
			{
			var agree=confirm("Está seguro de eliminar este registro? Este proceso es irreversible.");
			if (agree)
			  return true ;
			else
			   return false ;
			}
 	jQuery(document).ready(function($){
	 		
			   			$('#rut').rut();
						$('#nombreProfesor').validation(' abcdefghijklmnñopqrstuvwxyzáéiou');
				  		$('#ApellidoPaterno').validation(' abcdefghijklmnñopqrstuvwxyzáéiou');
				  		$('#ApellidoMaterno').validation(' abcdefghijklmnñopqrstuvwxyzáéiou');
				  		$('#asignatura').validation(' abcdefghijklmnñopqrstuvwxyzáéiou');
            $("#agregarProfesor").click(function(){
            	var texto = $('.rut-error').text();
               	var rut = $("#rut").val();
				if (texto == "Rut incorrecto") {
					alert("rut incorrecto");
					$("#rut").focus();
				}else{
					// alert("rut correcto");
					if ($("#rut").val()==0) {
						alert("Ingrese su rut");
						$("#rut").focus();
					}
					else if ($("#nombreProfesor").val()==0) {
						alert("Ingrese nombre Profesor");
						$("#nombreProfesor").focus();
					}
					else if ($("#ApellidoPaterno").val()==0) {
						
						alert("Ingrese apellido paterno");
						$("#ApellidoPaterno").focus();
					}
					else if ($("#ApellidoMaterno").val()==0) {
						alert("Ingrese apellido materno");
						$("#ApellidoMaterno").focus();
					}
					else if ($("#asignatura").val()==0) {
						alert("Ingrese Asignatura");
						$("#asignatura").focus();
					}
			
					else if ($("#contrasena").val()==0) {
						alert("Ingrese una contrasena");
						$("#contrasena").focus();
					}else{
						// $('#datosP').submit();
						var rut = $("#rut").val();
						var nombreProfesor = $("#nombreProfesor").val();
						var ApellidoPaterno = $("#ApellidoPaterno").val();
						var ApellidoMaterno = $("#ApellidoMaterno").val();
						var asignatura = $("#asignatura").val();
						var contrasena = $("#contrasena").val();
						
		            	$.post('agregarProfesor.php', {rut:rut,nombreProfesor:nombreProfesor,ApellidoPaterno:ApellidoPaterno,ApellidoMaterno:ApellidoMaterno,asignatura:asignatura,contrasena:contrasena}, function(data){
                    		// if (data == 'ok') {
                    			$('#mensaje').fadeIn('slow').html(data);
                    		// 	$("#mensaje").css("background-color", "green");
                    		// 	$("#mensaje").text("Se agrego correctamente");	
                    		// // }else{
                    		// 	$("#mensaje").css("background-color", "red");
                    		// 	$("#mensaje").text("no se inserto el registro");	
                    		// }
                      		

             			 });
					}
				}
			});
            $("#cerrar").click(function(){
            	location.reload();
            	});
			});
		</script>
		  <style>
		  	.datos{
		  		margin-top: 2em;
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
				.correcto{
					color: green;
					text-align: center;
					padding: .5em;
					font-weight: bold;
				}
				.incorrecto{
					color: red;
					text-align: center;
					padding: .5em;
					font-weight: bold;
				}
				.tabla{
					font-size: .9em;

				}
				.delete{
			  		width: 20px;
			  		height: 20px;
			  	}
			  	.add{
			  		width: 40px;
			  		height: 40px;
			  		text-align: center;
			  	}

				@media screen and (max-width: 800px) {
					.tabla{
					font-size: .7em;

				}
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
        <a class="navbar-brand" href="admin.php"><img src="images/logo.jpg" class="logo" alt=""></a>

      <div class="collapse navbar-collapse" id="navbarTogglerDemo02">
          <ul class="navbar-nav mr-auto mt-2 mt-md-0">
              <li class="nav-item active">
               
              </li>
             <!-- comienza el drop -->
             
       
          </ul>
          <form class="form-inline my-2 my-lg-0 informacionUsuario">
              <!-- <input class="form-control mr-sm-2" type="text" placeholder="Buscar">
              <button class="btn btn-outline-success my-2 my-sm-0" type="submit">Buscar</button> -->
             <?php  echo "<strong>".$nombreAdmin."</strong>"." "."&nbsp&nbsp<a class='btn btn-danger' href='logout.php'>Cerrar Sesión</a> ";?>
          </form>
        </div>
  </nav>
<!--   fin de la navegacion  -->
<div class="container">
	<div class="row">
		<div class="col-sm-2"></div>
		<div class="col-sm-8 datos">
			<!-- comienzo del modal -->
			<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
					<div class="modal-dialog" role="document">
							<div class="modal-content">
							  <div class="modal-header">
							    <h5 class="modal-title" id="exampleModalLabel">AGREGAR PROFESOR</h5>
							    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
							      <span aria-hidden="true">&times;</span>
							    </button>
							  </div>
							  <div class="modal-body">
							    <form id="datosP">
							      <div class="form-group">
							      	<label for="recipient-name" class="form-control-label">RUT</label>
							      	<input type="test" class="form-control" id="rut" name="rut" placeholder="Rut Estudiante">
							        <label for="recipient-name" class="form-control-label">Nombre</label>
							        <input type="text" class="form-control" id="nombreProfesor" name="nombreProfesor" maxlength="70">
							        <label for="recipient-name" class="form-control-label">Apellido Paterno</label>
							        <input type="text" class="form-control" id="ApellidoPaterno" name="ApellidoPaterno" maxlength="70">
							        <label for="recipient-name" class="form-control-label">Apellido Materno</label>
							        <input type="text" class="form-control" id="ApellidoMaterno" name="ApellidoMaterno" maxlength="70">
							        <label for="recipient-name" class="form-control-label">Asignatura</label>
							        <input type="text" class="form-control" id="asignatura" name="asignatura" maxlength="70">
							        <label for="recipient-name" class="form-control-label">Contraseña</label>
							        <input type="password" class="form-control" id="contrasena" name="contrasena" maxlength="70">
							      <!--   <label for="recipient-name" class="form-control-label"> Repetir Contraseña</label>
							        <input type="password" class="form-control" id="contrasenaR" name="contrasenaR" maxlength="70"> -->
							      </div>
							      <div class="form-group">
							        <label for="message-text" class="form-control-label" id="mensaje"></label>
							      </div>
							    </form>
							  </div>
							  <div class="modal-footer">
							    <button type="button" class="btn btn-secondary" id="cerrar" data-dismiss="modal">Cerrar</button>
							    <button type="button" class="btn btn-primary" id="agregarProfesor">Agregar</button>
							  </div>
							</div>
					</div>
			</div>
			<!-- fin del modal -->
			<div class="tabla">	
			<table class="table table-bordered">
			  <thead>
			  	<tr>
			  		<td colspan="4"><button type="button" class="btn btn-primary add" data-toggle="modal" data-target="#exampleModal" data-whatever="@getbootstrap">+</button></td>
			  	</tr>
			    <tr>
			      <th>ID</th>
			      <th>NOMBRES</th>
			      <th colspan="2">OPCIONES</th>
			    </tr>
			  </thead>
			  <tbody>
					  <?php
							  	$profesor = mysqli_query($link, "SELECT rut, CONCAT(nombre, ' ',apellido_paterno, ' ',apellido_materno) AS nombres FROM profesor");
					  		  	while ($rowProfesor = mysqli_fetch_array($profesor)) {
								                            $nombresProfesor = utf8_encode($rowProfesor['nombres']);
								                            $idProfesor = $rowProfesor['rut'];
								                          
									   echo  "<tr>
									      		<th scope='row'>$idProfesor</th>
									      		<td>$nombresProfesor</td>
									      		";
									      		?>
									      	  <td width='30'> <a onclick="return confirmSubmit()" href="deleteProfesor.php?id=<?php echo $idProfesor;?>&nombres=<?php echo $nombreAdmin;?>"><img class="delete" src="images/delete.png"></a></td>
									      	  <?php echo "<td width='30'><a href='updateProfesor.php?rut=$idProfesor&nombres=$nombreAdmin'><img src='images/editar.png' class='delete' alt=''></a></td>"; ?>
									    	</tr>
									  		<?
							  		      }	

							  ?>
			  </tbody>
			</table>
			</div>		
		</div>

		<div class="col-sm-2"></div>
	</div>
</div>

<script>
	$('#exampleModal').on('show.bs.modal', function (event) {
			var button = $(event.relatedTarget) // Button that triggered the modal
			var recipient = button.data('whatever') // Extract info from data-* attributes
			// If necessary, you could initiate an AJAX request here (and then do the updating in a callback).
			// Update the modal's content. We'll use jQuery here, but you could use a data binding library or other methods instead.
			var modal = $(this)
			// modal.find('.modal-title').text()
			// modal.find('.modal-body input').val(recipient)
	})

	</script>
	    <script src="https://cdnjs.cloudflare.com/ajax/libs/tether/1.4.0/js/tether.min.js" integrity="sha384-DztdAPBWPRXSA/3eYEEUWrWCy7G5KFbe8fFjk5JAIxUYHKkDx6Qin1DkWx51bBrb" crossorigin="anonymous"></script>
    <script src="js/bootstrap.min.js"></script>
</body>
</html>
<?
}
}
?>