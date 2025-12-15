<?php



    // appel de dao.php
    $dao_file = "dao.php";

    // vérif si dao existe
    if (file_exists($dao_file)) {

        require_once("dao.php");
        // Initialisation de la connexion
    $connexion = creeConnection();
        
    } else {
        echo "Le fichier dao n'exsite pas !";
    }

    try {

        $msg = "";

        $sql = "select * from fabricant";
        // liste des Fabricant (colone nom de la tabele fabricant)
        $reponse = $connexion->query($sql);
        foreach ($reponse as $row) {
            $msg .= ( $row["nom_fabricant"] ."<br>");
        }
        
    } catch (PDOException $e) {
        echo "Err lors de la requete ". $sql . $e->getMessage();
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
