<?php

    // appel des fichiez impaortant (dao.php)
    spl_autoload_register(function($classe){
        include_once("class/" . $classe . ".class.php");
    });

    // Initialisation de la connexion
    
   
    // teste 1 Liste Fabricant (tables)
    try {

        $msg = "<ul>";

        $table = "fabricant";

        $retours = FabricantsMgr::getTableList($table);

        // liste des Fabricant (colone nom de la tabele fabricant)
// var_dump($retour);
// exit();
        
        if ($retours == false) {
             $msg .= " Le nom de table n'exsite pas dans la BDD !";
        } else {
            foreach($retours as $retour){
                $msg .=  " <li>$retour[nom_fabricant]<li> ";  //implode(",",$retour);
            }
            $msg .= "</ul>";
        }

    } catch (PDOException $e) {
        echo "Err lors de la requete " . $e->getMessage();
    }

    // teste 2 : fonction du fabricant ID
    try {

        $msg1= " ";

        $retour = FabricantsMgr::getFabricantById( 10
    );

        if ($retour == false) {
            $msg1 .= " L'id rechercher n'exsite pas dans la table !";
        } else {
            $msg1 .= "Le fabricant avec l'id n° " . implode(" est : ",$retour);
        }
        
    } catch (PDOException $e) {
        echo "Err lors de la requete " . $e->getMessage();
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
            <p> Voici le résultat du test 1 : <?= $msg ?> </p>

            <p> <br> Voici le résultat du test 2 :  <br> <?= $msg1 ?> </p>
           
        </div>
        
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js" integrity="sha384-FKyoEForCGlyvwx9Hj09JcYn3nv7wiPVlz7YYwJrWVcXK/BmnVDxM+D2scQbITxI" crossorigin="anonymous"></script>
  </body>
