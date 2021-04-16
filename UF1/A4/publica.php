<?php
session_start();

/*
--Credencials--
email: hola@hola.com
password: hola
*/

//Variables que modificaré posteriorment en cas de que hi hagi algun error a l'hora d'introduir les dades.
$erroremail="";
$errorpass="";

//-- Cookie per login automatic --//
//Comprovo si existeix la politica de cookies i la cookie d'autologin i comprovo que les dades emmagatzemades siguin correctes. 
//En cas afirmatiu, accedeixo a la pàgina privada.
if(isset($_COOKIE["email"]) && isset($_COOKIE["pass"]) && isset($_COOKIE["politica"])){
    if ($_COOKIE["email"]=="hola@hola.com" && password_verify ("hola",$_COOKIE["pass"])){
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
    include "validacio.php";
    }
}

//Si no s'ha acceptat la cookie principal mostrarà el formulari per acceptar
if (!isset($_COOKIE['politica'])){ 
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">

<title>Sessions</title>

</head>

<body>

<h2>Cookies</h2>
<p>¿Aceptas nuestras cookies?</p>
<form  method="post" name="myform">
    <button  type="submit" name="acceptar">Acceptar</button><br /><br />
    <button  type="submit" name="refusar">Refusar</button><br /><br />
</form>

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

<title>Sessions</title>

</head>

<body>

<h3>Log in</h3>
<form  method="post" name="myform">
    <label>Email</label> <input type="text" name="email" value="<?php if($_SERVER['REQUEST_METHOD'] == 'POST') echo $_REQUEST["email"] ?>" size="30"/><span class="error"><?=$erroremail;?></span><br /><br />
    <label>Password</label> <input type="text" name="password" value="<?php if($_SERVER['REQUEST_METHOD'] == 'POST') echo $_REQUEST["password"] ?>" size="30"/><span class="error"><?=$errorpass;?></span><br /><br />
    <input type="checkbox" name="recordar" value="recordar">  Recordar Usuario y Contraseña<br><br>
    <button  type="submit">Entrar</button><br /><br />
</form>

</body>
</html>


<?php
}
?>