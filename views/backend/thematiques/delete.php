<?php
include '../header-admin.php';

if (!isset($_SESSION['numStat']) || ($_SESSION['numStat'] != 1 && $_SESSION['numStat'] != 2)) {
    header('Location: ../../views/backend/members/list.php?error=forbidden');
    exit();
}

if(isset($_GET['numThem'])){
    $numThematique = $_GET['numThem'];
    $libThematique = sql_select("THEMATIQUE", "libThem", "numThem = '$numThematique'")[0]['libThem'];
    
    $articlesLies = [];
    if (isset($_GET['error']) && $_GET['error'] === 'is_linked') {
        $articlesLies = sql_select("ARTICLE", "libTitrArt", "numThem = '$numThematique'");
    }
}
?>

<div class="container mt-4">
    <h1>Suppression Thématique</h1>

    <?php if (!empty($articlesLies)): ?>
        <div class="alert alert-danger">
            <strong>Action impossible :</strong> Cette thématique est utilisée par les articles suivants :
            <ul>
                <?php foreach ($articlesLies as $art): ?>
                    <li><?php echo $art['libTitrArt']; ?></li>
                <?php endforeach; ?>
            </ul>
            Modifiez ces articles avant de pouvoir supprimer la thématique.
        </div>
    <?php endif; ?>

    <form action="<?php echo ROOT_URL . '/api/thematiques/delete.php' ?>" method="post">
        <div class="form-group">
            <label for="libThem">Nom de la thématique</label>
            <input name="numThem" type="hidden" value="<?php echo $numThematique; ?>" />
            <input class="form-control" type="text" value="<?php echo $libThematique; ?>" readonly disabled />
        </div>
        <div class="form-group mt-3">
            <a href="list.php" class="btn btn-primary">Retour</a>
            <?php if (empty($articlesLies)): ?>
                <button type="submit" class="btn btn-danger">Confirmer delete ?</button>
            <?php endif; ?>
        </div>
    </form>
</div>