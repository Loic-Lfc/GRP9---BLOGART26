<?php
$pageTitle = "Supprimer une Thématique";
$pageIcon = "fas fa-trash";
include '../header-admin.php';

if(isset($_GET['numThem'])){
    $numThematique = $_GET['numThem'];
    $libThematique = sql_select("THEMATIQUE", "libThem", "numThem = $numThematique")[0]['libThem'];
}
?>

<!-- Bootstrap form to create a new statut -->
<div class="container">
    <div class="row">
        <div class="col-md-12">
            <h1>Suppression Statut</h1>
        </div>
        <div class="col-md-12">
            <!-- Form to create a new statut -->
            <form action="<?php echo ROOT_URL . '/api/thematiques/delete.php' ?>" method="post">
                <div class="form-group">
                    <label for="libThem">Nom du thematique</label>
                    <input id="numThem" name="numThem" class="form-control" style="display: none" type="text" value="<?php echo($numThematique); ?>" readonly="readonly" />
                    <input id="libThem" name="libThem" class="form-control" type="text" value="<?php echo($libThematique); ?>" readonly="readonly" disabled />
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