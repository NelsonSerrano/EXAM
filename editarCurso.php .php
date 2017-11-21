<?php
$idCurso = $_POST['idCurso'];
$curso = $_POST['curso'];
require_once('control/conexion.php');
mysqli_query($link, "UPDATE curso SET curso= '$curso' WHERE id_curso = '$idCurso'");
echo "se actualizo correctamente";
echo "<META HTTP-EQUIV='refresh' CONTENT='4; URL=control/addNewCurso.php'>"; 
?>



