<?php
if (!isset($_SESSION)) {
    session_start();
}

include '../../../header.php';

// Si l'utilisateur a déjà une session, redirigez-le vers index.php
if (isset($_SESSION['pseudoMemb'])) {
    header("Location: ../../../index.php");
    exit();
}
?>

<!-- Page Header -->
<section class="page-header text-white">
  <div class="container">
    <h1 class="display-4 fw-bold">
      <i class="fas fa-sign-in-alt me-3"></i>Connexion
    </h1>
    <p class="lead">Accédez à votre compte Street Art Bordeaux</p>
  </div>
</section>

<!-- Login Form -->
<section class="py-5">
  <div class="container">
    <div class="row justify-content-center">
      <div class="col-lg-6">
        <div class="article-card">
          <div class="article-body">
            
            <?php 
            if (isset($_GET['error'])) {
                echo '<div class="alert alert-danger" role="alert"><i class="fas fa-exclamation-circle me-2"></i>Pseudonyme ou mot de passe incorrect.</div>';
            }
            if (isset($_GET['success'])) {
                echo '<div class="alert alert-success" role="alert"><i class="fas fa-check-circle me-2"></i>Inscription réussie ! Vous pouvez maintenant vous connecter.</div>';
            }
            ?>

            <form action="../../../api/security/login.php" method="post">
              <div class="mb-4">
                <label for="pseudoMemb" class="form-label fw-bold">
                  <i class="fas fa-user me-2"></i>Pseudonyme
                </label>
                <input type="text" class="form-control" id="pseudoMemb" name="pseudoMemb" placeholder="Entrez votre pseudonyme" required>
              </div>
              
              <div class="mb-4">
                <label for="passMemb" class="form-label fw-bold">
                  <i class="fas fa-lock me-2"></i>Mot de passe
                </label>
                <input type="password" class="form-control" id="passMemb" name="passMemb" placeholder="Entrez votre mot de passe" required>
              </div>
              
              <button type="submit" class="btn-cartoon w-100">
                <i class="fas fa-sign-in-alt me-2"></i>Se connecter
              </button>
            </form>

            <hr class="my-4">
            
            <div class="text-center">
              <p class="mb-2">Pas encore inscrit ?</p>
              <a href="signup.php" class="btn-cartoon-outline">
                <i class="fas fa-user-plus me-2"></i>Créer un compte
              </a>
            </div>

          </div>
        </div>
      </div>
    </div>
  </div>
</section>

<?php include("../../../footer.php"); ?>