<?php
//ctrl saisies form avant import bdd
function ctrlSaisies($saisie){

    // Convertion caractères spéciaux en entités HTML => peu performant
    // Préférer htmlentities()
    // $saisie = htmlspecialchars($saisie, ENT_QUOTES);
    // Suppression des espaces (ou d'autres caractères) en début et fin de chaîne
    $saisie = trim($saisie);
    // Suppression des antislashs d'une chaîne
    $saisie = stripslashes($saisie);
    return $saisie;
}

/**
 * Valide le pseudo du membre
 * - Minimum: 6 caractères
 * - Maximum: 70 caractères
 * 
 * @param string $pseudo Le pseudo à valider
 * @return bool true si le pseudo est valide, false sinon
 */
function validatePseudoMemb($pseudo) {
    $pseudo = trim($pseudo);
    $length = strlen($pseudo);
    
    // Vérifier que le pseudo n'est pas vide et respecte les limites
    return $length >= 6 && $length <= 70;
}

/**
 * Valide le password du membre
 * Critères:
 * - Minimum: 8 caractères
 * - Maximum: 15 caractères
 * - Au moins une majuscule
 * - Au moins une minuscule
 * - Au moins un chiffre
 * - Les caractères spéciaux sont acceptés
 * 
 * @param string $password Le password à valider
 * @return bool true si le password est valide, false sinon
 */
function validatePassMemb($password) {
    $length = strlen($password);
    
    // Vérifier la longueur (8-15 caractères)
    if ($length < 8 || $length > 15) {
        return false;
    }
    
    // Vérifier qu'il y a au moins une majuscule
    if (!preg_match('/[A-Z]/', $password)) {
        return false;
    }
    
    // Vérifier qu'il y a au moins une minuscule
    if (!preg_match('/[a-z]/', $password)) {
        return false;
    }
    
    // Vérifier qu'il y a au moins un chiffre
    if (!preg_match('/[0-9]/', $password)) {
        return false;
    }
    
    return true;
}
?>