<?php
session_start();

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
if (isset($_SESSION["email"])){
    echo "Benvingut ".$_SESSION["email"]."<br><br>";
    
}else{
    header("location:publica.php");
}
?>



<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">

<title>Sessions</title>

</head>

<body>

<form  method="post" name="myform">

    <button  type="submit">Log Out</button>

</form>

</body>
</html>