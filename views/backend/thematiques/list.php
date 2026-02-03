<?php
include '../../../header.php'; // contains the header and call to config.php

// On vérifie si l'utilisateur est admin ou modérateur
if (!isset($_SESSION['numStat']) || ($_SESSION['numStat'] != 1 && $_SESSION['numStat'] != 2)) {
    header('Location: ../../views/backend/members/list.php?error=forbidden');
    exit();
}

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
<?php
include '../../../footer.php'; // contains the footer