<?php
// api/comments/update.php
require_once '../../config.php';
$db = sql_connect();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $numCom = $_POST['numCom'];
    $attModOK = isset($_POST['attModOK']) ? 1 : 0; // Validation (booléen)
    $notifComKOAff = $_POST['notifComKOAff'] ?? null; // Notification si refus
    $delLogiq = isset($_POST['delLogiq']) ? 1 : 0; // Suppression logique (booléen)

    // Date de modération : date du jour au moment de l'update
    $dtModCom = date("Y-m-d-H-i-s");

    // Date de suppression logique : initialisée si archivé
    $dtDelLogCom = ($delLogiq == 1) ? date("Y-m-d-H-i-s") : null;

    try {
        $sql = "UPDATE COMMENT 
                SET attModOK = :attModOK, 
                    notifComKOAff = :notifComKOAff, 
                    dtModCom = :dtModCom, 
                    delLogiq = :delLogiq, 
                    dtDelLogCom = :dtDelLogCom 
                WHERE numCom = :numCom";

        $stmt = $db->prepare($sql);
        $stmt->execute([
            'attModOK' => $attModOK,
            'notifComKOAff' => $notifComKOAff,
            'dtModCom' => $dtModCom,
            'delLogiq' => $delLogiq,
            'dtDelLogCom' => $dtDelLogCom,
            'numCom' => $numCom
        ]);

        header("Location: ../../views/backend/comments/list.php?msg=update_ok");
        exit();
    } catch (PDOException $e) {
        die("Erreur : " . $e->getMessage());
    }
}