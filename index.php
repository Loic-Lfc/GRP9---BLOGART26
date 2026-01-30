<?php 
require_once 'header.php';
sql_connect();

// Récupération des articles (à adapter selon votre BDD)
// $articles = getAllArticles();
?>

<!-- Hero Section -->
<section class="hero-section">
  <div class="hero-overlay"></div>
  <div class="container">
    <div class="row align-items-center min-vh-60">
      <div class="col-lg-6">
        <div class="hero-content">
          <h1 class="hero-title display-3 fw-bold">
            <span class="text-primary">Street Art</span><br>
            <span class="text-white">Bordeaux</span>
          </h1>
          <p class="hero-subtitle lead text-white mb-4">
            Découvrez l'univers fascinant du street art bordelais ! Explorez les œuvres, 
            rencontrez les artistes et plongez dans la culture urbaine.
          </p>
          <div class="hero-buttons">
            <a href="/articles.php" class="btn btn-cartoon btn-lg me-3">
              <i class="fas fa-palette me-2"></i>Découvrir
            </a>
            <a href="#articles" class="btn btn-outline-light btn-lg">
              <i class="fas fa-arrow-down me-2"></i>Explorer
            </a>
          </div>
        </div>
      </div>
      <div class="col-lg-6 d-none d-lg-block">
        <div class="hero-image-container">
          <img src="https://images.unsplash.com/photo-1499781350541-7783f6c6a0c8?w=800" alt="Street Art Bordeaux" class="img-fluid hero-img">
        </div>
      </div>
    </div>
  </div>
</section>

<!-- Search Section -->
<section class="search-section py-5">
  <div class="container">
    <div class="search-card">
      <h3 class="text-center mb-4">
        <i class="fas fa-search me-2 text-primary"></i>Rechercher un article
      </h3>
      <form method="GET" action="/articles.php">
        <div class="row g-3">
          <div class="col-md-3">
            <div class="input-group-cartoon">
              <span class="input-icon"><i class="fas fa-tag"></i></span>
              <input type="text" class="form-control form-cartoon" name="keyword" placeholder="Mots-clés...">
            </div>
          </div>
          <div class="col-md-3">
            <div class="input-group-cartoon">
              <span class="input-icon"><i class="fas fa-heading"></i></span>
              <input type="text" class="form-control form-cartoon" name="title" placeholder="Titre...">
            </div>
          </div>
          <div class="col-md-3">
            <div class="input-group-cartoon">
              <span class="input-icon"><i class="fas fa-user-edit"></i></span>
              <input type="text" class="form-control form-cartoon" name="author" placeholder="Auteur...">
            </div>
          </div>
          <div class="col-md-3">
            <button type="submit" class="btn btn-cartoon w-100">
              <i class="fas fa-search"></i>
            </button>
          </div>
        </div>
      </form>
    </div>
  </div>
</section>

<!-- Articles Section -->
<section id="articles" class="articles-section py-5">
  <div class="container">
    <h2 class="section-title text-center mb-5">
      <i class="fas fa-newspaper me-2"></i>Derniers Articles
    </h2>
    
    <div class="row g-4">
      <div class="col-12">
        <div class="text-center py-5">
          <i class="fas fa-newspaper" style="font-size: 4rem; color: var(--color-gray); opacity: 0.3;"></i>
          <h3 class="mt-4" style="color: var(--color-gray);">Aucun article disponible</h3>
          <p class="text-muted">Les articles seront ajoutés par l'administrateur du site.</p>
        </div>
      </div>
    </div>
  </div>
</section>

<?php require_once 'footer.php'; ?>

