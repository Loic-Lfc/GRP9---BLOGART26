<?php
include '../header-admin.php';

if (!isset($_SESSION['numStat']) || ($_SESSION['numStat'] != 1 && $_SESSION['numStat'] != 2)) {
    header('Location: /index.php?error=access_denied');
    exit();
}

$queryArticles = "ARTICLE 
                INNER JOIN THEMATIQUE ON ARTICLE.numThem = THEMATIQUE.numThem";
$articles = sql_select($queryArticles, "ARTICLE.numArt, ARTICLE.dtCreaArt, ARTICLE.libTitrArt, THEMATIQUE.libThem");
?>

<div class="container-fluid mt-4">
    <div class="row">
        <div class="col-md-12">
            <h1>Articles</h1>
            <table class="table table-striped">
                <thead>
                    <tr>
                        <th>Id</th>
                        <th>Titre</th>
                        <th>Date de création</th>
                        <th>Thématique</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($articles as $article) { ?>
                        <tr>
                            <td><strong><?php echo $article['numArt']; ?></strong></td>
                            <td><?php echo $article['libTitrArt']; ?></td>
                            <td><?php echo $article['dtCreaArt']; ?></td>
                            <td><?php echo $article['libThem']; ?></td>
                            <td>
                                <a href="edit.php?numArt=<?php echo $article['numArt']; ?>" class="btn btn-sm btn-outline-warning">Edit</a>
                                <a href="delete.php?numArt=<?php echo $article['numArt']; ?>" class="btn btn-sm btn-outline-danger">Delete</a>
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