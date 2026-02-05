<?php
require_once '../../../header.php';
sql_connect();

function parseBBCode($text) {
    $find = [
        '~\[b\](.*?)\[/b\]~s',
        '~\[i\](.*?)\[/i\]~s',
        '~\[u\](.*?)\[/u\]~s',
        '~\[url=(.*?)\](.*?)\[/url\]~s'
    ];
    $replace = [
        '<strong>$1</strong>',
        '<em>$1</em>',
        '<u>$1</u>',
        '<a href="$1" target="_blank" style="color: #3498db; text-decoration: underline;">$2</a>'
    ];
    return preg_replace($find, $replace, $text);
}

$id = $_GET['id'] ?? null;

// Récupérer le membre connecté
$isConnected = isset($_SESSION['numMemb']);
$numMemb = $_SESSION['numMemb'] ?? null;

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
if(isset($_GET['numArt'])){
    $numMemb = $_GET['numMemb'];
    $urlPhotArt = sql_select("ARTICLE", "urlPhotArt", "numArt = $numArticle")[0]['urlPhotArt'];
}

$article = $article[0];

// Récupérer la thématique
$thematique = sql_select("THEMATIQUE", "libThem", "numThem = " . ($article['numThem'] ?? 0));
$thematiqueNom = !empty($thematique) ? $thematique[0]['libThem'] : 'Non catégorisé';

// Récupérer le membre connecté (pour test, on met temporairement numMemb = 1)
$numMemb = $_SESSION['numMemb'] ?? 0;

// Vérifier si le membre a déjà liké cet article
$liked = false;

if ($isConnected) {
    $like = sql_select(
        'LIKEART',
        '*',
        "numArt = {$article['numArt']} AND numMemb = $numMemb"
    );
    $liked = (!empty($like) && $like[0]['likeA']) ? true : false;
}

// Récupérer le total des likes pour cet article
$totalLikes = sql_select('LIKEART', 'COUNT(*) AS total', "numArt = {$article['numArt']} AND likeA = true")[0]['total'];
?>

<!-- Hero Article -->
<?php 
  // On prépare l'URL de l'image
  $bgImage = !empty($article['urlPhotArt']) ? "/src/uploads/" . htmlspecialchars($article['urlPhotArt']) : ''; 
?>

<section class="hero-section text-white d-flex align-items-center" 
        style="position: relative; 
                min-height: 500px; 
                background: url('<?php echo $bgImage; ?>') no-repeat center center; 
                background-size: cover;">
  
  <div style="position: absolute; top: 0; left: 0; width: 100%; height: 100%; background: rgba(0,0,0,0.2); z-index: 1;"></div>

  <div class="container" style="position: relative; z-index: 2;">
    <div class="row">
      <div class="col-lg-10 mx-auto">
        
        <div class="mb-3">
          <span class="badge bg-light text-dark">
            <i class="fas fa-folder me-1"></i><?php echo htmlspecialchars($thematiqueNom); ?>
          </span>
        </div>

        <h1 class="display-4 fw-bold mb-4">
          <?php echo htmlspecialchars($article['libTitrArt'] ?? 'Sans titre'); ?>
        </h1>

        <div class="d-flex gap-4 text-light">
          <span>
            <i class="fas fa-calendar me-2"></i>
            <?php echo date('d/m/Y', strtotime($article['dtCreaArt'])); ?>
          </span>
        </div>

      </div>
    </div>
  </div>
</section>


