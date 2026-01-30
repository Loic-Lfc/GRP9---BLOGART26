<?php
include '../../../header.php';

if(isset($_GET['numArt'])){
    $numArticle = $_GET['numArt'];
    $libTitrArt = sql_select("ARTICLE", "libTitrArt", "numArt = $numArticle")[0]['libTitrArt'];
    $libChapoArt = sql_select("ARTICLE", "libChapoArt", "numArt = $numArticle")[0]['libChapoArt'];
    $libAccrochArt = sql_select("ARTICLE", "libAccrochArt", "numArt = $numArticle")[0]['libAccrochArt'];
    $parag1Art = sql_select("ARTICLE", "parag1Art", "numArt = $numArticle")[0]['parag1Art'];
    $libSsTitr1Art = sql_select("ARTICLE", "libSsTitr1Art", "numArt = $numArticle")[0]['libSsTitr1Art'];
    $parag2Art = sql_select("ARTICLE", "parag2Art", "numArt = $numArticle")[0]['parag2Art'];
    $libSsTitr2Art = sql_select("ARTICLE", "libSsTitr2Art", "numArt = $numArticle")[0]['libSsTitr2Art'];
    $parag3Art = sql_select("ARTICLE", "parag3Art", "numArt = $numArticle")[0]['parag3Art'];
    $libConclArt = sql_select("ARTICLE", "libConclArt", "numArt = $numArticle")[0]['libConclArt'];
    $urlPhotArt = sql_select("ARTICLE", "urlPhotArt", "numArt = $numArticle")[0]['urlPhotArt'];
}
?>

<!-- Bootstrap form to create a new statut -->
<div class="container">
    <div class="row">
        <div class="col-md-12">
            <h1>Suppression Article</h1>
        </div>
        <div class="col-md-12">
            <!-- Form to create a new statut -->
            <form action="<?php echo ROOT_URL . '/api/articles/delete.php' ?>" method="post" action="delete.php">
                <input type="hidden" name="numArt" value="<?php echo($numArticle); ?>" />
                <div class="form-group">
                    <label for="libTitrArt">Article</label>
                    <textarea class="form-control auto-height" rows="20" readonly disabled>
                    <?php
                    echo $libTitrArt . "\n\n";
                    echo $libChapoArt . "\n\n";
                    echo $libAccrochArt . "\n\n";
                    echo $parag1Art . "\n\n";
                    echo $libSsTitr1Art . "\n\n";
                    echo $parag2Art . "\n\n";
                    echo $libSsTitr2Art . "\n\n";
                    echo $parag3Art . "\n\n";
                    echo $libConclArt;
                    ?>
                    </textarea>
                    <img src="/src/uploads/<?php echo $urlPhotArt; ?>" alt="Image de l'article" width="600"/>
                </div>
                <br />
                <div class="form-group mt-2">
                    <a href="list.php" class="btn btn-primary">List</a>
                    <button type="submit" class="btn btn-danger">Confirmer delete ?</button>
                </div>
            </form>
        </div>
    </div>
</div>