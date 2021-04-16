<?php

require "funcions.php";
$error="";
$errornom="";
$erroremail="";
$errorpass="";
$err=false;

if($_SERVER['REQUEST_METHOD'] == 'POST'){
    $nom=test_input($_REQUEST["nom"]);
    $email=test_input($_REQUEST["email"]);
    $pass=test_input($_REQUEST["password"]);
    $passRepe=test_input($_REQUEST["password2"]);

    //Validacio del camp nom
    if(empty($nom)){
        $errornom="El nom es oligatori.";
        $err=true;
    }else if(!preg_match("/^[a-zA-Z' ]*$/",$nom)) {
        $errornom= "Nomès s'accepten lletres.";
        $err=true;
    }

    //Validació del camp email.
    if(empty($email)){
        $erroremail="L'adreça de correu és obligatoria.";
        $err=true;
    }else if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $erroremail = "Format d'email no vàlid.";
        $err=true;
    }

    //Validació del camp password.
    if(empty($pass)){
        $errorpass="La contrasenya és obligatoria.";
        $err=true;
    }else if(!preg_match("/^[a-zA-Z0-9-' ]*$/",$pass)) {
        $errorpass= "Nomès s'accepten lletres i números.";
        $err=true;
    }

    //Validacio del camp password2
    if(empty($passRepe)){
        $errorpass="La contrasenya és obligatoria.";
        $err=true;
    }else if(!preg_match("/^[a-zA-Z0-9-' ]*$/",$passRepe)) {
        $errorpass= "Nomès s'accepten lletres i números.";
        $err=true;
    }
    $passXifrada = md5($pass);


    if($pass==$passRepe){
        $passXifrada = md5($pass);
        //Si no hi ha cap error en les validacions, comprovo si l'email existeix a la BD i si no, dono d'alta a l'usuari.
        if(!$err){
            $verificacio=verificacioBD($email);
            if ($verificacio){
                $error="Aquest email ja està registrat.";
            }else{
                altaUsuari($nom, $email, $passXifrada);
                $error="Registre complert. En 5 segons tornaràs a la pàgina de login.";
                header("refresh:5;url=publica.php");
            }
        }
    }else{
        $errorpass="Les contrasenyes no coincideixen.";
    }
    
}

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/style.css">
    <title>Document</title>
</head>
<body>
    <div id="form">
        <h2><span class="error"><?=$error;?></span></h2>
        <h3>Registre</h3>
        <form  method="post" name="myform">
            <label>Nom</label> <input type="text" name="nom" size="30" value="<?php if($_SERVER['REQUEST_METHOD'] == 'POST') echo $_REQUEST["nom"] ?>"/><span class="error"><?=$errornom;?></span><br />
            <label>Email</label> <input type="text" name="email" size="30"/ value="<?php if($_SERVER['REQUEST_METHOD'] == 'POST') echo $_REQUEST["email"] ?>"><span class="error"><?=$erroremail;?></span><br />
            <label>Password</label> <input type="password" name="password"  size="30"/><span class="error"><?=$errorpass;?></span><br />
            <label>Password</label> <input type="password" name="password2"  size="30"/><span class="error"><?=$errorpass;?></span><br />
            
            <button id="boton" type="submit" name="registrar">Registrar</button><br><br>
            <a href="publica.php">Tornar</a>
        </form>
        


    </div>
    
</body>
</html>