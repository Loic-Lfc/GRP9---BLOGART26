<?php
if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    header('Location: ../../index.php');
    exit();
}

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
$motsClesRaw = $_POST['motsCles'] ?? '';
$motsCles = !empty($motsClesRaw) ? explode(',', $motsClesRaw) : [];

$errors = [];
if (mb_strlen($libTitrArt) > 100) $errors[] = "Le titre dépasse 100 caractères.";
if (mb_strlen($libChapoArt) > 500) $errors[] = "Le chapeau dépasse 500 caractères.";
if (mb_strlen($libAccrochArt) > 100) $errors[] = "L'accroche dépasse 100 caractères.";
if (mb_strlen($parag1Art) > 1200) $errors[] = "Le paragraphe 1 dépasse 1200 caractères.";
if (mb_strlen($libSsTitr1Art) > 100) $errors[] = "Le sous-titre 1 dépasse 100 caractères.";
if (mb_strlen($parag2Art) > 1200) $errors[] = "Le paragraphe 2 dépasse 1200 caractères.";
if (mb_strlen($libSsTitr2Art) > 100) $errors[] = "Le sous-titre 2 dépasse 100 caractères.";
if (mb_strlen($parag3Art) > 1200) $errors[] = "Le paragraphe 3 dépasse 1200 caractères.";
if (mb_strlen($libConclArt) > 800) $errors[] = "La conclusion dépasse 800 caractères.";

if (!empty($errors)) {
    $errorMsg = urlencode(implode(' ', $errors));
    header("Location: ../../views/backend/articles/create.php?error=$errorMsg");
    exit();
}

$urlPhotArt = null;
if (isset($_FILES['urlPhotArt']) && $_FILES['urlPhotArt']['error'] === 0) {
    $uploadDir = $_SERVER['DOCUMENT_ROOT'] . '/src/uploads/';
    if (!is_dir($uploadDir)) {
        mkdir($uploadDir, 0755, true);
    }
    $ext = strtolower(pathinfo($_FILES['urlPhotArt']['name'], PATHINFO_EXTENSION));
    $imageName = 'art_' . date('YmdHis') . '_' . uniqid() . '.' . $ext;
    if (move_uploaded_file($_FILES['urlPhotArt']['tmp_name'], $uploadDir . $imageName)) {
        $urlPhotArt = $imageName;
    }
}

try {
    $DB->beginTransaction();

    $sql = "INSERT INTO ARTICLE (dtCreaArt, libTitrArt, libChapoArt, libAccrochArt, parag1Art, libSsTitr1Art, parag2Art, libSsTitr2Art, parag3Art, libConclArt, urlPhotArt, numThem)
            VALUES (:dtCreaArt, :libTitrArt, :libChapoArt, :libAccrochArt, :parag1Art, :libSsTitr1Art, :parag2Art, :libSsTitr2Art, :parag3Art, :libConclArt, :urlPhotArt, :numThem)";

    $stmt = $DB->prepare($sql);
    $bindDt = ($dtCreaArt && trim($dtCreaArt) !== '') ? $dtCreaArt : date('Y-m-d H:i:s');

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

    $lastNumArt = $DB->lastInsertId();

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

    $DB->commit();
    header('Location: ../../views/backend/articles/list.php?success=1');
    exit();

} catch (PDOException $e) {
    if ($DB->inTransaction()) $DB->rollBack();
    die('Erreur SQL : ' . $e->getMessage());
}