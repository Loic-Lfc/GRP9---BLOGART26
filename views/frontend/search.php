<?php 
require_once '../../header.php';
sql_connect();

// Récupérer la recherche
$searchQuery = isset($_GET['q']) ? trim($_GET['q']) : '';

// Rediriger vers la page articles avec le paramètre de recherche
header("Location: /articles.php?q=" . urlencode($searchQuery));
exit();
?>
