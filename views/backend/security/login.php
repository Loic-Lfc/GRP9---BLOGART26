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
      <i class="fas fa-sign-in-alt me-3"></i>CONNEXION
    </h1>
    <p class="lead">Accédez à votre compte Murmures Bordeaux</p>
  </div>
</section>

<!-- Login Form -->
<section class="py-5" style="background: var(--color-dark);">
  <div class="container">
    <div class="row justify-content-center">
      <div class="col-lg-5">
        <div class="article-card">
          <div class="article-body" style="padding: 2.5rem;">
            
            <?php 
            if (isset($_GET['error'])) {
                if ($_GET['error'] === 'recaptcha') {
                    echo '<div class="alert alert-danger" role="alert" style="background: rgba(227, 30, 36, 0.15); border-color: var(--color-primary); color: #ffffff;"><i class="fas fa-exclamation-circle me-2"></i>Veuillez cocher la case "Je ne suis pas un robot" pour continuer.</div>';
                } else {
                    echo '<div class="alert alert-danger" role="alert" style="background: rgba(227, 30, 36, 0.15); border-color: var(--color-primary); color: #ffffff;"><i class="fas fa-exclamation-circle me-2"></i>Pseudonyme ou mot de passe incorrect.</div>';
                }
            }
            if (isset($_GET['success'])) {
                echo '<div class="alert alert-success" role="alert" style="background: rgba(76, 175, 80, 0.15); border-color: #4CAF50; color: #4CAF50;"><i class="fas fa-check-circle me-2"></i>Inscription réussie ! Vous pouvez maintenant vous connecter.</div>';
            }
            ?>

            <form action="../../../api/security/login.php" method="post">
              <div class="mb-4">
                <label for="pseudoMemb" class="form-label fw-bold">
                  <i class="fas fa-user me-2"></i>PSEUDONYME
                </label>
                <input type="text" class="form-control" id="pseudoMemb" name="pseudoMemb" placeholder="Entrez votre pseudonyme" required>
              </div>
              
              <div class="mb-4">
                <label for="passMemb" class="form-label fw-bold">
                  <i class="fas fa-lock me-2"></i>MOT DE PASSE
                </label>
                <input type="password" class="form-control" id="passMemb" name="passMemb" placeholder="Entrez votre mot de passe" required>
              </div>
              
              <!-- reCAPTCHA v2 -->
              <div class="mb-4">
                <div class="g-recaptcha" data-sitekey="6LexJl8sAAAAAJ-6piYK9VQDiCFVdhcTkaF4ZH83"></div>
              </div>
              
              <button type="submit" class="btn-cartoon w-100 mb-3">
                <i class="fas fa-sign-in-alt me-2"></i>SE CONNECTER
              </button>
            </form>

            <hr style="border-color: var(--color-border); margin: 2rem 0;">
            
            <div class="text-center">
              <p style="color: var(--color-text-secondary); margin-bottom: 1rem;">Pas encore inscrit ?</p>
              <a href="signup.php" class="btn-cartoon-outline w-100">
                <i class="fas fa-user-plus me-2"></i>CRÉER UN COMPTE
              </a>
            </div>

          </div>
        </div>
      </div>
    </div>
  </div>
</section>

<?php include("../../../footer.php"); ?>