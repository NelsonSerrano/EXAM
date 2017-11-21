<?php
session_start();
if (!isset($_SESSION['usuario'])) {
    echo "acceso denegado";
    echo "<META HTTP-EQUIV='refresh' CONTENT='4; URL=index.php'>"; 
    exit;
}else{
$rut = $_SESSION['usuario'];
require_once('control/conexion.php');
if ($_GET) {
	$idProfesor = $_GET['idProfesor'];
	$nombreProfesor = $_GET['nombreProfesor'];
	$apellido_paterno = $_GET['apellido_paterno'];
}else{
	require_once('control/conexion.php');
	$sqlProfesor = mysqli_query($link, "SELECT rut, nombre, apellido_paterno, apellido_materno FROM profesor WHERE rut = '$rut' ");
	while ($rowProfesor = mysqli_fetch_array($sqlProfesor)) {
					    $nombreProfesor = $rowProfesor['nombre'];
					    $apellido_paterno = $rowProfesor['apellido_paterno'];
					    $idProfesor = $rowProfesor['rut'];
	}
}


?>
<!DOCTYPE html>
<html lang="es-cl">
	    <head>
			<meta charset="UTF-8">
			<title>Examp</title>
			<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
		    <script src="js/jquery-3.2.1.min.js"></script>
		    <script src="js/main.js"></script>
		    <script src="js/alert.js"></script>
		    <script src="lib/alertify.js"></script>
		    <script src="js/validation.js"></script>
			<link rel="stylesheet" href="css/normalize.css">
		    <link rel="stylesheet" href="css/bootstrap.min.css">
		    <link rel="stylesheet" href="css/style.css">
		    <link rel="stylesheet" href="css/alertify.core.css" />
			<link rel="stylesheet" href="css/alertify.default.css" />
			<link rel="stylesheet" href="css/estilos.css">
			<script>
			function confirmSubmit()
				{
				var agree=confirm("Está seguro de eliminar este registro? Este proceso es irreversible.");
				if (agree)
					return true ;
				else
					return false ;
				}
			  $(document).ready(function(){
			  		
							var press = 0;
			  				$('#nombreHabilidad').validation(' abcdefghijklmnñopqrstuvwxyzáéiou');
			            	$('#agregarHabilidad').click(function(){
			            	press++;
			            	if (press > 1) {
			            		location.reload();
			            	}else{
		      				nombreHabilidad = $("#nombreHabilidad").val();
		      				$.post('agregarHabilidad.php', {nombreHabilidad : nombreHabilidad}, function(data){
		      				ok();
		                    $('#resultado').fadeIn('slow').html(data);
		                	});
		      				}

		      		});
			        $("#cerrar").click(function(){
			        	location.reload();
			        });

			    });	
			</script>



				<style>
					.lateral{
			
					}
					.centro{
					
						padding: 1em;
					}
					.derecho{
						
					}
					.habi{
						margin-top: 2em;
					}
					
				  	.delete{
					  		width: 20px;
					  		height: 20px;
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
			              <a class="nav-link" href="#"><span class="sr-only">(current)</span></a>
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
			             <?php  echo "<strong>".$nombreProfesor."  ".$apellido_paterno."</strong>"." "."&nbsp&nbsp<a class='btn btn-danger' href='logout.php'>Cerrar Sesión</a> ";?>
			          </form>
			        </div>
			    </nav>
			<!--  fin de la navegacion  -->
			<div class="container habi">
				<div class="row">
					<div class="col-md-2 lateral">
						
					</div>
					<div class="col-md-8 centro">
						 
							<!-- comienzo del modal -->
							<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
							  <div class="modal-dialog" role="document">
							    <div class="modal-content">
							      <div class="modal-header">
							        <h5 class="modal-title" id="exampleModalLabel">AGREGAR NUEVA HABILIDAD</h5>
							        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
							          <span aria-hidden="true">&times;</span>
							        </button>
							      </div>
							      <div class="modal-body">
							        <form>
							          <div class="form-group">
							            <label for="recipient-name" class="form-control-label">Nombre Habilidad</label>
							            <input type="text" class="form-control" id="nombreHabilidad" name="nombreHabilidad" maxlength="70">
							          </div>
							         <!--  <div class="form-group">
							            <label for="message-text" class="form-control-label">Message:</label>
							            <textarea class="form-control" id="message-text"></textarea>
							          </div> -->
							        </form>
							      </div>
							      <div class="modal-footer">
							        <button type="button" class="btn btn-secondary" id="cerrar" data-dismiss="modal">Cerrar</button>
							        <button type="button" class="btn btn-primary" id="agregarHabilidad">Agregar</button>
							      </div>
							    </div>
							  </div>
							</div>
							<!-- fin del modal -->
							<table class="table table-bordered" id="tablaHab">
							  <thead>
							  	<tr>
							      <th><button type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModal" data-whatever="@getbootstrap">+</button></th>
							      <th colspan="2">HABILIDADES</th>
							    </tr>
							    <tr>
							      <th>ID</th>
							      <th>Nombre</th>
							      <th>Eliminar</th>
							    </tr>
							  </thead>
							  <tbody>
							  <?php
							  	$habilidades = mysqli_query($link, "SELECT id_habilidades, nombre_habilidad FROM habilidades");
					  		  	while ($rowHabilidades = mysqli_fetch_array($habilidades)) {
								                            $nombreHabilidad = utf8_encode($rowHabilidades['nombre_habilidad']);
								                            $idHabilidades = $rowHabilidades['id_habilidades'];
								                          
									   echo  "<tr>
									      		<th scope='row'>$idHabilidades</th>
									      		<td>$nombreHabilidad </td>
									    	";
									    		?>

									      	  <td width='30'> <a onclick="return confirmSubmit()" href="deleteHabilidad.php?idHabilidades=<?php echo $idHabilidades;?>&nombreProfesor=<?php echo $nombreProfesor;?>"><img class="delete" src="images/delete.png"></a></td>
									      	 
									    	</tr>
									  		<?
									  
							  		}	

							  ?>
							  
							    
							  </tbody>
							</table>
						</div>
					<div class="col-md-2 derecho" id="resultado"></div>
				</div>
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
<?php }?>