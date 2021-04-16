<?php

$email=test_input($_REQUEST["email"]);
$pass=test_input($_REQUEST["password"]);
$err=false;

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
$passXifrada = md5($pass);
$usuariExisteix=logInBD($email, $passXifrada);

if (!$err){
    if ($usuariExisteix){
        $id=getID($email, $passXifrada);
        $nom=getNom($email, $passXifrada);
        $admin=verificarAdmin($id);
        $_SESSION["nom"]=$nom;
        $_SESSION["email"]=$email;
        $_SESSION["password"]=$passXifrada;
        $_SESSION["id"]=$id;
        $_SESSION["admin"]=$admin;
        if(isset($_REQUEST["recordar"])){
            //Estableixo les cookies amb les dades de login
            $_SESSION["autologin"]=true;
            setcookie('email', $email, time() + (60 * 60 * 24 * 365));
            setcookie('pass', $passXifrada, time() + (60 * 60 * 24 * 365));
        }else{
            $_SESSION["autologin"]=false;
        }
        header("location: privada.php");
    }else{
        $error="Dades incorrectes.";
    }
}

?>