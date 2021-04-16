<?php 
session_start();
require "funcions.php";

$errorusername="";
$errorpass="";
$error="";
$err=false;



if($_SERVER['REQUEST_METHOD'] == 'POST'){        

    if(isset($_REQUEST["login"])){
        $username=test_input($_REQUEST["username"]);
        $pass=test_input($_REQUEST["password"]);

        //Validacio del cam username
        if(empty($username)){
            $errorusername="L'username és obligatori.";
            $err=true;
        }
        
        //Validació del camp password.
        if(empty($pass)){
            $errorpass="La contrasenya és obligatoria.";
            $err=true;
        }

        if(!$err){
            
            $passXifrada = md5($pass);
            $usuariExisteix=logInBD($username, $passXifrada);
            if ($usuariExisteix){
                if($pass==$_SESSION["codi"]){
                    $_SESSION["username"]=$username;
                    header ("location:canviarPass.php");
                }else{
                    $_SESSION["nom"]=getNom($username, $passXifrada);
                    $_SESSION["username"]=$username;
                    header("location:home.php");
                }
                
            }else{
                $error="Dades incorrectes.";
            }
        }
    }
}
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">

<title>Examen</title>

</head>

<body>
    <span class="error"><?=$error;?></span><br><br>
    <h3>Log in</h3>
    <form  method="post" name="myform">
        <label>Username</label> <input type="text" name="username" value="<?php if($_SERVER['REQUEST_METHOD'] == 'POST') echo $_REQUEST["username"] ?>" size="30"/><br />
        <span class="error"><?=$errorusername;?></span><br>
        <label>Password</label> <input type="password" name="password" value="<?php if($_SERVER['REQUEST_METHOD'] == 'POST') echo $_REQUEST["password"] ?>" size="30"/><br>
        <span class="error"><?=$errorpass;?></span><br>
        <button id="boton" type="submit" name="login">Entrar</button><br><br>
        <a href="recuperarPass.php">Recuperar Password</a>
    </form>

</body>
</html>