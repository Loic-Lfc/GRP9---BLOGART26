<?php
require_once '../../config/defines.php';
require_once '../../config/security.php';
require_once '../../functions/query/connect.php';

sql_connect();

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

// Nettoyage strict des mots-clés
$motsClesRaw = $_POST['motsCles'] ?? '';
$motsCles = !empty($motsClesRaw) ? explode(',', $motsClesRaw) : [];

$finalFileName = null;

if (isset($_FILES['urlPhotArt']) && $_FILES['urlPhotArt']['error'] === UPLOAD_ERR_OK) {
    $uploadDir = __DIR__ . '/../../src/uploads/';

    if (!is_dir($uploadDir)) {
        mkdir($uploadDir, 0755, true);
    }

    $origName = basename($_FILES['urlPhotArt']['name']);
    $ext = strtolower(pathinfo($origName, PATHINFO_EXTENSION));
    $finalFileName = 'art_' . date('YmdHis') . '_' . uniqid() . '.' . $ext;
    $targetPath = $uploadDir . $finalFileName;

    if (!move_uploaded_file($_FILES['urlPhotArt']['tmp_name'], $targetPath)) {
        die("Erreur upload");
    }
}

try {
    $DB->beginTransaction();

    $sql = "INSERT INTO ARTICLE (dtCreaArt, libTitrArt, libChapoArt, libAccrochArt, parag1Art, libSsTitr1Art, parag2Art, libSsTitr2Art, parag3Art, libConclArt, urlPhotArt, numThem)
            VALUES (:dtCreaArt, :libTitrArt, :libChapoArt, :libAccrochArt, :parag1Art, :libSsTitr1Art, :parag2Art, :libSsTitr2Art, :parag3Art, :libConclArt, :urlPhotArt, :numThem)";

    $stmt = $DB->prepare($sql);

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
    $stmt->bindValue(':urlPhotArt', $finalFileName);
    $stmt->bindValue(':numThem', $numThem, PDO::PARAM_INT);

    $stmt->execute();

    $lastNumArt = $DB->lastInsertId();

    // Insertion des mots-clés sécurisée
    if ($lastNumArt && !empty($motsCles)) {
        $sqlMot = "INSERT INTO MOTCLEARTICLE (numArt, numMotCle) VALUES (:numArt, :numMotCle)";
        $stmtMot = $DB->prepare($sqlMot);
        
        foreach ($motsCles as $numMotCle) {
            $idMot = intval($numMotCle);
            // On vérifie que l'ID est > 0 avant d'insérer
            if ($idMot > 0) {
                $stmtMot->execute([
                    ':numArt' => $lastNumArt,
                    ':numMotCle' => $idMot
                ]);
            }
        }
    }

    $DB->commit();
    header('Location: ../../views/backend/articles/list.php?success=1');
    exit();

} catch (PDOException $e) {
    if ($DB->inTransaction()) $DB->rollBack();
    die('Erreur SQL : ' . $e->getMessage());
}