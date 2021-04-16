<?php

//Funcio per connectar amb la base de dades.
function connexioBD(){
    $conn = new mysqli('localhost', 'mmallofre', 'mmallofre', 'mmallofre_A5');
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }
    return $conn;
}

//funcio per validar dades introduides.
function test_input($data) {
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    return $data;
}

//Funcio per verificar les dades introduides amb la base de dades i fer login.
function logInBD($email, $passXifrada ){
    $conn=connexioBD();
    $usuariExisteix=false;
    $sql="SELECT * FROM usuaris WHERE email='$email' and password='$passXifrada'";
    if (!$resultado = $conn->query($sql)) {
        die("Error en la consulta".$conn->error);
    }
    if($resultado->num_rows>=0){
        while($usuari=$resultado->fetch_assoc()){
            $usuariExisteix=true;           
        }
    }
    $resultado->free();
    $conn->close();
    return $usuariExisteix;
}

//Funcio per retornar el ID.
function getID($email, $passXifrada){
    $conn=connexioBD();
    $sql="SELECT id FROM usuaris WHERE email='$email' and password='$passXifrada'";
    if (!$resultado = $conn->query($sql)) {
        die("Error en la consulta".$conn->error);
    }
    if($resultado->num_rows>=0){
        while($usuari=$resultado->fetch_assoc()){
            $id=$usuari["id"];           
        }
    }
    $resultado->free();
    $conn->close();
    return $id;
}

//Funcio per retornar el nom de l'usuari
function getNom($email, $passXifrada){
    $conn=connexioBD();
    $sql="SELECT nom FROM usuaris WHERE email='$email' and password='$passXifrada'";
    if (!$resultado = $conn->query($sql)) {
        die("Error en la consulta".$conn->error);
    }
    if($resultado->num_rows>=0){
        while($usuari=$resultado->fetch_assoc()){
            $nom=$usuari["nom"];           
        }
    }
    $resultado->free();
    $conn->close();
    return $nom;
}

//funcio per comrpovar si existeix un usuari a la base de dades a l'hora de registrar-se.
function verificacioBD($email){
    $conn=connexioBD();
    $usuariExisteix=false;
    $sql="SELECT * FROM usuaris WHERE email='$email'";
    if (!$resultado = $conn->query($sql)) {
        die("Error en la consulta".$conn->error);
    }
    if($resultado->num_rows>=0){
        while($usuari=$resultado->fetch_assoc()){
            $usuariExisteix=true;           
        }
    }
    $resultado->free();
    $conn->close();
    return $usuariExisteix;
}

//Funció per donar-se d'alta.
function altaUsuari($nom, $email, $passXifrada){
    $conn=connexioBD();
    $sql="INSERT INTO usuaris (nom, email, password) VALUES ('$nom', '$email', '$passXifrada')";
    if (!$resultado =$conn->query($sql)){
        die("Error al darte de alta".$conn->error);
    }
    $conn->close();
}

//Funcio per editar l'usuari.
function editaUsuari($id, $nom, $email, $passXifrada){
    $conn=connexioBD();
    $sql="UPDATE usuaris SET nom='$nom', email='$email', password='$passXifrada' WHERE id='$id'";
    if (!$resultado =$conn->query($sql)){
        die("Error al editar".$conn->error);
    }
    $conn->close();
}

//funcio per verificar que el mail no esta repetit.
function verificarMail($id, $email){
    $conn=connexioBD();
    $emailRepe=true;
    $sql="SELECT email FROM usuaris WHERE id='$id'";
    if (!$resultado =$conn->query($sql)){
        die("Error al comprobar datos".$conn->error);
    }
    if($resultado->num_rows>=0){
        while($usuari=$resultado->fetch_assoc()){
            if($usuari["email"]==$email){
                $emailRepe=false;
            }         
        }
    }
    return $emailRepe;
    $resultado->free();
    $conn->close();
}

//funcio per verificar si qui inicia sessio es admin
function verificarAdmin($id){
    $conn=connexioBD();
    $admin=false;
    $sql="SELECT rol FROM usuaris WHERE id='$id'";
    if (!$resultado =$conn->query($sql)){
        die("Error al comprobar datos".$conn->error);
    }
    if($resultado->num_rows>=0){
        while($usuari=$resultado->fetch_assoc()){
            if($usuari["rol"]==1){
                $admin=true;
            }         
        }
    }
    return $admin;
    $resultado->free();
    $conn->close();
}

//funcio per mostrar tota la base de dades.
function mostrarBD(){
    $conn=connexioBD();
    $llistaUsuaris="";
    $sql="SELECT * FROM usuaris";
    if (!$resultado =$conn->query($sql)){
        die("Error al comprobar datos".$conn->error);
    }
    if($resultado->num_rows>=0){
       while($usuari=$resultado->fetch_assoc()){
           $email=$usuari["email"];
           $id=$usuari["id"];
           $llistaUsuaris.=$usuari["id"]."  ".$usuari["nom"]."  ".$usuari["email"]."  ".$usuari["rol"]."  "."<a href='editarAdmin.php?email=$email'>Editar</a>"."  "."<a href='borrar.php?id=$id'>Borrar</a>"."<br>";
       }
    }
    return $llistaUsuaris;
    $resultado->free();
    $conn->close();
}

//funcio per agafar les dades d'un usuari concret
function getUsuari($email){
    $conn=connexioBD();
    $sql="SELECT * FROM usuaris WHERE email='$email'";
    if (!$resultado =$conn->query($sql)){
        die("Error al comprobar datos".$conn->error);
    }
    if($resultado->num_rows>=0){
        while($usuari=$resultado->fetch_assoc()){
            $user=$usuari;    
        }
    }
    return $user;
    $resultado->free();
    $conn->close();
}

//funcio per esborrar usuari
function borrarUsuari($id){
    $conn=connexioBD();
    $sql="DELETE FROM usuaris WHERE id='$id'";
    if (!$resultado =$conn->query($sql)){
        die("Error al comprobar datos".$conn->error);
    }
    $conn->close();
}

//Funcio per generar una nova contrasenya alfanumerica aleatoria
function generate_string($strength = 16) {
    $input = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
    $input_length = strlen($input);
    $random_string = '';
    for($i = 0; $i < $strength; $i++) {
        $random_character = $input[mt_rand(0, $input_length - 1)];
        $random_string .= $random_character;
    }
 
    return $random_string;
}

//Funcio per cambiar la contrasenya per la nova generada
function editaPass($email, $password){
    $conn=connexioBD();
    $sql="UPDATE usuaris SET password=md5('$password') WHERE email='$email'";
    if (!$resultado =$conn->query($sql)){
        die("Error al editar".$conn->error);
    }

    $conn->close();
}

?>
