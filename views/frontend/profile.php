<?php
// Inclusion des fichiers nécessaires
include '../../header.php';
require_once '../../functions/query/connect.php';
require_once '../../functions/query/select.php';

// Démarrer la session si elle n'existe pas
if (!isset($_SESSION)) {
    session_start();
}

// Initialiser la connexion
sql_connect();

// Vérifier si un numMemb est passé en paramètre
if (!isset($_GET['numMemb'])) {
    header("Location: /index.php");
    exit();
}

$numMemb = intval($_GET['numMemb']);

// Récupérer les informations du membre
$membre = sql_select("MEMBRE", "*", "numMemb = " . $numMemb);

if (empty($membre)) {
    echo "<div class='container mt-5'><div class='alert alert-danger'>Membre non trouvé</div></div>";
    include '../../footer.php';
    exit();
}

$membre = $membre[0];

// Récupérer le statut du membre
$statut = sql_select("STATUT", "*", "numStat = " . $membre['numStat']);
$statut = !empty($statut) ? $statut[0]['libStat'] : 'Inconnu';
?>

<div class="container mt-5">
    <div class="row">
        <div class="col-md-8 offset-md-2">
            <div class="card">
                <div class="card-header bg-primary text-white">
                    <h2>Profil de <?php echo htmlspecialchars($membre['prenomMemb'] . ' ' . $membre['nomMemb']); ?></h2>
                </div>
                <div class="card-body">
                    <table class="table table-striped">
                        <tr>
                            <th>Pseudo :</th>
                            <td><?php echo htmlspecialchars($membre['pseudoMemb']); ?></td>
                        </tr>
                        <tr>
                            <th>Nom :</th>
                            <td><?php echo htmlspecialchars($membre['nomMemb']); ?></td>
                        </tr>
                        <tr>
                            <th>Prénom :</th>
                            <td><?php echo htmlspecialchars($membre['prenomMemb']); ?></td>
                        </tr>
                        <tr>
                            <th>Email :</th>
                            <td><?php echo htmlspecialchars($membre['eMailMemb']); ?></td>
                        </tr>
                        <tr>
                            <th>Statut :</th>
                            <td><?php echo htmlspecialchars($statut); ?></td>
                        </tr>
                        <tr>
                            <th>RGPD :</th>
                            <td>
                                <?php 
                                if ($membre['accordMemb'] == 1) {
                                    echo "<span class='badge bg-success'>Accepté</span>";
                                } else {
                                    echo "<span class='badge bg-danger'>Refusé</span>";
                                }
                                ?>
                            </td>
                        </tr>
                    </table>

                    <?php
                    // Afficher le bouton modifier/supprimer uniquement si c'est le profil de l'utilisateur connecté
                    if (isset($_SESSION['numMemb']) && $_SESSION['numMemb'] == $numMemb) {
                        ?>
                        <div class="mt-4">
                            <a href="<?php echo ROOT_URL . '/views/backend/members/edit.php?numMemb=' . $numMemb; ?>" class="btn btn-warning">Modifier mon profil</a>
                            <a href="<?php echo ROOT_URL . '/api/members/delete.php?numMemb=' . $numMemb; ?>" class="btn btn-danger" onclick="return confirm('Êtes-vous sûr de vouloir supprimer votre compte ?');">Supprimer mon compte</a>
                        </div>
                        <?php
                    }
                    ?>
                </div>
            </div>
        </div>
    </div>
</div>

<?php
include '../../footer.php';
?>
