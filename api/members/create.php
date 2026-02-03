<?php
// Inclusion des fichiers nécessaires
include '../../header.php';
require_once '../../functions/ctrlSaisies.php';

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
        header('Location: ../../views/backend/members/create.php?error=recaptcha');
        exit();
    }
} else {
    header('Location: ../../views/backend/members/create.php?error=recaptcha');
    exit();
}

//Importation des données du formulaire
$pseudoMemb = ctrlSaisies($_POST['pseudoMemb']);
$prenomMemb = ctrlSaisies($_POST['prenomMemb']);
$nomMemb = ctrlSaisies($_POST['nomMemb']);
$passMemb = $_POST['passMemb'];
$passMemb2 = $_POST['passMemb2'];
$eMailMemb = ctrlSaisies($_POST['eMailMemb']);
$eMailMemb2 = ctrlSaisies($_POST['eMailMemb2']);
$dtCreaMemb = date("Y-m-d H:i:s");
$dtMajMemb = "NULL";
$numStat = ctrlSaisies($_POST['numStat']);
$accordMemb = isset($_POST['accordMemb']) ? 1 : 0;

// Vérification du pseudo
$longueurPseudo = strlen($pseudoMemb);
if ($longueurPseudo < 6 || $longueurPseudo > 70) {
    header('Location: ../../views/backend/members/create.php?error=size');
    exit();
}

$existence = sql_select("MEMBRE", "pseudoMemb", "pseudoMemb = '$pseudoMemb'");
if (!empty($existence)) {
    header('Location: ../../views/backend/members/create.php?error=exists');
    exit();
}

// Verification du mail
if (!filter_var($eMailMemb, FILTER_VALIDATE_EMAIL) || !filter_var($eMailMemb2, FILTER_VALIDATE_EMAIL)) {
    header('Location: ../../views/backend/members/create.php?error=email_invalid');
    exit();
}

if ($eMailMemb !== $eMailMemb2) {
    header('Location: ../../views/backend/members/create.php?error=email_match');
    exit();
}

// Verification du mot de passe
$regex = "/^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[!@#$%^&*(),.?\":{}|<>]).{8,15}$/";

if (!preg_match($regex, $passMemb) || !preg_match($regex, $passMemb2)) {
    header('Location: ../../views/backend/members/create.php?error=pass_invalid');
    exit();
}

if ($passMemb !== $passMemb2) {
    header('Location: ../../views/backend/members/create.php?error=pass_match');
    exit();
}

$hashPass = password_hash($passMemb, PASSWORD_DEFAULT);

// Vérification de l'accord RGPD
if ($accordMemb !== 1) {
    header('Location: ../../views/backend/members/create.php?error=rgpd');
    exit();
}

// Insertion dans la base de données
sql_insert(
    'MEMBRE', 
    'prenomMemb, nomMemb, pseudoMemb, passMemb, eMailMemb, dtCreaMemb, dtMajMemb, accordMemb, numStat', 
    "'$prenomMemb', '$nomMemb', '$pseudoMemb', '$hashPass', '$eMailMemb', '$dtCreaMemb', $dtMajMemb, $accordMemb, '$numStat'"
);

// Redirection vers la liste des membres
header('Location: ../../views/backend/members/list.php');