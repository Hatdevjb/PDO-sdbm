<?php

// // CONSTANTES

//     // pour dsn     // $dsn =  "mysql:dbname=sdbm_v2;host=localhost:3306";
//         const NOMDB = "sdbm_v2";
//         const NOMSERV = "localhost";
//         const PORT = ":3306";
//     // pour Connexion
//         const USERNAME = "root";
//         const PASSWORD = "";

// methode

$param_file = "param/param.ini";

if (file_exists($param_file)) {
    $tparam = parse_ini_file  ("param/param.ini", true);
} else  {
    die("Fichiez Parametre INTOUVABLE !");
}

// variable du DSN
extract($tparam);

// variable du DSN
$dsn = "mysql:dbname=" . $NOMDB .";host=" . $NOMSERV . $PORT ;

// Ouverture d'une connexion sur la base fabricant SGBD MySQL
try {
  
    // connection à la BDD
    $option = array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION, 
                    PDO::MYSQL_ATTR_INIT_COMMAND => 'SET NAMES utf8');

    $connexion = new PDO($dsn,$USERNAME,$PASSWORD, $option);

    // message de connection OK
    echo ("Connection <b> réussie </b>" );

    // message pour affichage dans html 
    $msg = "";
    $sql = "select * from fabricant";
    // liste des Fabricant (colone nom de la tabele fabricant)
    $reponse = $connexion->query($sql);
    foreach ($reponse as $row) {
        $msg .= ( $row["nom_fabricant"] ."<br>");
    }


} catch (PDOException $e) {
    // Si ERR :
    echo "Echec connection : %\n" .  $e->getMessage();
}

try {
    $sql = "select * from fabricant where id_fabricant= :id";
    $reponse = $connexion->prepare($sql);

    $reponse->execute( array(":id" => 9));

    while ($row = $reponse->fetch(PDO::FETCH_ASSOC)) {
        $msg .= ( $row["id_fabricant"] ."<br>");
    }
    
} catch (PDOException $e) {
    echo "Err lors de la requete ". $sql . $e->getMessage();
}

?>

<!doctype html>
<html lang="fr">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>EX Fetch</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-sRIl4kxILFvY47J16cr9ZwB07vP4J8+LH7qKQnuqkuIAvNWLzeN8tE5YBujZqJLB" crossorigin="anonymous">
  </head>

  <body>
        <h1 class="container w-50 p-6 mt-5">Liste des fabricant : </h1>

        <div class="container w-50 border p-4 mt-5">
            <p> Voici vos infos :  <br> <?= $msg ?> </p>
           
        </div>
        
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js" integrity="sha384-FKyoEForCGlyvwx9Hj09JcYn3nv7wiPVlz7YYwJrWVcXK/BmnVDxM+D2scQbITxI" crossorigin="anonymous"></script>
  </body>
