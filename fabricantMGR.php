<?php
    // recupere une co avec le fichiez dao (donc qui gère les co)
    require_once("dao.php");
    // fichiez pour les faire un CURAT sur la table fabricant

    /**
     * utilise id fournie pour sortire le fabricant avec cette id (1 result)
     * 
    */
    function getFabricantById($id) {
        // établit la co
        $connexion = creeConnection();

        // requete pour la BDD (séléctione les fabricant avec l'id = ?)
        $sql = "SELECT * FROM fabricant WHERE id_fabricant= ?";

        // prep la co
        $curseur = $connexion->prepare($sql);

        // execute le requete avec l'id rentrer  dans la fonction 
        $curseur->execute( array($id));

        $fabricant = $curseur->fetch(PDO::FETCH_ASSOC);

        $curseur->closeCursor();

        return $fabricant;
        
    } 
