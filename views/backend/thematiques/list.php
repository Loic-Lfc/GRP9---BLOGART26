<?php
include '../header-admin.php';

if (!isset($_SESSION['numStat']) || ($_SESSION['numStat'] != 1 && $_SESSION['numStat'] != 2)) {
    header('Location: /index.php?error=access_denied');
    exit();
}

$thematiques = sql_select("THEMATIQUE", "*");
?>

<div class="container-fluid mt-4">
    <div class="row">
        <div class="col-md-12">
            <h1>Thématiques</h1>
            <table class="table table-striped">
                <thead>
                    <tr>
                        <th>Id</th>
                        <th>Libellé</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($thematiques as $them) { ?>
                        <tr>
                            <td><strong><?php echo $them['numThem']; ?></strong></td>
                            <td><?php echo $them['libThem']; ?></td>
                            <td>
                                <a href="edit.php?numThem=<?php echo $them['numThem']; ?>" class="btn btn-sm btn-outline-warning">Edit</a>
                                <a href="delete.php?numThem=<?php echo $them['numThem']; ?>" class="btn btn-sm btn-outline-danger">Delete</a>
                            </td>
                        </tr>               
                    <?php } ?>
                </tbody>
            </table>
            <div class="mb-5">
                <a href="create.php" class="btn btn-success">Créer</a>
            </div>
        </div>
    </div>
</div>