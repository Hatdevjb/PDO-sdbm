<?php
    class Fabricant {
        // Données membres
        private $id_fabricant;
        private $nom_fabricant;

        public function __construct($id, string $nom) {
            $this->id_fabricant = (int) $id;
            $this->setNom_Fabricant($nom);
        }
        
        // Getters and setters
        public function getId_Fabricant() : int {
            return $this->id_fabricant;
        }

        public function getNom_Fabricant() : string {
            return $this->nom_fabricant;
        }

        public function setNom_Fabricant(string $nom) {
            $this->nom_fabricant = ucfirst($nom);
        }

        public function __toString() {
            return "ID : " . $this->id_fabricant . ", nom : " . $this->nom_fabricant;
        }
    }


?>