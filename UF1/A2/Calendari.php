<?php

/*LListes on guardaré els dies del mes dividits en setmanes. La primera array contindrà els noms del dies. 
Les següents, els numeros dels dies per cada una de les setmanes, que aniré omplint més endevant. */
$dies= array ('Dilluns', 'Dimarts', 'Dimecres', 'Dijous', 'Divendres', 'Dissabte', 'Diumenge');
$primerasetmana = array();
$segonasetmana = array();
$tercerasetmana = array();
$quartasetmana = array();
$cinquenasetmana = array();

//Comprovo quin dia de la setmana era el dia 1 i quants dies te el mes.
$primerdia=date("l", mktime(0, 0, 0, date("m"), 1, date("Y")));
$ultimodia=$day = date("d", mktime(0,0,0, date("m")+1, 0, date("Y")));

//Completo la primera array amb la primera setmana del mes depenent de quin dia comença el mes.
switch ($primerdia){
    case "Monday":
        $primerasetmana=array (1,2,3,4,5,6,7);
        break;
    case "Tuesday":
        $primerasetmana=array ("",1,2,3,4,5,6);
        break;
    case "Wednesday":
        $primerasetmana=array ("","",1,2,3,4,5);
        break;
    case "Thursday":
        $primerasetmana=array ("","","",1,2,3,4);
        break;
    case "Friday":
        $primerasetmana=array ("","","","",1,2,3);
        break;
    case "Sunday":
        $primerasetmana=array ("","","","","",1,2);
        break;
    case "Saturday":
        $primerasetmana=array ("","","","","","",1);
        break;
}

/*Completo la segona array amb la segona setmana. Agafo el valor de la ultima posicio de la array de la primera setmana (ultim dia de la setmana pasada)
per anar sumant els dies i completar la segona setmana.
*/
$dia=$primerasetmana[6];
for($i=0;$i<=6;$i++){
    $dia++;
    $segonasetmana[$i]=$dia;
}

//Completo la tercera array amb la tercera setmana
$dia=$segonasetmana[6];
for($i=0;$i<=6;$i++){
    $dia++;
    $tercerasetmana[$i]=$dia;
}

//Completo la quarta array amb la quarta setmana
$dia=$tercerasetmana[6];
for($i=0;$i<=6;$i++){
    $dia++;
    $quartasetmana[$i]=$dia;
}

//Completo la cinquena array amb la cinquena setmana. Quan el numero del dia coincideixi amb l'ultim dia del mes, deixarà d'omplir la llista.
$dia=$quartasetmana[6];
for($i=0;$i<=6;$i++){
    $dia++;
    $cinquenasetmana[$i]=$dia;
    if($dia==$ultimodia){
        break;
    }
}

//Estableixo la array calendari que conté totes les arrays que corresponen a les setmanes del mes.
$calendari = array ('Dies' => $dies, 'Primera Setmana' => $primerasetmana, 'Segona Setmana' => $segonasetmana, 'Tercera setmana' => $tercerasetmana, 'Quarta setmana' => $quartasetmana, 'Cinquena Setmana' => $cinquenasetmana);

//Imprimeixo per pantalla el mes i l'any actual.
echo date("M Y");

/*Printo el calendari. Estableixo una taula i per cada clau de la array calendari faig una fila.
Introdueixo els valors de cada clau en una celda. */
echo "<table border='1'>";
foreach ($calendari as $clau=>$valor){
    echo "<tr>";
    foreach ($valor as $element){
        echo "<td>";
        echo $element;
        echo "</td>";
    }    
    echo "</tr>";
}
echo "</table>";
?>