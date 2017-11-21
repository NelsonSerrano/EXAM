<?php

session_start();
session_destroy();

echo "<h1>Sesión Finalizada!</h1>";
// header("Refresh:4; url=login.php");
// header('refresh: 4; url=/login.php');
echo "<META HTTP-EQUIV='refresh' CONTENT='2; URL=index.php'>"; 

?>