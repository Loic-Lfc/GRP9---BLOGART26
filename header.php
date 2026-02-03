<!DOCTYPE html>
<html lang="fr-FR">
<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Blog'Art</title>
    <!-- Load CSS -->
    <link rel="stylesheet" href="src/css/style.css" />
    <!-- Bootstrap CSS only -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous" />
    <link rel="shortcut icon" type="image/x-icon" href="src/images/article1.png" />
    <script src="https://www.google.com/recaptcha/api.js"></script>
</head>
<?php
//load config
require_once 'config.php';
?>
<body>
<nav class="navbar navbar-expand-lg bg-light">
  <div class="container-fluid">
    <a class="navbar-brand" href="#">Blog'Art 25</a>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarNav">
      <ul class="navbar-nav">
        <li class="nav-item">
          <a class="nav-link active" aria-current="page" href="/">Home</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="/views/backend/dashboard.php">Admin</a>
        </li>
      </ul>
    </div>
    <!--right align-->
    <div class="d-flex">
      <form class="d-flex" role="search">
          <input class="form-control me-2" type="search" placeholder="Rechercher sur le site…" aria-label="Search" >
      </form>
      <?php
      // Démarrer la session si elle n'existe pas
      if (!isset($_SESSION)) {
          session_start();
      }
      
      // Vérifier si un utilisateur est connecté
      if (isset($_SESSION['pseudoMemb']) && isset($_SESSION['numMemb'])) {
          // Utilisateur connecté
          ?>
          <span class="me-2 align-self-center text-primary fw-bold">
              <?php echo htmlspecialchars($_SESSION['pseudoMemb']); ?>
          </span>
          <a class="btn btn-danger m-1" href="/api/security/disconnect.php" role="button">Disconnect</a>
          <?php
      } else {
          // Utilisateur non connecté
          ?>
          <a class="btn btn-primary m-1" href="/views/backend/security/login.php" role="button">Login</a>
          <a class="btn btn-dark m-1" href="/views/backend/security/signup.php" role="button">Sign up</a>
          <?php
      }
      ?>
    </div>
  </div>
</nav>