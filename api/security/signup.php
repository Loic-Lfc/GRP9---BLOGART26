<?php


require_once '../../config/security.php';
require_once '../../functions/query/connect.php';

// Vérifier que la méthode est POST
if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    http_response_code(405);
    die("Erreur : Méthode non autorisée");
}

// Récupérer les données POST
$prenomMemb = trim($_POST['prenomMemb'] ?? '');
$nomMemb = trim($_POST['nomMemb'] ?? '');
$pseudoMemb = trim($_POST['pseudoMemb'] ?? '');
$eMailMemb = trim($_POST['eMailMemb'] ?? '');
$passMemb = $_POST['passMemb'] ?? '';
$passConfirm = $_POST['passConfirm'] ?? '';
$accordMemb = isset($_POST['accordMemb']) ? 1 : 0;

// Valider les données requises
if (!$prenomMemb || !$nomMemb || !$pseudoMemb || !$eMailMemb || !$passMemb || !$passConfirm) {
    die("Erreur : Tous les champs obligatoires doivent être remplis");
}

// Vérifier que les deux mots de passe correspondent
if ($passMemb !== $passConfirm) {
    die("Erreur : Les mots de passe ne correspondent pas");
}

// Vérifier la longueur du mot de passe
if (strlen($passMemb) < 6) {
    die("Erreur : Le mot de passe doit contenir au moins 6 caractères");
}

// Valider l'email
if (!filter_var($eMailMemb, FILTER_VALIDATE_EMAIL)) {
    die("Erreur : L'adresse email n'est pas valide");
}

try {
    // Initialiser la connexion
    sql_connect();
    
    // Vérifier que le pseudo n'existe pas déjà
    $sqlCheckPseudo = "SELECT numMemb FROM MEMBRE WHERE pseudoMemb = ?";
    $stmtCheck = $DB->prepare($sqlCheckPseudo);
    $stmtCheck->execute([$pseudoMemb]);
    
    if ($stmtCheck->rowCount() > 0) {
        die("Erreur : Ce pseudo est déjà utilisé");
    }
    
    // Vérifier que l'email n'existe pas déjà
    $sqlCheckEmail = "SELECT numMemb FROM MEMBRE WHERE eMailMemb = ?";
    $stmtCheckEmail = $DB->prepare($sqlCheckEmail);
    $stmtCheckEmail->execute([$eMailMemb]);
    
    if ($stmtCheckEmail->rowCount() > 0) {
        die("Erreur : Cet email est déjà utilisé");
    }
    
    // Hash du mot de passe
    $passHash = password_hash($passMemb, PASSWORD_DEFAULT);
    
    // Statut par défaut : 1 (membre)
    $numStat = 1;
    
    // Préparation de la requête SQL INSERT
    $sql = "INSERT INTO MEMBRE (
                prenomMemb, nomMemb, pseudoMemb, passMemb, eMailMemb, 
                accordMemb, numStat
            ) VALUES (?, ?, ?, ?, ?, ?, ?)";
    
    $stmt = $DB->prepare($sql);
    
    // Exécution avec les valeurs
    $stmt->execute([
        $prenomMemb,
        $nomMemb,
        $pseudoMemb,
        $passHash,
        $eMailMemb,
        $accordMemb,
        $numStat
    ]);
    
    // Redirection vers la page de connexion
    header('Location: ../../views/backend/security/login.php?signup=success');
    exit();
    
} catch (PDOException $e) {
    http_response_code(500);
    die("Erreur lors de l'inscription : " . htmlspecialchars($e->getMessage()));
} catch (Exception $e) {
    http_response_code(500);
    die("Erreur : " . htmlspecialchars($e->getMessage()));
}
?>