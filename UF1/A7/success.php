<?php
session_start();
require ("funcions.php");
if($_SESSION["idComanda"]==$_REQUEST["idComanda"]){
    afegirComanda($_SESSION["preuTotal"], $_SESSION["id"], $_SESSION["productesCarrito"]);
    

    echo "<div id='cookies'>"."La compra s'ha realitzat correctament"."<br><br>"."<a href='publica.php'>Tornar</a>"."</div>";
    unset($_SESSION["productesCarrito"]);

}
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
<link rel="stylesheet" href="css/style.css">
<script src="https://polyfill.io/v3/polyfill.min.js?version=3.52.1&features=fetch"></script>
<script src="https://js.stripe.com/v3/"></script>
<title>Compra OK</title>

</head>

<body>

</body>

</html>