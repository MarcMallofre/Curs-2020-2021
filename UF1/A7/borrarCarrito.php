<?php
session_start();
require("funcions.php");


foreach($_SESSION["productesCarrito"] as $clau=>$valor){
    if($valor==$_GET["borrarCarrito"]){
        unset($_SESSION["productesCarrito"][$clau]);
    }
}


header("location:carrito.php");

?>