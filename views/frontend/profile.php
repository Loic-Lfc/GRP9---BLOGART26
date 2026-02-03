<?php
include '../../header.php';
sql_connect();

// Vérifier si un numMemb est passé en paramètre
if (!isset($_GET['numMemb'])) {
    header("Location: /index.php");
    exit();
}

$numMemb = intval($_GET['numMemb']);

// Récupérer les informations du membre
$membre = sql_select("MEMBRE", "*", "numMemb = $numMemb");

if (empty($membre)) {
    echo '<div class="container mt-5"><div class="alert alert-danger"><i class="fas fa-exclamation-triangle me-2"></i>Membre non trouvé</div></div>';
    include '../../footer.php';
    exit();
}

$membre = $membre[0];

// Récupérer le statut du membre
$statut = sql_select("STATUT", "*", "numStat = " . $membre['numStat']);
$statut = !empty($statut) ? $statut[0]['libStat'] : 'Inconnu';

// Récupérer les articles du membre (si applicable)
$articles = sql_select("ARTICLE", "*", "numMemb = $numMemb ORDER BY dtCreaArt DESC LIMIT 5");
?>

<!-- Page Header -->
<section class="page-header text-white">
  <div class="container">
    <h1 class="display-4 fw-bold">
      <i class="fas fa-user-circle me-3"></i>Profil utilisateur
    </h1>
    <p class="lead">Informations et activité du membre</p>
  </div>
</section>

<!-- Profile Content -->
<section class="py-5">
  <div class="container">
    <div class="row g-4">
      <!-- Sidebar - Informations -->
      <div class="col-lg-4">
        <div class="article-card">
          <div class="article-body text-center">
            <div class="mb-4">
              <div class="stat-icon mx-auto">
                <i class="fas fa-user"></i>
              </div>
            </div>
            <h3 class="article-title"><?php echo htmlspecialchars($membre['pseudoMemb']); ?></h3>
            <p class="text-muted mb-3">
              <i class="fas fa-shield-alt me-2"></i><?php echo htmlspecialchars($statut); ?>
            </p>
            <hr>
            <div class="text-start">
              <p class="mb-2">
                <strong><i class="fas fa-user me-2"></i>Nom complet :</strong><br>
                <?php echo htmlspecialchars($membre['prenomMemb'] . ' ' . $membre['nomMemb']); ?>
              </p>
              <p class="mb-2">
                <strong><i class="fas fa-envelope me-2"></i>Email :</strong><br>
                <?php echo htmlspecialchars($membre['eMailMemb']); ?>
              </p>
              <p class="mb-2">
                <strong><i class="fas fa-calendar-plus me-2"></i>Membre depuis :</strong><br>
                <?php echo date('d/m/Y', strtotime($membre['dtCreaMemb'])); ?>
              </p>
              <?php if(!empty($membre['dtMajMemb'])): ?>
              <p class="mb-2">
                <strong><i class="fas fa-calendar-check me-2"></i>Dernière mise à jour :</strong><br>
                <?php echo date('d/m/Y', strtotime($membre['dtMajMemb'])); ?>
              </p>
              <?php endif; ?>
              <p class="mb-0">
                <strong><i class="fas fa-shield-check me-2"></i>RGPD :</strong><br>
                <?php echo $membre['accordMemb'] == 1 ? '<span class="text-success">Accepté</span>' : '<span class="text-danger">Non accepté</span>'; ?>
              </p>
            </div>
          </div>
        </div>
      </div>

      <!-- Main Content - Articles -->
      <div class="col-lg-8">
        <div class="article-card">
          <div class="article-body">
            <h3 class="article-title">
              <i class="fas fa-newspaper me-2"></i>Articles publiés
            </h3>
            
            <?php if(empty($articles)): ?>
              <div class="alert alert-info">
                <i class="fas fa-info-circle me-2"></i>
                Ce membre n'a pas encore publié d'articles.
              </div>
            <?php else: ?>
              <div class="list-group">
                <?php foreach($articles as $article): ?>
                  <a href="/views/frontend/articles/article1.php?id=<?php echo $article['numArt']; ?>" 
                     class="list-group-item list-group-item-action">
                    <div class="d-flex w-100 justify-content-between">
                      <h5 class="mb-1">
                        <i class="fas fa-file-alt me-2"></i>
                        <?php echo htmlspecialchars($article['titreArt'] ?? 'Sans titre'); ?>
                      </h5>
                      <small class="text-muted">
                        <i class="fas fa-calendar me-1"></i>
                        <?php echo date('d/m/Y', strtotime($article['dtCreaArt'])); ?>
                      </small>
                    </div>
                    <p class="mb-1 text-muted">
                      <?php echo substr(strip_tags($article['chapArt'] ?? ''), 0, 100) . '...'; ?>
                    </p>
                  </a>
                <?php endforeach; ?>
              </div>
            <?php endif; ?>
          </div>
        </div>

        <!-- Statistics -->
        <div class="row g-3 mt-3">
          <div class="col-md-4">
            <div class="stat-card">
              <div class="stat-icon">
                <i class="fas fa-newspaper"></i>
              </div>
              <div class="stat-number"><?php echo count($articles); ?></div>
              <div class="stat-label">Articles</div>
            </div>
          </div>
          <div class="col-md-4">
            <div class="stat-card">
              <div class="stat-icon">
                <i class="fas fa-comments"></i>
              </div>
              <div class="stat-number">0</div>
              <div class="stat-label">Commentaires</div>
            </div>
          </div>
          <div class="col-md-4">
            <div class="stat-card">
              <div class="stat-icon">
                <i class="fas fa-heart"></i>
              </div>
              <div class="stat-number">0</div>
              <div class="stat-label">Likes</div>
            </div>
          </div>
        </div>
      </div>
    </div>

    <!-- Retour -->
    <div class="text-center mt-5">
      <a href="/index.php" class="btn-cartoon-outline">
        <i class="fas fa-arrow-left me-2"></i>Retour à l'accueil
      </a>
    </div>
  </div>
