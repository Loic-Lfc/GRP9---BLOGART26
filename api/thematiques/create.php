<?php
require_once $_SERVER['DOCUMENT_ROOT'] . '/config.php';
require_once '../../functions/ctrlSaisies.php';

$libThematique = ($_POST['libThem']);

sql_insert('THEMATIQUE', 'libThem', "'$libThematique'");


header('Location: ../../views/backend/thematiques/list.php');
