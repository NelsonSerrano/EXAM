<?php
require_once('control/conexion.php');
$nombreHabilidad = $_POST['nombreHabilidad'];
echo $nombreHabilidad;
$habilidades = mysqli_query($link, "INSERT INTO habilidades (id_habilidades, nombre_habilidad) VALUES (NULL, '$nombreHabilidad')");
?>



