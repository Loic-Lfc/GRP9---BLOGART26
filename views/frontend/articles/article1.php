<?php
require_once '../../../header.php';
require_once '../../../config.php';

$db = sql_connect(); 

$id = $_GET['id'] ?? null;

if ($id) {
    $query = $db->prepare("SELECT * FROM ARTICLE WHERE numArt = ?");
    $query->execute([$id]);
    $article = $query->fetch();

    if ($article) {
?>
        <h1><?= htmlspecialchars($article['libTitrArt']) ?></h1>
        
        <?php if (!empty($article['urlPhotArt'])): ?>
            <div>
                <img src="<?= ROOT_URL ?>/src/uploads/<?= htmlspecialchars($article['urlPhotArt']) ?>" 
                    alt="Illustration" 
                    style="max-width: 100%; height: auto;">
            </div>
        <?php endif; ?>

        <p><strong><?= htmlspecialchars($article['libChapoArt']) ?></strong></p>
        
        <section>
            <h3><?= htmlspecialchars($article['libSsTitr1Art']) ?></h3>
            <p><?= nl2br(htmlspecialchars($article['parag1Art'])) ?></p>
        </section>

        <section>
            <h3><?= htmlspecialchars($article['libSsTitr2Art']) ?></h3>
            <p><?= nl2br(htmlspecialchars($article['parag2Art'])) ?></p>
        </section>

        <p><?= nl2br(htmlspecialchars($article['parag3Art'])) ?></p>
        
        <p><i><?= htmlspecialchars($article['libConclArt']) ?></i></p>
<?php
    } else {
        echo "Article introuvable.";
    }
} else {
    echo "ID manquant.";
}
?>