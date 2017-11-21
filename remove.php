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
 <script type="text/javascript">
           $(document).ready(function(){
            $('.delete').on("click",function(){
               		 var id = $(this).parent().attr('id');
                	 var service = $(this).parent().attr('data');
                     $.post('deleteExamen.php', {id:service}, function(data){
                     	$('#hola').empty();
                         $('#hola').append('<div class="correcto">Se ha eliminado correctamente el servicio con id='+service+'.</div>').fadeIn("slow");
							$('#'+parent).fadeOut("slow");
							$('#'+parent).remove();
                    

                  });
            });
        });

 </script>

 </head>
 <body>
		
	<!-- <div class="container">
		<div class="row">
			<div class="col-md-2"></div>
			<div class="col-md-8"> -->
				<div class="service_list" id="s" data="103">    
				   ...(Datos del servicio o producto)                      
				   <a href="" class="delete" id="delete53">Eliminar</a>
				   <input type="text" value="104" id="id">
				</div>
					<div class="service_list" id="service54" data="54">    
				   ...(Datos del servicio o producto)                      
				  	 <a href="" class="delete" id="delete54">Eliminar</a>
					</div>
					<div class="service_list" id="service55" data="55">    
				   ...(Datos del servicio o producto)                      
				   <a href="" class="delete" id="delete55">Eliminar</a>
				</div>
				<div id="hola"></div>
	<!-- 		</div>
			<div class="col-md-2"></div>
		</div>
	</div> -->


    <script src="https://cdnjs.cloudflare.com/ajax/libs/tether/1.4.0/js/tether.min.js" integrity="sha384-DztdAPBWPRXSA/3eYEEUWrWCy7G5KFbe8fFjk5JAIxUYHKkDx6Qin1DkWx51bBrb" crossorigin="anonymous"></script>
    <script src="js/bootstrap.min.js"></script>

</body>
</html>