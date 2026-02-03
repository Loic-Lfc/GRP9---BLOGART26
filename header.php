<!DOCTYPE html>
<html lang="fr-FR">
<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Street Art Bordeaux - Blog'Art</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous" />
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" />
    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Fredoka:wght@300;400;500;600;700&family=Poppins:wght@300;400;600&display=swap" rel="stylesheet">
    <!-- Custom CSS -->
    <link rel="stylesheet" href="/src/css/style.css" />
    <link rel="shortcut icon" type="image/x-icon" href="/src/images/article1.png" />
    <script src="https://www.google.com/recaptcha/api.js"></script>
</head>
<?php
//load config
$configPath = __DIR__ . '/config.php';
if(file_exists($configPath)) {
    require_once $configPath;
}

// Démarrer la session si elle n'existe pas
if (!isset($_SESSION)) {
    session_start();
}
?>
<body>
<nav class="navbar navbar-expand-lg navbar-cartoon sticky-top">
  <div class="container">
    <a class="navbar-brand" href="/index.php">
      <i class="fas fa-spray-can me-2"></i>Street Art BDX
    </a>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarNav">
      <ul class="navbar-nav ms-auto">
        <li class="nav-item">
          <a class="nav-link" href="/index.php"><i class="fas fa-home me-1"></i>Accueil</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="/articles.php"><i class="fas fa-palette me-1"></i>Articles</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="/views/backend/dashboard.php"><i class="fas fa-user-shield me-1"></i>Admin</a>
        </li>
      </ul>
      <div class="d-flex ms-3">
        <?php if (isset($_SESSION['pseudoMemb']) && isset($_SESSION['numMemb'])): ?>
          <!-- Utilisateur connecté -->
          <span class="me-3 align-self-center fw-bold text-dark">
            <i class="fas fa-user-circle me-1"></i><?php echo htmlspecialchars($_SESSION['pseudoMemb']); ?>
          </span>
          <a class="btn-cartoon-outline-sm" href="/api/security/disconnect.php">
            <i class="fas fa-sign-out-alt me-1"></i>Déconnexion
          </a>
        <?php else: ?>
          <!-- Utilisateur non connecté -->
          <a class="btn-cartoon-sm me-2" href="/views/backend/security/login.php">
            <i class="fas fa-sign-in-alt me-1"></i>Connexion
          </a>
          <a class="btn-cartoon-outline-sm" href="/views/backend/security/signup.php">
            <i class="fas fa-user-plus me-1"></i>Inscription
          </a>
        <?php endif; ?>
      </div>
    </div>
  </div>
</nav>

<!-- Bootstrap JS -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"></script>