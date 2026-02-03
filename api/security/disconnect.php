<?php
require_once '../../config/defines.php';
require_once '../../config/security.php';

// Démarrer la session si elle n'existe pas
if (!isset($_SESSION)) {
    session_start();
}

// Détruire toutes les variables de session
$_SESSION = [];

// Détruire le cookie de session
if (ini_get("session.use_cookies")) {
    $params = session_get_cookie_params();
    setcookie(
        session_name(),
        '',
        time() - 42000,
        $params["path"],
        $params["domain"],
        $params["secure"],
        $params["httponly"]
    );
}

// Détruire la session
session_destroy();

// Rediriger vers la page de connexion
header('Location: ../../views/backend/security/login.php');
exit();
?>