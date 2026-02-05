<?php
require_once $_SERVER['DOCUMENT_ROOT'] . '/config.php';
require_once '../../functions/ctrlSaisies.php';

// Vérifier que c'est une requête POST
if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    header('Location: ../../index.php');
    exit();
}

$numMemb = $_POST['numMemb'] ?? null;

if (!$numMemb) {
    header('Location: ../../views/backend/members/list.php?error=missing_id');
    exit();
}

$membre = sql_select("MEMBRE", "numStat", "numMemb = $numMemb")[0];

if ($membre['numStat'] == 1) {
    header('Location: ../../views/backend/members/list.php?error=admin_protected');
    exit();
}

$countCom = sql_select("COMMENT", "COUNT(*) as total", "numMemb = $numMemb")[0]['total'];

if ($countCom > 0) {
    header("Location: ../../views/backend/members/delete.php?numMemb=$numMemb&error=has_comments");
    exit();
}

sql_delete('MEMBRE', "numMemb = $numMemb");

header('Location: ../../views/backend/members/list.php?success=deleted');
exit();