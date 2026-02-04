<?php include 'header-admin.php'; ?>

            <!-- Quick Actions -->
            <h2 class="admin-section-title">ACTIONS RAPIDES</h2>
            <div class="quick-actions">
                <div class="action-card action-articles">
                    <div class="action-icon">
                        <i class="fas fa-newspaper"></i>
                    </div>
                    <h3>Articles</h3>
                    <p>Gérez vos articles de blog</p>
                    <div class="action-buttons">
                        <a href="/views/backend/articles/list.php" class="btn-cartoon-sm">
                            <i class="fas fa-list me-1"></i>Liste
                        </a>
                        <a href="/views/backend/articles/create.php" class="btn-cartoon-outline-sm">
                            <i class="fas fa-plus me-1"></i>Créer
                        </a>
                    </div>
                </div>

                <div class="action-card action-members">
                    <div class="action-icon">
                        <i class="fas fa-users"></i>
                    </div>
                    <h3>Membres</h3>
                    <p>Gérez les utilisateurs</p>
                    <div class="action-buttons">
                        <a href="/views/backend/members/list.php" class="btn-cartoon-sm">
                            <i class="fas fa-list me-1"></i>Liste
                        </a>
                        <a href="/views/backend/members/create.php" class="btn-cartoon-outline-sm">
                            <i class="fas fa-plus me-1"></i>Créer
                        </a>
                    </div>
                </div>

                <div class="action-card action-comments">
                    <div class="action-icon">
                        <i class="fas fa-comments"></i>
                    </div>
                    <h3>Commentaires</h3>
                    <p>Modérez les commentaires</p>
                    <div class="action-buttons">
                        <a href="/views/backend/comments/list.php" class="btn-cartoon-sm">
                            <i class="fas fa-list me-1"></i>Liste
                        </a>
                        <a href="/views/backend/comments/create.php" class="btn-cartoon-outline-sm">
                            <i class="fas fa-plus me-1"></i>Créer
                        </a>
                    </div>
                </div>

                <div class="action-card action-keywords">
                    <div class="action-icon">
                        <i class="fas fa-tags"></i>
                    </div>
                    <h3>Mots-clés</h3>
                    <p>Organisez avec des tags</p>
                    <div class="action-buttons">
                        <a href="/views/backend/keywords/list.php" class="btn-cartoon-sm">
                            <i class="fas fa-list me-1"></i>Liste
                        </a>
                        <a href="/views/backend/keywords/create.php" class="btn-cartoon-outline-sm">
                            <i class="fas fa-plus me-1"></i>Créer
                        </a>
                    </div>
                </div>

                <div class="action-card action-thematiques">
                    <div class="action-icon">
                        <i class="fas fa-folder"></i>
                    </div>
                    <h3>Thématiques</h3>
                    <p>Catégorisez vos contenus</p>
                    <div class="action-buttons">
                        <a href="/views/backend/thematiques/list.php" class="btn-cartoon-sm">
                            <i class="fas fa-list me-1"></i>Liste
                        </a>
                        <a href="/views/backend/thematiques/create.php" class="btn-cartoon-outline-sm">
                            <i class="fas fa-plus me-1"></i>Créer
                        </a>
                    </div>
                </div>

                <div class="action-card action-statuts">
                    <div class="action-icon">
                        <i class="fas fa-toggle-on"></i>
                    </div>
                    <h3>Statuts</h3>
                    <p>Gérez les statuts</p>
                    <div class="action-buttons">
                        <a href="/views/backend/statuts/list.php" class="btn-cartoon-sm">
                            <i class="fas fa-list me-1"></i>Liste
                        </a>
                        <a href="/views/backend/statuts/create.php" class="btn-cartoon-outline-sm">
                            <i class="fas fa-plus me-1"></i>Créer
                        </a>
                    </div>
                </div>
            </div>
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
                        <i class="fas fa-heart"></i>
                    </div>
                    <div class="stat-number">342</div>
                    <div class="stat-label">Likes</div>
                </div>
            </div>
        </div>
    </main>
</div>