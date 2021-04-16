<?php
require "funcions.php";
$error="";
$err=false;
$errorpass="";
$errorpassRepe="";
$codi=$_GET["codi"];

$data1= new DateTime(GetDataLink($codi));
$data2=new DateTime(date('Y-m-d H:i:s'));

$dteDiff=$data1->diff($data2);
$diferencia= $dteDiff->format("%H");

if($diferencia>02){
    echo "El link ha caducat";
}else{
    if($_SERVER['REQUEST_METHOD'] == 'POST'){

        $pass=test_input($_REQUEST["password"]);
        $passRepe=test_input($_REQUEST["passwordRepe"]);
        $codi=$_REQUEST["codi"];
        if(comprovarEmailRecuperarPass($codi)){
    
            //Validació del camp password.
            if(empty($pass)){
                $errorpass="La contrasenya és obligatoria.";
                $err=true;
            }else if(!preg_match("/^[a-zA-Z0-9-' ]*$/",$pass)) {
                $errorpass= "Nomès s'accepten lletres i números.";
                $err=true;
            }
    
            //Validacio de la repeticio de la password
            if(empty($passRepe)){
                $errorpassRepe="La contrasenya és obligatoria.";
                $err=true;
            }else if(!preg_match("/^[a-zA-Z0-9-' ]*$/",$passRepe)) {
                $errorpassRepe= "Nomès s'accepten lletres i números.";
                $err=true;
            }
    
            if(!$err){
                if($pass==$passRepe){
                    $email=EmailCodi($codi);
                    editaPass($email, $pass);
                    $error="Contrasenya canviada correctament";
    
                }else{
                    $error="Les contrasenyes no coincideixen";
                }
            }
    
    
        }else{
            echo "Algo no ha salido bien";
        }
    
    
        
    
    }
    
    
    
    
    if(comprovarEmailRecuperarPass($codi)){
    
    ?>
    
    
    <!DOCTYPE html>
    <html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="stylesheet" href="css/style.css">
        <title>Canviar contrasenya</title>
    </head>
    <body>
        <div id="form">
            <h2><span class="error"><?=$error;?></span></h2>
            <h3>Introdueix les noves dades</h3>
            <form  method="post" name="myform">
                <label>Introdueix la nova password</label> <input type="password" name="password"  size="30"/><span class="error"><?=$errorpass;?></span><br />
                <label>Torna a introduir-la</label> <input type="password" name="passwordRepe"  size="30"/><span class="error"><?=$errorpassRepe;?></span><br />
                <input type="hidden" name="codi" value="<?=$codi?>">
     
                
                <button id="boton"  type="submit" name="canvi">Canviar</button><br><br>
                <a href="privada.php">Tornar</a>
            </form>
    
    
        </div>
        
            
    </body>
    </html>
    
    
    <?php
    
    
    }else{
        echo"Algo no ha salido bien";
    }
    
    
}
?>


