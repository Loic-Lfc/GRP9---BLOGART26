<?php
require_once '../../config/defines.php';
require_once '../../config/security.php';

// Vérifier que c'est une requête POST
if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    header('Location: ../../contact.php?error=invalid_request');
    exit();
}

// Récupérer et nettoyer les données
$nom = trim($_POST['nom'] ?? '');
$email = trim($_POST['email'] ?? '');
$sujet = trim($_POST['sujet'] ?? '');
$message = trim($_POST['message'] ?? '');

// Validation des champs obligatoires
if (empty($nom) || empty($email) || empty($sujet) || empty($message)) {
    header('Location: ../../contact.php?error=empty_fields');
    exit();
}

// Validation de l'email
if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
    header('Location: ../../contact.php?error=invalid_email');
    exit();
}

// Validation de la longueur du message
if (strlen($message) < 10) {
    header('Location: ../../contact.php?error=message_too_short');
    exit();
}

// Préparer l'email
$to = 'contact@murmuresbordeaux.fr'; // Remplacez par votre véritable adresse email
$subject = '[Contact Murmures Bordeaux] ' . htmlspecialchars($sujet);
$emailMessage = "Nouveau message de contact reçu\n\n";
$emailMessage .= "Nom: " . htmlspecialchars($nom) . "\n";
$emailMessage .= "Email: " . htmlspecialchars($email) . "\n";
$emailMessage .= "Sujet: " . htmlspecialchars($sujet) . "\n\n";
$emailMessage .= "Message:\n" . htmlspecialchars($message) . "\n";

// En-têtes de l'email
$headers = "From: " . $email . "\r\n";
$headers .= "Reply-To: " . $email . "\r\n";
$headers .= "X-Mailer: PHP/" . phpversion() . "\r\n";
$headers .= "Content-Type: text/plain; charset=UTF-8\r\n";

// Envoyer l'email
// Note: Pour que mail() fonctionne, vous devez configurer un serveur SMTP sur votre serveur
// Alternativement, vous pouvez sauvegarder les messages dans la base de données
$mailSent = @mail($to, $subject, $emailMessage, $headers);

// Pour le développement, on peut sauvegarder dans un fichier log
$logFile = __DIR__ . '/../../logs/contacts.log';
$logDir = dirname($logFile);
if (!file_exists($logDir)) {
    @mkdir($logDir, 0777, true);
}

$logEntry = date('[Y-m-d H:i:s]') . " Contact de: $nom ($email)\n";
$logEntry .= "Sujet: $sujet\n";
$logEntry .= "Message: $message\n";
$logEntry .= str_repeat('-', 80) . "\n";

@file_put_contents($logFile, $logEntry, FILE_APPEND);

// Rediriger avec succès
header('Location: ../../contact.php?success=1');
exit();
?>
