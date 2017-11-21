<?php
session_start();
$_SESSION['usuario'] = $_POST["usuario"];
$_SESSION['password']= $_POST["password"];

 // $usuario = "15.500.246-86";
 // $password = " ";

 $link = mysqli_connect("localhost", "root", "root", "examen");

            /* comprobar la conexión */
            if (mysqli_connect_errno()) {
                printf("Falló la conexión: %s\n", mysqli_connect_error());
                exit();
            }
if ($_SESSION['usuario']) {
	
$profesor = mysqli_query($link, "SELECT * FROM profesor WHERE rut = '".$_SESSION['usuario']."'" );
mysqli_num_rows($profesor);


$administrador = mysqli_query($link, "SELECT * FROM administrador WHERE id_administrador = '".$_SESSION['usuario']."'");
mysqli_num_rows($administrador);


$estudiante = mysqli_query($link, "SELECT * FROM estudiante WHERE rut ='".$_SESSION['usuario']."'");
mysqli_num_rows($estudiante);

// echo mysqli_num_rows($profesor)."<br>";
// echo mysqli_num_rows($administrador)."<br>";
// echo mysqli_num_rows($estudiante)."<br>";
                   
		if (mysqli_num_rows($profesor) > 0) {
			

				 while ($row = mysqli_fetch_array($profesor)) {
                            $BdIdProfesor = $row['rut'];
                            $BdPassword = $row['contrasena'];
				  
		}

		if ($_SESSION['password']) {
				if ($_SESSION['password'] == $BdPassword) {
					 echo "profesor";
				}else{
					echo "contraseña Incorrecta";
					
				}
		}else{

			echo "Rellene el campo de Contraseña";
		}

		}elseif (mysqli_num_rows($administrador) > 0) {
				
						
					while ($row = mysqli_fetch_array($administrador)) {
                            $BdIdAdmin = $row['id_administrador'];
                            $BdPassword = $row['contrasena'];
                        
                        } /// se cierra el ciclo while
		if ($_SESSION['password']) {
				if ( $_SESSION['password'] == $BdPassword) {

					 echo "administrador";

				}else{

					echo "contraseña Incorrecta";
					
				}
		}else{
			
			echo "Rellene el campo de Contraseña";
		}


				 
		}elseif (mysqli_num_rows($estudiante) > 0) {
						
				  	 while ($row = mysqli_fetch_array($estudiante)) {
                            $BdIdestudiante = $row['rut'];
                            $BdPassword = $row['contrasena'];
                        
                        } /// se cierra el ciclo while

		if ($_SESSION['password']) {
				if ($_SESSION['password'] == $BdPassword) {

					 echo "estudiante";

				}else{

				echo "
					<table class='table table-bordered'>
					  <thead>
					    <tr>
					      <th class='error'>Contraseña Incorrecta</th>
					    <tr>
					      <th class='registrar'><a class='btn btn-info' href='registrarEstudiante.php'>Registrarse</a></th>
					     </tr>
					  </thead>
					  </table>
			";
					
				}
		}else{
		echo "
					<table class='table table-bordered'>
					  <thead>
					    <tr>
					      <th class='error'>Rellene el campo de Contraseña</th>
					    <tr>
					      <th class='registrar'><a class='btn btn-info' href='registrarEstudiante.php'>Registrarse</a></th>
					     </tr>
					  </thead>
					  </table>
			";
		}

		}else{

			echo "
					<table class='table table-bordered'>
					  <thead>
					    <tr>
					      <th class='error'>Usuario No Registrado</th>
					    <tr>
					      <th class='registrar'><a class='btn btn-info' href='registrarEstudiante.php'>Registrarse</a></th>
					     </tr>
					  </thead>
					  </table>
			";
			mysqli_close($link); 
		}

}else{

		echo "
					<table class='table table-bordered'>
					  <thead>
					    <tr>
					      <th class='error'>Rellene todos los Campos</th>
					    <tr>
					      <th class='registrar'><a class='btn btn-info' href='registrarEstudiante.php'>Registrarse</a></th>
					     </tr>
					  </thead>
					  </table>
			";
}


?>