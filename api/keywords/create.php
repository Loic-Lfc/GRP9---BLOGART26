<?php
require_once $_SERVER['DOCUMENT_ROOT'] . '/config.php';
require_once '../../functions/ctrlSaisies.php';

// Vérifier que c'est une requête POST
if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    header('Location: ../../index.php');
    exit();
}

$libMotCle = ($_POST['libMotCle']);

sql_insert('motcle', 'libMotCle', "'$libMotCle'");


header('Location: ../../views/backend/keywords/list.php');