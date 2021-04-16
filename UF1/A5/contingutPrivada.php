<?php
session_start();

require "funcions.php";

//Si cliquem el botó de Log out destruim la sessió i la cookie d'autologin i redirecciono a la pàgina publica.php.
//Per borrar les cookies faig que tinguin un valor null, si ho feia amb unset($_COOKIE) no em fincionava.

if($_SERVER['REQUEST_METHOD'] == 'POST') {
    setcookie('email', null, time() + (60 * 60 * 24 * 365));
    setcookie('pass', null, time() + (60 * 60 * 24 * 365));
    session_destroy();
    session_unset();
    $_SESSION=[];
    header("location:publica.php");
}

//Si s'ha iniciat sessió, mostrarà el contingut de la pàgina, si no redirecciona a la pàgina publica.php.


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
<?php
if (isset($_SESSION["email"])){
    echo "Benvingut ".$_SESSION["nom"]."<br><br>";
    
}else{
    header("location:publica.php");
}


//Si qui ha iniciat sessió és l'admin, se li mostrarà per pantalla la llista d'usuaris de la BD amb les ocipons de crear, editar i esborrar usuaris.
if($_SESSION["admin"]){

    if(isset($_REQUEST["crearNuevo"])){
        header("alta.php");
    }
    echo "LLista de tots els usuaris. Rol 1=admin 2=user"."<br>"."<br>";
    echo "ID Nom Email Rol<br><br>";
    echo $llistaUsuaris=mostrarBD();

    echo"<br><a href='alta.php'>Crear nou usuari</a>";

    //Si qui ha iniciat sessió no és admin, se li mostrarà unicament la opció d'editar les seves dades.
}else{
?>
<a href="editar.php"\>Editar datos</a><br>
<?php
}
//A tothom se li mostrarà el botó de logout.
?>

<form  method="post" name="myform">
    <br>
    <button id="boton" type="submit">Log Out</button>

</form>
</div>
</body>
</html>