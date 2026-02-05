<?php
include '../header-admin.php';

if (!isset($_SESSION['numStat']) || ($_SESSION['numStat'] != 1 && $_SESSION['numStat'] != 2)) {
    header('Location: /index.php?error=access_denied');
    exit();
}

$numCom = $_GET['numCom'];
$query = "COMMENT INNER JOIN MEMBRE ON COMMENT.numMemb = MEMBRE.numMemb WHERE numCom = $numCom";
$comment = sql_select($query, "COMMENT.*, MEMBRE.pseudoMemb")[0];
?>

<div class="container mt-4">
    <h1>SUPPRIMER LE COMMENTAIRE</h1>
    <div class="alert alert-danger">
        Confirmez-vous la suppression du commentaire de <strong><?php echo $comment['pseudoMemb']; ?></strong> ?
        <p class="mt-3"><em>"<?php echo $comment['libCom']; ?>"</em></p>
    </div>
    <form action="../../../api/comments/delete.php" method="POST">
        <input type="hidden" name="numCom" value="<?php echo $numCom; ?>">
        <a href="list.php" class="btn btn-secondary">Annuler</a>
        <button type="submit" class="btn btn-danger">Supprimer définitivement</button>
    </form>
</div>