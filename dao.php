<?php
    // fichier pour les connection 

    // appel de param.ini
    $param_file = "param/param.ini";

    // vérif si param exsite
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

    } catch (PDOException $e) {
        // Si ERR :
        echo "Echec connection : %\n" .  $e->getMessage();
    }


