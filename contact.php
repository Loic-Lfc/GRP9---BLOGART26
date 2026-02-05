<?php include 'header.php'; ?>

<!-- Page Header -->
<section class="page-header text-white">
  <div class="container">
    <h1 class="display-4 fw-bold">
      <i class="fas fa-envelope me-3"></i>CONTACTEZ-NOUS
    </h1>
    <p class="lead">Une question ? Une suggestion ? Nous sommes à votre écoute</p>
  </div>
</section>

<!-- Contact Form -->
<section class="py-5" style="background: var(--color-dark);">
  <div class="container">
    <div class="row justify-content-center">
      <div class="col-lg-8">
        <div class="article-card">
          <div class="article-body" style="padding: 2.5rem;">
            
            <?php 
            if (isset($_GET['success'])) {
                echo '<div class="alert alert-success" role="alert"><i class="fas fa-check-circle me-2"></i>Votre message a été envoyé avec succès ! Nous vous répondrons dans les plus brefs délais.</div>';
            }
            if (isset($_GET['error'])) {
                $alertStyle = 'background: rgba(227, 30, 36, 0.15); border-color: var(--color-primary); color: #ffffff;';
                if ($_GET['error'] === 'empty_fields') {
                    echo '<div class="alert alert-danger" role="alert" style="' . $alertStyle . '"><i class="fas fa-exclamation-circle me-2"></i>Veuillez remplir tous les champs obligatoires.</div>';
                } else if ($_GET['error'] === 'invalid_email') {
                    echo '<div class="alert alert-danger" role="alert" style="' . $alertStyle . '"><i class="fas fa-exclamation-circle me-2"></i>L\'adresse email n\'est pas valide.</div>';
                } else if ($_GET['error'] === 'message_too_short') {
                    echo '<div class="alert alert-danger" role="alert" style="' . $alertStyle . '"><i class="fas fa-exclamation-circle me-2"></i>Votre message doit contenir au moins 10 caractères.</div>';
                } else {
                    echo '<div class="alert alert-danger" role="alert" style="' . $alertStyle . '"><i class="fas fa-exclamation-circle me-2"></i>Une erreur est survenue. Veuillez réessayer.</div>';
                }
            }
            ?>

            <form action="api/contact/send.php" method="post">
              <div class="mb-4">
                <label for="nom" class="form-label fw-bold">
                  <i class="fas fa-user me-2"></i>NOM <span class="text-danger">*</span>
                </label>
                <input type="text" class="form-control" id="nom" name="nom" placeholder="Votre nom" required>
              </div>

              <div class="mb-4">
                <label for="email" class="form-label fw-bold">
                  <i class="fas fa-envelope me-2"></i>EMAIL <span class="text-danger">*</span>
                </label>
                <input type="email" class="form-control" id="email" name="email" placeholder="votre@email.com" required>
              </div>

              <div class="mb-4">
                <label for="sujet" class="form-label fw-bold">
                  <i class="fas fa-tag me-2"></i>SUJET <span class="text-danger">*</span>
                </label>
                <input type="text" class="form-control" id="sujet" name="sujet" placeholder="Sujet de votre message" required>
              </div>

              <div class="mb-4">
                <label for="message" class="form-label fw-bold">
                  <i class="fas fa-comment-dots me-2"></i>MESSAGE <span class="text-danger">*</span>
                </label>
                <textarea class="form-control" id="message" name="message" rows="6" placeholder="Votre message..." required minlength="10"></textarea>
                <small class="d-block mt-1" style="color: var(--color-text-secondary);">Minimum 10 caractères</small>
              </div>

              <button type="submit" class="btn-cartoon w-100">
                <i class="fas fa-paper-plane me-2"></i>ENVOYER LE MESSAGE
              </button>
            </form>

            <hr style="border-color: var(--color-border); margin: 2rem 0;">
            
            <div class="text-center">
              <h3 class="mb-3" style="font-family: var(--font-title); color: var(--color-white);">AUTRES MOYENS DE NOUS CONTACTER</h3>
              <p style="color: var(--color-text-secondary);">
                <i class="fas fa-envelope me-2"></i>
                <a href="mailto:contact@murmuresbordeaux.fr" style="color: var(--color-white); text-decoration: none;">contact@murmuresbordeaux.fr</a>
              </p>
              <div class="d-flex justify-content-center gap-3 mt-3">
                <a href="https://instagram.com/murmuresbordeaux" target="_blank" class="btn-cartoon-outline" style="padding: 0.8rem 1.5rem;">
                  <i class="fab fa-instagram me-2"></i>Instagram
                </a>
                <a href="https://twitter.com/murmuresbordeaux" target="_blank" class="btn-cartoon-outline" style="padding: 0.8rem 1.5rem;">
                  <i class="fab fa-twitter me-2"></i>Twitter
                </a>
              </div>
            </div>

          </div>
        </div>
      </div>
    </div>
  </div>
</section>

<?php include 'footer.php'; ?>
