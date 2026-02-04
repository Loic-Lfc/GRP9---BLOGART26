<?php
include '../header-admin.php'; // contains the header and call to config.php

// On vérifie si l'utilisateur est admin ou modérateur
if (!isset($_SESSION['numStat']) || ($_SESSION['numStat'] != 1 && $_SESSION['numStat'] != 2)) {
    header('Location: ../../views/backend/members/list.php?error=forbidden');
    exit();
}

//Load all statuts
$statuts = sql_select("STATUT", "*");
?>

<!-- Bootstrap default layout to display all statuts in foreach -->
<div class="container">
    <div class="row">
        <div class="col-md-12">
            <h1>Statuts</h1>
            <table class="table table-striped">
                <thead>
                    <tr>
                        <th>Id</th>
                        <th>Nom des statuts</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach($statuts as $statut){ ?>
                        <tr>
                            <td><?php echo($statut['numStat']); ?></td>
                            <td><?php echo($statut['libStat']); ?></td>
                            <td>
                                <a href="edit.php?numStat=<?php echo($statut['numStat']); ?>" class="btn btn-primary">Edit</a>
                                <a href="delete.php?numStat=<?php echo($statut['numStat']); ?>" class="btn btn-danger">Delete</a>
                            </td>
                        </tr>
                    <?php } ?>
                </tbody>
            </table>
            <a href="create.php" class="btn btn-success">Create</a>
        </div>
    </div>
</div>
</div>