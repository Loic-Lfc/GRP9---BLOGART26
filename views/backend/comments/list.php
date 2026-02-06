<?php
include '../header-admin.php';

if (!isset($_SESSION['numStat']) || ($_SESSION['numStat'] != 1 && $_SESSION['numStat'] != 2)) {
    header('Location: /index.php?error=access_denied');
    exit();
}

$queryComments = "COMMENT 
                 INNER JOIN ARTICLE ON COMMENT.numArt = ARTICLE.numArt
                 INNER JOIN MEMBRE ON COMMENT.numMemb = MEMBRE.numMemb";

$comments = sql_select($queryComments, "COMMENT.*, ARTICLE.libTitrArt, MEMBRE.pseudoMemb");
?>

<div class="container-fluid mt-4">
    <div class="row">
        <div class="col-md-12">
            <h1>Commentaires</h1>
            <table class="table table-striped">
                <thead>
                    <tr>
                        <th>Id</th>
                        <th>Date</th>
                        <th>Contenu</th>
                        <th>Validé le</th>
                        <th>Statut Mod</th>
                        <th>Article</th>
                        <th>Membre</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($comments as $comment) { ?>
                        <tr>
                            <td><strong><?php echo $comment['numCom']; ?></strong></td>
                            <td><?php echo $comment['dtCreaCom']; ?></td>
                            <td><?php echo mb_strimwidth($comment['libCom'], 0, 80, " [...]"); ?></td>
                            <td><?php echo $comment['dtModCom'] ?: 'Jamais'; ?></td>
                            <td>
                                <span class="badge <?php echo $comment['attModOK'] ? 'bg-success' : 'bg-warning'; ?>">
                                    <?php echo $comment['attModOK'] ? 'Validé' : 'En attente'; ?>
                                </span>
                            </td>
                            <td><?php echo $comment['libTitrArt']; ?></td>
                            <td><?php echo $comment['pseudoMemb']; ?></td>
                            <td>
                                <?php if (!$comment['attModOK']) { ?>
                                    <form action="../../../api/comments/update.php?numCom=<?php echo $comment['numCom']; ?>" method="POST" style="display: inline;">
                                        <button type="submit" class="btn btn-sm btn-outline-success w-100 mb-1">Valider</button>
                                    </form>
                                <?php } ?>
                                <a href="delete.php?numCom=<?php echo $comment['numCom']; ?>" class="btn btn-sm btn-outline-danger w-100">Supprimer</a>
                            </td>
                        </tr>               
                    <?php } ?>
                </tbody>
            </table>
        </div>
    </div>
</div>