<!DOCTYPE html>
<html lang="fr-FR">
<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Street Art Bordeaux - Blog'Art</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" />
    <link href="https://fonts.googleapis.com/css2?family=Permanent+Marker&family=Poppins:wght@300;400;600&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="/src/css/style.css" />
    <link rel="shortcut icon" type="image/x-icon" href="/src/images/article1.png" />
    <script src="https://www.google.com/recaptcha/api.js"></script>
</head>

<?php
// Démarrer la session en tout premier
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

// Chargement de la config
$configPath = __DIR__ . '/config.php';
if(file_exists($configPath)) {
    require_once $configPath;
}
?>

<body>
<nav class="navbar navbar-expand-lg navbar-cartoon sticky-top">
  <div class="container">
    <a href="/index.php" class="navbar-brand">
        <img src="/src/images/murmures_bordeaux.png" alt="Murmures Bordeaux" style="height: 50px; width: auto; object-fit: contain;">
    </a>

    <button class="navbar-toggler custom-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>

    <div class="collapse navbar-collapse" id="navbarNav">
      <ul class="navbar-nav ms-auto">
        <li class="nav-item">
          <a class="nav-link" href="/index.php">Accueil</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="/articles.php">Articles</a>
        </li>

        <?php if (isset($_SESSION['numStat']) && $_SESSION['numStat'] == 1): ?>
            <li class="nav-item">
              <a class="nav-link" href="/views/backend/dashboard.php">
                Admin
              </a>
            </li>
        <?php endif; ?>
      </ul>

      <div class="d-flex ms-lg-3 mt-3 mt-lg-0 flex-column flex-lg-row gap-2">
        <?php if (isset($_SESSION['pseudoMemb']) && isset($_SESSION['numMemb'])): ?>
          <span class="me-lg-3 align-self-center fw-bold" style="color: var(--color-white);">
            <?php echo htmlspecialchars($_SESSION['pseudoMemb']); ?>
          </span>
          <a class="btn-cartoon-outline-sm" href="/api/security/disconnect.php" style="padding: 6px 16px; font-size: 0.8rem;">
            Déconnexion
          </a>
        <?php else: ?>
          <a class="btn-cartoon-sm me-2" href="/views/backend/security/login.php" style="padding: 6px 16px; font-size: 0.8rem;">
            Connexion
          </a>
          <a class="btn-cartoon-outline-sm" href="/views/backend/security/signup.php" style="padding: 5px 15px; font-size: 0.8rem;">
            Inscription
          </a>
        <?php endif; ?>
      </div>
    </div>
  </div>
</nav>

<style>
/* Style personnalisé pour le bouton burger */
.navbar-toggler.custom-toggler {
  border-color: var(--color-primary);
  background-color: transparent;
  padding: 0.5rem 0.75rem;
}

.navbar-toggler.custom-toggler:focus {
  box-shadow: 0 0 0 0.25rem rgba(227, 30, 36, 0.25);
}

.navbar-toggler.custom-toggler .navbar-toggler-icon {
  background-image: url("data:image/svg+xml,%3csvg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 30 30'%3e%3cpath stroke='rgba(255, 255, 255, 1)' stroke-linecap='round' stroke-miterlimit='10' stroke-width='2' d='M4 7h22M4 15h22M4 23h22'/%3e%3c/svg%3e");
}

.navbar-toggler.custom-toggler:hover {
  background-color: rgba(227, 30, 36, 0.1);
}
</style>

<script>
// Script pour s'assurer que le menu burger fonctionne correctement
document.addEventListener('DOMContentLoaded', function() {
  const navbarToggler = document.querySelector('.navbar-toggler');
  const navbarCollapse = document.querySelector('#navbarNav');
  
  if (navbarToggler && navbarCollapse) {
    navbarToggler.addEventListener('click', function() {
      // Toggle la classe 'show' manuellement si Bootstrap ne fonctionne pas
      if (!navbarCollapse.classList.contains('collapsing')) {
        navbarCollapse.classList.toggle('show');
      }
    });
    
    // Fermer le menu quand on clique sur un lien
    const navLinks = navbarCollapse.querySelectorAll('.nav-link');
    navLinks.forEach(link => {
      link.addEventListener('click', function() {
        if (window.innerWidth < 992) {
          navbarCollapse.classList.remove('show');
        }
      });
    });
  }
});
</script>