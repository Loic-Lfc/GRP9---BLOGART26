<?php
//load config - use absolute path
if (!defined('ROOT')) {
    $configPath = $_SERVER['DOCUMENT_ROOT'] . '/config.php';
    if(file_exists($configPath)) {
        require_once $configPath;
    }
}
?>
<!DOCTYPE html>
<html lang="fr-FR">
<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title><?php echo isset($pageTitle) ? $pageTitle : 'Administration'; ?> - Street Art BDX</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" />
    <link href="https://fonts.googleapis.com/css2?family=Permanent+Marker&family=Poppins:wght@300;400;600&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="/src/css/style.css" />
    <link rel="stylesheet" href="/src/css/dashboard.css" />
    <script src="https://www.google.com/recaptcha/api.js" async defer></script>
</head>
<body>
<div class="admin-layout">
    <!-- SIDEBAR -->
    <aside class="admin-sidebar">
        <a href="/index.php" class="admin-logo" style="text-decoration: none; color: inherit; display: flex; align-items: center; justify-content: center;">
            <img src="/src/images/murmures_bordeaux.png" alt="Murmures Bordeaux" style="height: 50px; width: auto;">
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
                <h1>
                    <?php if(isset($pageIcon)): ?>
                        <i class="<?php echo $pageIcon; ?> me-3"></i>
                    <?php endif; ?>
                    <?php echo isset($pageTitle) ? $pageTitle : 'Administration'; ?>
                </h1>
                <a href="/index.php" class="btn-cartoon-outline-sm">
                    <i class="fas fa-globe me-2"></i>Retour au site
                </a>
            </div>
        </header>

        <!-- Content -->
        <div class="admin-content">
