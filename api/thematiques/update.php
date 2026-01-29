<?php
require_once $_SERVER['DOCUMENT_ROOT'] . '/config.php';
require_once '../../functions/ctrlSaisies.php';

$numThematique = ($_POST['numThem']);
$libThematique = ($_POST['libThem']);

sql_update('THEMATIQUE', "libThem = '$libThematique'", "numThem = $numThematique");

header('Location: ../../views/backend/thematiques/list.php');
