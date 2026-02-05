<?php
require_once $_SERVER['DOCUMENT_ROOT'] . '/config.php';
require_once '../../functions/ctrlSaisies.php';

// Vérifier que c'est une requête POST
if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    header('Location: ../../index.php');
    exit();
}

sql_connect();

session_start();
$numMemb = $_SESSION['numMemb'] ?? 1;

if(!isset($_POST['numArt'])) {
    http_response_code(400);
    echo "Erreur : numArt manquant";
    exit;
}

$numArt = intval($_POST['numArt']);

$exist = sql_select('LIKEART', '*', "numMemb = $numMemb AND numArt = $numArt");

if(empty($exist)){
    sql_insert('LIKEART', [
        'numMemb' => $numMemb,
        'numArt'  => $numArt,
        'likeA'   => true
    ]);
}

$totalLikes = sql_select('LIKEART', 'COUNT(*) AS total', "numArt = $numArt AND likeA = true")[0]['total'];
echo $totalLikes;