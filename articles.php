<?php 
require_once 'header.php';
sql_connect();

// Pagination
$page = isset($_GET['page']) ? intval($_GET['page']) : 1;
$perPage = 9;
$offset = ($page - 1) * $perPage;

// Filtres
$searchQuery = isset($_GET['q']) ? trim($_GET['q']) : '';
$thematique = isset($_GET['them']) ? intval($_GET['them']) : 0;
$motCle = isset($_GET['kw']) ? intval($_GET['kw']) : 0;

// Construction de la requête
$where = '1=1';
if (!empty($searchQuery)) {
    $searchQuery = htmlspecialchars($searchQuery);
    $where .= " AND (libTitrArt LIKE '%$searchQuery%' OR chapArt LIKE '%$searchQuery%')";
}
if ($thematique > 0) {
    $where .= " AND numThem = $thematique";
}
if ($motCle > 0) {
    $where .= " AND numArt IN (SELECT numArt FROM ASSOCIER WHERE numMotCle = $motCle)";
}

// Récupérer les articles
$articles = sql_select('ARTICLE', '*', "$where ORDER BY dtCreaArt DESC LIMIT $perPage OFFSET $offset");
$totalArticles = sql_select('ARTICLE', 'COUNT(*) as total', $where)[0]['total'] ?? 0;
$totalPages = ceil($totalArticles / $perPage);

// Récupérer les thématiques et mots-clés
$thematiques = sql_select('THEMATIQUE', '*');
$motsCles = sql_select('MOTCLE', '*');
?>

<!-- Page Header -->
<section class="page-header text-white">
  <div class="container">
    <h1 class="display-4 fw-bold">
     Tous les articles
    </h1>
    <p class="lead">Explorez notre collection d'articles sur le street art bordelais</p>
  </div>
</section>

<!-- Search Section -->
<section class="search-section" style="margin-top: -40px;">
  <div class="container">
    <div class="search-card">
      <form action="/articles.php" method="GET">
        <div class="row g-3 align-items-end">
          <div class="col-md-4">
            <label class="form-label fw-bold">
              <i class="fas fa-search me-2"></i>Rechercher
            </label>
            <div class="input-group-cartoon">
              <i class="fas fa-search input-icon"></i>
              <input type="text" name="q" class="form-control form-cartoon" 
                    placeholder="Titre, artiste, contenu..." 
                    value="<?php echo htmlspecialchars($searchQuery); ?>">
            </div>
          </div>
          <div class="col-md-3">
            <label class="form-label fw-bold">
              <i class="fas fa-folder me-2"></i>Thématique
            </label>
            <select name="them" class="form-control form-cartoon" style="padding-left: 20px;">
              <option value="0">Toutes</option>
              <?php foreach($thematiques as $them): ?>
                <option value="<?php echo $them['numThem']; ?>" 
                        <?php echo ($thematique == $them['numThem']) ? 'selected' : ''; ?>>
                  <?php echo htmlspecialchars($them['libThem']); ?>
                </option>
              <?php endforeach; ?>
            </select>
          </div>
          <div class="col-md-3">
            <label class="form-label fw-bold">
              <i class="fas fa-tags me-2"></i>Mot-clé
            </label>
            <select name="kw" class="form-control form-cartoon" style="padding-left: 20px;">
              <option value="0">Tous</option>
              <?php foreach($motsCles as $mc): ?>
                <option value="<?php echo $mc['numMotCle']; ?>" 
                        <?php echo ($motCle == $mc['numMotCle']) ? 'selected' : ''; ?>>
                  <?php echo htmlspecialchars($mc['libMotCle']); ?>
                </option>
              <?php endforeach; ?>
            </select>
          </div>
          <div class="col-md-2">
            <button type="submit" class="btn-cartoon w-100">
              <i class="fas fa-filter me-2"></i>Filtrer
            </button>
          </div>
        </div>
        
        <?php if(!empty($searchQuery) || $thematique > 0 || $motCle > 0): ?>
          <div class="text-center mt-3">
            <a href="/articles.php" class="btn-cartoon-outline-sm">
              <i class="fas fa-times me-2"></i>Réinitialiser les filtres
            </a>
          </div>
        <?php endif; ?>
      </form>
    </div>
  </div>
</section>

