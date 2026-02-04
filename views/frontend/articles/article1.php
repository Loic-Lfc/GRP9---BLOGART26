<?php
require_once '../../../header.php';
sql_connect();

$id = $_GET['id'] ?? null;

if (!$id) {
    header("Location: /articles.php");
    exit();
}

// Récupérer l'article
$article = sql_select("ARTICLE", "*", "numArt = $id");

if (empty($article)) {
    echo '<div class="container mt-5"><div class="alert alert-danger"><i class="fas fa-exclamation-triangle me-2"></i>Article introuvable</div></div>';
    include '../../../footer.php';
    exit();
}

$article = $article[0];

// Récupérer l'auteur
$auteur = sql_select("MEMBRE", "pseudoMemb, prenomMemb, nomMemb", "numMemb = " . ($article['numMemb'] ?? 0));
$auteurNom = !empty($auteur) ? $auteur[0]['pseudoMemb'] : 'Auteur inconnu';

// Récupérer la thématique
$thematique = sql_select("THEMATIQUE", "libThem", "numThem = " . ($article['numThem'] ?? 0));
$thematiqueNom = !empty($thematique) ? $thematique[0]['libThem'] : 'Non catégorisé';

// Récupérer le membre connecté (pour test, on met temporairement numMemb = 1)
$numMemb = $_SESSION['numMemb'] ?? 1;

// Vérifier si le membre a déjà liké cet article
$like = sql_select('LIKEART', '*', "numArt = {$article['numArt']} AND numMemb = $numMemb");
$liked = (!empty($like) && $like[0]['likeA']) ? true : false;

// Récupérer le total des likes pour cet article
$totalLikes = sql_select('LIKEART', 'COUNT(*) AS total', "numArt = {$article['numArt']} AND likeA = true")[0]['total'];
?>

<!-- Hero Article -->
<section class="hero-section text-white">
  <div class="container">
    <div class="row">
      <div class="col-lg-10 mx-auto">
        <div class="mb-3">
          <span class="badge bg-light text-dark">
            <i class="fas fa-folder me-1"></i><?php echo htmlspecialchars($thematiqueNom); ?>
          </span>
        </div>
        <h1 class="display-4 fw-bold mb-4">
          <?php echo htmlspecialchars($article['titreArt'] ?? 'Sans titre'); ?>
        </h1>
        <div class="d-flex gap-4 text-light">
          <span>
            <i class="fas fa-user me-2"></i>
            Par <strong><?php echo htmlspecialchars($auteurNom); ?></strong>
          </span>
          <span>
            <i class="fas fa-calendar me-2"></i>
            <?php echo date('d/m/Y', strtotime($article['dtCreaArt'])); ?>
          </span>
        </div>
      </div>
    </div>
  </div>
</section>

