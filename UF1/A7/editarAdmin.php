<?php
require "funcions.php";

//Pagina per editar les dades dels usuaris amb rol admin.

$error="";
$errornom="";
$erroremail="";
$errorpass="";
$err=false;

$email=$_GET["email"];
$user=getUsuari($email);
$nom=$user["nom"];
$pass=$user["password"];
$id=$user["id"];

if($_SERVER['REQUEST_METHOD'] == 'POST'){
    $nom=test_input($_REQUEST["nom"]);
    $email=test_input($_REQUEST["email"]);
    $pass=test_input($_REQUEST["password"]);
    $passRepe=test_input($_REQUEST["passwordRepe"]);

    //Validacio del nom
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

    //Validacio de la repeticio de la password
    if(empty($passRepe)){
        $errorpass="La contrasenya és obligatoria.";
        $err=true;
    }else if(!preg_match("/^[a-zA-Z0-9-' ]*$/",$passRepe)) {
        $errorpass= "Nomès s'accepten lletres i números.";
        $err=true;
    }

    //Si les contrasenyes introduides conicideixen i no hi ha cap error en les validacions, comprovo si l'email existeix a la BD, i si no, edito l'usuari.
    if($pass==$passRepe){
        $passXifrada = md5($pass);

        if (!$err){
            $verificacio=verificacioBD($email);
            $emailRepe=verificarMail($id, $email);
            if ($verificacio && $emailRepe){
                $error="Aquest email ja està registrat.";
            }else{
                editaUsuari($id, $nom, $email, $passXifrada);
                $error="Edició completada.";
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
    <title>Editar dades</title>
</head>
<body>
    <div id="form">
        <h2><span class="error"><?=$error;?></span></h2>
        <h3>Introdueix les noves dades</h3>
        <form  method="post" name="myform">
            <label>Nom</label> <input type="text" name="nom" size="30" value="<?php echo $nom ?>"/><span class="error"><?=$errornom;?></span><br />
            <label>Email</label> <input type="text" name="email" size="30" value="<?php echo $email ?>"/><span class="error"><?=$erroremail;?></span><br />
            <label>Password</label> <input type="password" name="password"  size="30"/><span class="error"><?=$errorpass;?></span><br />
            <label>Password</label> <input type="password" name="passwordRepe"  size="30"/><span class="error"><?=$errorpass;?></span><br />

            <button id="boton" type="submit" name="registrar">Modificar</button><br><br>
            <a href="privada.php">Tornar</a>
        </form>

    </div>
    
        
</body>
</html>