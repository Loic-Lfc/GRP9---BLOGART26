<?php
// Fonction pour transformer le BBCode en HTML
function parseBBCode($text) {
    $text = preg_replace('/\[b\](.*?)\[\/b\]/is', '<strong>$1</strong>', $text);
    $text = preg_replace('/\[i\](.*?)\[\/i\]/is', '<em>$1</em>', $text);
    
    // Gestion de l'ancre : [anchor=nom]
    $text = preg_replace('/\[anchor=(.*?)\]/is', '<span id="$1"></span>', $text);
    
    // Gestion du lien vers l'ancre : [goto=nom]Texte[/goto]
    $text = preg_replace('/\[goto=(.*?)\](.*?)\[\/goto\]/is', '<a href="#$1">$2</a>', $text);

    return nl2br($text);
}

include '../../../header.php';

// On récupère les articles avec une jointure pour avoir le nom de la thématique directement
$queryArticles = "ARTICLE 
                INNER JOIN THEMATIQUE ON ARTICLE.numThem = THEMATIQUE.numThem";
$articles = sql_select($queryArticles, "ARTICLE.*, THEMATIQUE.libThem");
?>

<div class="container-fluid mt-4">
    <div class="row">
        <div class="col-md-12">
            <h1>Articles</h1>
            <table class="table table-striped border">
                <thead>
                    <tr>
                        <th>Id</th>
                        <th>Date</th>
                        <th>Titre</th>
                        <th>Chapeau</th>
                        <th>Accroche</th>
                        <th>Mots Clés</th>
                        <th>Thématique</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($articles as $article) { 
                        // Récupération des mots-clés pour l'article actuel
                        $numArt = $article['numArt'];
                        $jointureMots = "MOTCLEARTICLE 
                                        INNER JOIN MOTCLE ON MOTCLEARTICLE.numMotCle = MOTCLE.numMotCle";
                        $motsClesArray = sql_select($jointureMots, "libMotCle", "numArt = $numArt");
                        
                        // Préparation de la chaîne des mots-clés
                        $listeMots = "";
                        if (!empty($motsClesArray)) {
                            $nomsMots = array_column($motsClesArray, 'libMotCle');
                            $listeMots = implode(', ', $nomsMots);
                        }
                    ?>
                        <tr>
                            <td><strong><?php echo $article['numArt']; ?></strong></td>
                            <td><?php echo str_replace(':', '/', $article['dtCreaArt']); ?></td>
                            <td><?php echo $article['libTitrArt']; ?></td>
                            
                            <td><?php echo parseBBCode(mb_strimwidth($article['libChapoArt'], 0, 100, " [...]")); ?></td>
                            
                            <td><?php echo mb_strimwidth($article['libAccrochArt'], 0, 100, " [...]"); ?></td>
                            
                            <td><?php echo $listeMots ?: "Aucun"; ?></td>
                            
                            <td><?php echo $article['libThem']; ?></td>
                            
                            <td>
                                <a href="edit.php?numArt=<?php echo $article['numArt']; ?>" class="btn btn-sm btn-outline-warning w-100 mb-1">Edit</a>
                                <a href="delete.php?numArt=<?php echo $article['numArt']; ?>" class="btn btn-sm btn-outline-danger w-100">Delete</a>
                            </td>
                        </tr>
                    <?php } ?>
                </tbody>
            </table>
            <div class="mb-5">
                <a href="create.php" class="btn btn-success">Create New Article</a>
            </div>
        </div>
    </div>
</div>

<?php include '../../../footer.php'; ?>