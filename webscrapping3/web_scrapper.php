<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title></title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" type="text/css" media="screen" href="main.css" />
    <script src="pagespeed.js"></script>
</head>
<body>
    
</body>
</html>

<?php

// set_time_limit() nos permite no tener limite de ejecuciones. No recomendable.
set_time_limit(0);

// No nos muestra los warnings del aplicativo. No recomendable.
error_reporting(0);

// Abrimos nuestro archivo.
$archivo = fopen("allpresta.csv", "r");
$resultados = fopen("analisis.csv", "w");

//Introducimos las cabeceras del archivo con los resultados que generaremos.
fwrite($resultados,'"URL WEB","PAIS","SECTOR"'. "\r\n");

// Lo recorremos.
$j=0;
while (($datos = fgetcsv($archivo, ",")) == true) {
  $j++;
  $num = count($datos);
  $linea++;
  if($j>1){

    //checkear web


    if($datos[27]=="ES"){
        fwrite($resultados,$datos[0].",".$datos[27].",".$datos[5]. "\r\n");


    }
    

  }
  $j++ ;
   

}
echo 'Archivo "analisis.csv" creado correctamente!';

// Cerramos el archivo
fclose($archivo);
fclose($resultados);
?>