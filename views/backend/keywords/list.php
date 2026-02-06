<?php
include '../header-admin.php';

if (!isset($_SESSION['numStat']) || ($_SESSION['numStat'] != 1 && $_SESSION['numStat'] != 2)) {
    header('Location: /index.php?error=access_denied');
    exit();
}

$motscles = sql_select("MOTCLE", "*");
?>

<div class="container-fluid mt-4">
    <div class="row">
        <div class="col-md-12">
            <h1>Mots Clés</h1>
            <table class="table table-striped">
                <thead>
                    <tr>
                        <th>Id</th>
                        <th>Désignation</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($motscles as $mot) { ?>
                        <tr>
                            <td><strong><?php echo $mot['numMotCle']; ?></strong></td>
                            <td><?php echo $mot['libMotCle']; ?></td>
                            <td>
                                <a href="edit.php?numMotCle=<?php echo $mot['numMotCle']; ?>" class="btn btn-sm btn-outline-warning">Edit</a>
                                <a href="delete.php?numMotCle=<?php echo $mot['numMotCle']; ?>" class="btn btn-sm btn-outline-danger">Delete</a>
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