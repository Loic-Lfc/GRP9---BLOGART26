<?php
include '../header-admin.php';

if (!isset($_SESSION['numStat']) || ($_SESSION['numStat'] != 1 && $_SESSION['numStat'] != 2)) {
    header('Location: /index.php?error=access_denied');
    exit();
}

$statuts = sql_select("STATUT", "*");
?>

<div class="container mt-4">
    <h1>Statuts</h1>
    <table class="table table-striped">
        <thead>
            <tr>
                <th>Id</th>
                <th>Libellé</th>
                <th>Date Création</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($statuts as $statut) { ?>
                <tr>
                    <td><strong><?php echo $statut['numStat']; ?></strong></td>
                    <td><?php echo $statut['libStat']; ?></td>
                    <td><?php echo $statut['dtCreaStat']; ?></td>
                    <td>
                        <?php if (!in_array($statut['numStat'], [1, 2, 3])) { ?>
                            <a href="edit.php?numStat=<?php echo $statut['numStat']; ?>" class="btn btn-sm btn-outline-warning">Edit</a>
                            <a href="delete.php?numStat=<?php echo $statut['numStat']; ?>" class="btn btn-sm btn-outline-danger">Delete</a>
                        <?php } else { ?>
                            <span class="badge bg-secondary">Protégé</span>
                        <?php } ?>
                    </td>
                </tr>               
            <?php } ?>
        </tbody>
    </table>
    <div class="mb-5">
        <a href="create.php" class="btn btn-success">Créer</a>
    </div>
</div>