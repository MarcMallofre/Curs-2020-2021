<?php

echo "Text: ".$_REQUEST["mytext"]."<br>";

echo "Radiobutton: ".$_REQUEST["myradio"]."<br>";

echo "Checkbutton: ";
if (isset($_REQUEST["mycheckbox"])){
    foreach($_REQUEST["mycheckbox"] as $clau=>$valor){
        echo $valor." ";
    }
}
echo "<br>";

echo "Select: ".$_REQUEST["myselect"]."<br>";

echo "Textarea: ".$_REQUEST["mytextarea"];

?>