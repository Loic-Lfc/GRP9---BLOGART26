<?php 
require_once 'header.php';
sql_connect();
?>

<!-- Signup Section -->
<section class="auth-section">
  <div class="container">
    <div class="row justify-content-center">
      <div class="col-md-6 col-lg-5">
        <div class="auth-card">
          <div class="text-center mb-4">
            <div class="auth-icon bg-success">
              <i class="fas fa-user-plus"></i>
            </div>
            <h2 class="fw-bold mt-3">Inscription</h2>
            <p class="text-muted">Rejoignez notre communauté !</p>
          </div>

          <form method="POST" action="/api/security/signup.php" id="signupForm">
            <div class="mb-3">
              <label class="form-label">
                <i class="fas fa-user me-2"></i>Pseudo
              </label>
              <input type="text" class="form-control form-cartoon" name="pseudo" placeholder="Votre pseudo" required>
            </div>

            <div class="mb-3">
              <label class="form-label">
                <i class="fas fa-envelope me-2"></i>Email
              </label>
              <input type="email" class="form-control form-cartoon" name="email" placeholder="votre@email.com" required>
            </div>

            <div class="mb-3">
              <label class="form-label">
                <i class="fas fa-lock me-2"></i>Mot de passe
              </label>
              <input type="password" class="form-control form-cartoon" id="password" name="password" placeholder="••••••••" required>
              <div class="form-text">Minimum 8 caractères</div>
            </div>

            <div class="mb-3">
              <label class="form-label">
                <i class="fas fa-lock me-2"></i>Confirmer le mot de passe
              </label>
              <input type="password" class="form-control form-cartoon" id="password_confirm" name="password_confirm" placeholder="••••••••" required>
            </div>

            <div class="mb-3 form-check">
              <input type="checkbox" class="form-check-input" id="terms" required>
              <label class="form-check-label" for="terms">
                J'accepte les <a href="/views/frontend/rgpd/cgu.php">CGU</a> et la <a href="/views/frontend/rgpd/rgpd.php">politique de confidentialité</a>
              </label>
            </div>

            <button type="submit" class="btn btn-cartoon w-100 mb-3">
              <i class="fas fa-user-plus me-2"></i>Créer mon compte
            </button>
          </form>

          <hr class="my-4">

          <div class="text-center">
            <p class="mb-0">Déjà un compte ? 
              <a href="/login.php" class="fw-bold text-decoration-none">Se connecter</a>
            </p>
          </div>
        </div>
      </div>
    </div>
  </div>
</section>

<script>
document.getElementById('signupForm').addEventListener('submit', function(e) {
  const password = document.getElementById('password').value;
  const passwordConfirm = document.getElementById('password_confirm').value;
  
  if(password !== passwordConfirm) {
    e.preventDefault();
    alert('Les mots de passe ne correspondent pas !');
    return false;
  }
  
  if(password.length < 8) {
    e.preventDefault();
    alert('Le mot de passe doit contenir au moins 8 caractères !');
    return false;
  }
});
</script>

<?php require_once 'footer.php'; ?>
