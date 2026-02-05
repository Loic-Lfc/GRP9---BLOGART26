<?php
require_once $_SERVER['DOCUMENT_ROOT'] . '/config.php';
require_once '../../functions/ctrlSaisies.php';

$numThem = $_POST['numThem'];

$count = sql_select("ARTICLE", "COUNT(*) as total", "numThem = '$numThem'")[0]['total'];

if ($count > 0) {
    header("Location: ../../views/backend/thematiques/delete.php?numThem=$numThem&error=is_linked");
    exit();
}

sql_delete('THEMATIQUE', "numThem = '$numThem'");
header('Location: ../../views/backend/thematiques/list.php?success=deleted');