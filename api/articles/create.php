<?php
// On vérifie si la méthode d'envoi est bien POST
if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    header('Location: ../../index.php');
    exit();
}

// Inclusions des fichiers de configuration et de fonctions
require_once '../../config/defines.php';
require_once '../../config/security.php';
require_once '../../functions/query/connect.php';

// Connexion à la base de données
sql_connect();

// --- RÉCUPÉRATION DES DONNÉES---

if (isset($_POST['libTitrArt'])) {
    $libTitrArt = $_POST['libTitrArt'];
} else {
    $libTitrArt = null;
}

if (isset($_POST['dtCreaArt'])) {
    $dtCreaArt = $_POST['dtCreaArt'];
} else {
    $dtCreaArt = null;
}

if (isset($_POST['libChapoArt'])) {
    $libChapoArt = $_POST['libChapoArt'];
} else {
    $libChapoArt = null;
}

if (isset($_POST['libAccrochArt'])) {
    $libAccrochArt = $_POST['libAccrochArt'];
} else {
    $libAccrochArt = null;
}

if (isset($_POST['parag1Art'])) {
    $parag1Art = $_POST['parag1Art'];
} else {
    $parag1Art = null;
}

if (isset($_POST['libSsTitr1Art'])) {
    $libSsTitr1Art = $_POST['libSsTitr1Art'];
} else {
    $libSsTitr1Art = null;
}

if (isset($_POST['parag2Art'])) {
    $parag2Art = $_POST['parag2Art'];
} else {
    $parag2Art = null;
}

if (isset($_POST['libSsTitr2Art'])) {
    $libSsTitr2Art = $_POST['libSsTitr2Art'];
} else {
    $libSsTitr2Art = null;
}

if (isset($_POST['parag3Art'])) {
    $parag3Art = $_POST['parag3Art'];
} else {
    $parag3Art = null;
}

if (isset($_POST['libConclArt'])) {
    $libConclArt = $_POST['libConclArt'];
} else {
    $libConclArt = null;
}

// Récupération de la thématique 
if (isset($_POST['numThem']) && $_POST['numThem'] !== '') {
    $numThem = intval($_POST['numThem']);
} else {
    $numThem = null;
}

// Récupération des mots-clés
if (isset($_POST['motsCles'])) {
    $motsClesRaw = $_POST['motsCles'];
} else {
    $motsClesRaw = '';
}

if (!empty($motsClesRaw)) {
    $motsCles = explode(',', $motsClesRaw);
} else {
    $motsCles = [];
}

// --- VÉRIFICATION DES LONGUEURS  ---

$errors = [];

if (mb_strlen($libTitrArt) > 100) {
    $errors[] = "Le titre dépasse 100 caractères.";
}

if (mb_strlen($libChapoArt) > 500) {
    $errors[] = "Le chapeau dépasse 500 caractères.";
}

if (mb_strlen($libAccrochArt) > 100) {
    $errors[] = "L'accroche dépasse 100 caractères.";
}

if (mb_strlen($parag1Art) > 1200) {
    $errors[] = "Le paragraphe 1 dépasse 1200 caractères.";
}

if (mb_strlen($libSsTitr1Art) > 100) {
    $errors[] = "Le sous-titre 1 dépasse 100 caractères.";
}

if (mb_strlen($parag2Art) > 1200) {
    $errors[] = "Le paragraphe 2 dépasse 1200 caractères.";
}

if (mb_strlen($libSsTitr2Art) > 100) {
    $errors[] = "Le sous-titre 2 dépasse 100 caractères.";
}

if (mb_strlen($parag3Art) > 1200) {
    $errors[] = "Le paragraphe 3 dépasse 1200 caractères.";
}

if (mb_strlen($libConclArt) > 800) {
    $errors[] = "La conclusion dépasse 800 caractères.";
}

// Si on a des erreurs, on redirige
if (!empty($errors)) {
    $errorMsg = urlencode(implode(' ', $errors));
    header("Location: ../../views/backend/articles/create.php?error=$errorMsg");
    exit();
}

// --- GESTION DE L'IMAGE ---

$urlPhotArt = null;

if (isset($_FILES['urlPhotArt'])) {
    if ($_FILES['urlPhotArt']['error'] === 0) {
        $uploadDir = $_SERVER['DOCUMENT_ROOT'] . '/src/uploads/';
        
        if (!is_dir($uploadDir)) {
            mkdir($uploadDir, 0755, true);
        }
        
        $fileInfo = pathinfo($_FILES['urlPhotArt']['name']);
        $ext = strtolower($fileInfo['extension']);
        $imageName = 'art_' . date('YmdHis') . '_' . uniqid() . '.' . $ext;
        
        if (move_uploaded_file($_FILES['urlPhotArt']['tmp_name'], $uploadDir . $imageName)) {
            $urlPhotArt = $imageName;
        }
    }
}

// --- INSERTION EN BASE DE DONNÉES ---

try {
    // Début d'une transaction (pour garantir que tout est inséré ou rien du tout)
    $DB->beginTransaction();

    $sql = "INSERT INTO ARTICLE (dtCreaArt, libTitrArt, libChapoArt, libAccrochArt, parag1Art, libSsTitr1Art, parag2Art, libSsTitr2Art, parag3Art, libConclArt, urlPhotArt, numThem)
            VALUES (:dtCreaArt, :libTitrArt, :libChapoArt, :libAccrochArt, :parag1Art, :libSsTitr1Art, :parag2Art, :libSsTitr2Art, :parag3Art, :libConclArt, :urlPhotArt, :numThem)";

    $stmt = $DB->prepare($sql);

    // Détermination de la date de création
    if ($dtCreaArt && trim($dtCreaArt) !== '') {
        $bindDt = $dtCreaArt;
    } else {
        $bindDt = date('Y-m-d H:i:s');
    }

    $stmt->execute([
        ':dtCreaArt' => $bindDt,
        ':libTitrArt' => $libTitrArt,
        ':libChapoArt' => $libChapoArt,
        ':libAccrochArt' => $libAccrochArt,
        ':parag1Art' => $parag1Art,
        ':libSsTitr1Art' => $libSsTitr1Art,
        ':parag2Art' => $parag2Art,
        ':libSsTitr2Art' => $libSsTitr2Art,
        ':parag3Art' => $parag3Art,
        ':libConclArt' => $libConclArt,
        ':urlPhotArt' => $urlPhotArt,
        ':numThem' => $numThem
    ]);

    // Récupération de l'ID de l'article qui vient d'être créé
    $lastNumArt = $DB->lastInsertId();

    // Insertion des mots-clés dans la table de liaison
    if (!empty($motsCles)) {
        $sqlMot = "INSERT INTO MOTCLEARTICLE (numArt, numMotCle) VALUES (:numArt, :numMotCle)";
        $stmtMot = $DB->prepare($sqlMot);
        
        foreach ($motsCles as $numMotCle) {
            $stmtMot->execute([
                ':numArt' => $lastNumArt,
                ':numMotCle' => intval($numMotCle)
            ]);
        }
    }

    // On valide définitivement la transaction
    $DB->commit();
    
    header('Location: ../../views/backend/articles/list.php?success=1');
    exit();

} catch (PDOException $e) {
    // En cas d'erreur, on annule ce qui a été fait dans la transaction
    if ($DB->inTransaction()) {
        $DB->rollBack();
    }
    die('Erreur SQL : ' . $e->getMessage());
}