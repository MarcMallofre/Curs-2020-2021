<?php
require("funcions.php");

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;
use PHPMailer\PHPMailer\SMTP;

require 'PHPMailer/src/Exception.php';
require 'PHPMailer/src/PHPMailer.php';
require 'PHPMailer/src/SMTP.php';

$pas="";
if(verificacioBD($_REQUEST["email"])){
    $codi=generate_string(10);
    afegirCodiRecuperar($codi, $_REQUEST["email"]);
    
    

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

        $mail->Body    = 'Per canviar la teva contrsenya entra <a href="https://dawjavi.insjoaquimmir.cat/mmallofre/Curs%202020%202021/UF1/A8/recuperarPass.php?codi='.$codi.'">aqui</a>';


        $mail->send();
    
    } catch (Exception $e) {
    echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
    }
    

}
echo "Si l'email és vàld, rebras un link per poder canviar la contrasenya"."<br><br>";

echo "<a href=publica.php>Tornar</a>";


?>