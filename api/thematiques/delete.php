<?php
require_once $_SERVER['DOCUMENT_ROOT'] . '/config.php';
require_once '../../functions/ctrlSaisies.php';

$numThematique = ($_POST['numThem']);

sql_delete('THEMATIQUE', "numThem = $numThematique");


header('Location: ../../views/backend/thematiques/list.php');
