<?php

function test_input($data) {
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    return $data;
}

$email=test_input($_REQUEST["email"]);
$pass=test_input($_REQUEST["password"]);

//Validació del camp email.
if(empty($email)){
    $erroremail="L'adreça de correu és obligatoria.";
}else if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
    $erroremail = "Format d'email no vàlid.";
}else if($email!="hola@hola.com"){
    $erroremail="Email incorrecte.";
}

//Validació del camp password.
if(empty($pass)){
    $errorpass="La contrasenya és obligatoria.";
}else if(!preg_match("/^[a-zA-Z0-9-' ]*$/",$pass)) {
    $errorpass= "Nomès s'accepten lletres i números.";
}else if($pass!="hola"){
    $errorpass="Contrasenya incorrecte.";
}

//Comprovacio de dades correctes. Si son correctes, enviarà a la pàgina privada. Si s'ha seleccionat recordar credencials, creo cookies per recordar-les.
if ($email=="hola@hola.com" && $pass=="hola"){
    //Encripto la contrsenya.
    $passXifrada = password_hash($pass, PASSWORD_BCRYPT);
    $_SESSION["email"]=$email;
    $_SESSION["password"]=$passXifrada;
    if(isset($_REQUEST["recordar"])){
        //Estableixo les cookies amb les dades de login
        setcookie('email', $email, time() + (60 * 60 * 24 * 365));
        setcookie('pass', $passXifrada, time() + (60 * 60 * 24 * 365));
    }
    header("location: privada.php");
}
?>