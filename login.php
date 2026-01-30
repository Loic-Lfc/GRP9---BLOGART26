<?php 
require_once 'header.php';
sql_connect();
?>

<!-- Login Section -->
<section class="auth-section">
  <div class="container">
    <div class="row justify-content-center">
      <div class="col-md-5 col-lg-4">
        <div class="auth-card">
          <div class="text-center mb-4">
            <div class="auth-icon">
              <i class="fas fa-sign-in-alt"></i>
            </div>
            <h2 class="fw-bold mt-3">Connexion</h2>
            <p class="text-muted">Content de vous revoir !</p>
          </div>

          <form method="POST" action="/api/security/login.php">
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
              <input type="password" class="form-control form-cartoon" name="password" placeholder="••••••••" required>
            </div>

            <div class="mb-3 form-check">
              <input type="checkbox" class="form-check-input" id="remember" name="remember">
              <label class="form-check-label" for="remember">
                Se souvenir de moi
              </label>
            </div>

            <button type="submit" class="btn btn-cartoon w-100 mb-3">
              <i class="fas fa-sign-in-alt me-2"></i>Se connecter
            </button>

            <div class="text-center">
              <a href="#" class="text-decoration-none small">Mot de passe oublié ?</a>
            </div>
          </form>

          <hr class="my-4">

          <div class="text-center">
            <p class="mb-0">Pas encore de compte ? 
              <a href="/signup.php" class="fw-bold text-decoration-none">S'inscrire</a>
            </p>
          </div>
        </div>
      </div>
    </div>
  </div>
</section>

<?php require_once 'footer.php'; ?>
