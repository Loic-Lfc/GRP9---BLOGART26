<?php
// api/comments/create.php
session_start();
require_once '../../config.php'; 

// On s'assure que la connexion est initialisée et on l'assigne à $db
$db = sql_connect(); 

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Sécurité supplémentaire : si $db est toujours null, on tente de récupérer la globale
    if (!$db) {
        global $db;
    }

    // Si après cela c'est toujours null, on arrête tout avec un message clair
    if (!$db) {
        die("Erreur : La connexion à la base de données ($db) est introuvable. Vérifiez sql_connect().");
    }

    $numArt = $_POST['numArt'] ?? null;
    $libCom = $_POST['libCom'] ?? null;
    $numMemb = $_SESSION['numMemb'] ?? 1;

    // Date de création obligatoire : format imposé par le cahier des charges
    $dtCreaCom = date("Y-m-d-H-i-s");

    try {
        // Tous les attributs sont obligatoires pour l'INSERT
        $sql = "INSERT INTO COMMENT (dtCreaCom, libCom, attModOK, notifComKOAff, dtModCom, dtDelLogCom, delLogiq, numArt, numMemb) 
                VALUES (:dtCreaCom, :libCom, 0, NULL, NULL, NULL, 0, :numArt, :numMemb)";

        $stmt = $db->prepare($sql);
        $stmt->execute([
            'dtCreaCom' => $dtCreaCom,
            'libCom' => $libCom,
            'numArt' => $numArt,
            'numMemb' => $numMemb
        ]);

        // Redirection vers l'article avec message de validation
        header("Location: /views/frontend/articles/article1.php?id=$numArt&comment=pending#commentaires");
        exit();

    } catch (PDOException $e) {
        die("Erreur SQL : " . $e->getMessage());
    }
}