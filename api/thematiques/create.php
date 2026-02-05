<?php
require_once $_SERVER['DOCUMENT_ROOT'] . '/config.php';
require_once '../../functions/ctrlSaisies.php';

// Vérifier que c'est une requête POST
if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    header('Location: ../../index.php');
    exit();
}

$libThematique = ($_POST['libThem']);

sql_insert('THEMATIQUE', 'libThem', "'$libThematique'");


header('Location: ../../views/backend/thematiques/list.php');
