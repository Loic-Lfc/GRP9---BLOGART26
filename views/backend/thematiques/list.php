<?php
$pageTitle = "Gestion des Thématiques";
$pageIcon = "fas fa-folder";
include '../header-admin.php';

//Load all thematiques
$thematique = sql_select("THEMATIQUE", "*");
?>

<!-- Bootstrap default layout to display all thematiques in foreach -->
<div class="container">
    <div class="row">
        <div class="col-md-12">
            <h1>Thematiques</h1>
            <table class="table table-striped">
                <thead>
                    <tr>
                        <th>Id</th>
                        <th>Nom des thematiques</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach($thematique as $thematique_item){ ?>
                        <tr>
                            <td><?php echo($thematique_item['numThem']); ?></td>
                            <td><?php echo($thematique_item['libThem']); ?></td>
                            <td>
                                <a href="edit.php?numThem=<?php echo($thematique_item['numThem']); ?>" class="btn btn-primary">Edit</a>
                                <a href="delete.php?numThem=<?php echo($thematique_item['numThem']); ?>" class="btn btn-danger">Delete</a>
                            </td>
                        </tr>
                    <?php } ?>
                </tbody>
            </table>
            <a href="create.php" class="btn btn-success">Create</a>
        </div>
    </div>
</div>
<?php include '../footer-admin.php'; ?>