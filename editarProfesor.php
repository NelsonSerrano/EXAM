<?php
$rut = $_POST['rut'];
$nombre = $_POST['nombre'];
$apellidoPaterno = $_POST['apellidoPaterno'];
$apellidoMaterno = $_POST['apellidoMaterno'];
$asignatura = $_POST['asignatura'];

require_once('control/conexion.php');
mysqli_query($link, "UPDATE profesor SET nombre= '$nombre', apellido_paterno = '$apellidoPaterno', apellido_materno = '$apellidoMaterno', asignatura = '$asignatura' WHERE rut = '$rut'");
echo "se actualizo correctamente";
echo "<META HTTP-EQUIV='refresh' CONTENT='4; URL=admin.php'>"; 
?>



