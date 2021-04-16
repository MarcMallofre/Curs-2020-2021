<?php
session_start();

require "funcions.php";


$erroremail="";
$errorpass="";
$error="";


//-- Cookie per login automatic --//
//Comprovo si existeix la politica de cookies i la cookie d'autologin i comprovo que les dades emmagatzemades siguin correctes. 
//En cas afirmatiu, accedeixo a la pàgina privada.
if(isset($_COOKIE["email"]) && isset($_COOKIE["pass"]) && isset($_COOKIE["politica"])){
    $email=$_COOKIE["email"];
    $passXifrada=$_COOKIE["pass"];
    $usuariExisteix=logInBD($email, $passXifrada);

    if($usuariExisteix){
        $_SESSION["email"]=$_COOKIE["email"];
        $_SESSION["password"]=$_COOKIE["pass"];
        header("location: privada.php");
    }
}else{
    //Comprovo que si s'accedeix a la pàgina pública i s'ha iniciat sessió previament sense haver tancat el navegador, accedeixi a la pàgina privada
    if (isset($_SESSION["email"])){
        header("location: privada.php");
    }

    if($_SERVER['REQUEST_METHOD'] == 'POST'){
    //-- Politica de cookies --//
        //Si s'ha acceptat les cookies, creo la cookie i torno a carregar la pàgina per a que em mostri el LogIn
        if(isset($_REQUEST["acceptar"])){
            setcookie('politica', '1', time() + (60 * 60 * 24 * 365));
            header("location: publica.php");
        }
        //Si no s'accepta la cookie es redirecciona a google.
        if(isset($_REQUEST["refusar"])){
            header("location: https://www.google.es");
        } 
        
        //Comprovació de dades correctes
        if(isset($_REQUEST["login"])){
            include "validacio.php";
        }

        if(isset($_REQUEST["alta"])){
            header("location: alta.php");
        }
    }
}

//Si no s'ha acceptat la cookie principal mostrarà el formulari per acceptar
if (!isset($_COOKIE['politica'])){ 
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
<link rel="stylesheet" href="css/style.css">
<title>Sessions</title>

</head>

<body>
<div id="cookies">
    <h2>Cookies</h2>
    <p>¿Aceptas nuestras cookies?</p>
    <form  method="post" name="myform">
        <button id="si" type="submit" name="acceptar">Acceptar</button>
        <button id="no" type="submit" name="refusar">Refusar</button>
    </form>
</div>



</body>
</html>

<?php
//Si s'ha acceptat la cookie principal, mostrarà el formulari.
}else{
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
<link rel="stylesheet" href="css/style.css">

<title>Sessions</title>
<script>
    function check(){
        if(!document.forms[0].email.value.length>0){
            alert("Has d'introduir un email.");
        }else{
            location.href="recuperarPass.php?email="+document.forms[0].email.value;
        }
    }

</script>
</head>

<body>

<div id="form">
    <span class="error"><?=$error;?></span><br><br>
    <h3>Log in</h3>
    <form  method="post" name="myform">
        <label>Email</label> <input type="text" name="email" value="<?php if($_SERVER['REQUEST_METHOD'] == 'POST') echo $_REQUEST["email"] ?>" size="30"/><br />
        <span class="error"><?=$erroremail;?></span>
        <label>Password</label> <input type="password" name="password" value="<?php if($_SERVER['REQUEST_METHOD'] == 'POST') echo $_REQUEST["password"] ?>" size="30"/><br>
        <span class="error"><?=$errorpass;?></span>
        <br><input type="checkbox" name="recordar" value="recordar">  Recordar Usuario y Contraseña<br><br>
        <button id="boton" type="submit" name="login">Entrar</button>
        <button id="boton" type="submit" name="alta">Registrar</button><br /><br />
        <a href="#" onclick="check();">Recuperar Password</a>
    </form>

</div>


</body>
</html>

<?php
}
?>