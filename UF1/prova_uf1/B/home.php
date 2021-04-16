<?php
session_start();
require "funcions.php";

if (isset($_SESSION["nom"])){
    echo "Benvingut ".$_SESSION["nom"]."<br><br>";

    if($_SERVER['REQUEST_METHOD'] == 'POST') {
        session_destroy();
        session_unset();
        $_SESSION=[];
        header("location:index.php");
    }
    
}else{
    header("location:index.php");
}

?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">

<title>Home</title>

</head>

<body>
<form  method="post" name="myform">
    <br>
    <button id="boton" type="submit">Log Out</button>

</form>
</body>
</html>