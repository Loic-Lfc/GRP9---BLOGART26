<?php
require_once $_SERVER['DOCUMENT_ROOT'] . '/config.php';
require_once '../../functions/ctrlSaisies.php';

// Vérifier que c'est une requête POST
if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    header('Location: ../../index.php');
    exit();
}

$libStat = ($_POST['libStat']);

sql_insert('STATUT', 'libStat', "'$libStat'");


header('Location: ../../views/backend/statuts/list.php');