<?php
require_once $_SERVER['DOCUMENT_ROOT'] . '/config.php';
require_once '../../functions/query/connect.php';
require_once '../../functions/query/delete.php';

// Initialiser la connexion
sql_connect();

// Récupérer le numéro de l'article à supprimer
$numArt = isset($_POST['numArt']) ? intval($_POST['numArt']) : 0;

// Vérifier que le numéro d'article est valide
if ($numArt > 0) {
    // Supprimer d'abord les mots-clés liés à cet article
    sql_delete('MOTCLEARTICLE', "numArt = " . $numArt);
    
    // Supprimer ensuite l'article
    sql_delete('ARTICLE', "numArt = " . $numArt);
    
    header('Location: ../../views/backend/articles/list.php?success=1');
} else {
    header('Location: ../../views/backend/articles/list.php?error=1');
}
exit();
?>
