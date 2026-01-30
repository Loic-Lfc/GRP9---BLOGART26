<?php
require_once $_SERVER['DOCUMENT_ROOT'] . '/config.php';
require_once '../../functions/ctrlSaisies.php';

$numArt = ($_POST['numArt']);

sql_delete('THEMATIQUE', "numThem = $numThematique");


header('Location: ../../views/backend/articles/list.php');
