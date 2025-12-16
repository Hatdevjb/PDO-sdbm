<?php
    // recupere une co avec le fichiez dao (donc qui gère les co)
    include_once("class/Dao.class.php");
    include_once("class/FabricantsMgrExeption.class.class.php");
    // fichiez pour les faire un CURAT sur la table fabricant



    class FabricantsMgr {
        
        /**
         * Utilise nom fournie pour sortire  la liste de la table 
         * 
         * @param [type] $nomTable
         * @return array
         * 
        */
        public static function getTableList($nomTable) {
            // établit la co
            $connexion = DAO::getConnexion();

            // requete pour la BDD (séléctione les fabricant avec l'id = ?)
            $sql = "SELECT * FROM $nomTable";

            // prep la co
            $curseur = $connexion->query($sql);

            $tList = $curseur->fetchAll(PDO::FETCH_ASSOC);

            $curseur->closeCursor();

            return $tList;
            
        } 

        /**
         * utilise id fournie pour sortire le fabricant avec cette id (1 result)
         * 
        */
        public static function getFabricantById(int $idFabricant) {
            // établit la co
            $connexion =  DAO::getConnexion();

            // requete pour la BDD (séléctione les fabricant avec l'id = ?)
            $sql = "SELECT * FROM fabricant WHERE id_fabricant= ?";

            // prep la co
            $curseur = $connexion->prepare($sql);

            // execute le requete avec l'id rentrer  dans la fonction 
            $curseur->execute( array($idFabricant));

            $fabricant = $curseur->fetch(PDO::FETCH_ASSOC);

            $curseur->closeCursor();

            // Test si aucun fabricant trouvé
            if ($fabricant == false) {
                throw new FabricantsMgrException("ERR:ID Fabricant inconnu");
            }

            return $fabricant;
            
        } 


        
    }