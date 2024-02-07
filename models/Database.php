<!-- connexion à la base de donnée -->
<?php
    $servername = "localhost";
    $username = "root";
    $password = "";
    $database = "ichi_manga";
    GLOBAL $pdo;

    try {
        $pdo = new PDO("mysql:host=$servername;
            dbname=$database;
            charset=utf8", 
            $username, 
            $password);

        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
           
        if (session_status() == PHP_SESSION_NONE) {
            session_start();
        }
    } catch (PDOException $error) {
        
        die("Erreur de connexion à la base de données. Veuillez contacter l'administrateur du site.");
    }

?>