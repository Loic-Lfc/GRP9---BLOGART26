<?php
include '../../../header.php';

// On vérifie si l'utilisateur est admin ou modérateur
if (!isset($_SESSION['numStat']) || ($_SESSION['numStat'] != 1 && $_SESSION['numStat'] != 2)) {
    header('Location: ../../views/backend/members/list.php?error=forbidden');
    exit();
}

$membres = sql_select("MEMBRE", "*");
?>

<div class="container">
    <div class="row">
        <div class="col-md-12">
            <h1>Membres</h1>

            <?php if (isset($_GET['error'])): ?>

                <!-- Messages d'erreur -->
                <div class="alert alert-danger">
                    <?php
                    if ($_GET['error'] == 'forbidden') 
                        echo "Vous n'avez pas les droits nécessaires pour effectuer cette action.";
                    else if ($_GET['error'] == 'admin_protected') 
                        echo "Impossible de supprimer le compte Administrateur : ce compte est protégé.";
                    ?>
                </div>
            <?php endif; ?>

            <table class="table table-striped">
                <thead>
                    <tr>
                        <th>Id</th>
                        <th>Pseudo</th>
                        <th>Nom</th>
                        <th>Prénom</th>
                        <th>Email</th>
                        <th>Mot De Passe</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach($membres as $membre){ ?>
                        <tr>
                            <td><?php echo($membre['numMemb']); ?></td>
                            <td><?php echo($membre['pseudoMemb']); ?></td>
                            <td><?php echo($membre['nomMemb']); ?></td>
                            <td><?php echo($membre['prenomMemb']); ?></td>
                            <td><?php echo($membre['eMailMemb']); ?></td>
                            <td style="max-width: 150px; overflow: hidden; text-overflow: ellipsis; white-space: nowrap;">
                                <?php echo($membre['passMemb']); ?>
                            </td>
                            <td>
                                <a href="edit.php?numMemb=<?php echo($membre['numMemb']); ?>" class="btn btn-primary">Edit</a>
                                <?php if ($membre['numStat'] != 1): ?>
                                    <a href="delete.php?id=<?php echo $membre['numMemb']; ?>" class="btn btn-danger">Supprimer</a>
                                <?php else: ?>
                                    <span class="badge badge-secondary">Protégé</span>
                                <?php endif; ?>
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
include '../../../footer.php';