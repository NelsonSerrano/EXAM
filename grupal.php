<!DOCTYPE html>
<html lang="es-cl">
	<head>
	    <meta charset="UTF-8">
	    <title>EXAMP Alumnos</title>
	    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
	    <script src="./js/jquery-3.2.1.min.js"></script>
	    <script src="./js/main.js"></script>
	    <script src="js/alertAddAlumnos.js"></script>
		<script src="lib/alertify.js"></script>
	    <link rel="stylesheet" href="./css/estilo.css">
	    <link rel="stylesheet" href="./css/normalize.css">
	    <link rel="stylesheet" href="./css/bootstrap.min.css">
	    <link rel="stylesheet" href="./css/style.css">
	    <link rel="stylesheet" href="css/alertify.core.css" />
		<link rel="stylesheet" href="css/alertify.default.css" />
	    <!-- <script>
	    	$(document).ready(function(){
	    		var cont = 0;
			    $("#agregar").click(function () 
			    {
			    	var arreglo = [];
			    	cont++;
			    	arreglo.push($("#nombres").val());
			    	if (cont == 3) {
			   		alert(arreglo);
			   		$.ajax({
						 async: false,
						 type: "POST",
						 url: "ver.php",
						 data: {
						     arreglo: arreglo
						 },
						 success: function(data) {
						  alert(data);
						 }
						});
			   		}
				});

			});
	    </script> -->
		    <script type="text/javascript">
			   $(function() {
			   	 var arreglo = new Array();
			   	 var contador = 0;
			   		$('#alumno').change(function(){
			   			contador++;
			   			 if (contador < 3) {
			   			$('#alumno option:selected').each(function(){	
			   				
			   				ok();
							 arreglo.push($("#alumno").val());
							 largo = arreglo.length;
							 var nombre = $("#nombre").val();
							 $('#ver').html(largo);
			   			});	
			   			
			   			}else{
			   				
			   	
						alert (arreglo);
				        $.ajax({
				            type: 'POST',
				            url: 'ver.php',
				            data:{arreglo:arreglo},
				            success: function(data) {
				                // Imprimimos la respuesta en el div result
				                $('#ver').html(data);

				            }
				        })
				       }	
				    }); 
				});

		   </script>
</head>
<body>
<div class="container">
	<div class="row">
		<div class="col-md-1"></div>
		<div class="col-md-10">
			<form action="">
			    <div class="form-group">
						 <label for="exampleSelect2">Seleccione Alumno</label>
			               <select class='form-control selectCurso' id='alumno' name='alumno'>
						        <option>Seleccione Exámen</option>
						        <?php
						        require_once('control/conexion.php');
						        $resultadoEstudiantes = mysqli_query($link, "SELECT rut, CONCAT(nombre, ' ',apellido_paterno) AS alumno FROM estudiante WHERE curso_id_curso = 4");

						         while ($rowEstudiantes = mysqli_fetch_array($resultadoEstudiantes)) {
						                $rut = $rowEstudiantes['rut'];
						                $nombre = $rowEstudiantes['alumno'];
						                                       
						        ?>
						        <option value = "<?php echo $rut; ?>"><?php echo $nombre; ?></option> 
						        <?php
						                 }
						        ?>
					      </select>
			  </div>
				<input type="button" value="Enviar Exámen"  id="agregar" class="btn btn-outline-success my-2 my-sm-0">
</form>
<div id="ver">
	
</div>
		</div>
		<div class="col-md-1"></div>
	</div>
</div>

  <script src="https://cdnjs.cloudflare.com/ajax/libs/tether/1.4.0/js/tether.min.js" integrity="sha384-DztdAPBWPRXSA/3eYEEUWrWCy7G5KFbe8fFjk5JAIxUYHKkDx6Qin1DkWx51bBrb" crossorigin="anonymous"></script>
    <script src="js/bootstrap.min.js"></script>
</body>
</html>