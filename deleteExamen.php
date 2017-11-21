<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>EXAMEN ELIMINADO</title>
	<style>
		#delete-examen{
			margin: 0 auto;
			width: 50%;
			height: 70px;
			background: green;
			color: white;
			text-align: center;
			padding: 1em;
		}
		#delete-examen a{
			display: block;
			padding: 1em;
			text-decoration: none;
			color: white;
			font-weight: 800;
		}
	</style>
</head>
<body>
<?php

if ($_GET) {
	$idExamen = $_GET['id'];
	require_once('control/conexion.php');
	 mysqli_query($link, "DELETE FROM examen WHERE id_examen = '$idExamen'");
	echo '<div id="delete-examen">
			Se elimino correctamente el examen
			<a href="misExamenes.php">Volver</a>
		</div>';
}else{
	echo "no se puede realizar la acción";
	echo "<META HTTP-EQUIV='refresh' CONTENT='4; URL=index.php'>"; 
}

?>
	
</body>
</html>





