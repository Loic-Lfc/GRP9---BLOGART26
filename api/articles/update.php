<?php
require_once $_SERVER['DOCUMENT_ROOT'] . '/config.php';
require_once '../../functions/ctrlSaisies.php';

$numArt = ctrlSaisies($_POST['numArt']);
$dtCreaArt = ctrlSaisies($_POST['dtCreaArt']);
$dtMajArt = ctrlSaisies($_POST['dtMajArt']);
$libTitrArt = addslashes(ctrlSaisies($_POST['libTitrArt']));
$libChapoArt = addslashes(ctrlSaisies($_POST['libChapoArt']));
$libAccrochArt = addslashes(ctrlSaisies($_POST['libAccrochArt']));
$parag1Art = addslashes(ctrlSaisies($_POST['parag1Art']));
$libSsTitr1Art = addslashes(ctrlSaisies($_POST['libSsTitr1Art']));
$parag2Art = addslashes(ctrlSaisies($_POST['parag2Art']));
$libSsTitr2Art = addslashes(ctrlSaisies($_POST['libSsTitr2Art']));
$parag3Art = addslashes(ctrlSaisies($_POST['parag3Art']));
$libConclArt = addslashes(ctrlSaisies($_POST['libConclArt']));
$numThem = ctrlSaisies($_POST['numThem']);

$urlPhotArt = $_POST['urlPhotArt']; 
if (isset($_FILES['urlPhotArt']) && $_FILES['urlPhotArt']['error'] === 0) {
    $oldImagePath = $_SERVER['DOCUMENT_ROOT'] . '/src/uploads/' . $_POST['urlPhotArt'];
    if (file_exists($oldImagePath) && !empty($_POST['urlPhotArt'])) {
        unlink($oldImagePath);
    }

    $imageName = time() . '_' . $_FILES['urlPhotArt']['name'];
    move_uploaded_file($_FILES['urlPhotArt']['tmp_name'], $_SERVER['DOCUMENT_ROOT'] . '/src/uploads/' . $imageName);
    $urlPhotArt = $imageName;
}

sql_update('ARTICLE', 
    "dtCreaArt='$dtCreaArt', 
    dtMajArt='$dtMajArt', 
    libTitrArt='$libTitrArt', 
    libChapoArt='$libChapoArt', 
    libAccrochArt='$libAccrochArt', 
    parag1Art='$parag1Art', 
    libSsTitr1Art='$libSsTitr1Art', 
    parag2Art='$parag2Art', 
    libSsTitr2Art='$libSsTitr2Art', 
    parag3Art='$parag3Art', 
    libConclArt='$libConclArt', 
    urlPhotArt='$urlPhotArt', 
    numThem=$numThem", 
    "numArt = $numArt"
);

header('Location: ../../views/backend/articles/list.php');