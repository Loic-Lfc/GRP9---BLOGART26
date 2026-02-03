<?php
require_once '../../config/defines.php';
require_once '../../config/security.php';
require_once '../../functions/query/connect.php';
require_once '../../functions/query/select.php';
require_once '../../functions/ctrlSaisies.php';

// Initialiser la connexion
sql_connect();

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST["pseudoMemb"]) && isset($_POST["passMemb"]) && isset($_POST["passMemb2"])) {
    $username = trim($_POST['pseudoMemb']);
    $prenomMemb = trim($_POST['prenomMemb'] ?? '');
    $nomMemb = trim($_POST['nomMemb'] ?? '');
    $eMailMemb = trim($_POST['eMailMemb'] ?? '');
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