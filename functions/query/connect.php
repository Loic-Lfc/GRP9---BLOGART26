<?php
function sql_connect(){
    global $DB;

    try {
        $DB = new PDO('mysql:host=' . SQL_HOST . ';charset=utf8;dbname=' . SQL_DB, SQL_USER, SQL_PWD);
        // On configure PDO pour qu'il lance des exceptions en cas d'erreur
        $DB->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        return $DB;
    } catch (PDOException $e) {
        die("Erreur de connexion à la base de données : " . $e->getMessage());
    }
}
?>