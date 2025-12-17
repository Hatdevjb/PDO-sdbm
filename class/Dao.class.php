<?php

    class DAO {

        private static $connexion;
        
        /**
         * 
         * Crée une connexion et la retourne 
         * 
         */
        private static function connect() {
            // appel de param.ini
            $param_file = "param/param.ini";

            // vérif si param existe
            if (!file_exists($param_file)) {
                die("Fichier Paramètre INTROUVABLE !");
            }
            // 
            $tparam = parse_ini_file($param_file, true);

            // variable du DSN
            extract($tparam);
            
            // dsn 
            $dsn = "mysql:dbname=" . $NOMDB . ";host=" . $NOMHOST . $PORT;

            try {

                // connection à la BDD
                $option = array(
                    PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION, 
                    PDO::MYSQL_ATTR_INIT_COMMAND => 'SET NAMES utf8'
                );

                self::$connexion = new PDO($dsn, $USERNAME, $PASSWORD, $option);

                return self::$connexion;
                
            } catch (PDOException $e) {
                // Si ERR :
                die('<h1>Erreur de connexion : </h1>' . $e->getMessage());
            }
        }

        // Détruit la connexion
        public static function disconnect() {
            self::$connexion = null;
        }

        // Pattern Singleton
        public static function getConnexion() {
            if (self::$connexion != null) {
                //echo "<br>Retourne la connexion existante<br>";
                return self::$connexion;
            } else {
                //echo "<br>Crée une connexion<br>";
                return self::connect();
            }
        }

        // AJOUT DES METHODES POUR LES REQUETES AVEC JOINTURES
    }
    
?>