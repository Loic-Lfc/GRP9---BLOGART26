<?php 
require_once 'header.php';
sql_connect();

// Récupérer les 3 articles mis en avant
$articles = sql_select('ARTICLE', '*', '1=1 ORDER BY dtCreaArt DESC LIMIT 3');
$thematiques = sql_select('THEMATIQUE', '*');
?>

<!-- Hero Section -->
<section class="hero-section text-white">
  <div class="container">
    <div class="row align-items-center">
      <div class="col-lg-6 mb-4 mb-lg-0">
        <h1 class="hero-title mb-4">
          <i class="fas fa-spray-can me-3"></i>Street Art Bordeaux
        </h1>
        <p class="lead mb-4">Découvrez l'univers du street art bordelais à travers nos articles, reportages et interviews d'artistes urbains.</p>
        <div class="d-flex gap-3">
          <a href="/articles.php" class="btn-cartoon">
            <i class="fas fa-palette me-2"></i>Découvrir les articles
          </a>
          <a href="/views/backend/security/signup.php" class="btn-cartoon-outline">
            <i class="fas fa-user-plus me-2"></i>Rejoindre la communauté
          </a>
        </div>
      </div>
      <div class="col-lg-6">
        <img src="/src/images/article1.png" alt="Street Art" class="img-fluid hero-img">
      </div>
    </div>
  </div>
</section>

<!-- Articles Section -->
<section id="articles" class="py-5">
  <div class="container">
    <div class="text-center mb-5">
      <h2 class="section-title">Articles mis en avant</h2>
      <p class="text-muted mt-4">Découvrez notre sélection d'articles sur le street art bordelais</p>
    </div>
    
    <div class="row g-4">
      <?php if(empty($articles)): ?>
        <div class="col-12">
          <div class="alert alert-info text-center">
            <i class="fas fa-info-circle me-2"></i>Aucun article disponible pour le moment.
          </div>
        </div>
      <?php else: ?>
        <?php foreach($articles as $article): ?>
          <div class="col-md-6 col-lg-4">
            <div class="article-card">
              <div class="article-image">
                <?php if(!empty($article['photoArt'])): ?>
                  <img src="/src/uploads/<?php echo htmlspecialchars($article['photoArt']); ?>" alt="<?php echo htmlspecialchars($article['titreArt']); ?>">
                <?php else: ?>
                  <img src="/src/images/article1.png" alt="Default">
                <?php endif; ?>
                <span class="article-badge">
                  <i class="fas fa-tag me-1"></i>Street Art
                </span>
              </div>
              <div class="article-body">
                <h3 class="article-title"><?php echo htmlspecialchars($article['titreArt']); ?></h3>
                <p class="article-excerpt">
                  <?php echo substr(strip_tags($article['chapArt']), 0, 120) . '...'; ?>
                </p>
                <div class="article-meta">
                  <span><i class="fas fa-calendar me-1"></i><?php echo date('d/m/Y', strtotime($article['dtCreaArt'])); ?></span>
                  <span><i class="fas fa-user me-1"></i>Auteur</span>
                </div>
                <div class="article-stats">
                  <span><i class="fas fa-eye me-1"></i>0 vues</span>
                  <span><i class="fas fa-heart me-1"></i>0 likes</span>
                  <span><i class="fas fa-comment me-1"></i>0 commentaires</span>
                </div>
                <a href="/views/frontend/articles/article1.php?id=<?php echo $article['numArt']; ?>" class="btn-cartoon-sm mt-3 w-100">
                  <i class="fas fa-arrow-right me-2"></i>Lire l'article
                </a>
              </div>
            </div>
          </div>
        <?php endforeach; ?>
      <?php endif; ?>
    </div>

    <div class="text-center mt-5">
      <a href="/articles.php" class="btn-cartoon-outline">
        <i class="fas fa-th me-2"></i>Voir tous les articles
      </a>
    </div>
  </div>
</section>

<!-- Stats Section -->
<section class="py-5" style="background: var(--color-white);">
  <div class="container">
    <div class="stats-grid">
      <div class="stat-card">
        <div class="stat-icon">
          <i class="fas fa-newspaper"></i>
        </div>
        <div class="stat-number"><?php echo count($articles); ?></div>
        <div class="stat-label">Articles publiés</div>
      </div>
      <div class="stat-card">
        <div class="stat-icon">
          <i class="fas fa-users"></i>
        </div>
        <div class="stat-number">0</div>
        <div class="stat-label">Membres actifs</div>
      </div>
      <div class="stat-card">
        <div class="stat-icon">
          <i class="fas fa-comments"></i>
        </div>
        <div class="stat-number">0</div>
        <div class="stat-label">Commentaires</div>
      </div>
      <div class="stat-card">
        <div class="stat-icon">
          <i class="fas fa-heart"></i>
        </div>
        <div class="stat-number">0</div>
        <div class="stat-label">Likes</div>
      </div>
    </div>
  </div>
</section>

<?php require_once 'footer.php'; ?>