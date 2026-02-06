<?php
// Inclure les fichiers de configuration pour les chemins et la sécurité
require_once '../../config/defines.php';
require_once '../../config/security.php';
require_once '../../functions/query/connect.php';

// --- VÉRIFICATION DE LA MÉTHODE ---
// On vérifie si la requête est bien de type POST
if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    // Si ce n'est pas le cas, on redirige vers l'index
    header('Location: ../../index.php');
    // On arrête le script
    exit();
}

// --- CONFIGURATION DE L'ENTÊTE ---
// On indique au navigateur que ce fichier ne renvoie pas du HTML, mais du JSON
header('Content-Type: application/json; charset=utf-8');

try {
    // Connexion à la base de données
    sql_connect();
    
    // Préparation de la requête SQL pour récupérer les 10 articles les plus récents
    $sql = "SELECT numArt, libTitrArt, libChapoArt, dtCreaArt FROM ARTICLE 
            ORDER BY dtCreaArt DESC 
            LIMIT 10";
    
    // Exécution de la requête
    $stmt = $DB->query($sql);
    
    // On récupère tous les résultats sous forme de tableau associatif
    $articles = $stmt->fetchAll(PDO::FETCH_ASSOC);
    
    // --- PRÉPARATION DE LA RÉPONSE (SANS RACCOURCI) ---
    // On crée un tableau vide pour construire la réponse proprement
    $reponse = [];
    $reponse['success'] = true;
    $reponse['articles'] = $articles;
    
    // On transforme le tableau PHP en texte au format JSON et on l'affiche
    echo json_encode($reponse);
    
} catch (PDOException $e) {
    // En cas d'erreur spécifique à la base de données
    // On envoie un code d'erreur 500 (Erreur interne du serveur)
    http_response_code(500);
    
    $reponseErreurSql = [];
    $reponseErreurSql['success'] = false;
    $reponseErreurSql['error'] = 'Erreur lors de la récupération des articles';
    
    echo json_encode($reponseErreurSql);

} catch (Exception $e) {
    // En cas d'autre type d'erreur (générale)
    http_response_code(500);
    
    $reponseErreurGenerale = [];
    $reponseErreurGenerale['success'] = false;
    $reponseErreurGenerale['error'] = 'Erreur : ' . $e->getMessage();
    
    echo json_encode($reponseErreurGenerale);
}
?>

