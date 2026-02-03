<?php
require_once $_SERVER['DOCUMENT_ROOT'] . '/config.php';
require_once '../../functions/ctrlSaisies.php';

$id = $_GET['id'];
$membre = sql_select("MEMBRE", "numStat", "numMemb = $id")[0];

if ($membre['numStat'] == 1) {
    header('Location: list.php?error=admin_protected');
    exit();
}

$numMemb = (int) ($_POST['numMemb'] ?? 0);

if ($numMemb > 0) {
    sql_delete('MEMBRE', "numMemb = $numMemb");
}

header('Location: ../../views/backend/members/list.php');
exit();