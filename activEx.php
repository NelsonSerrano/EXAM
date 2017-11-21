
<?php
$idExamen = $_POST['idExamen'];
$estadoC = "inactivo";

require_once('control/conexion.php');
$resultadoExamen = mysqli_query($link, "SELECT * from examen WHERE id_examen = '".$idExamen."' AND estado = '$estadoC'");
$numeroLinea = mysqli_num_rows($resultadoExamen);
if ($numeroLinea > 0) {
		$activar = mysqli_query($link, "UPDATE examen SET  estado = 'activo' WHERE id_examen = '$idExamen'");
		echo "<script>
				ok();
		 	 </script>	
			 ";
 			// echo "esta es la ip del servidor: ".($_SERVER['SERVER_ADDR']." ".$IP);
 			echo "<div class='ipServer'>Díctele este IP a los alumnos:  <h1>".$localIP = getHostByName(php_uname('n'))."/lexam</h1></div>";
 			// echo gethostbyaddr($_SERVER['REMOTE_ADDR']);
			//  echo ($_SERVER['SERVER_NAME']);
			// echo ($_SERVER['DOCUMENT_ROOT']); // con esta linea sabemos donde se encuentra el directorio del sistema....
}else{
	echo "<script>
			alerta();
		  </script>	
	";
}

