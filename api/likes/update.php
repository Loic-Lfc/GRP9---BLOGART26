<?php
require_once $_SERVER['DOCUMENT_ROOT'] . '/config.php';
require_once '../../functions/ctrlSaisies.php';
sql_connect();

session_start();

if (!isset($_SESSION['numMemb'])) {
    http_response_code(401);
    echo 'NOT_CONNECTED';
    exit;
}

$numMemb = (int) $_SESSION['numMemb'];

if(!isset($_POST['numArt'])) {
    http_response_code(400);
    echo "Erreur : numArt manquant";
    exit;
}

$numArt = intval($_POST['numArt']);

$exist = sql_select('LIKEART', '*', "numMemb = $numMemb AND numArt = $numArt");

if(!empty($exist)){
    $likeA = (int)$exist[0]['likeA'];
    $newLike = $likeA ? 0 : 1;

    sql_update('LIKEART', ['likeA' => $newLike], "numMemb = $numMemb AND numArt = $numArt");

} else {
    $columns = "numMemb, numArt, likeA";
    $values  = "$numMemb, $numArt, 1";
    sql_insert('LIKEART', $columns, $values);
}

$totalLikes = sql_select('LIKEART', 'COUNT(*) AS total', "numArt = $numArt AND likeA = 1")[0]['total'];
echo $totalLikes;
?>