<!-- Article Content -->
<section class="py-5">
  <div class="container">
    <div class="row">
      <div class="col-lg-10 mx-auto">
        <!-- Image principale -->
        <?php if(!empty($article['photoArt'])): ?>
          <div class="article-image mb-5" style="height: 500px; border-radius: var(--radius-sm); overflow: hidden; box-shadow: var(--shadow);">
            <img src="/src/uploads/<?php echo htmlspecialchars($article['photoArt']); ?>" 
                 alt="<?php echo htmlspecialchars($article['titreArt']); ?>"
                 style="width: 100%; height: 100%; object-fit: cover;">
          </div>
        <?php endif; ?>

        <!-- Chapô -->
        <?php if(!empty($article['chapArt'])): ?>
          <div class="lead mb-5" style="font-size: 1.2rem; line-height: 1.8; color: var(--color-gray);">
            <?php echo nl2br(htmlspecialchars($article['chapArt'])); ?>
          </div>
        <?php endif; ?>

        <!-- Contenu de l'article -->
        <div class="article-content" style="font-size: 1.1rem; line-height: 1.9;">
          <?php if(!empty($article['sousTitre1Art'])): ?>
            <h2 class="mt-5 mb-3" style="font-family: var(--font-title); color: var(--color-dark);">
              <?php echo htmlspecialchars($article['sousTitre1Art']); ?>
            </h2>
          <?php endif; ?>
          
          <?php if(!empty($article['parag1Art'])): ?>
            <p><?php echo nl2br(htmlspecialchars($article['parag1Art'])); ?></p>
          <?php endif; ?>

          <?php if(!empty($article['sousTitre2Art'])): ?>
            <h2 class="mt-5 mb-3" style="font-family: var(--font-title); color: var(--color-dark);">
              <?php echo htmlspecialchars($article['sousTitre2Art']); ?>
            </h2>
          <?php endif; ?>
          
          <?php if(!empty($article['parag2Art'])): ?>
            <p><?php echo nl2br(htmlspecialchars($article['parag2Art'])); ?></p>
          <?php endif; ?>

          <?php if(!empty($article['parag3Art'])): ?>
            <p><?php echo nl2br(htmlspecialchars($article['parag3Art'])); ?></p>
          <?php endif; ?>

          <?php if(!empty($article['conclusionArt'])): ?>
            <div class="mt-5 p-4" style="background: var(--color-light); border-left: 4px solid var(--color-dark); border-radius: var(--radius-sm);">
              <p class="mb-0" style="font-style: italic;">
                <?php echo nl2br(htmlspecialchars($article['conclusionArt'])); ?>
              </p>
            </div>
          <?php endif; ?>
        </div>

        <!-- Stats & Actions -->
        <div class="article-stats-actions">
          <div class="d-flex justify-content-between align-items-center flex-wrap gap-3">
            <div class="d-flex gap-4">
              <span>
                <i class="fas fa-eye me-2"></i>
                <strong>0</strong> vues
              </span>
              <span>
                <i class="fas fa-heart me-2"></i>
                <strong id="likeCount"><?php echo $totalLikes; ?></strong> likes
              </span>
              <span>
                <i class="fas fa-comment me-2"></i>
                <strong>0</strong> commentaires
              </span>
            </div>
            <div class="d-flex gap-2">
              <button id="btnLike" class="btn-cartoon-outline-sm <?php echo $liked ? 'liked' : ''; ?>">
                <i class="fas fa-heart me-1"></i>
                <?php echo $liked ? 'Retirer J’aime' : 'J’aime'; ?>
              </button>
              <button id="btnShare" class="btn-cartoon-sm">
                <i class="fas fa-share-alt me-1"></i>Partager
              </button>
            </div>
          </div>
        </div>

        <!-- Navigation -->
        <div class="text-center mt-5 mb-5">
          <a href="/articles.php" class="btn-cartoon-outline" style="padding: 15px 40px; font-size: 1rem;">
            <i class="fas fa-arrow-left me-2"></i>Retour aux articles
          </a>
        </div>
      </div>
    </div>
  </div>
</section>

<!-- Section commentaires (à développer) -->
<section class="comments-section">
  <div class="container">
    <div class="row">
      <div class="col-lg-10 mx-auto">
        <div class="comments-header">
          <h2 class="comments-title">
            <i class="fas fa-comments"></i>
            Commentaires
          </h2>
          <div class="comments-divider"></div>
        </div>
        
        <div class="comments-placeholder">
          <div class="comments-icon-wrapper">
            <i class="fas fa-comments"></i>
          </div>
          <h3>Bientôt disponible !</h3>
          <p>
            La section des commentaires arrive prochainement.<br>
            Vous pourrez bientôt partager vos réactions et échanger avec la communauté.
          </p>
        </div>
      </div>
    </div>
  </div>
</section>
<script>
document.getElementById('btnLike').addEventListener('click', function() {
    const btn = this;
    const numArt = <?php echo $article['numArt']; ?>;

    fetch('/api/likes/update.php', {
        method: 'POST',
        headers: {'Content-Type': 'application/x-www-form-urlencoded'},
        body: 'numArt=' + numArt
    })
    .then(response => response.text())
    .then(totalLikes => {
        document.getElementById('likeCount').innerText = totalLikes;

        if(btn.classList.contains('liked')) {
            btn.classList.remove('liked');
            btn.innerHTML = '<i class="fas fa-heart me-1"></i>J’aime';
        } else {
            btn.classList.add('liked');
            btn.innerHTML = '<i class="fas fa-heart me-1"></i>Retirer J’aime';
        }
    })
    .catch(err => console.error('Erreur : ', err));
});

// Bouton Partager - Copie l'URL
document.getElementById('btnShare').addEventListener('click', function() {
    const btn = this;
    const url = window.location.href;
    
    navigator.clipboard.writeText(url).then(function() {
        // Feedback visuel
        const originalHTML = btn.innerHTML;
        btn.innerHTML = '<i class="fas fa-check me-1"></i>Lien copié !';
        btn.style.background = 'var(--color-accent)';
        
        setTimeout(function() {
            btn.innerHTML = originalHTML;
            btn.style.background = '';
        }, 2000);
    }).catch(function(err) {
        console.error('Erreur lors de la copie : ', err);
        alert('Impossible de copier le lien. Veuillez le copier manuellement : ' + url);
    });
});
</script>
<?php include '../../../footer.php'; ?>