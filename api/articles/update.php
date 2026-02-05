<?php
// Inclusion du fichier de configuration globale et des fonctions de base de données
require_once $_SERVER['DOCUMENT_ROOT'] . '/config.php';
// Inclusion des fonctions de connexion et de manipulation de la base de données
require_once '../../functions/query/connect.php';
require_once '../../functions/query/update.php';

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

$numArt = isset($_POST['numArt']) ? intval($_POST['numArt']) : 0;
if (isset($_POST['dtCreaArt'])) {
    $dtCreaArt = $_POST['dtCreaArt'];
} else {
    $dtCreaArt = '';
}
$dtMajArt = date('Y-m-d H:i:s');
// On vérifie si la donnée "libTitrArt" existe dans le tableau $_POST
if (isset($_POST['libTitrArt'])) {
    // Si elle existe, on range sa valeur dans la variable
    $libTitrArt = $_POST['libTitrArt'];
} else {
    // Si elle n'existe pas, on met une chaine de caractères vide par défaut
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

$numThem = isset($_POST['numThem']) ? intval($_POST['numThem']) : 0;

$errors = [];
if (mb_strlen($libTitrArt) > 100) $errors[] = "Titre trop long (100 max).";
if (mb_strlen($libChapoArt) > 500) $errors[] = "Chapeau trop long (500 max).";
if (mb_strlen($libAccrochArt) > 100) $errors[] = "Accroche trop longue (100 max).";
if (mb_strlen($parag1Art) > 1200) $errors[] = "Paragraphe 1 trop long (1200 max).";
if (mb_strlen($libSsTitr1Art) > 100) $errors[] = "Sous-titre 1 trop long (100 max).";
if (mb_strlen($parag2Art) > 1200) $errors[] = "Paragraphe 2 trop long (1200 max).";
if (mb_strlen($libSsTitr2Art) > 100) $errors[] = "Sous-titre 2 trop long (100 max).";
if (mb_strlen($parag3Art) > 1200) $errors[] = "Paragraphe 3 trop long (1200 max).";
if (mb_strlen($libConclArt) > 800) $errors[] = "Conclusion trop longue (800 max).";

if (!empty($errors)) {
    $msg = urlencode(implode(' ', $errors));
    header("Location: ../../views/backend/articles/edit.php?numArt=$numArt&error=$msg");
    exit();
}

$urlPhotArt = $_POST['oldUrlPhotArt'] ?? ''; 

if (isset($_FILES['urlPhotArt']) && $_FILES['urlPhotArt']['error'] === 0) {
    $uploadDir = $_SERVER['DOCUMENT_ROOT'] . '/src/uploads/';
    if (!empty($_POST['oldUrlPhotArt'])) {
        $oldImagePath = $uploadDir . $_POST['oldUrlPhotArt'];
        if (file_exists($oldImagePath)) unlink($oldImagePath);
    }
    $ext = strtolower(pathinfo($_FILES['urlPhotArt']['name'], PATHINFO_EXTENSION));
    $imageName = 'art_' . date('YmdHis') . '_' . uniqid() . '.' . $ext;
    move_uploaded_file($_FILES['urlPhotArt']['tmp_name'], $uploadDir . $imageName);
    $urlPhotArt = $imageName;

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
    
<<<<<<< HEAD
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
=======
    $motsCles = !empty($_POST['motsCles']) ? explode(',', $_POST['motsCles']) : [];
    foreach ($motsCles as $numMotCle) {
        $numMotCle = intval(trim($numMotCle));
        if ($numMotCle > 0) {
            $sql_insert = "INSERT INTO MOTCLEARTICLE (numArt, numMotCle) VALUES (:numArt, :numMotCle)";
            $request = $DB->prepare($sql_insert);
            $request->execute([':numArt' => $numArt, ':numMotCle' => $numMotCle]);
>>>>>>> e0e0cbbeabdc88511ba5d59bbeadbad00654c25b
        }
    }
}

// Redirection et arrêt du script
header('Location: ../../views/backend/articles/list.php?success=1');
exit();
?>