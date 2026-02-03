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
      <i class="fas fa-user-plus me-3"></i>INSCRIPTION
    </h1>
    <p class="lead">Rejoignez la communauté Murmures Bordeaux</p>
  </div>
</section>

<!-- Signup Form -->
<section class="py-5" style="background: var(--color-dark);">
  <div class="container">
    <div class="row justify-content-center">
      <div class="col-lg-8">
        <div class="article-card">
          <div class="article-body" style="padding: 2.5rem;">
            
            <?php 
            if (isset($_GET['error'])) {
                $alertStyle = 'background: rgba(227, 30, 36, 0.15); border-color: var(--color-primary); color: var(--color-primary);';
                if ($_GET['error'] === 'pseudo') {
                    echo '<div class="alert alert-danger" role="alert" style="' . $alertStyle . '"><i class="fas fa-exclamation-circle me-2"></i>Ce pseudonyme existe déjà. Veuillez en choisir un autre.</div>';
                } else if ($_GET['error'] === 'pseudo_length') {
                    echo '<div class="alert alert-danger" role="alert" style="' . $alertStyle . '"><i class="fas fa-exclamation-circle me-2"></i>Le pseudonyme doit contenir entre 6 et 70 caractères.</div>';
                } else if ($_GET['error'] === 'password_format') {
                    echo '<div class="alert alert-danger" role="alert" style="' . $alertStyle . '"><i class="fas fa-exclamation-circle me-2"></i>Le mot de passe doit contenir entre 8 et 15 caractères, au moins une majuscule, une minuscule et un chiffre.</div>';
                } else if ($_GET['error'] === 'email_invalid') {
                    echo '<div class="alert alert-danger" role="alert" style="' . $alertStyle . '"><i class="fas fa-exclamation-circle me-2"></i>L\'adresse email n\'est pas valide. Veuillez entrer une adresse email correcte.</div>';
                } else if ($_GET['error'] === 'email_mismatch') {
                    echo '<div class="alert alert-danger" role="alert" style="' . $alertStyle . '"><i class="fas fa-exclamation-circle me-2"></i>Les deux adresses email ne correspondent pas. Veuillez les vérifier.</div>';
                } else {
                    echo '<div class="alert alert-danger" role="alert" style="' . $alertStyle . '"><i class="fas fa-exclamation-circle me-2"></i>Erreur lors de l\'inscription. Vérifiez que vos mots de passe correspondent.</div>';
                }
            }
            ?>

            <form action="../../../api/security/signup.php" method="post">
              <div class="row">
                <div class="col-md-6 mb-4">
                  <label for="prenomMemb" class="form-label fw-bold">
                    <i class="fas fa-id-card me-2"></i>PRÉNOM
                  </label>
                  <input type="text" class="form-control" id="prenomMemb" name="prenomMemb" placeholder="Votre prénom">
                </div>
                
                <div class="col-md-6 mb-4">
                  <label for="nomMemb" class="form-label fw-bold">
                    <i class="fas fa-id-card me-2"></i>NOM
                  </label>
                  <input type="text" class="form-control" id="nomMemb" name="nomMemb" placeholder="Votre nom">
                </div>
              </div>

              <div class="mb-4">
                <label for="pseudoMemb" class="form-label fw-bold">
                  <i class="fas fa-user me-2"></i>PSEUDONYME <small style="color: var(--color-text-secondary); font-weight: normal;">(6-70 caractères)</small>
                </label>
                <input type="text" class="form-control" id="pseudoMemb" name="pseudoMemb" placeholder="Choisissez un pseudonyme" required minlength="6" maxlength="70">
              </div>

              <div class="row">
                <div class="col-md-6 mb-4">
                  <label for="eMailMemb" class="form-label fw-bold">
                    <i class="fas fa-envelope me-2"></i>EMAIL
                  </label>
                  <input type="email" class="form-control" id="eMailMemb" name="eMailMemb" placeholder="votre@email.com" required>
                </div>
                
                <div class="col-md-6 mb-4">
                  <label for="eMailMemb2" class="form-label fw-bold">
                    <i class="fas fa-envelope me-2"></i>CONFIRMER L'EMAIL
                  </label>
                  <input type="email" class="form-control" id="eMailMemb2" name="eMailMemb2" placeholder="Confirmez votre email" required>
                </div>
              </div>

              <div class="row">
                <div class="col-md-6 mb-4">
                  <label for="passMemb" class="form-label fw-bold">
                    <i class="fas fa-lock me-2"></i>MOT DE PASSE
                  </label>
                  <input type="password" class="form-control" id="passMemb" name="passMemb" placeholder="Entrez votre mot de passe" required minlength="8" maxlength="15" pattern="^(?=.*[A-Z])(?=.*[a-z])(?=.*[0-9]).*$" title="Le mot de passe doit contenir au moins une majuscule, une minuscule et un chiffre">
                  <small class="d-block mt-1" style="color: var(--color-text-secondary);">8-15 caractères, 1 majuscule, 1 minuscule, 1 chiffre</small>
                </div>
                
                <div class="col-md-6 mb-4">
                  <label for="passMemb2" class="form-label fw-bold">
                    <i class="fas fa-lock me-2"></i>CONFIRMER LE MOT DE PASSE
                  </label>
                  <input type="password" class="form-control" id="passMemb2" name="passMemb2" placeholder="Confirmez le mot de passe" required>
                </div>
              </div>
              
              <button type="submit" class="btn-cartoon w-100 mb-3">
                <i class="fas fa-user-plus me-2"></i>S'INSCRIRE
              </button>
            </form>

            <hr style="border-color: var(--color-border); margin: 2rem 0;">
            
            <div class="text-center">
              <p style="color: var(--color-text-secondary); margin-bottom: 1rem;">Déjà inscrit ?</p>
              <a href="login.php" class="btn-cartoon-outline w-100">
                <i class="fas fa-sign-in-alt me-2"></i>SE CONNECTER
              </a>
            </div>

          </div>
        </div>
      </div>
    </div>
  </div>
</section>

<?php include("../../../footer.php"); ?>