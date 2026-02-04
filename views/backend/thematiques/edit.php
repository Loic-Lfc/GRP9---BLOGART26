<?php
include '../header-admin.php';

// On vérifie si l'utilisateur est admin ou modérateur
if (!isset($_SESSION['numStat']) || ($_SESSION['numStat'] != 1 && $_SESSION['numStat'] != 2)) {
    header('Location: ../../views/backend/members/list.php?error=forbidden');
    exit();
}

if (isset($_GET['numThem'])) {
    $numThematique = $_GET['numThem'];
    $libThematique = sql_select("THEMATIQUE", "libThem", "numThem = $numThematique")[0]['libThem'];
}
?>

<!-- Bootstrap form to create a new statut -->
<div class="container">
    <div class="row">
        <div class="col-md-12">
            <h1>Modification Statut</h1>
        </div>
        <div class="col-md-12">
            <!-- Form to create a new statut -->
            <form action="<?php echo ROOT_URL . '/api/thematiques/update.php' ?>" method="post">
                <div class="form-group">
                    <label for="libThem">Nom du thematique</label>
                    <input id="numThem" name="numThem" class="form-control" style="display: none" type="text"
                        value="<?php echo ($numThematique); ?>" readonly="readonly" />
                    <input id="libThem" name="libThem" class="form-control" type="text"
                        value="<?php echo ($libThematique); ?>" />
                </div>
                <br />
                <div class="form-group mt-2">
                    <a href="list.php" class="btn btn-primary">List</a>
                    <button type="submit" class="btn btn-primary">Modifier</button>
                </div>
            </form>
        </div>
    </div>
</div>