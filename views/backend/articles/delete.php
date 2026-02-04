<?php
include '../header-admin.php';

if (!isset($_SESSION['numStat']) || ($_SESSION['numStat'] != 1 && $_SESSION['numStat'] != 2)) {
    header('Location: /index.php?error=access_denied');
    exit();
}

$articleFound = false;
if (isset($_GET['numArt'])) {
    $numArticle = intval($_GET['numArt']);
    $articleData = sql_select("ARTICLE", "*", "numArt = $numArticle");

    if (!empty($articleData)) {
        $articleFound = true;
        $row = $articleData[0];
        $libTitrArt = $row['libTitrArt'];
        $libChapoArt = $row['libChapoArt'];
        $libAccrochArt = $row['libAccrochArt'];
        $parag1Art = $row['parag1Art'];
        $libSsTitr1Art = $row['libSsTitr1Art'];
        $parag2Art = $row['parag2Art'];
        $libSsTitr2Art = $row['libSsTitr2Art'];
        $parag3Art = $row['parag3Art'];
        $libConclArt = $row['libConclArt'];
        $urlPhotArt = $row['urlPhotArt'];
    }
}

if (!$articleFound && !isset($_GET['error'])) {
    header('Location: list.php?error=not_found');
    exit();
}
?>

<div class="container">
    <?php if (isset($_GET['error'])): ?>
        <div class="alert alert-danger alert-dismissible fade show mt-3" role="alert">
            <strong>Erreur !</strong> 
            <?php 
                switch($_GET['error']) {
                    case 'sql_error': echo "Impossible de supprimer l'article (contraintes de données ou erreur serveur)."; break;
                    case 'not_found': echo "L'article demandé n'existe pas ou a déjà été supprimé."; break;
                    default: echo "Une erreur inconnue est survenue.";
                }
            ?>
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    <?php endif; ?>

    <div class="row">
        <div class="col-md-12">
            <h1>Suppression Article</h1>
        </div>
        <div class="col-md-12">
            <form action="<?php echo ROOT_URL . '/api/articles/delete.php' ?>" method="post">
                <input type="hidden" name="numArt" value="<?php echo $numArticle; ?>" />
                <div class="form-group">
                    <label for="libTitrArt">Article</label>
                    <textarea class="form-control" rows="10" readonly disabled><?php
                        echo $libTitrArt . "\n\n";
                        echo $libChapoArt . "\n\n";
                        echo $libAccrochArt . "\n\n";
                        echo $parag1Art . "\n\n";
                        echo $libSsTitr1Art . "\n\n";
                        echo $parag2Art . "\n\n";
                        echo $libSsTitr2Art . "\n\n";
                        echo $parag3Art . "\n\n";
                        echo $libConclArt;
                    ?></textarea>
                    <?php if(!empty($urlPhotArt)): ?>
                        <div class="mt-3">
                            <img src="/src/uploads/<?php echo $urlPhotArt; ?>" alt="Image" style="max-width: 100%; height: auto; border: 1px solid #ddd;"/>
                        </div>
                    <?php endif; ?>
                </div>
                <br />
                <div class="form-group mt-2">
                    <a href="list.php" class="btn btn-primary">Retour à la liste</a>
                    <button type="submit" class="btn btn-danger">Confirmer la suppression</button>
                </div>
            </form>
        </div>
    </div>
</div><?php include '../footer-admin.php';
?>