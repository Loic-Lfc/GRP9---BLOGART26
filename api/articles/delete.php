<?php
require_once $_SERVER['DOCUMENT_ROOT'] . '/config.php'; // Inclusion du fichier de configuration pour les constantes et la connexion à la base de données
require_once '../../functions/query/connect.php'; // Inclusion de la fonction de connexion à la base de données
require_once '../../functions/query/select.php'; // Inclusion de la fonction de sélection pour récupérer les données de l'article avant suppression
require_once '../../functions/query/delete.php'; // Inclusion de la fonction de suppression pour supprimer l'article et les données associées

// --- VÉRIFICATION DE LA MÉTHODE ---
// On vérifie que le formulaire a bien été envoyé en POST pour éviter les suppressions accidentelles
if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    header('Location: ../../index.php');
    exit();
}

sql_connect();

// --- RÉCUPÉRATION DE L'ID (SANS RACCOURCI) ---
if (isset($_POST['numArt'])) {
    // Si l'ID existe, on le convertit en nombre entier
    $numArt = intval($_POST['numArt']);
} else {
    // Sinon, on met 0 par défaut
    $numArt = 0;
}

// --- LOGIQUE DE SUPPRESSION ---
if ($numArt > 0) {
    // On cherche d'abord l'article pour récupérer le nom de son image avant de le supprimer
    $article = sql_select("ARTICLE", "urlPhotArt", "numArt = $numArt");

    // Si l'article existe bien en base de données
    if (!empty($article)) {
        try {
            // Étape 1 : Supprimer les données liées dans les autres tables (clés étrangères)
            // On supprime les likes, les commentaires et les mots-clés associés à cet article
            sql_delete('LIKEART', "numArt = " . $numArt);
            sql_delete('COMMENT', "numArt = " . $numArt);
            sql_delete('MOTCLEARTICLE', "numArt = " . $numArt);

            // Étape 2 : Supprimer l'article lui-même de la table ARTICLE
            sql_delete('ARTICLE', "numArt = " . $numArt);

            // Étape 3 : Supprimer le fichier image physiquement sur le serveur
            $imageName = $article[0]['urlPhotArt'];
            $imagePath = $_SERVER['DOCUMENT_ROOT'] . '/src/uploads/' . $imageName;

            // On vérifie que le champ n'est pas vide et que le fichier existe sur le disque
            if (!empty($imageName)) {
                if (file_exists($imagePath)) {
                    unlink($imagePath); // Cette fonction supprime réellement le fichier
                }
            }

            // Redirection avec succès
            header('Location: ../../views/backend/articles/list.php?success=1');
            
        } catch (Exception $e) {
            // En cas d'erreur SQL ou autre, on renvoie vers la page de confirmation avec l'erreur
            header('Location: ../../views/backend/articles/delete.php?numArt=' . $numArt . '&error=sql_error');
        }
    } else {
        // Si l'article n'existe pas dans la base
        header('Location: ../../views/backend/articles/list.php?error=not_found'); // Redirection avec une erreur =>article n'a pas été trouvé
    }
} else {
    // Si l'ID fourni n'est pas valide (ex: 0 ou vide)
    header('Location: ../../views/backend/articles/list.php?error=invalid_id');
}

exit();
?>

