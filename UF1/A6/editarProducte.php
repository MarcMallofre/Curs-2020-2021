<?php
session_start();

//Pagina per editar les dades dels usuaris amb rol user.

require "funcions.php";

$error="";
$errornom="";
$errordescripcio="";
$errorpreu="";
$errorarxiu="";
$errorcategoria="";
$err=false;
$idUsuari=$_SESSION["id"];
$idProducte=$_GET["id"];


if($_SERVER['REQUEST_METHOD'] == 'POST'){
    if(comprovarBorrar($idProducte, $idUsuari)){ //Comprovo si el producte que es vol editar, pertany a l'usuari.
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

        $carpetaImatges = 'imatges/';
        $micarpeta = 'imatges/'.$idUsuari;
        //Validacio del upload file. Si no es penja cap arxiu, s'indica amb l'error. Si es penja un arxiu que no es jpg o jpeg, també salra error
        for($i=0; $i<count($_FILES['imagenes']['tmp_name']); $i++){
            if(!empty($_FILES["imagenes"]['tmp_name'][$i])){
                $tipus = exif_imagetype($_FILES['imagenes']['tmp_name'][$i]);
                if (($tipus != IMAGETYPE_JPEG) and ($tipus != IMAGETYPE_PNG)){
                    $err=true;
                    $errorarxiu="Format d'imatge no valid";
                } 
            }
        }  

            //Si s'ha seleccionat alguna categoria, es comprovarà si el registre ja existeix, per a mostrar l'error
        if(isset($_REQUEST["categoria"])){
            foreach($_REQUEST["categoria"] as $clau=>$valor){
                $idCategoria=getIdCategoria($valor);
                comprovaCategoriaProducte($idProducte,$idCategoria);
                if(comprovaCategoriaProducte($idProducte,$idCategoria)){
                    $errorcategoria.="El producte ja pertany a una de les categories seleccionades";
                    $err=true;
                }
            }
        }
        
        
//Si no hi ha cap error, modifico el producte
        if(!$err){
            editaProducte($idProducte, $nom, $descripcio, $preu);
            
            if(isset($_REQUEST["categoria"])){
                foreach($_REQUEST["categoria"] as $clau=>$valor){
                    $idCategoria=getIdCategoria($valor);
                    afegirCategoria($idProducte,$idCategoria);
                }
            }

            //Si s'ha afegit alguna imatge, es puja a la base de dades
            for($i=0; $i<count($_FILES['imagenes']['name']); $i++){
                if(!empty($_FILES["imagenes"]['name'][$i])){
                    $nomImg=$_FILES['imagenes']['name'][$i];
                    $ruta= $micarpeta.'/'.basename($nomImg);
                    if (!move_uploaded_file($_FILES['imagenes']['tmp_name'][$i], $ruta)) {
                        $errorarxiu= "No s'ha trobat el fitxer.";
                    }else{
                        altaImg($nomImg, $ruta, $idProducte);  
                    }
                }
            }   
            $error="Producte modificat correctament.";
        }
    }else{
        die("Error de seguretat");
    }
    
}else{
    if(comprovarBorrar($idProducte, $idUsuari)){
        
        $producte=getProducte($idProducte);
        $nom=$producte["nom"];
        $descripcio=$producte["descripcio"];
        $preu=$producte["preu"];
    }else{
        die("Error de seguretat");
    }
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/style.css">
    <title>Editar producte</title>
</head>
<body>
    <div id="form">
        <h2><span class="error"><?=$error;?></span></h2>
        <h3>Editar producte</h3>
        <form enctype="multipart/form-data" method="post" name="myform">
            <label>Nom</label> <input type="text" name="nom" size="30" value="<?php echo $nom ?>"/><span class="error"><?=$errornom;?></span><br />
            <label>Descripcio</label><textarea name="descripcio" id="" cols="30" rows="10" ><?php echo $descripcio ?></textarea> <span class="error"><?=$errordescripcio;?></span><br />
            <label>Preu</label> <input type="text" name="preu"  size="30" value="<?php echo $preu ?>"/><span class="error"><?=$errorpreu;?></span><br />
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