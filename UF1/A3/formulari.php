<?php

if($_SERVER['REQUEST_METHOD'] == 'POST') {

    //Llegeixo el text introduit
    echo "Text: ".$_REQUEST["mytext"]."<br>";

    //Llegeixo Radiobutton
    echo "Radiobutton: ".$_REQUEST["myradio"]."<br>";
    
    //LLegeixo Checkbutton
    echo "Checkbutton: ";
    if (isset($_REQUEST["mycheckbox"])){
        foreach($_REQUEST["mycheckbox"] as $clau=>$valor){
            echo $valor." ";
        }
    }
    echo "<br>";
    
    //Llegeixo Select
    echo "Select: ".$_REQUEST["myselect"]."<br>";
    
    //Llegeixo Textarea
    echo "Textarea: ".$_REQUEST["mytextarea"]."<br>";

    //Llegeixo els arxius enviats
    $carpetaImatges = 'fitxers/';

    for($i=0; $i<count($_FILES['file']['name']); $i++){

        $fichero_subido = $carpetaImatges.basename($_FILES['file']['name'][$i]);

        if (move_uploaded_file($_FILES['file']['tmp_name'][$i], $fichero_subido)) {
            echo "<a href=\"".$fichero_subido."\">File</a><br>";
        }else{
            echo "No s'ha trobat el fitxer.";
        }
    }
    

} else {

?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">

<title>Exemple de formulari</title>

</head>

<body>

<div style="margin: 30px 10%;">
<h3>My form</h3>
<form enctype="multipart/form-data" action="formulari.php" method="post" id="myform" name="myform">

    <label>Text</label> <input type="text" value="" size="30" maxlength="100" name="mytext" id="" /><br /><br />

    <input type="radio" name="myradio" value="1" /> First radio
    <input type="radio" checked="checked" name="myradio" value="2" /> Second radio<br /><br />

    <input type="checkbox" name="mycheckbox[]" value="1" /> First checkbox
    <input type="checkbox" checked="checked" name="mycheckbox[]" value="2" /> Second checkbox<br /><br />

    <label>Select ... </label>
    <select name="myselect" id="">
        <optgroup label="group 1">
            <option value="1" selected="selected">item one</option>
        </optgroup>
        <optgroup label="group 2" >
            <option value="2">item two</option>
        </optgroup>
    </select><br /><br />

    <textarea name="mytextarea" id="" rows="3" cols="30">
Text area
    </textarea> <br /><br />

    <label>File</label>
    <input name="file[]" type="file" multiple><br /><br />

    <button id="mysubmit" type="submit">Submit</button><br /><br />

</form>
</div>

</body>
</html>

<?php
}
?>