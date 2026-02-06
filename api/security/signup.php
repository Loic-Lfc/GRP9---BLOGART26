<?php
require_once '../../config/defines.php';
require_once '../../config/security.php';
require_once '../../functions/query/connect.php';
require_once '../../functions/query/select.php';
require_once '../../functions/ctrlSaisies.php';

// Vérifier que c'est une requête POST
if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    header('Location: ../../index.php');
    exit();
}

// Initialiser la connexion
sql_connect();

// on vérifie que tous les champs soient remplis
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST["pseudoMemb"]) && isset($_POST["passMemb"]) && isset($_POST["passMemb2"])) {
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
        
        $context = stream_context_create($options); //prepare la requete http pour envoyer les données à l'API de Google
        $result = file_get_contents($url, false, $context); //envoie la requete à l'API de Google et récupère la réponse
        $response = json_decode($result); //décoder la réponse JSON de l'API de Google pour vérifier si le reCAPTCHA a été validé avec succès
        
        // Vérifier la réponse reCAPTCHA v2
        if (!$response->success) {
            header('Location: ../../views/backend/security/signup.php?error=recaptcha');
            exit();
        }
    } else {
        header('Location: ../../views/backend/security/signup.php?error=recaptcha');
        exit();
    }
    
    $username = trim($_POST['pseudoMemb']);
    $prenomMemb = trim($_POST['prenomMemb'] ?? '');
    $nomMemb = trim($_POST['nomMemb'] ?? '');
    $eMailMemb = trim($_POST['eMailMemb'] ?? '');
    $eMailMemb2 = trim($_POST['eMailMemb2'] ?? '');
    $password = $_POST['passMemb'];
    $password2 = $_POST['passMemb2'];
    
    // Validation des données
    // Vérifier que le pseudo respecte les critères (6-70 caractères)
    if (!validatePseudoMemb($username)) {
        header("Location: ../../views/backend/security/signup.php?error=pseudo_length");
        exit();
    }
    
    // Vérifier que le password respecte les critères (8-15 caractères, 1 majuscule, 1 minuscule, 1 chiffre)
    if (!validatePassMemb($password)) {
        header("Location: ../../views/backend/security/signup.php?error=password_format");
        exit();
    }
    
    // Vérifier que les deux emails sont valides
    if (!validateEmailMemb($eMailMemb) || !validateEmailMemb($eMailMemb2)) {
        header("Location: ../../views/backend/security/signup.php?error=email_invalid");
        exit();
    }
    
    // Vérifier que les deux emails correspondent
    if ($eMailMemb !== $eMailMemb2) {
        header("Location: ../../views/backend/security/signup.php?error=email_mismatch");
        exit();
    }
    
    // Vérifier que les mots de passe correspondent
    if ($password === $password2) {
        // Vérifier si le pseudo existe déjà
        $exist = sql_select("MEMBRE", "*", "pseudoMemb = '" . htmlspecialchars($username) . "'");
        
        if (empty($exist)) {
            // Hasher le mot de passe
            $hashedPassword = password_hash($password, PASSWORD_DEFAULT);
            
            global $DB;
            $sql_requete = "INSERT INTO MEMBRE (prenomMemb, nomMemb, pseudoMemb, passMemb, eMailMemb, dtCreaMemb, numStat, accordMemb) 
                            VALUES (:prenomMemb, :nomMemb, :pseudoMemb, :passMemb, :eMailMemb, NOW(), 3, 1)";
            $request = $DB->prepare($sql_requete);
            $request->execute([
                ':prenomMemb' => $prenomMemb,
                ':nomMemb' => $nomMemb,
                ':pseudoMemb' => $username,
                ':passMemb' => $hashedPassword,
                ':eMailMemb' => $eMailMemb
            ]);
            
            header("Location: ../../views/backend/security/login.php?success=1");
            exit();
        } else {
            header("Location: ../../views/backend/security/signup.php?error=pseudo");
            exit();
        }
    } else {
        header("Location: ../../views/backend/security/signup.php?error=validation");
        exit();
    }
}

header('Location: ../../views/backend/security/signup.php');
exit();
?>