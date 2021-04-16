<?php
session_start();
require "funcions.php";

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;
use PHPMailer\PHPMailer\SMTP;

require 'PHPMailer/src/Exception.php';
require 'PHPMailer/src/PHPMailer.php';
require 'PHPMailer/src/SMTP.php';

$err=false;
$erroremail="";
$errorusername="";

$num1=rand(0, 10);
$num2=rand(0, 10);
$suma=$num1+$num2;



if($_SERVER['REQUEST_METHOD'] == 'POST'){
    
    if(empty($_REQUEST["suma"])){
        echo "Introdueix la suma dels digits.";
    }else{
        if($_REQUEST["resultat"]==$_REQUEST["suma"]){
            $username=test_input($_REQUEST["username"]);
            $email=test_input($_REQUEST["email"]);
            if(empty($email)){
                $erroremail="L'adreça de correu és obligatoria.";
                $err=true;
            }else if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
                $erroremail = "Format d'email no vàlid.";
                $err=true;
            }

            if(empty($username)){
                $errorusername="L'username és obligatori.";
                $err=true;
            }

        
            if(!$err){
                

                if(verificacioBD($username, $email)){
                    $pas="";
                    $novaPassword=generate_string(8);

                    $_SESSION["codi"]=$novaPassword;

                    editaPass($username, $novaPassword);
            
                    $mail = new PHPMailer(true);
            
                    try{
            
                        $mail->isSMTP();
                        //Set the hostname of the mail server
                        $mail->Host = 'smtp.gmail.com';
                        // use
                        // $mail->Host = gethostbyname('smtp.gmail.com');
                        // if your network does not support SMTP over IPv6
            
                        //Set the SMTP port number - 587 for authenticated TLS, a.k.a. RFC4409 SMTP submission
                        $mail->Port = 587;
            
                        //Set the encryption mechanism to use - STARTTLS or SMTPS
                        $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
            
                        //Whether to use SMTP authentication
                        $mail->SMTPAuth = true;
            
                        //Username to use for SMTP authentication - use full email address for gmail
                        $mail->Username = 'mmalloen@gmail.com';
            
                        //Password to use for SMTP authentication
                        $mail->Password = 'uranyleebglgnvgj';
            
                        //Set who the message is to be sent from
                        $mail->setFrom('mmalloen@gmail.com', 'Recuperació de contrasenya');
            
            
                        //Set who the message is to be sent to
                        $mail->addAddress($_REQUEST["email"]);
            
                        // Content
                        $mail->isHTML(true); 
            
                        //Set the subject line
                        $mail->Subject = 'Nova contrasenya';
            
                        $mail->Body    = "La nova contrasenya és $novaPassword ";
            
            
                        $mail->send();
                    
                    } catch (Exception $e) {
                    echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
                    }
                }
                echo "Si l'username i l'email son vàlids, rebras una nova contrasenya"."<br><br>";
            }
        }else{
            echo "La suma es incorrecte";
        }
    }

}

?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">

<title>Recuperar Password</title>
</head>

<body>
    <h3>Introdueix un email</h3>
    <form  method="post" name="myform">
        <label>Username</label> <input type="text" name="username" value="<?php if($_SERVER['REQUEST_METHOD'] == 'POST') echo $_REQUEST["username"] ?>" size="30"/>
        <span class="error"><?=$errorusername;?></span><br><br>
        <label>Email</label> <input type="text" name="email" value="<?php if($_SERVER['REQUEST_METHOD'] == 'POST') echo $_REQUEST["email"] ?>" size="30"/>
        <span class="error"><?=$erroremail;?></span><br><br>
        <?php echo $num1." + ".$num2?>
        <input type="hidden" name="suma" value="<?=$suma?>">
        <input type="text" name="resultat" id="suma">
        <button id="boton" type="submit" name="regenerar">Regenerar Password</button><br><br>

        <a href=index.php>Tornar</a>
    </form>

</body>
</html>