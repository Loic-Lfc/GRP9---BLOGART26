<?php
require_once $_SERVER['DOCUMENT_ROOT'] . '/config.php';
require_once '../../functions/query/connect.php';
require_once '../../functions/query/update.php';

sql_connect();

$numArt = isset($_POST['numArt']) ? intval($_POST['numArt']) : 0;
$dtCreaArt = isset($_POST['dtCreaArt']) ? $_POST['dtCreaArt'] : '';
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

$urlPhotArt = $_POST['oldUrlPhotArt'] ?? ''; 

if (isset($_FILES['urlPhotArt']) && $_FILES['urlPhotArt']['error'] === 0) {
    $uploadDir = $_SERVER['DOCUMENT_ROOT'] . '/src/uploads/';
    
    if (!empty($_POST['oldUrlPhotArt'])) {
        $oldImagePath = $uploadDir . $_POST['oldUrlPhotArt'];
        if (file_exists($oldImagePath)) {
            unlink($oldImagePath);
        }
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
    
    if (!empty($_POST['motsCles'])) {
        $motsCles = explode(',', $_POST['motsCles']);
        foreach ($motsCles as $numMotCle) {
            $numMotCle = intval(trim($numMotCle));
            if ($numMotCle > 0) {
                $sql_insert = "INSERT INTO MOTCLEARTICLE (numArt, numMotCle) VALUES (:numArt, :numMotCle)";
                $request = $DB->prepare($sql_insert);
                $request->execute([':numArt' => $numArt, ':numMotCle' => $numMotCle]);
            }
        }
    }
}

header('Location: ../../views/backend/articles/list.php?success=1');
exit();