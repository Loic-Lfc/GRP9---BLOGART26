<?php
include '../header-admin.php';

if (!isset($_SESSION['numStat']) || ($_SESSION['numStat'] != 1 && $_SESSION['numStat'] != 2)) {
    header('Location: ../../views/backend/members/list.php?error=forbidden');
    exit();
}

if(isset($_GET['numMotCle'])){
    $numMotCle = $_GET['numMotCle'];
    $libMotCle = sql_select("motcle", "libMotCle", "numMotCle = $numMotCle")[0]['libMotCle'];
    
    $articlesLies = [];
    if (isset($_GET['error']) && $_GET['error'] === 'is_linked') {
        $query = "MOTCLEARTICLE INNER JOIN ARTICLE ON MOTCLEARTICLE.numArt = ARTICLE.numArt WHERE numMotCle = $numMotCle";
        $articlesLies = sql_select($query, "ARTICLE.libTitrArt");
    }
}
?>

<div class="container mt-4">
    <h1>Suppression mot clé</h1>

    <?php if (!empty($articlesLies)): ?>
        <div class="alert alert-danger">
            <strong>Action impossible :</strong> Ce mot-clé est utilisé par les articles suivants :
            <ul>
                <?php foreach ($articlesLies as $art): ?>
                    <li><?php echo $art['libTitrArt']; ?></li>
                <?php endforeach; ?>
            </ul>
            Veuillez retirer ce mot-clé de ces articles avant de le supprimer.
        </div>
    <?php endif; ?>

    <form action="<?php echo ROOT_URL . '/api/keywords/delete.php' ?>" method="post">
        <div class="form-group">
            <label for="libMotCle">Nom du mot clé</label>
            <input name="numMotCle" type="hidden" value="<?php echo $numMotCle; ?>" />
            <input class="form-control" type="text" value="<?php echo $libMotCle; ?>" readonly disabled />
        </div>
        <div class="form-group mt-3">
            <a href="list.php" class="btn btn-primary">Retour</a>
            <?php if (empty($articlesLies)): ?>
                <button type="submit" class="btn btn-danger">Confirmer delete ?</button>
            <?php endif; ?>
        </div>
    </form>
</div>