</section>

<?php include '../../footer.php'; ?>
                        </tr>
                        <tr>
                            <th>Nom :</th>
                            <td><?php echo htmlspecialchars($membre['nomMemb']); ?></td>
                        </tr>
                        <tr>
                            <th>Prénom :</th>
                            <td><?php echo htmlspecialchars($membre['prenomMemb']); ?></td>
                        </tr>
                        <tr>
                            <th>Email :</th>
                            <td><?php echo htmlspecialchars($membre['eMailMemb']); ?></td>
                        </tr>
                        <tr>
                            <th>Statut :</th>
                            <td><?php echo htmlspecialchars($statut); ?></td>
                        </tr>
                        <tr>
                            <th>RGPD :</th>
                            <td>
                                <?php 
                                if ($membre['accordMemb'] == 1) {
                                    echo "<span class='badge bg-success'>Accepté</span>";
                                } else {
                                    echo "<span class='badge bg-danger'>Refusé</span>";
                                }
                                ?>
                            </td>
                        </tr>
                    </table>

                    <?php
                    // Afficher le bouton modifier/supprimer uniquement si c'est le profil de l'utilisateur connecté
                    if (isset($_SESSION['numMemb']) && $_SESSION['numMemb'] == $numMemb) {
                        ?>
                        <div class="mt-4">
                            <a href="<?php echo ROOT_URL . '/views/backend/members/edit.php?numMemb=' . $numMemb; ?>" class="btn btn-warning">Modifier mon profil</a>
                            <a href="<?php echo ROOT_URL . '/api/members/delete.php?numMemb=' . $numMemb; ?>" class="btn btn-danger" onclick="return confirm('Êtes-vous sûr de vouloir supprimer votre compte ?');">Supprimer mon compte</a>
                        </div>
                        <?php
                    }
                    ?>
                </div>
            </div>
        </div>
    </div>
</div>

<?php
include '../../footer.php';
?>
