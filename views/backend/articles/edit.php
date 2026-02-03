<?php
include '../../../header.php';

if (isset($_GET['numArt'])) {
    $numArt = $_GET['numArt'];
    $article = sql_select("ARTICLE", "*", "numArt = $numArt");
    
    if (!empty($article)) {
        $article = $article[0];
        $dtCreaArt = $article['dtCreaArt'] ?? '';
        $dtMajArt = $article['dtMajArt'] ?? '';
        $libTitrArt = $article['libTitrArt'] ?? '';
        $libChapoArt = $article['libChapoArt'] ?? '';
        $libAccrochArt = $article['libAccrochArt'] ?? '';
        $parag1Art = $article['parag1Art'] ?? '';
        $libSsTitr1Art = $article['libSsTitr1Art'] ?? '';
        $parag2Art = $article['parag2Art'] ?? '';
        $libSsTitr2Art = $article['libSsTitr2Art'] ?? '';
        $parag3Art = $article['parag3Art'] ?? '';
        $libConclArt = $article['libConclArt'] ?? '';
        $urlPhotArt = $article['urlPhotArt'] ?? '';
        $numThem = $article['numThem'] ?? '';
    } else {
        // Article non trouvé, rediriger
        header('Location: list.php?error=not_found');
        exit();
    }
} else {
    // Pas de numArt fourni, rediriger
    header('Location: list.php?error=no_id');
    exit();
}

$thematiques = sql_select("THEMATIQUE", "*");
?>

<!-- Bootstrap form to create a new statut -->
<div class="container">
    <div class="row">
        <div class="col-md-12"><h1>Modification Article</h1></div>
        <div class="col-md-12">
            <form action="<?php echo ROOT_URL . '/api/articles/update.php' ?>" method="post" enctype="multipart/form-data">
                
                <div class="form-group">
                    <label for="numArt">ID de l'article (non modifiable)</label>
                    <input id="numArt" name="numArt" class="form-control" type="text" value="<?php echo $numArt; ?>" readonly />
                </div>

                <div class="form-group">
                    <label for="dtCreaArt">Date de l'article</label>
                    <input id="dtCreaArt" name="dtCreaArt" class="form-control" type="datetime-local" value="<?php echo $dtCreaArt ? date('Y-m-d\TH:i', strtotime($dtCreaArt)) : ''; ?>" />
                </div>

                <div class="form-group">
                    <label for="dtMajArt">Mise à jour de l'article</label>
                    <input id="dtMajArt" name="dtMajArt" class="form-control" type="datetime-local" value="<?php echo $dtMajArt ? date('Y-m-d\TH:i', strtotime($dtMajArt)) : ''; ?>" />
                </div>

                <div class="form-group">
                    <label for="libTitrArt">Titre de l'article</label>
                    <input id="libTitrArt" name="libTitrArt" class="form-control" type="text" value="<?php echo $libTitrArt; ?>" />
                </div>

                <div class="form-group">
                    <label for="libChapoArt">Description de l'article</label>
                    <textarea id="libChapoArt" name="libChapoArt" class="form-control"><?php echo $libChapoArt; ?></textarea>
                </div>

                <div class="form-group">
                    <label for="libAccrochArt">Accroche de l'article</label>
                    <input id="libAccrochArt" name="libAccrochArt" class="form-control" type="text" value="<?php echo $libAccrochArt; ?>" />
                </div>

                <div class="form-group">
                    <label for="libSsTitr1Art">Premier sous titre</label>
                    <input id="libSsTitr1Art" name="libSsTitr1Art" class="form-control" type="text" value="<?php echo $libSsTitr1Art; ?>" />
                </div>

                <div class="form-group">
                    <label for="parag1Art">Premier paragraphe</label>
                    <textarea id="parag1Art" name="parag1Art" class="form-control"><?php echo $parag1Art; ?></textarea>
                </div>

                <div class="form-group">
                    <label for="libSsTitr2Art">Deuxième sous titre</label>
                    <input id="libSsTitr2Art" name="libSsTitr2Art" class="form-control" type="text" value="<?php echo $libSsTitr2Art; ?>" />
                </div>

                <div class="form-group">
                    <label for="parag2Art">Deuxième paragraphe</label>
                    <textarea id="parag2Art" name="parag2Art" class="form-control"><?php echo $parag2Art; ?></textarea>
                </div>

                <div class="form-group">
                    <label for="parag3Art">Troisième paragraphe</label>
                    <textarea id="parag3Art" name="parag3Art" class="form-control"><?php echo $parag3Art; ?></textarea>
                </div>

                <div class="form-group">
                    <label for="libConclArt">Conclusion</label>
                    <textarea id="libConclArt" name="libConclArt" class="form-control"><?php echo $libConclArt; ?></textarea>
                </div>

                <div class="form-group mt-3">
                    <label>Illustration actuelle</label>
                    <div class="mb-2">
                        <img src="../../../src/uploads/<?php echo $urlPhotArt; ?>" alt="Image" style="width: 150px; border: 1px solid #ccc;">
                    </div>
                    <input type="hidden" name="urlPhotArt" value="<?php echo $urlPhotArt; ?>">
                    <label for="urlPhotArt">Remplacer l'image</label>
                    <input id="urlPhotArt" name="urlPhotArt" class="form-control" type="file" accept="image/*" />
                </div>

                <div class="form-group mt-3">
                    <label for="numThem">Thématique</label>
                    <select name="numThem" id="numThem" class="form-control" required>
                        <?php foreach ($thematiques as $them): ?>
                            <option value="<?php echo $them['numThem']; ?>" <?php echo ($them['numThem'] == $numThem) ? 'selected' : ''; ?>>
                                <?php echo $them['libThem']; ?>
                            </option>
                        <?php endforeach; ?>
                    </select>
                </div>

                <div class="form-group mt-4">
                    <a href="list.php" class="btn btn-secondary">List</a>
                    <button type="submit" class="btn btn-primary">Edit</button>
                </div>
            </form>
        </div>
    </div>
</div>