<!DOCTYPE html>
<html lang="fr-FR">
<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Dashboard Admin - Street Art BDX</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" />
    <link href="https://fonts.googleapis.com/css2?family=Fredoka:wght@300;400;500;600;700&family=Poppins:wght@300;400;600&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="../../src/css/style.css" />
</head>
<body>
<div class="admin-layout">
    <!-- SIDEBAR -->
    <aside class="admin-sidebar">
        <a href="/index.php" class="admin-logo" style="text-decoration: none; color: inherit; display: block;">
            <h3><i class="fas fa-spray-can me-2"></i>Street Art BDX</h3>
        </a>
        <nav class="admin-menu">
            <a href="/views/backend/dashboard.php" class="admin-menu-item active">
                <i class="fas fa-home"></i>
                <span>Dashboard</span>
            </a>
            <a href="/views/backend/articles/list.php" class="admin-menu-item">
                <i class="fas fa-newspaper"></i>
                <span>Articles</span>
            </a>
            <a href="/views/backend/members/list.php" class="admin-menu-item">
                <i class="fas fa-users"></i>
                <span>Membres</span>
            </a>
            <a href="/views/backend/comments/list.php" class="admin-menu-item">
                <i class="fas fa-comments"></i>
                <span>Commentaires</span>
            </a>
            <a href="/views/backend/keywords/list.php" class="admin-menu-item">
                <i class="fas fa-tags"></i>
                <span>Mots-clés</span>
            </a>
            <a href="/views/backend/thematiques/list.php" class="admin-menu-item">
                <i class="fas fa-folder"></i>
                <span>Thématiques</span>
            </a>
            <a href="/views/backend/statuts/list.php" class="admin-menu-item">
                <i class="fas fa-toggle-on"></i>
                <span>Statuts</span>
            </a>
            <a href="/views/backend/likes/list.php" class="admin-menu-item">
                <i class="fas fa-heart"></i>
                <span>Likes</span>
            </a>
            <hr>
            <a href="/index.php" class="admin-menu-item">
                <i class="fas fa-arrow-left"></i>
                <span>Retour au site</span>
            </a>
            <a href="/api/security/disconnect.php" class="admin-menu-item">
                <i class="fas fa-sign-out-alt"></i>
                <span>Déconnexion</span>
            </a>
        </nav>
    </aside>

    <!-- MAIN CONTENT -->
    <main class="admin-main">
        <!-- Header -->
        <header class="admin-header">
            <div class="d-flex justify-content-between align-items-center">
                <h1><i class="fas fa-tachometer-alt me-3"></i>Dashboard</h1>
                <a href="/index.php" class="btn-cartoon-outline-sm">
                    <i class="fas fa-globe me-2"></i>Retour au site
                </a>
            </div>
        </header>

        <!-- Content -->
        <div class="admin-content">
            <!-- Stats -->
            <div class="stats-grid">
                <div class="stat-card">
                    <div class="stat-icon">
                        <i class="fas fa-newspaper"></i>
                    </div>
                    <div class="stat-number">24</div>
                    <div class="stat-label">Articles</div>
                </div>
                <div class="stat-card">
                    <div class="stat-icon">
                        <i class="fas fa-users"></i>
                    </div>
                    <div class="stat-number">156</div>
                    <div class="stat-label">Membres</div>
                </div>
                <div class="stat-card">
                    <div class="stat-icon">
                        <i class="fas fa-comments"></i>
                    </div>
                    <div class="stat-number">89</div>
                    <div class="stat-label">Commentaires</div>
                </div>
                <div class="stat-card">
                    <div class="stat-icon">
                        <i class="fas fa-eye"></i>
                    </div>
                    <div class="stat-number">12.5k</div>
                    <div class="stat-label">Vues</div>
                </div>
            </div>

            <!-- Quick Actions -->
            <h2 class="admin-section-title">Actions rapides</h2>
            <div class="quick-actions">
                <div class="action-card">
                    <h3><i class="fas fa-newspaper me-2"></i>Articles</h3>
                    <p>Gérez vos articles de blog</p>
                    <div class="action-buttons">
                        <a href="/views/backend/articles/list.php" class="btn-cartoon-sm">
                            <i class="fas fa-list me-1"></i>List
                        </a>
                        <a href="/views/backend/articles/create.php" class="btn-cartoon-outline-sm">
                            <i class="fas fa-plus me-1"></i>Create
                        </a>
                    </div>
                </div>

                <div class="action-card">
                    <h3><i class="fas fa-users me-2"></i>Membres</h3>
                    <p>Gérez les utilisateurs</p>
                    <div class="action-buttons">
                        <a href="/views/backend/members/list.php" class="btn-cartoon-sm">
                            <i class="fas fa-list me-1"></i>List
                        </a>
                        <a href="/views/backend/members/create.php" class="btn-cartoon-outline-sm">
                            <i class="fas fa-plus me-1"></i>Create
                        </a>
                    </div>
                </div>

                <div class="action-card">
                    <h3><i class="fas fa-comments me-2"></i>Commentaires</h3>
                    <p>Modérez les commentaires</p>
                    <div class="action-buttons">
                        <a href="/views/backend/comments/list.php" class="btn-cartoon-sm">
                            <i class="fas fa-list me-1"></i>List
                        </a>
                        <a href="/views/backend/comments/create.php" class="btn-cartoon-outline-sm">
                            <i class="fas fa-plus me-1"></i>Create
                        </a>
                    </div>
                </div>

                <div class="action-card">
                    <h3><i class="fas fa-tags me-2"></i>Mots-clés</h3>
                    <p>Organisez avec des tags</p>
                    <div class="action-buttons">
                        <a href="/views/backend/keywords/list.php" class="btn-cartoon-sm">
                            <i class="fas fa-list me-1"></i>List
                        </a>
                        <a href="/views/backend/keywords/create.php" class="btn-cartoon-outline-sm">
                            <i class="fas fa-plus me-1"></i>Create
                        </a>
                    </div>
                </div>

                <div class="action-card">
                    <h3><i class="fas fa-folder me-2"></i>Thématiques</h3>
                    <p>Catégorisez vos contenus</p>
                    <div class="action-buttons">
                        <a href="/views/backend/thematiques/list.php" class="btn-cartoon-sm">
                            <i class="fas fa-list me-1"></i>List
                        </a>
                        <a href="/views/backend/thematiques/create.php" class="btn-cartoon-outline-sm">
                            <i class="fas fa-plus me-1"></i>Create
                        </a>
                    </div>
                </div>

                <div class="action-card">
                    <h3><i class="fas fa-toggle-on me-2"></i>Statuts</h3>
                    <p>Gérez les statuts</p>
                    <div class="action-buttons">
                        <a href="/views/backend/statuts/list.php" class="btn-cartoon-sm">
                            <i class="fas fa-list me-1"></i>List
                        </a>
                        <a href="/views/backend/statuts/create.php" class="btn-cartoon-outline-sm">
                            <i class="fas fa-plus me-1"></i>Create
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </main>
</div>

<!-- Footer -->
<footer class="footer-cartoon admin-footer py-4">
    <div class="container">
        <div class="row">
            <div class="col-md-6">
                <h5 class="fw-bold"><i class="fas fa-spray-can me-2"></i>Street Art BDX Admin</h5>
                <p class="text-light-gray mb-0">Gérez votre blog sur le street art bordelais</p>
            </div>
            <div class="col-md-6 text-md-end">
                <p class="text-light-gray mb-0">&copy; 2026 Street Art Bordeaux</p>
            </div>
        </div>
    </div>
</footer>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>