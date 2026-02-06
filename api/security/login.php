<?php
require_once '../../config/defines.php';
require_once '../../config/security.php';
require_once '../../functions/query/connect.php';
require_once '../../functions/query/select.php';

// Vérifier que c'est une requête POST
if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    header('Location: ../../index.php');
    exit();
}

// Initialiser la connexion
sql_connect();

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST["passMemb"]) && isset($_POST["pseudoMemb"])) {
    // Vérification reCAPTCHA v2
    if(isset($_POST['g-recaptcha-response'])){
        $token = $_POST['g-recaptcha-response'];
        $url = 'https://www.google.com/recaptcha/api/siteverify';
        $data = array(
            'secret' => '6LexJl8sAAAAADDkJYxpJ1XXToXR0nk25Ay08PZH',
            'response' => $token
        );
        $options = array(
            'http' => array (
                'header' => "Content-Type: application/x-www-form-urlencoded\r\n",
                'method' => 'POST',
                'content' => http_build_query($data)
            )
        );
        
        $context = stream_context_create($options);
        $result = file_get_contents($url, false, $context);
        $response = json_decode($result);
        
        // Vérifier la réponse reCAPTCHA v2
        if (!$response->success) {
            header('Location: ../../views/backend/security/login.php?error=recaptcha');
            exit();
        }
    } else {
        header('Location: ../../views/backend/security/login.php?error=recaptcha');
        exit();
    }
    
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