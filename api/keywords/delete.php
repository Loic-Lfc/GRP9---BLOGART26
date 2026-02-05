<?php
require_once $_SERVER['DOCUMENT_ROOT'] . '/config.php';
require_once '../../functions/ctrlSaisies.php';

$numMotCle = $_POST['numMotCle'];

$count = sql_select("MOTCLEARTICLE", "COUNT(*) as total", "numMotCle = $numMotCle")[0]['total'];

if ($count > 0) {
    header("Location: ../../views/backend/keywords/delete.php?numMotCle=$numMotCle&error=is_linked");
    exit();
}

sql_delete('motcle', "numMotCle = $numMotCle");
header('Location: ../../views/backend/keywords/list.php?success=deleted');