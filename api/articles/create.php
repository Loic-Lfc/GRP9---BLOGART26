<?php

require_once '../../config/defines.php';
require_once '../../config/security.php';
require_once '../../functions/query/connect.php';

// Vérifier que c'est une requête POST
if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    header('Location: ../../index.php');
    exit();
}

sql_connect();

// Récupération des champs POST
$libTitrArt = $_POST['libTitrArt'] ?? null;
$dtCreaArt = $_POST['dtCreaArt'] ?? null;
$libChapoArt = $_POST['libChapoArt'] ?? null;
$libAccrochArt = $_POST['libAccrochArt'] ?? null;
$parag1Art = $_POST['parag1Art'] ?? null;
$libSsTitr1Art = $_POST['libSsTitr1Art'] ?? null;
$parag2Art = $_POST['parag2Art'] ?? null;
$libSsTitr2Art = $_POST['libSsTitr2Art'] ?? null;
$parag3Art = $_POST['parag3Art'] ?? null;
$libConclArt = $_POST['libConclArt'] ?? null;
$numThem = isset($_POST['numThem']) && $_POST['numThem'] !== '' ? intval($_POST['numThem']) : null;
$motsCles = $_POST['motsCles'] ?? [];

// --- GESTION DE L'IMAGE ---
$finalFileName = null; // C'est ce nom qu'on mettra en BDD

if (isset($_FILES['urlPhotArt']) && $_FILES['urlPhotArt']['error'] === UPLOAD_ERR_OK) {
    // Dossier cible défini par ta consigne
    $uploadDir = __DIR__ . '/../../../src/uploads/'; 
    
    // Création du dossier s'il n'existe pas
    if (!is_dir($uploadDir)) mkdir($uploadDir, 0755, true);

    $origName = basename($_FILES['urlPhotArt']['name']);
    $ext = strtolower(pathinfo($origName, PATHINFO_EXTENSION));

    // Création du nom à la volée : art_ANNÉE_MOIS_JOUR_ID.extension
    $finalFileName = 'art_' . date('YmdHis') . '_' . uniqid() . '.' . $ext;
    
    $targetPath = $uploadDir . $finalFileName;

    if (!move_uploaded_file($_FILES['urlPhotArt']['tmp_name'], $targetPath)) {
        die("Erreur : Impossible de déplacer le fichier vers $uploadDir");
    }
}

try {
    $DB->beginTransaction();

    $sql = "INSERT INTO ARTICLE (dtCreaArt, libTitrArt, libChapoArt, libAccrochArt, parag1Art, libSsTitr1Art, parag2Art, libSsTitr2Art, parag3Art, libConclArt, urlPhotArt, numThem)
            VALUES (:dtCreaArt, :libTitrArt, :libChapoArt, :libAccrochArt, :parag1Art, :libSsTitr1Art, :parag2Art, :libSsTitr2Art, :parag3Art, :libConclArt, :urlPhotArt, :numThem)";

    $stmt = $DB->prepare($sql);

    // Formatage de la date pour SQL
    $bindDt = ($dtCreaArt && trim($dtCreaArt) !== '') ? $dtCreaArt : date('Y-m-d H:i:s');

    $stmt->bindValue(':dtCreaArt', $bindDt);
    $stmt->bindValue(':libTitrArt', $libTitrArt);
    $stmt->bindValue(':libChapoArt', $libChapoArt);
    $stmt->bindValue(':libAccrochArt', $libAccrochArt);
    $stmt->bindValue(':parag1Art', $parag1Art);
    $stmt->bindValue(':libSsTitr1Art', $libSsTitr1Art);
    $stmt->bindValue(':parag2Art', $parag2Art);
    $stmt->bindValue(':libSsTitr2Art', $libSsTitr2Art);
    $stmt->bindValue(':parag3Art', $parag3Art);
    $stmt->bindValue(':libConclArt', $libConclArt);
    $stmt->bindValue(':urlPhotArt', $finalFileName); // On stocke le nom généré
    $stmt->bindValue(':numThem', $numThem, PDO::PARAM_INT);

    $stmt->execute();

    $lastNumArt = $DB->lastInsertId();

    // Insertion des mots-clés liés
    if (!empty($motsCles) && is_array($motsCles)) {
        $sqlMot = "INSERT INTO MOTCLEARTICLE (numArt, numMotCle) VALUES (:numArt, :numMotCle)";
        $stmtMot = $DB->prepare($sqlMot);
        foreach ($motsCles as $numMotCle) {
            $stmtMot->execute([
                ':numArt' => $lastNumArt,
                ':numMotCle' => intval($numMotCle)
            ]);
        }
    }

    $DB->commit();
    header('Location: ../../views/backend/articles/list.php?success=1');
    exit();

} catch (PDOException $e) {
    if ($DB->inTransaction()) $DB->rollBack();
    die('Erreur SQL : ' . $e->getMessage());
}