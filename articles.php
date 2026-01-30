<?php 
require_once 'header.php';
sql_connect();

// Récupération des paramètres
$keyword = isset($_GET['keyword']) ? $_GET['keyword'] : '';
$title = isset($_GET['title']) ? $_GET['title'] : '';
$author = isset($_GET['author']) ? $_GET['author'] : '';
$category = isset($_GET['category']) ? $_GET['category'] : '';
$sort = isset($_GET['sort']) ? $_GET['sort'] : 'recent';
?>

<!-- Page Header -->
<div class="page-header">
  <div class="container">
    <h1 class="display-4 fw-bold text-center text-white">
      <i class="fas fa-palette me-3"></i>Tous les Articles
    </h1>
    <p class="lead text-center text-white">Explorez notre collection sur le street art bordelais</p>
  </div>
</div>

<!-- Search & Filters -->
<section class="filters-section">
  <div class="container py-4">
    <!-- Barre de recherche -->
    <div class="search-card mb-4">
      <form method="GET">
        <div class="row g-3">
          <div class="col-md-3">
            <div class="input-group-cartoon">
              <span class="input-icon"><i class="fas fa-tag"></i></span>
              <input type="text" class="form-control form-cartoon" name="keyword" value="<?php echo htmlspecialchars($keyword); ?>" placeholder="Mots-clés...">
            </div>
          </div>
          <div class="col-md-3">
            <div class="input-group-cartoon">
              <span class="input-icon"><i class="fas fa-heading"></i></span>
              <input type="text" class="form-control form-cartoon" name="title" value="<?php echo htmlspecialchars($title); ?>" placeholder="Titre...">
            </div>
          </div>
          <div class="col-md-3">
            <div class="input-group-cartoon">
              <span class="input-icon"><i class="fas fa-user-edit"></i></span>
              <input type="text" class="form-control form-cartoon" name="author" value="<?php echo htmlspecialchars($author); ?>" placeholder="Auteur...">
            </div>
          </div>
          <div class="col-md-3">
            <button type="submit" class="btn btn-cartoon w-100">
              <i class="fas fa-search me-2"></i>Rechercher
            </button>
          </div>
        </div>
      </form>
    </div>

    <!-- Filtres -->
    <div class="filters-card">
      <div class="row align-items-center g-3">
        <div class="col-md-8">
          <div class="filter-group">
            <span class="filter-label"><i class="fas fa-filter me-2"></i>Catégories :</span>
            <button class="btn-filter <?php echo $category == '' ? 'active' : ''; ?>" onclick="filterCategory('')">
              <i class="fas fa-th me-1"></i>Tous
            </button>
            <button class="btn-filter <?php echo $category == 'street-art' ? 'active' : ''; ?>" onclick="filterCategory('street-art')">
              <i class="fas fa-spray-can me-1"></i>Street Art
            </button>
            <button class="btn-filter <?php echo $category == 'artistes' ? 'active' : ''; ?>" onclick="filterCategory('artistes')">
              <i class="fas fa-user-artist me-1"></i>Artistes
            </button>
            <button class="btn-filter <?php echo $category == 'culture' ? 'active' : ''; ?>" onclick="filterCategory('culture')">
              <i class="fas fa-landmark me-1"></i>Culture
            </button>
            <button class="btn-filter <?php echo $category == 'evenements' ? 'active' : ''; ?>" onclick="filterCategory('evenements')">
              <i class="fas fa-calendar-alt me-1"></i>Événements
            </button>
          </div>
        </div>
        <div class="col-md-4">
          <div class="input-group-cartoon">
            <span class="input-icon"><i class="fas fa-sort"></i></span>
            <select class="form-select form-cartoon" onchange="sortArticles(this.value)">
              <option value="recent" <?php echo $sort == 'recent' ? 'selected' : ''; ?>>Plus récents</option>
              <option value="ancien" <?php echo $sort == 'ancien' ? 'selected' : ''; ?>>Plus anciens</option>
              <option value="az" <?php echo $sort == 'az' ? 'selected' : ''; ?>>Titre A-Z</option>
              <option value="za" <?php echo $sort == 'za' ? 'selected' : ''; ?>>Titre Z-A</option>
              <option value="popular" <?php echo $sort == 'popular' ? 'selected' : ''; ?>>Plus populaires</option>
            </select>
          </div>
        </div>
      </div>
    </div>
  </div>
</section>

<!-- Articles Grid -->
<section class="articles-section py-5">
  <div class="container">
    <div class="row mb-4">
      <div class="col">
        <p class="results-count">
          <i class="fas fa-info-circle me-2"></i>
          <span>0 article trouvé</span>
        </p>
      </div>
    </div>

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

<script>
function filterCategory(cat) {
  const url = new URL(window.location.href);
  if (cat) {
    url.searchParams.set('category', cat);
  } else {
    url.searchParams.delete('category');
  }
  window.location.href = url.toString();
}

function sortArticles(sort) {
  const url = new URL(window.location.href);
  url.searchParams.set('sort', sort);
  window.location.href = url.toString();
}
</script>

<?php require_once 'footer.php'; ?>
