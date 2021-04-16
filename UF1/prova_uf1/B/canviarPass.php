<?php
session_start();
require "funcions.php";
$errorpass="";
$errorpass2="";
$error="";
if($_SERVER['REQUEST_METHOD'] == 'POST') {
    $pass=test_input($_REQUEST["password"]);
    $pass2=test_input($_REQUEST["password2"]);

    if($pass==$pass2){
        $username=$_SESSION["username"];
        editaPass($username, $pass);
        header("location:home.php");
    }else{
        $error="Les passwords no coincideixen";
    }
}


?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/style.css">
    <title>Canviar Password</title>
</head>
<body>
        <h2><span class="error"><?=$error;?></span></h2>
        <p>Introdueix la nova contrasenya</p>
        <form  method="post" name="myform">
            <label>Password</label> <input type="password" name="password"  size="30"/><span class="error"><?=$errorpass;?></span><br />
            <label>Password</label> <input type="password" name="password2"  size="30"/><span class="error"><?=$errorpass2;?></span><br />
            
            <button id="boton" type="submit" name="canviar">Canviar</button><br><br>
        </form>
</body>
</html>