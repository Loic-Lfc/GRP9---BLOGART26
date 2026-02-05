<?php
require_once $_SERVER['DOCUMENT_ROOT'] . '/config.php';
require_once '../../functions/query/connect.php';
require_once '../../functions/query/select.php';
require_once '../../functions/query/delete.php';

// Vérifier que c'est une requête POST
if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    header('Location: ../../index.php');
    exit();
}

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['numCom'])) {
    $numCom = $_POST['numCom'];
    
    sql_delete('COMMENT', "numCom = $numCom");
    
    header('Location: /views/backend/comments/list.php?success=deleted');
    exit();
} else {
    header('Location: /views/backend/comments/list.php?error=invalid');
    exit();
}