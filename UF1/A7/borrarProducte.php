<?php
session_start();
require "funcions.php";
$idUsuari=$_SESSION["id"];

//Si s'ha seleccionat borrar un producte, entre aqui i borra el producte i les imatges associades a ell.
if(isset($_GET["borrarProducte"])){
    $idProducte=$_GET["borrarProducte"];
    if(comprovarBorrar($idProducte, $idUsuari)){
        
        
        borrarProducte($idProducte);
        borrarImagenes($idProducte);
    }
}

//Si s'ha seleccionat borrar una imatge en concret, entrarà a qui i la borrarà.
if(isset($_GET["borrarImatge"])){
    $idImatge=$_GET["borrarImatge"];
    if(comprovarImg($idImatge, $idUsuari)){
        $ruta=getRuta($idImatge);
        borrarImagen($idImatge, $ruta);
    }
    
}

//Si s'ha seleccionat borrar una categoria d'un prodcucte entrara aqui.
if (isset($_GET["categoria"])){
    $idCategoria=$_GET["categoria"];
    $idProducte=$_GET["producte"];
    borrarCategoriaProducte($idCategoria, $idProducte);
}

header("location:privada.php");
?>