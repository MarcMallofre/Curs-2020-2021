<?php
//pagina per esborrar usuaris per part de l'admin.
require "funcions.php";
$id=$_GET["id"];
borrarUsuari($id);
header("location:privada.php");

?>