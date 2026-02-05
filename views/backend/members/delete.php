<?php
include '../header-admin.php';

if (!isset($_SESSION['numStat']) || ($_SESSION['numStat'] != 1 && $_SESSION['numStat'] != 2)) {
    header('Location: list.php?error=forbidden');
    exit();
}

$numMemb = $_GET['numMemb'] ?? '';
$membre = sql_select("MEMBRE", "*", "numMemb = $numMemb")[0];

$hasComments = (isset($_GET['error']) && $_GET['error'] === 'has_comments');
?>

<div class="container mt-4">
    <h1>Suppression Membre</h1>

    <?php if ($hasComments): ?>
        <div class="alert alert-danger">
            <strong>Action impossible :</strong> Ce membre a posté des commentaires. 
            Vous devez supprimer ses commentaires avant de pouvoir supprimer son compte.
        </div>
    <?php endif; ?>

    <form action="<?php echo ROOT_URL . '/api/members/delete.php' ?>" method="post">
        <input type="hidden" name="numMemb" value="<?php echo $numMemb; ?>" />
        
        <div class="form-group">
            <label>Détails du compte</label>
            <input class="form-control mb-2" type="text" value="Prénom : <?php echo $membre['prenomMemb']; ?>" disabled />
            <input class="form-control mb-2" type="text" value="Nom : <?php echo $membre['nomMemb']; ?>" disabled />
            <input class="form-control mb-2" type="text" value="Pseudo : <?php echo $membre['pseudoMemb']; ?>" disabled />
            <input class="form-control" type="text" value="Email : <?php echo $membre['eMailMemb']; ?>" disabled />
        </div>

        <div class="form-group mt-3">
            <a href="list.php" class="btn btn-primary">Retour</a>
            <?php if (!$hasComments): ?>
                <button type="submit" class="btn btn-danger">Confirmer la suppression</button>
            <?php endif; ?>
        </div>
    </form>
</div>