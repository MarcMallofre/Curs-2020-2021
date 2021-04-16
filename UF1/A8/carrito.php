<?php
session_start();
require("funcions.php");


$llistaCarrito="";
$preuTotal=0;
if(!empty($_SESSION["productesCarrito"])){
    foreach($_SESSION["productesCarrito"] as $clau=>$valor){
        $producte=getProducte($valor);
        
        $imatges=mostrarImatgesPublica($valor);
        $llistaCarrito.="ID: ".$producte["id"]." Nom: ".$producte["nom"]." Descripcio: ".$producte["descripcio"]." Preu: ".$producte["preu"]."  "."<a href='borrarCarrito.php?borrarCarrito=$valor'>Eliminar</a>"."<br><br>".$imatges."<br><br>";
        $preuTotal+=$producte["preu"];
      }
    $llistaCarrito.="<h3>Total a pagar: ".$preuTotal." €"."</h3>"."<br>";
    $_SESSION["preuTotal"]=$preuTotal;
    echo "<div id=cookies>"."La teva cistella de la compra: <br><br>".$llistaCarrito."<button id='checkout-button'>Comprar</button><br><br></div>";
}else{
    echo "<div id=cookies>"."La cistella està buida"."<br><br>"."</div>";
}


?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
<link rel="stylesheet" href="css/style.css">
<script src="https://polyfill.io/v3/polyfill.min.js?version=3.52.1&features=fetch"></script>
<script src="https://js.stripe.com/v3/"></script>
<title>Privada</title>

</head>

<body>


<div id="cookies">
    

    <a href="publica.php">Tornar</a>
    </div>
  </body>
  <script type="text/javascript">
    // Create an instance of the Stripe object with your publishable API key
    var stripe = Stripe("pk_test_51HpdtjCiSBb1ZyaVqX2rlr6J1Uk5csBqr3487vyX5fHVI7Ql6FjxZR4E4dT9Y7dueB9R4hOaiN72yIjJsrs39c8v00b068zhWR");
    var checkoutButton = document.getElementById("checkout-button");
    checkoutButton.addEventListener("click", function () {
      fetch("create-session.php", {
        method: "POST",
      })
        .then(function (response) {
          return response.json();
        })
        .then(function (session) {
          return stripe.redirectToCheckout({ sessionId: session.id });
        })
        .then(function (result) {
          // If redirectToCheckout fails due to a browser or network
          // error, you should display the localized error message to your
          // customer using error.message.
          if (result.error) {
            alert(result.error.message);
          }
        })
        .catch(function (error) {
          console.error("Error:", error);
        });
    });
  </script>
</html>