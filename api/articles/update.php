<?php
require_once $_SERVER['DOCUMENT_ROOT'] . '/config.php';
require_once '../../functions/query/connect.php';
require_once '../../functions/query/update.php';

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    header('Location: ../../index.php');
    exit();
}

sql_connect();

$numArt = isset($_POST['numArt']) ? intval($_POST['numArt']) : 0;
$dtCreaArt = $_POST['dtCreaArt'] ?? '';
$dtMajArt = date('Y-m-d H:i:s');
$libTitrArt = $_POST['libTitrArt'] ?? '';
$libChapoArt = $_POST['libChapoArt'] ?? '';
$libAccrochArt = $_POST['libAccrochArt'] ?? '';
$parag1Art = $_POST['parag1Art'] ?? '';
$libSsTitr1Art = $_POST['libSsTitr1Art'] ?? '';
$parag2Art = $_POST['parag2Art'] ?? '';
$libSsTitr2Art = $_POST['libSsTitr2Art'] ?? '';
$parag3Art = $_POST['parag3Art'] ?? '';
$libConclArt = $_POST['libConclArt'] ?? '';
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

sql_update('ARTICLE', $updateData, "numArt = $numArt");

if (isset($_POST['motsCles'])) {
    global $DB;
    $request = $DB->prepare("DELETE FROM MOTCLEARTICLE WHERE numArt = :numArt");
    $request->execute([':numArt' => $numArt]);
    
    $motsCles = !empty($_POST['motsCles']) ? explode(',', $_POST['motsCles']) : [];
    foreach ($motsCles as $numMotCle) {
        $numMotCle = intval(trim($numMotCle));
        if ($numMotCle > 0) {
            $sql_insert = "INSERT INTO MOTCLEARTICLE (numArt, numMotCle) VALUES (:numArt, :numMotCle)";
            $request = $DB->prepare($sql_insert);
            $request->execute([':numArt' => $numArt, ':numMotCle' => $numMotCle]);
        }
    }
}

header('Location: ../../views/backend/articles/list.php?success=1');
exit();