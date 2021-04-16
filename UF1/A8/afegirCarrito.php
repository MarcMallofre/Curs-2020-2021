<?php
session_start();
require("funcions.php");

$error=false;
$idProducte=$_GET["idProducte"];

foreach($_SESSION["productesCarrito"] as $clau=>$valor){
    if($valor==$idProducte){
        $error=true;
    }
}

if(!$error){
    $_SESSION["productesCarrito"][]=$idProducte;
}

header("location:publica.php");
?>