<?php
session_start();
require ("funcions.php");

$_SESSION["idComanda"]=generate_string(20);

require 'stripe-php/init.php';
\Stripe\Stripe::setApiKey('sk_test_51HpdtjCiSBb1ZyaVNxmLqxpD26eY0hwPnuROYmBlxuCeFD2cLyQtfKe92fcTjbEEN4X0CSzYqbiyiR9hguIJkSsX00UbvK2Yya');
header('Content-Type: application/json');
$YOUR_DOMAIN = 'http://dawjavi.insjoaquimmir.cat';
$checkout_session = \Stripe\Checkout\Session::create([
  'payment_method_types' => ['card'],
  'line_items' => [[
    'price_data' => [
      'currency' => 'eur',
      'unit_amount' => $_SESSION["preuTotal"]*100,
      'product_data' => [
        'name' => 'Mi Pagina Web',
        
      ],
    ],
    'quantity' => 1,
  ]],
  'mode' => 'payment',
  'success_url' => $YOUR_DOMAIN . '/mmallofre/Curs%202020%202021/UF1/A7/success.php?idComanda='.$_SESSION["idComanda"].'',
  'cancel_url' => $YOUR_DOMAIN . '/mmallofre/Curs%202020%202021/UF1/A7/cancel.php',
]);
echo json_encode(['id' => $checkout_session->id]);

?>