<?php
session_start();

require "funcions.php";

$error="";
$errornom="";
$errordescripcio="";
$errorpreu="";
$errorcategoria="";
$errorarxiu="";
$err=false;
$idUsuari=$_SESSION["id"];

if($_SERVER['REQUEST_METHOD'] == 'POST'){
    $nom=test_input($_REQUEST["nom"]);
    $descripcio=test_input($_REQUEST["descripcio"]);
    $preu=test_input($_REQUEST["preu"]);


    //Validacio del camp nom
    if(empty($nom)){
        $errornom="El nom es oligatori.";
        $err=true;
    }else if(!preg_match("/^[a-zA-Z' ]*$/",$nom)) {
        $errornom= "Nomès s'accepten lletres.";
        $err=true;
    }

    //Validació del camp descripcio.
    if(empty($descripcio)){
        $errordescripcio="La descripció és obligatoria.";
        $err=true;
    }

    //Validació del camp preu.
    if(empty($preu)){
        $errorpreu="El preu és obligatori.";
        $err=true;
    }else if(!preg_match("/^[0-9' ]*$/",$preu)) {
        $errorpreu= "Nomès s'accepten números.";
        $err=true;
    }

    //Validacio camp categoria
    if (!isset($_REQUEST["categoria"])){
        $errorcategoria="Has de seleccionar una categoria";
        $err=true;
        
    }


    $carpetaImatges = 'imatges/';
    //Validacio del upload file. Si no es penja cap arxiu, s'indica amb l'error. Si es penja un arxiu que no es jpg o jpeg, també salra error
    for($i=0; $i<count($_FILES['imagenes']['tmp_name']); $i++){
        if(empty($_FILES["imagenes"]['tmp_name'][$i])){
            $errorarxiu="La foto és obligatoria.";
            $err=true;
        }else{
            $tipus = exif_imagetype($_FILES['imagenes']['tmp_name'][$i]);
            if (($tipus != IMAGETYPE_JPEG) and ($tipus != IMAGETYPE_PNG)){
                $err=true;
                $errorarxiu="Format d'imatge no valid";
            } 
        }
    }

    //Comprovo si la imatge que es puja ja existeix
    $micarpeta = 'imatges/'.$idUsuari;
    if (!file_exists($micarpeta)) {
        mkdir($micarpeta, 0777);
    }
    for($i=0; $i<count($_FILES['imagenes']['name']); $i++){
        $nomImg=$_FILES['imagenes']['name'][$i];
        $ruta= $micarpeta.'/'.basename($nomImg);
        if(file_exists($ruta)){
            $errorarxiu.="L'arxiu ".$nomImg ." ja existeix"."<br>";   
            $err=true;            
        }
    }

    //Si no hi ha cap error, pujo el producte i les imatges
    if(!$err){
        $idProducte=altaProducte($nom, $descripcio, $preu, $idUsuari);
        foreach($_REQUEST["categoria"] as $clau=>$valor){
            $idCategoria=getIdCategoria($valor);
            afegirCategoria($idProducte,$idCategoria);
        }
        for($i=0; $i<count($_FILES['imagenes']['name']); $i++){
            $nomImg=$_FILES['imagenes']['name'][$i];
            $ruta= $micarpeta.'/'.basename($nomImg);
            if (!move_uploaded_file($_FILES['imagenes']['tmp_name'][$i], $ruta)) {
                echo "No s'ha trobat el fitxer.";
            }else{
                altaImg($nomImg, $ruta, $idProducte);  
            }
        }
        $error="Producte pujat correctament.";
    }
}


?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/style.css">
    <title>Pujar producte</title>
</head>
<body>
    <div id="form">
        <h2><span class="error"><?=$error;?></span></h2>
        <h3>Pujar producte</h3>
        <form enctype="multipart/form-data" method="post" name="myform">
            <label>Nom</label> <input type="text" name="nom" size="30" value="<?php if($_SERVER['REQUEST_METHOD'] == 'POST') echo $_REQUEST["nom"] ?>"/><span class="error"><?=$errornom;?></span><br />
            <label>Descripcio</label><textarea name="descripcio" id="" cols="30" rows="10" ><?php if($_SERVER['REQUEST_METHOD'] == 'POST') echo $_REQUEST["descripcio"] ?></textarea> <span class="error"><?=$errordescripcio;?></span><br />
            <label>Preu</label> <input type="text" name="preu"  size="30" value="<?php if($_SERVER['REQUEST_METHOD'] == 'POST') echo $_REQUEST["preu"] ?>"/><span class="error"><?=$errorpreu;?></span><br />
            <label>Categoria</label>
            <input type="checkbox" name="categoria[]" value="Tecnologia" /> Tecnologia
            <input type="checkbox" name="categoria[]" value="Electrodomestics" /> Electrodomestics<br /><br /> 
            <input type="checkbox" name="categoria[]" value="Papereria" /> Papereria<br /><br /> 
            </select><span class="error"><?=$errorcategoria;?></span><br /><br />
            <label>Imatges</label>
            <input name="imagenes[]" type="file" multiple><span class="error"><?=$errorarxiu;?></span><br /><br />
            
            <button id="boton" type="submit" name="pujar">Pujar</button><br><br>
            <a href="publica.php">Tornar</a>
        </form>
        


    </div>
    
</body>
</html>