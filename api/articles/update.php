<?php
// Inclusion du fichier de configuration globale et des fonctions de base de données
require_once $_SERVER['DOCUMENT_ROOT'] . '/config.php';
// Inclusion des fonctions de connexion et de manipulation de la base de données
require_once '../../functions/query/connect.php';
require_once '../../functions/query/update.php';

// Sécurité : Vérifie que le script est appelé via un formulaire 
if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    // Redirection vers l'index si on tente d'accéder au fichier en direct
    header('Location: ../../index.php');
    exit();
}

// Initialisation de la connexion à la base de données
sql_connect();

// --- RÉCUPÉRATION ET SÉCURISATION DE L'ID DE L'ARTICLE ---
if (isset($_POST['numArt'])) {
    $numArt = intval($_POST['numArt']);
} else {
    $numArt = 0;
}

// --- RÉCUPÉRATION DE LA DATE DE CRÉATION D'ORIGINE ---
if (isset($_POST['dtCreaArt'])) {
    $dtCreaArt = $_POST['dtCreaArt'];
} else {
    $dtCreaArt = '';
}

// Génération automatique de la date de mise à jour à l'instant T
$dtMajArt = date('Y-m-d H:i:s');

// --- RÉCUPÉRATION DES CONTENUS TEXTUELS ---

if (isset($_POST['libTitrArt'])) {
    $libTitrArt = $_POST['libTitrArt'];
} else {
    $libTitrArt = '';
}

if (isset($_POST['libChapoArt'])) {
    $libChapoArt = $_POST['libChapoArt'];
} else {
    $libChapoArt = '';
}

if (isset($_POST['libAccrochArt'])) {
    $libAccrochArt = $_POST['libAccrochArt'];
} else {
    $libAccrochArt = '';
}

if (isset($_POST['parag1Art'])) {
    $parag1Art = $_POST['parag1Art'];
} else {
    $parag1Art = '';
}

if (isset($_POST['libSsTitr1Art'])) {
    $libSsTitr1Art = $_POST['libSsTitr1Art'];
} else {
    $libSsTitr1Art = '';
}

if (isset($_POST['parag2Art'])) {
    $parag2Art = $_POST['parag2Art'];
} else {
    $parag2Art = '';
}

if (isset($_POST['libSsTitr2Art'])) {
    $libSsTitr2Art = $_POST['libSsTitr2Art'];
} else {
    $libSsTitr2Art = '';
}

if (isset($_POST['parag3Art'])) {
    $parag3Art = $_POST['parag3Art'];
} else {
    $parag3Art = '';
}

if (isset($_POST['libConclArt'])) {
    $libConclArt = $_POST['libConclArt'];
} else {
    $libConclArt = '';
}

if (isset($_POST['numThem'])) {
    $numThem = intval($_POST['numThem']);
} else {
    $numThem = 0;
}

// --- GESTION DE L'IMAGE ---

// On récupère le nom de l'ancienne image pour le garder si on ne change rien
if (isset($_POST['oldUrlPhotArt'])) {
    $urlPhotArt = $_POST['oldUrlPhotArt'];
} else {
    $urlPhotArt = '';
}

// Vérification de l'upload d'un nouveau fichier
if (isset($_FILES['urlPhotArt'])) {
    if ($_FILES['urlPhotArt']['error'] === 0) {
        
        $uploadDir = $_SERVER['DOCUMENT_ROOT'] . '/src/uploads/';
        
        // Suppression de l'ancienne image si elle existe
        if (!empty($urlPhotArt)) {
            $oldImagePath = $uploadDir . $urlPhotArt;
            if (file_exists($oldImagePath)) {
                unlink($oldImagePath); 
            }
        }

        // Création d'un nouveau nom unique
        $fileInfo = pathinfo($_FILES['urlPhotArt']['name']);
        $ext = strtolower($fileInfo['extension']);
        $imageName = 'art_' . date('YmdHis') . '_' . uniqid() . '.' . $ext;
        
        // Déplacement du fichier
        move_uploaded_file($_FILES['urlPhotArt']['tmp_name'], $uploadDir . $imageName);
        $urlPhotArt = $imageName; 
    }
}

// --- MISE À JOUR SQL ---

$updateData = [
    'dtCreaArt' => $dtCreaArt,
    'dtMajArt' => $dtMajArt,
    'libTitrArt' => $libTitrArt,
    'libChapoArt' => $libChapoArt,
    'libAccrochArt' => $libAccrochArt,
    'parag1Art' => $parag1Art,
    'libSsTitr1Art' => $libSsTitr1Art,
    'parag2Art' => $parag2Art,
    'libSsTitr2Art' => $libSsTitr2Art,
    'parag3Art' => $parag3Art,
    'libConclArt' => $libConclArt,
    'urlPhotArt' => $urlPhotArt,
    'numThem' => $numThem
];

// Appel de la fonction de mise à jour
sql_update('ARTICLE', $updateData, "numArt = $numArt");

// --- GESTION DES MOTS-CLÉS ---

if (isset($_POST['motsCles'])) {
    global $DB;
    
    // Suppression des anciennes liaisons
    $request = $DB->prepare("DELETE FROM MOTCLEARTICLE WHERE numArt = :numArt");
    $request->execute([':numArt' => $numArt]);
    
    if (!empty($_POST['motsCles'])) {
        // Découpage de la chaîne en tableau
        $motsClesArray = explode(',', $_POST['motsCles']);
        
        foreach ($motsClesArray as $valeurMot) {
            $numMotCle = intval(trim($valeurMot));
            
            if ($numMotCle > 0) {
                // Insertion un par un
                $sql_insert = "INSERT INTO MOTCLEARTICLE (numArt, numMotCle) VALUES (:numArt, :numMotCle)";
                $request = $DB->prepare($sql_insert);
                $request->execute([
                    ':numArt' => $numArt, 
                    ':numMotCle' => $numMotCle
                ]);
            }
        }
    }
}

// Redirection et arrêt du script
header('Location: ../../views/backend/articles/list.php?success=1');
exit();
?>