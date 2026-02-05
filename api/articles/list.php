<?php
// Inclure les fichiers de configuration
require_once '../../config/defines.php';
require_once '../../config/security.php';
require_once '../../functions/query/connect.php';

// Vérifier que c'est une requête POST
if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    header('Location: ../../index.php');
    exit();
}

// Indiquer que la réponse est en JSON
header('Content-Type: application/json; charset=utf-8');

try {
    // Initialiser la connexion
    sql_connect();
    
    // Récupérer les articles (limité aux 10 premiers)
    $sql = "SELECT numArt, libTitrArt, libChapoArt, dtCreaArt FROM ARTICLE 
            ORDER BY dtCreaArt DESC 
            LIMIT 10";
    
    $stmt = $DB->query($sql);
    $articles = $stmt->fetchAll(PDO::FETCH_ASSOC);
    
    // Retourner les articles en JSON
    echo json_encode([
        'success' => true,
        'articles' => $articles
    ]);
    
} catch (PDOException $e) {
    http_response_code(500);
    echo json_encode([
        'success' => false,
        'error' => 'Erreur lors de la récupération des articles'
    ]);
} catch (Exception $e) {
    http_response_code(500);
    echo json_encode([
        'success' => false,
        'error' => 'Erreur : ' . $e->getMessage()
    ]);
}
?>