<!-- Articles Section -->
<section class="py-5">
  <div class="container">
    <!-- Résultats -->
    <div class="d-flex justify-content-between align-items-center mb-4">
      <div>
        <h2 class="mb-0">
          <?php if(!empty($searchQuery)): ?>
            Résultats pour "<?php echo htmlspecialchars($searchQuery); ?>"
          <?php elseif($thematique > 0): ?>
            <?php 
              $themSelected = array_filter($thematiques, function($t) use ($thematique) {
                return $t['numThem'] == $thematique;
              });
              $themSelected = reset($themSelected);
              echo htmlspecialchars($themSelected['libThem']);
            ?>
          <?php else: ?>
            Tous les articles
          <?php endif; ?>
        </h2>
        <p class="text-muted mb-0"><?php echo $totalArticles; ?> article(s) trouvé(s)</p>
      </div>
    </div>

    <!-- Grille d'articles -->
    <div class="row g-4">
      <?php if(empty($articles)): ?>
        <div class="col-12">
          <div class="alert alert-info text-center">
            <i class="fas fa-info-circle me-2"></i>
            Aucun article ne correspond à votre recherche. 
            <a href="/articles.php" class="alert-link">Voir tous les articles</a>
          </div>
        </div>
      <?php else: ?>
        <?php foreach($articles as $article): ?>
          <div class="col-md-6 col-lg-4">
            <div class="article-card">
              <div class="article-image">
                <?php if(!empty($article['photoArt'])): ?>
                  <img src="/src/uploads/<?php echo htmlspecialchars($article['photoArt']); ?>" 
                      alt="<?php echo htmlspecialchars($article['libTitrArt']); ?>">
                <?php else: ?>
                  <img src="/src/images/article1.png" alt="Default">
                <?php endif; ?>
                <span class="article-badge">
                  <i class="fas fa-tag me-1"></i>Street Art
                </span>
              </div>
              <div class="article-body">
                <h3 class="article-title"><?php echo htmlspecialchars($article['libTitrArt']); ?></h3>
                <p class="article-excerpt">
                  <?php echo substr(strip_tags($article['libChapoArt']), 0, 120) . '...'; ?>
                </p>
                <div class="article-meta">
                  <span>
                    <i class="fas fa-calendar me-1"></i>
                    <?php echo date('d/m/Y', strtotime($article['dtCreaArt'])); ?>
                  </span>
                  <span><i class="fas fa-user me-1"></i>Auteur</span>
                </div>
                <div class="article-stats">
                  <span><i class="fas fa-eye me-1"></i>0 vues</span>
                  <span><i class="fas fa-heart me-1"></i>0 likes</span>
                  <span><i class="fas fa-comment me-1"></i>0 commentaires</span>
                </div>
                <a href="/views/frontend/articles/article1.php?id=<?php echo $article['numArt']; ?>" 
                  class="btn-cartoon-sm mt-3 w-100">
                  <i class="fas fa-arrow-right me-2"></i>Lire l'article
                </a>
              </div>
            </div>
          </div>
        <?php endforeach; ?>
      <?php endif; ?>
    </div>

    <!-- Pagination -->
    <?php if($totalPages > 1): ?>
      <nav class="mt-5">
        <ul class="pagination pagination-cartoon justify-content-center">
          <!-- Précédent -->
          <?php if($page > 1): ?>
            <li class="page-item">
              <a class="page-link" href="?page=<?php echo ($page - 1); ?><?php echo !empty($searchQuery) ? '&q=' . urlencode($searchQuery) : ''; ?><?php echo $thematique > 0 ? '&them=' . $thematique : ''; ?>">
                <i class="fas fa-chevron-left"></i>
              </a>
            </li>
          <?php endif; ?>

          <!-- Pages -->
          <?php for($i = 1; $i <= $totalPages; $i++): ?>
            <?php if($i == 1 || $i == $totalPages || ($i >= $page - 2 && $i <= $page + 2)): ?>
              <li class="page-item <?php echo ($i == $page) ? 'active' : ''; ?>">
                <a class="page-link" href="?page=<?php echo $i; ?><?php echo !empty($searchQuery) ? '&q=' . urlencode($searchQuery) : ''; ?><?php echo $thematique > 0 ? '&them=' . $thematique : ''; ?>">
                  <?php echo $i; ?>
                </a>
              </li>
            <?php elseif($i == $page - 3 || $i == $page + 3): ?>
              <li class="page-item disabled">
                <span class="page-link">...</span>
              </li>
            <?php endif; ?>
          <?php endfor; ?>

          <!-- Suivant -->
          <?php if($page < $totalPages): ?>
            <li class="page-item">
              <a class="page-link" href="?page=<?php echo ($page + 1); ?><?php echo !empty($searchQuery) ? '&q=' . urlencode($searchQuery) : ''; ?><?php echo $thematique > 0 ? '&them=' . $thematique : ''; ?>">
                <i class="fas fa-chevron-right"></i>
              </a>
            </li>
          <?php endif; ?>
        </ul>
      </nav>
    <?php endif; ?>
  </div>
</section>


<?php require_once 'footer.php'; ?>
