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


// Vérifie que l'identifiant de l'article est bien envoyé dans le formulaire
if(!isset($_POST['numArt'])) {
    // sinon renvoie une erreur HTML 400 (requête incorrecte)
    http_response_code(400);
    echo "Erreur : numArt manquant";
    exit;
}

$numArt = intval($_POST['numArt']);

$exist = sql_select('LIKEART', '*', "numMemb = $numMemb AND numArt = $numArt");

// Vérifie si le like existe ou pas (car il peut être créé avec une valeur de 0)
if(empty($exist)){
    sql_insert('LIKEART', [
        'numMemb' => $numMemb,
        'numArt'  => $numArt,
        'likeA'   => true
    ]);
}

$totalLikes = sql_select('LIKEART', 'COUNT(*) AS total', "numArt = $numArt AND likeA = true")[0]['total'];
echo $totalLikes;