<section class="py-5">
  <div class="container">
    <div class="row">
      <div class="col-lg-10 mx-auto">


        <?php if(!empty($article['libChapoArt'])): ?>
          <div class="lead mb-5" style="font-size: 1.2rem; line-height: 1.8; color: #E0E0E0;">
            <?php 
              // Utilisation de parseBBCode pour le Chapô
              echo nl2br(parseBBCode(htmlspecialchars($article['libChapoArt']))); 
            ?>
          </div>
        <?php endif; ?>

        
        <div class="article-content" style="font-size: 1.1rem; line-height: 1.9; color: #FFFFFF;">
          <?php if(!empty($article['libSsTitr1Art'])): ?>
            <h2 class="mt-5 mb-3" style="font-family: var(--font-title); color: #FFFFFF;">
              <?php echo htmlspecialchars($article['libSsTitr1Art']); ?>
            </h2>
          <?php endif; ?>
          
          <?php if(!empty($article['parag1Art'])): ?>
            <p><?php echo nl2br(parseBBCode(htmlspecialchars($article['parag1Art']))); ?></p>
          <?php endif; ?>

          <?php if(!empty($article['libSsTitr2Art'])): ?>
            <h2 class="mt-5 mb-3" style="font-family: var(--font-title); color: #FFFFFF;">
              <?php echo htmlspecialchars($article['libSsTitr2Art']); ?>
            </h2>
          <?php endif; ?>
          
          <?php if(!empty($article['parag2Art'])): ?>
            <p><?php echo nl2br(parseBBCode(htmlspecialchars($article['parag2Art']))); ?></p>
          <?php endif; ?>

          <?php if(!empty($article['parag3Art'])): ?>
            <p><?php echo nl2br(parseBBCode(htmlspecialchars($article['parag3Art']))); ?></p>
          <?php endif; ?>

          <?php if(!empty($article['conclusionArt'])): ?>
            <div class="mt-5 p-4" style="background: var(--color-light); border-left: 4px solid var(--color-dark); border-radius: var(--radius-sm);">
              <p class="mb-0" style="font-style: italic;">
                <?php echo nl2br(parseBBCode(htmlspecialchars($article['conclusionArt']))); ?>
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
              <button
                id="btnLike"
                class="btn-cartoon-outline-sm <?php echo $liked ? 'liked' : ''; ?>"
                <?php echo !$isConnected ? 'disabled' : ''; ?>
                title="<?php echo !$isConnected ? 'Connectez-vous pour aimer cet article' : ''; ?>"
              >
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
<section id="commentaires" class="comments-section py-5" style="background-color: #000000; color: #ffffff;">
  <div class="container">
    <div class="row">
      <div class="col-lg-10 mx-auto">
        <div class="comments-header mb-4">
          <h2 class="comments-title" style="color: #ffffff;">
            <i class="fas fa-comments me-2" style="color: #ffffff;"></i>Commentaires
          </h2>
          <div class="comments-divider" style="height: 3px; width: 60px; background: #ffffff; margin-top: 10px;"></div>
        </div>
        
        <?php if (isset($_GET['comment']) && $_GET['comment'] === 'pending'): ?>
          <div class="alert alert-success d-flex align-items-center mb-4" role="alert" 
               style="background-color: #28a745; color: #ffffff; border: none; border-radius: 8px;">
            <i class="fas fa-check-circle me-3" style="font-size: 1.5rem;"></i>
            <div>
              <strong>Merci pour votre commentaire !</strong><br>
              Votre message a besoin d'être validé par notre équipe. Il sera publié rapidement.
            </div>
          </div>
        <?php endif; ?>
        
        <div class="card border-0 mb-5" style="background-color: #1a1a1a; border: 1px solid #333 !important;">
          <div class="card-body p-4">
            <?php if (isset($_SESSION['numMemb'])): ?>
              <form action="/api/comments/create.php" method="POST">
                <input type="hidden" name="numArt" value="<?php echo $id; ?>">
                <div class="mb-3">
                  <label for="libCom" class="form-label fw-bold text-white">Votre message :</label>
                  <textarea class="form-control" name="libCom" id="libCom" rows="4" 
                    style="background-color: #2b2b2b; color: #ffffff; border: 1px solid #444;"
                    placeholder="Qu'en avez-vous pensé ?" required></textarea>
                </div>
                <button type="submit" class="btn btn-light">Publier</button>
              </form>
            <?php else: ?>
              <div class="text-center py-3">
                <p class="mb-3" style="color: #ffffff;">Vous devez être connecté pour laisser un commentaire.</p>
                <a href="../../backend/security/login.php" class="btn-cartoon-outline-sm" style="color: #ffffff; border-color: #ffffff;">Se connecter</a>
              </div>
            <?php endif; ?>
          </div>
        </div>

        <div class="comments-list">
          <?php 
          // Seuls les commentaires validés (attModOK = 1) et non supprimés (delLogiq = 0) s'affichent
          $commentaires = sql_select("COMMENT", "*", "numArt = $id AND attModOK = 1 AND delLogiq = 0 ORDER BY dtCreaCom DESC");
          
          if (!empty($commentaires)): 
            foreach ($commentaires as $com): 
              $auteurCom = sql_select("MEMBRE", "pseudoMemb", "numMemb = " . $com['numMemb'])[0];
          ?>
              <div class="comment-item mb-4 p-4 rounded shadow-sm" 
                  style="background-color: #1a1a1a; border-left: 5px solid #ffffff;">
                <div class="d-flex justify-content-between mb-2">
                  <strong style="color: #ffffff; font-size: 1.1rem;">
                    @<?php echo htmlspecialchars($auteurCom['pseudoMemb']); ?>
                  </strong>
                  <small style="color: #cccccc;">
                    <i class="far fa-clock me-1"></i><?php echo date('d/m/Y H:i', strtotime($com['dtCreaCom'])); ?>
                  </small>
                </div>
                <div class="comment-content" style="color: #ffffff; line-height: 1.6;">
                  <?php echo nl2br(htmlspecialchars($com['libCom'])); ?>
                </div>
              </div>
          <?php 
            endforeach; 
          else: 
          ?>
            <p class="text-center fst-italic py-4" style="color: #ffffff;">Aucun commentaire pour le moment. Soyez le premier à réagir !</p>
          <?php endif; ?>
        </div>
      </div>
    </div>
  </div>
</section>
<script>

const btnLike = document.getElementById('btnLike');

  if (btnLike && !btnLike.hasAttribute('disabled')) {
      btnLike.addEventListener('click', function() {
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
}


  
// Bouton Partager - Copie l'URL
const btnShare = document.getElementById('btnShare');
if (btnShare) {
  btnShare.addEventListener('click', function() {
      const btn = this;
      // Copie uniquement l'URL de base sans les paramètres (ID de connexion, etc.)
      const url = window.location.origin + window.location.pathname;
      
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
}
</script>
<?php include '../../../footer.php'; ?>