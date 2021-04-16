<?php

//Funcio per connectar amb la base de dades.
function connexioBD(){
    $conn = new mysqli('localhost', 'mmallofre', 'mmallofre', 'mmallofre_A8');
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
    $sql="SELECT rol_id FROM usuaris WHERE id=$id";
    if (!$resultado =$conn->query($sql)){
        die("Error al comprobar datos".$conn->error);
    }
    if($resultado->num_rows>=0){
        while($usuari=$resultado->fetch_assoc()){
            if($usuari["rol_id"]==1){
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
           $llistaUsuaris.=$usuari["id"]."  ".$usuari["nom"]."  ".$usuari["email"]."  ".$usuari["rol_id"]."  "."<a href='editarAdmin.php?email=$email'>Editar</a>"."  "."<a href='borrar.php?id=$id'>Borrar</a>"."<br>";
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

//funcio per pujar un producte
function altaProducte($nom, $descripcio, $preu, $idUsuari, $imatges, $micarpeta){
    $conn=connexioBD();
    $sql="INSERT INTO productes (nom, descripcio, preu, usuari_id) VALUES ('$nom', '$descripcio', '$preu', $idUsuari)";
    if (!$resultado =$conn->query($sql)){
        die("Error al darte de alta".$conn->error);
    }else{
        $idProducte=$conn->insert_id; 
    }
    foreach($imatges as $clau=>$valor){
        $idCategoria=getIdCategoria($valor);
        afegirCategoria($idProducte,$idCategoria);
    }
    for($i=0; $i<count($_FILES['imagenes']['name']); $i++){
        $nomImg=$_FILES['imagenes']['name'][$i];
        $ruta= $micarpeta.'/'.basename($nomImg);
        if (!move_uploaded_file($_FILES['imagenes']['tmp_name'][$i], $ruta)) {
            echo "No s'ha trobat el fitxer.";
        }else{
            altaImg($nomImg, $ruta, $idProducte);  
        }
    }
    echo "Producte penjat correctament";
    $conn->close();
}

//Funcio per pujar imatges
function altaImg($nomImg, $ruta, $idProducte){
    $conn=connexioBD();
    $sql="INSERT INTO imatges (nom, ruta, producte_id) VALUES ('$nomImg', '$ruta', '$idProducte')";
    if (!$resultado =$conn->query($sql)){
        die("Error al darte de alta".$conn->error);
    }
    $conn->close();
}

//Funcio per mostrar els productes de l'usuari que ha iniciat sessió
function mostrarProducte($id){
    $conn=connexioBD();
    $llistaProductes="";
    $sql1="SELECT * FROM productes WHERE usuari_id='$id'";
    if (!$resultado =$conn->query($sql1)){
        die("Error al comprobar datos".$conn->error);
    }
    if($resultado->num_rows>=0){
       while($producte=$resultado->fetch_assoc()){
            $idProducte=$producte["id"];
            $imatges=mostrarImatgesUsuaris($idProducte);
            $categoria=getCategoriaUsuari($idProducte);
            if($producte["comanda_id"]==null){
                $llistaProductes.="A LA VENTA ID: ".$producte["id"]." Nom: ".$producte["nom"]." Descripcio: ".$producte["descripcio"]." Preu: ".$producte["preu"]." Categories: ".$categoria."<a href='editarProducte.php?id=$idProducte'>Editar</a>"."  "."<a href='borrarProducte.php?borrarProducte=$idProducte'>Borrar</a>"."<br>".$imatges."<br>";
            }
            if($producte["comanda_id"]!=null){
               $llistaProductes.="VENUT ID: ".$producte["id"]." Nom: ".$producte["nom"]." Descripcio: ".$producte["descripcio"]." Preu: ".$producte["preu"]." Categories: ".$categoria."<a href='editarProducte.php?id=$idProducte'>Editar</a>"."  "."<a href='borrarProducte.php?borrarProducte=$idProducte'>Borrar</a>"."<br>".$imatges."<br>";
           }
          
        }
    }
   
    return $llistaProductes;
    $resultado->free();
    $conn->close();
}

//Funcio per mostrar les categories d'un producte al llistat privat de cada usuari mab la opció d'eliminar la categoria del producte
function getCategoriaUsuari($idProducte){
    $conn=connexioBD();
    $categoria="";
    $sql1="SELECT * FROM categories INNER JOIN categoria_producte ON categories.idCategoria=categoria_producte.categoria_id WHERE categoria_producte.producte_id='$idProducte'";
    if (!$resultado =$conn->query($sql1)){
        die("Error al comprobar datos".$conn->error);
    }
    if($resultado->num_rows>=0){
       while($categories=$resultado->fetch_assoc()){
           $idCategoria=$categories["idCategoria"];
           $categoria.=$categories["nomCategoria"]." "."<a href='borrarProducte.php?categoria=$idCategoria&producte=$idProducte'>B</a>"." ";
        }
    }
   
    return $categoria;
    $resultado->free();
    $conn->close();

}

//Funcio per mostrar les categories dels productes al llista general de la pagina
function getCategoria($idProducte){
    $conn=connexioBD();
    $categoria="";
    $sql1="SELECT nomCategoria FROM categories INNER JOIN categoria_producte ON categories.idCategoria=categoria_producte.categoria_id WHERE categoria_producte.producte_id='$idProducte'";
    if (!$resultado =$conn->query($sql1)){
        die("Error al comprobar datos".$conn->error);
    }
    if($resultado->num_rows>=0){
       while($categories=$resultado->fetch_assoc()){
           $categoria.=$categories["nomCategoria"]." ";
        }
    }
   
    return $categoria;
    $resultado->free();
    $conn->close();

}


//Funcio per mostrar les imatges dels productes de l'usuari que ha iniciat sessio
function mostrarImatgesUsuaris($idProducte){
    $conn=connexioBD();
    $llistaImatges="";
    $sql1="SELECT * FROM imatges WHERE producte_id='$idProducte'";
    if (!$resultado =$conn->query($sql1)){
        die("Error al comprobar datos".$conn->error);
    }
    if($resultado->num_rows>=0){
       while($imatges=$resultado->fetch_assoc()){
           $idImatge=$imatges["id"];
           $llistaImatges.="<img width=\"150px\" height=\"150px\" src=\"".$imatges["ruta"]."\">"."<a href='borrarProducte.php?borrarImatge=$idImatge'>Borrar Imatge</a>";
        }
    }
    return $llistaImatges;
    $resultado->free();
    $conn->close();
}


//Funcio per mostrar les imatges a la pagina publica
function mostrarImatgesPublica($idProducte){
    $conn=connexioBD();
    $llistaImatges="";
    $sql1="SELECT * FROM imatges WHERE producte_id='$idProducte'";
    if (!$resultado =$conn->query($sql1)){
        die("Error al comprobar datos".$conn->error);
    }
    if($resultado->num_rows>=0){
       while($imatges=$resultado->fetch_assoc()){
           $llistaImatges.="<img width=\"150px\" height=\"150px\" src=\"".$imatges["ruta"]."\">";
        }
    }
    return $llistaImatges;
    $resultado->free();
    $conn->close();
}

//funcio per comprovar si el producte pertany a l'usuari que el vol borrar
function comprovarBorrar($idProducte, $idUsuari){
    $conn=connexioBD();
    $existe=false;
    $sql1="SELECT * FROM productes WHERE id='$idProducte' and usuari_id='$idUsuari'";
    if (!$resultado =$conn->query($sql1)){
        die("Error al comprobar datos".$conn->error);
    }
    if($resultado->num_rows==1){
        $existe=true;
    }
    return $existe;
    $resultado->free();
    $conn->close();    
}

//funcio per comprovar si les imatges pertanyen a un producte de l'usuari que les intenta borrar
function comprovarImg($idImatge, $idUsuari){
    $conn=connexioBD();
    $existe=false;
    $sql1="SELECT * FROM imatges INNER JOIN productes ON imatges.producte_id=productes.id WHERE imatges.id='$idImatge' and productes.usuari_id='$idUsuari'";
    if (!$resultado =$conn->query($sql1)){
        die("Error al comprobar datos".$conn->error);
    }
    if($resultado->num_rows==1){
        $existe=true;
    }
    return $existe;
    $resultado->free();
    $conn->close();    
}

//Funcio per borrar productes
function borrarProducte($idProducte){
    $conn=connexioBD();
    $sql="DELETE FROM productes WHERE id='$idProducte'";
    if (!$resultado =$conn->query($sql)){
        die("Error al comprobar datos".$conn->error);
    }
    $conn->close();
}

//Funcio per editar un producte
function editaProducte($idProducte, $nom, $descripcio, $preu){
    $conn=connexioBD();
    $sql="UPDATE productes SET nom='$nom', descripcio='$descripcio', preu='$preu' WHERE id='$idProducte'";
    if (!$resultado =$conn->query($sql)){
        die("Error al editar".$conn->error);
    }
    $conn->close();
}

//funcio per obtenir les dades d'un sol producte
function getProducte($idProducte){
    $conn=connexioBD();
    $sql="SELECT * FROM productes WHERE id='$idProducte'";
    if (!$resultado =$conn->query($sql)){
        die("Error al comprobar datos".$conn->error);
    }
    if($resultado->num_rows>=0){
        while($producte=$resultado->fetch_assoc()){
            $product=$producte;    
        }
    }
    return $product;
    $resultado->free();
    $conn->close();
}

//funcio per mostrar tots els productes
function mostrarTotsProductes(){
    $conn=connexioBD();
    $products="";
    $sql="SELECT * FROM productes";
    if (!$resultado =$conn->query($sql)){
        die("Error al comprobar datos".$conn->error);
    }
    if($resultado->num_rows>=0){
        while($productes=$resultado->fetch_assoc()){
            $idProducte=$productes["id"];
            $imatges=mostrarImatgesPublica($idProducte);
            $categoria=getCategoria($idProducte);
            if($productes["comanda_id"]==null){
                $products.="ID: ".$productes["id"]." Nom: ".$productes["nom"]." Descripcio: ".$productes["descripcio"]." Preu: ".$productes["preu"]." Categories: ".$categoria."<br>".$imatges."<br>"."<br>";
                if(isset($_SESSION["email"]) && $_SESSION["id"]!=$productes["usuari_id"]){
                    $products.="<a href='afegirCarrito.php?idProducte=$idProducte'>Afegir a la cistella</a>"."<br>"."<br>";
                }   
            }
        }
    }
    return $products;
    $resultado->free();
    $conn->close();
}

//funcio per borrar imatges al servidor quan esborrem un producte
function borrarImagenes($id){
    $conn=connexioBD();
    $sql="DELETE FROM imatges WHERE producte_id='$id'";
    if (!$resultado =$conn->query($sql)){
        die("Error al comprobar datos".$conn->error);
    }
    $conn->close();
}

//Funcio per borrar una imatge en concret
function borrarImagen($idImagen, $ruta){
    $conn=connexioBD();
    $sql="DELETE FROM imatges WHERE id='$idImagen'";
    if (!$resultado =$conn->query($sql)){
        die("Error al comprobar datos".$conn->error);
    }
    unlink($ruta);
    $conn->close();
}

//funcio per obtenir la ruta de la imatga
function getRuta($idImatge){
    $conn=connexioBD();
    $productes="";
    $sql="SELECT ruta FROM imatges WHERE id='$idImatge'";
    if (!$resultado =$conn->query($sql)){
        die("Error al comprobar datos".$conn->error);
    }
    if($resultado->num_rows>=0){
        while($ruta=$resultado->fetch_assoc()){
            return $ruta["ruta"]; 
        }
    }   
    $resultado->free();
    $conn->close();
}

//Funcio per buscar productes al buscador
function buscador($productesBuscar){
    $conn=connexioBD();
    $productes="";
    $sql="SELECT * FROM productes WHERE nom LIKE '%$productesBuscar%'";
    if (!$resultado =$conn->query($sql)){
        die("Error al comprobar datos".$conn->error);
    }
    if($resultado->num_rows>=0){
        while($producte=$resultado->fetch_assoc()){
            $idProducte=$producte["id"];
            $imatges=mostrarImatgesPublica($idProducte);
            if($producte["comanda_id"]==null){
                $productes.="ID: ".$producte["id"]." Nom ".$producte["nom"]." Descripcio ".$producte["descripcio"]." Preu ".$producte["preu"]."<br>".$imatges."<br><br>";
                if(isset($_SESSION["email"]) && $_SESSION["id"]!=$producte["usuari_id"]){
                    $productes.="<a href='afegirCarrito.php?idProducte=$idProducte'>Afegir a la cistella</a>"."<br>"."<br>";
                }
            }
        }
    }
    return $productes;
    $resultado->free();
    $conn->close();
}

//Funcio per mostrar productes concrets d'una categoria
function buscadorProducteCategoria($productesBuscar, $categoria){
    $conn=connexioBD();
    $productes="";
    $sql="SELECT * FROM ((productes INNER JOIN categoria_producte ON categoria_producte.producte_id=productes.id) INNER JOIN categories ON categories.idCategoria=categoria_producte.categoria_id) WHERE productes.nom LIKE '%$productesBuscar%' AND categories.nomCategoria='$categoria'";
    if (!$resultado =$conn->query($sql)){
        die("Error al comprobar datos".$conn->error);
    }
    if($resultado->num_rows>=0){
        while($producte=$resultado->fetch_assoc()){
            $idProducte=$producte["id"];
            $imatges=mostrarImatgesPublica($idProducte);
            if($producte["comanda_id"]==null){
                $productes.="ID: ".$producte["id"]." Nom: ".$producte["nom"]." Descripcio: ".$producte["descripcio"]." Preu: ".$producte["preu"]."<br>".$imatges."<br><br>";
                if(isset($_SESSION["email"]) && $_SESSION["id"]!=$producte["usuari_id"]){
                    $productes.="<a href='afegirCarrito.php?idProducte=$idProducte'>Afegir a la cistella</a>"."<br>"."<br>";
                }
            }
        }
    }
    return $productes;
    $resultado->free();
    $conn->close();

}

//Funcio per gestionar el cercador
function buscadorCategoria($categoria){
    $conn=connexioBD();
    $productes="";
    $sql="SELECT * FROM ((productes INNER JOIN categoria_producte ON categoria_producte.producte_id=productes.id) INNER JOIN categories ON categories.idCategoria=categoria_producte.categoria_id) WHERE categories.nomCategoria='$categoria'";
    if (!$resultado =$conn->query($sql)){
        die("Error al comprobar datos".$conn->error);
    }
    if($resultado->num_rows>=0){
        while($producte=$resultado->fetch_assoc()){
            $idProducte=$producte["id"];
            $imatges=mostrarImatgesPublica($idProducte);
            if($producte["comanda_id"]==null){
            $productes.="ID: ".$producte["id"]." Nom: ".$producte["nom"]." Descripcio: ".$producte["descripcio"]." Preu: ".$producte["preu"]."<br>".$imatges."<br><br>";    
                if(isset($_SESSION["email"]) && $_SESSION["id"]!=$producte["usuari_id"]){
                    $productes.="<a href='afegirCarrito.php?idProducte=$idProducte'>Afegir a la cistella</a>"."<br>"."<br>";
                }
            }
        }
    }
    return $productes;
    $resultado->free();
    $conn->close();
}

//Funcio per afegir categories als productes a l'hora d'editar-los
function afegirCategoria($idProducte,$idCategoria){
    $conn=connexioBD();
    $sql="INSERT INTO categoria_producte (categoria_id, producte_id) VALUES ('$idCategoria','$idProducte')";
    if (!$resultado =$conn->query($sql)){
        die("Error al darte de alta".$conn->error);
    }
    $conn->close();
}

//Funcio per obtenir la id de la categoria en concret
function getIdCategoria($valor){
    $conn=connexioBD();
    $sql="SELECT idCategoria FROM categories WHERE nomCategoria='$valor'";
    if (!$resultado =$conn->query($sql)){
        die("Error al comprobar datos".$conn->error);
    }
    if($resultado->num_rows>=0){
        while($id=$resultado->fetch_assoc()){
            $idCategoria=$id["idCategoria"];
        }
    }
    return $idCategoria;
    $resultado->free();
    $conn->close();
}

//Funcio per esborrar la categoria d'un producte
function borrarCategoriaProducte($idCategoria, $idProducte){
    $conn=connexioBD();
    $sql="DELETE FROM categoria_producte WHERE categoria_id='$idCategoria' and producte_id=$idProducte";
    if (!$resultado =$conn->query($sql)){
        die("Error al comprobar datos".$conn->error);
    }
    $conn->close();
}

//Funcio per comprovar si ja existeix un registre de categoria per a un producte
function comprovaCategoriaProducte($idProducte,$idCategoria){
    $conn=connexioBD();
    $existe=false;
    $sql="SELECT * FROM categoria_producte WHERE categoria_id='$idCategoria' and producte_id='$idProducte'";
    if (!$resultado =$conn->query($sql)){
        die("Error al comprobar datos".$conn->error);
    }
    if($resultado->num_rows==1){
        $existe=true;
    }
    return $existe;
    $resultado->free();
    $conn->close();
}

//Funcio per afegir una comanda
function afegirComanda($importTotal, $usuariId, $idProductes){
    $conn=connexioBD();
    $data=date('l jS \of F Y h:i:s A');
    $sql="INSERT INTO comanda (data, importTotal, usuari_id) VALUES ('$data','$importTotal', '$usuariId')";
    if (!$resultado =$conn->query($sql)){
        die("Error al darte de alta".$conn->error);
    }
    $idComanda=$conn->insert_id;
    producteComanda($idProductes, $idComanda);
    $conn->close();
}

function producteComanda($idProductes, $idComanda){
    $conn=connexioBD();
    foreach($idProductes as $clau=>$valor){
        $sql="UPDATE productes SET comanda_id='$idComanda' WHERE id='$valor'";
        if (!$resultado =$conn->query($sql)){
            die("Error al editar".$conn->error);
        }
    }
    $conn->close();
}

function afegirCodiRecuperar($codi, $email){
    $conn=connexioBD();
    $data=date('Y-m-d H:i:s');
    $sql="INSERT INTO recuperarPass (codi, email, data) VALUES ('$codi','$email','$data')";
    if (!$resultado =$conn->query($sql)){
        die("Error al darte de alta".$conn->error);
    }
    $conn->close();
}

function comprovarEmailRecuperarPass($codi){
    $conn=connexioBD();
    $existe=false;
    $sql="SELECT recuperarPass.email FROM recuperarPass INNER JOIN usuaris ON usuaris.email=recuperarPass.email WHERE recuperarPass.codi='$codi'";
    if (!$resultado =$conn->query($sql)){
        die("Error al comprobar datos".$conn->error);
    }
    if($resultado->num_rows==1){
        $existe=true;
    }
    return $existe;
    $resultado->free();
    $conn->close();
}

function EmailCodi($codi){
    $conn=connexioBD();
    $sql="SELECT email FROM recuperarPass WHERE codi='$codi'";
    if (!$resultado =$conn->query($sql)){
        die("Error al comprobar datos".$conn->error);
    }
    if($resultado->num_rows>=0){
        while($usuari=$resultado->fetch_assoc()){
            $email=$usuari["email"];
        }
    }
    $resultado->free();
    $conn->close();
    return $email;
}

function GetDataLink($codi){
    $conn=connexioBD();
    $sql="SELECT data FROM recuperarPass WHERE codi='$codi'";
    if (!$resultado =$conn->query($sql)){
        die("Error al comprobar datos".$conn->error);
    }
    if($resultado->num_rows>=0){
        while($recuperar=$resultado->fetch_assoc()){
            $data=$recuperar["data"];
        }
    }
    $resultado->free();
    $conn->close();
    return $data;
}


?>