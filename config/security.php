<?php
/**
 * Check if user is logged in with SESSION
 */

// Démarrer la session si elle n'est pas déjà démarrée
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

 // hint : $_SESSION['USER_ID']
 // define constant ID_USER if user is logged in with define function

?>