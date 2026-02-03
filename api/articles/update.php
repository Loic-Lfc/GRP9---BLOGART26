<?php
require_once $_SERVER['DOCUMENT_ROOT'] . '/config.php';
require_once '../../functions/query/connect.php';
require_once '../../functions/query/update.php';

// Initialiser la connexion
sql_connect();

$numArt = isset($_POST['numArt']) ? intval($_POST['numArt']) : 0;
$dtCreaArt = isset($_POST['dtCreaArt']) ? $_POST['dtCreaArt'] : '';
$dtMajArt = isset($_POST['dtMajArt']) ? $_POST['dtMajArt'] : date('Y-m-d H:i:s');
$libTitrArt = isset($_POST['libTitrArt']) ? $_POST['libTitrArt'] : '';
$libChapoArt = isset($_POST['libChapoArt']) ? $_POST['libChapoArt'] : '';
$libAccrochArt = isset($_POST['libAccrochArt']) ? $_POST['libAccrochArt'] : '';
$parag1Art = isset($_POST['parag1Art']) ? $_POST['parag1Art'] : '';
$libSsTitr1Art = isset($_POST['libSsTitr1Art']) ? $_POST['libSsTitr1Art'] : '';
$parag2Art = isset($_POST['parag2Art']) ? $_POST['parag2Art'] : '';
$libSsTitr2Art = isset($_POST['libSsTitr2Art']) ? $_POST['libSsTitr2Art'] : '';
$parag3Art = isset($_POST['parag3Art']) ? $_POST['parag3Art'] : '';
$libConclArt = isset($_POST['libConclArt']) ? $_POST['libConclArt'] : '';
$numThem = isset($_POST['numThem']) ? intval($_POST['numThem']) : 0;
$urlPhotArt = isset($_POST['urlPhotArt']) ? $_POST['urlPhotArt'] : ''; 

// Gérer l'upload de l'image
if (isset($_FILES['urlPhotArt']) && $_FILES['urlPhotArt']['error'] === 0) {
    $oldImagePath = $_SERVER['DOCUMENT_ROOT'] . '/src/uploads/' . $_POST['urlPhotArt'];
    if (file_exists($oldImagePath) && !empty($_POST['urlPhotArt'])) {
        unlink($oldImagePath);
    }

    $imageName = time() . '_' . $_FILES['urlPhotArt']['name'];
    move_uploaded_file($_FILES['urlPhotArt']['tmp_name'], $_SERVER['DOCUMENT_ROOT'] . '/src/uploads/' . $imageName);
    $urlPhotArt = $imageName;
}

// Préparer le tableau des données à mettre à jour
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

// Mettre à jour l'article
sql_update('ARTICLE', $updateData, "numArt = $numArt");

// Gérer les mots-clés s'ils sont fournis
if (isset($_POST['motsCles']) && !empty($_POST['motsCles'])) {
    global $DB;
    
    // Supprimer les anciens mots-clés
    $sql_delete = "DELETE FROM MOTCLEARTICLE WHERE numArt = :numArt";
    $request = $DB->prepare($sql_delete);
    $request->execute([':numArt' => $numArt]);
    
    // Ajouter les nouveaux mots-clés
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

header('Location: ../../views/backend/articles/list.php?success=1');
exit();
?>