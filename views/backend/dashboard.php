<?php
$pageTitle = "Dashboard";
$pageIcon = "fas fa-home";
include '../header-admin.php';

// On vérifie si l'utilisateur est admin ou modérateur
if (!isset($_SESSION['numStat']) || ($_SESSION['numStat'] != 1 && $_SESSION['numStat'] != 2)) {
    header('Location: /views/backend/security/login.php?error=forbidden');
    exit();
}

// Récupérer les statistiques
$countArticles = sql_select('ARTICLE', 'COUNT(*) as total', '1=1')[0]['total'] ?? 0;
$countMembers = sql_select('MEMBRE', 'COUNT(*) as total', '1=1')[0]['total'] ?? 0;
$countComments = sql_select('COMMENTAIRE', 'COUNT(*) as total', '1=1')[0]['total'] ?? 0;
$countLikes = sql_select('LIKER', 'COUNT(*) as total', '1=1')[0]['total'] ?? 0;

?>

<!-- Statistics Grid -->
<div class="stats-grid">
    <div class="stat-card">
        <div class="stat-icon">
            <i class="fas fa-newspaper"></i>
        </div>
        <div class="stat-number"><?php echo $countArticles; ?></div>
        <div class="stat-label">Articles publiés</div>
    </div>
    
    <div class="stat-card">
        <div class="stat-icon">
            <i class="fas fa-users"></i>
        </div>
        <div class="stat-number"><?php echo $countMembers; ?></div>
        <div class="stat-label">Membres</div>
    </div>
    
    <div class="stat-card">
        <div class="stat-icon">
            <i class="fas fa-comments"></i>
        </div>
        <div class="stat-number"><?php echo $countComments; ?></div>
        <div class="stat-label">Commentaires</div>
    </div>
    
    <div class="stat-card">
        <div class="stat-icon">
            <i class="fas fa-heart"></i>
        </div>
        <div class="stat-number"><?php echo $countLikes; ?></div>
        <div class="stat-label">Likes</div>
    </div>
</div>

<!-- Quick Actions -->
<h2 class="admin-section-title mt-5">
    <i class="fas fa-bolt me-2"></i>Actions rapides
</h2>

<div class="quick-actions">
    <div class="action-card">
        <h3><i class="fas fa-newspaper me-2"></i>Articles</h3>
        <p>Gérer les articles du blog</p>
        <div class="action-buttons">
            <a href="/views/backend/articles/list.php" class="btn btn-primary btn-sm">
                <i class="fas fa-list me-1"></i>Liste
            </a>
            <a href="/views/backend/articles/create.php" class="btn btn-success btn-sm">
                <i class="fas fa-plus me-1"></i>Créer
            </a>
        </div>
    </div>
    
    <div class="action-card">
        <h3><i class="fas fa-users me-2"></i>Membres</h3>
        <p>Gérer les utilisateurs</p>
        <div class="action-buttons">
            <a href="/views/backend/members/list.php" class="btn btn-primary btn-sm">
                <i class="fas fa-list me-1"></i>Liste
            </a>
            <a href="/views/backend/members/create.php" class="btn btn-success btn-sm">
                <i class="fas fa-plus me-1"></i>Créer
            </a>
        </div>
    </div>
    
    <div class="action-card">
        <h3><i class="fas fa-comments me-2"></i>Commentaires</h3>
        <p>Modérer les commentaires</p>
        <div class="action-buttons">
            <a href="/views/backend/comments/list.php" class="btn btn-primary btn-sm">
                <i class="fas fa-list me-1"></i>Liste
            </a>
            <a href="/views/backend/comments/create.php" class="btn btn-success btn-sm">
                <i class="fas fa-plus me-1"></i>Créer
            </a>
        </div>
    </div>
    
    <div class="action-card">
        <h3><i class="fas fa-tags me-2"></i>Mots-clés</h3>
        <p>Gérer les tags des articles</p>
        <div class="action-buttons">
            <a href="/views/backend/keywords/list.php" class="btn btn-primary btn-sm">
                <i class="fas fa-list me-1"></i>Liste
            </a>
            <a href="/views/backend/keywords/create.php" class="btn btn-success btn-sm">
                <i class="fas fa-plus me-1"></i>Créer
            </a>
        </div>
    </div>
    
    <div class="action-card">
        <h3><i class="fas fa-folder me-2"></i>Thématiques</h3>
        <p>Gérer les catégories</p>
        <div class="action-buttons">
            <a href="/views/backend/thematiques/list.php" class="btn btn-primary btn-sm">
                <i class="fas fa-list me-1"></i>Liste
            </a>
            <a href="/views/backend/thematiques/create.php" class="btn btn-success btn-sm">
                <i class="fas fa-plus me-1"></i>Créer
            </a>
        </div>
    </div>
    
    <div class="action-card">
        <h3><i class="fas fa-toggle-on me-2"></i>Statuts</h3>
        <p>Gérer les statuts utilisateur</p>
        <div class="action-buttons">
            <a href="/views/backend/statuts/list.php" class="btn btn-primary btn-sm">
                <i class="fas fa-list me-1"></i>Liste
            </a>
            <a href="/views/backend/statuts/create.php" class="btn btn-success btn-sm">
                <i class="fas fa-plus me-1"></i>Créer
            </a>
        </div>
    </div>
</div>

<!-- Recent Activity -->
<h2 class="admin-section-title mt-5">
    <i class="fas fa-clock me-2"></i>Activité récente
</h2>

<div class="card">
    <div class="card-body">
        <div class="alert alert-info mb-0">
            <i class="fas fa-info-circle me-2"></i>
            Bienvenue sur le tableau de bord de <strong>Street Art Bordeaux</strong>. Utilisez le menu latéral pour naviguer dans l'administration.
        </div>
    </div>
</div>

<?php include '../../footer-admin.php'; ?>