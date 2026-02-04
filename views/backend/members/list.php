<?php
include '../header-admin.php';

if (!isset($_SESSION['numStat']) || ($_SESSION['numStat'] != 1 && $_SESSION['numStat'] != 2)) {
    header('Location: /index.php?error=access_denied');
    exit();
}

$queryMembres = "MEMBRE 
                INNER JOIN STATUT ON MEMBRE.numStat = STATUT.numStat
                ORDER BY MEMBRE.numStat ASC, MEMBRE.numMemb ASC";
$membres = sql_select($queryMembres, "MEMBRE.*, STATUT.libStat");
?>

<div class="container-fluid mt-4">
    <div class="row">
        <div class="col-md-12">
            <h1>Membres</h1>
            <table class="table table-striped">
                <thead>
                    <tr>
                        <th>Statut</th>
                        <th>Id</th>
                        <th>Pseudo</th>
                        <th>Prénom</th>
                        <th>Nom</th>
                        <th>Email</th>
                        <th>Date Création</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($membres as $membre) { ?>
                        <tr>
                            <td><span class="badge bg-danger"><?php echo $membre['libStat']; ?></span></td>
                            <td><strong><?php echo $membre['numMemb']; ?></strong></td>
                            <td><?php echo $membre['pseudoMemb']; ?></td>
                            <td><?php echo $membre['prenomMemb']; ?></td>
                            <td><?php echo $membre['nomMemb']; ?></td>
                            <td><?php echo $membre['eMailMemb']; ?></td>
                            <td><?php echo $membre['dtCreaMemb']; ?></td>
                            <td>
                                <?php if ($membre['numStat'] != 1) { ?>
                                    <a href="edit.php?numMemb=<?php echo $membre['numMemb']; ?>" class="btn btn-sm btn-outline-warning">Edit</a>
                                    <a href="delete.php?numMemb=<?php echo $membre['numMemb']; ?>" class="btn btn-sm btn-outline-danger">Delete</a>
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
    </div>
</div>