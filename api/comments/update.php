<?php
require_once $_SERVER['DOCUMENT_ROOT'] . '/config.php';
require_once '../../functions/ctrlSaisies.php';

$numCom = ctrlSaisies($_GET['numCom']);
$dtModCom = date('Y-m-d H:i:s');

sql_update('COMMENT', [
    "attModOK" => 1,
    "dtModCom" => $dtModCom
], "numCom = $numCom");

header('Location: ../../views/backend/comments/list.php?success=validated');