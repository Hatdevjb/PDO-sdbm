<?php
    function creeConnection() {
        // appel de param.ini
        $param_file = "param/param.ini";

        // vérif si param existe
        if (!file_exists($param_file)) {
            die("Fichier Paramètre INTROUVABLE !");
        }

        $tparam = parse_ini_file($param_file, true);

        // variable du DSN
        extract($tparam);
        $dsn = "mysql:dbname=" . $NOMDB . ";host=" . $NOMSERV . $PORT;

        try {
            // connection à la BDD
            $option = array(
                PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION, 
                PDO::MYSQL_ATTR_INIT_COMMAND => 'SET NAMES utf8'
            );

            $connexion = new PDO($dsn, $USERNAME, $PASSWORD, $option);

            // message de connection OK
            echo ("Connection <b> réussie </b>");

            return $connexion;
            
        } catch (PDOException $e) {
            // Si ERR :
            die("Echec connection : " . $e->getMessage());
        }
    }
