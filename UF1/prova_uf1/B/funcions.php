<?php

function connexioBD(){
    $conn = new mysqli('localhost', 'mmallofre', 'mmallofre', 'mmallofre_db_prova');
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }
    return $conn;
}

function test_input($data) {
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    return $data;
}

function logInBD($username, $pass){
    $conn=connexioBD();
    $usuariExisteix=false;
    $sql="SELECT * FROM usuaris_examen WHERE username='$username' and password='$pass'";
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

function getNom($username, $pass){
    $conn=connexioBD();
    $sql="SELECT nom FROM usuaris_examen WHERE username='$username' and password='$pass'";
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

function verificacioBD($username, $email){
    $conn=connexioBD();
    $usuariExisteix=false;
    $sql="SELECT * FROM usuaris_examen WHERE username='$username' and email='$email'";
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

function editaPass($username, $password){
    $conn=connexioBD();
    $sql="UPDATE usuaris_examen SET password=md5('$password') WHERE username='$username'";
    if (!$resultado =$conn->query($sql)){
        die("Error al editar".$conn->error);
    }
    $conn->close();
}

?>