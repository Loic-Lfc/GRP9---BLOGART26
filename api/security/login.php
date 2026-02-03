<?php
require_once '../../config/defines.php';
require_once '../../config/security.php';
require_once '../../functions/query/connect.php';
require_once '../../functions/query/select.php';

// Initialiser la connexion
sql_connect();

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST["passMemb"]) && isset($_POST["pseudoMemb"])) {
    $password = $_POST["passMemb"];
    $username = trim($_POST['pseudoMemb']);
    
    // Vérifier les données du membre
    $membre = sql_select("MEMBRE", "*", "pseudoMemb = '" . htmlspecialchars($username) . "'");
    
    if (!empty($membre)) {
        $membre = $membre[0];
        // Vérifier le mot de passe (crypté)
        if (password_verify($password, $membre['passMemb'])) {
            // Démarrer la session et enregistrer l'utilisateur
            if (!isset($_SESSION)) {
                session_start();
            }
            $_SESSION['pseudoMemb'] = $username;
            $_SESSION['numMemb'] = $membre['numMemb'];
            $_SESSION['nomMemb'] = $membre['nomMemb'];
            $_SESSION['prenomMemb'] = $membre['prenomMemb'];
            $_SESSION['numStat'] = $membre['numStat'];
            
            header("Location: ../../index.php");
            exit();
        } else {
            header("Location: ../../views/backend/security/login.php?error=1");
            exit();
        }
    } else {
        header("Location: ../../views/backend/security/login.php?error=1");
        exit();
    }
}

header('Location: ../../views/backend/security/login.php');
exit();
?>