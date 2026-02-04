<?php
include '../header-admin.php';

if (!isset($_SESSION['numStat']) || ($_SESSION['numStat'] != 1 && $_SESSION['numStat'] != 2)) {
    header('Location: /index.php?error=access_denied');
    exit();
}

sql_connect();

if (isset($_GET['numArt'])) {
    $numArt = $_GET['numArt'];
    $article = sql_select("ARTICLE", "*", "numArt = $numArt");
    
    if (!empty($article)) {
        $article = $article[0];
        $dtCreaArt = $article['dtCreaArt'] ?? '';
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

        // Récupérer les mots-clés de l'article
        $motsClesArt = sql_select("MOTCLEARTICLE", "numMotCle", "numArt = $numArt");
        $selectedIds = array_column($motsClesArt, 'numMotCle');

        // Récupérer TOUS les mots-clés pour faire le tri
        $allMotsCles = sql_select("MOTCLE", "*", null, null, "libMotCle");
    } else {
        header('Location: list.php?error=not_found');
        exit();
    }
} else {
    header('Location: list.php?error=no_id');
    exit();
}

$thematiques = sql_select("THEMATIQUE", "*");
?>

<div class="container mt-4">
    <div class="row">
        <div class="col-md-12"><h1>Modification Article</h1></div>
        <div class="col-md-12">
            <form action="<?php echo ROOT_URL . '/api/articles/update.php' ?>" method="post" enctype="multipart/form-data">
                
                <input type="hidden" name="numArt" value="<?php echo $numArt; ?>" />

                <div class="form-group">
                    <label for="dtCreaArt">Date de l'article</label>
                    <input id="dtCreaArt" name="dtCreaArt" class="form-control" type="datetime-local" value="<?php echo $dtCreaArt ? date('Y-m-d\TH:i', strtotime($dtCreaArt)) : ''; ?>" />
                </div>

                <div class="form-group">
                    <label for="libTitrArt">Titre de l'article</label>
                    <input id="libTitrArt" name="libTitrArt" class="form-control" type="text" value="<?php echo $libTitrArt; ?>" />
                </div>

                <div class="form-group">
                    <label for="libChapoArt">Description de l'article (Chapeau)</label>
                    <textarea id="libChapoArt" name="libChapoArt" class="form-control" rows="4"><?php echo $libChapoArt; ?></textarea>
                </div>

                <div class="form-group">
                    <label for="libAccrochArt">Accroche de l'article</label>
                    <input id="libAccrochArt" name="libAccrochArt" class="form-control" type="text" value="<?php echo $libAccrochArt; ?>" />
                </div>

                <div class="form-group">
                    <label for="parag1Art">Premier paragraphe</label>
                    <textarea id="parag1Art" name="parag1Art" class="form-control" rows="6"><?php echo $parag1Art; ?></textarea>
                </div>

                <div class="form-group">
                    <label for="libSsTitr1Art">Premier sous titre</label>
                    <input id="libSsTitr1Art" name="libSsTitr1Art" class="form-control" type="text" value="<?php echo $libSsTitr1Art; ?>" />
                </div>

                <div class="form-group">
                    <label for="parag2Art">Deuxième paragraphe</label>
                    <textarea id="parag2Art" name="parag2Art" class="form-control" rows="6"><?php echo $parag2Art; ?></textarea>
                </div>

                <div class="form-group">
                    <label for="libSsTitr2Art">Deuxième sous titre</label>
                    <input id="libSsTitr2Art" name="libSsTitr2Art" class="form-control" type="text" value="<?php echo $libSsTitr2Art; ?>" />
                </div>

                <div class="form-group">
                    <label for="parag3Art">Troisième paragraphe</label>
                    <textarea id="parag3Art" name="parag3Art" class="form-control" rows="6"><?php echo $parag3Art; ?></textarea>
                </div>

                <div class="form-group">
                    <label for="libConclArt">Conclusion</label>
                    <textarea id="libConclArt" name="libConclArt" class="form-control" rows="4"><?php echo $libConclArt; ?></textarea>
                </div>

                <div class="form-group mt-3">
                    <label>Illustration actuelle</label>
                    <div class="mb-2">
                        <img src="../../../src/uploads/<?php echo $urlPhotArt; ?>" alt="Image" style="width: 150px; border: 1px solid #ccc;">
                    </div>
                    <input type="hidden" name="oldUrlPhotArt" value="<?php echo $urlPhotArt; ?>">
                    <label for="urlPhotArt">Remplacer l'image</label>
                    <input id="urlPhotArt" name="urlPhotArt" class="form-control" type="file" accept="image/*" />
                </div>

                <div class="form-group mt-3">
                    <label for="numThem">Thématique</label>
                    <select name="numThem" id="numThem" class="form-control" required>
                        <?php foreach ($thematiques as $them): ?>
                            <option value="<?php echo $them['numThem']; ?>" <?php echo ($them['numThem'] == $numThem) ? 'selected' : ''; ?>>
                                <?php echo htmlspecialchars($them['libThem']); ?>
                            </option>
                        <?php endforeach; ?>
                    </select>
                </div>

                <div class="form-group mt-4">
                    <label>Choisissez les mots clés liés à l'article :</label>
                    <div class="row">
                        <div class="col-md-5">
                            <label>Liste Mots clés</label>
                            <select id="availableKeywords" class="form-control" multiple style="height: 200px;">
                                <option disabled>-- Choisissez un mot clé --</option>
                                <?php foreach ($allMotsCles as $mc): ?>
                                    <?php if (!in_array($mc['numMotCle'], $selectedIds)): ?>
                                        <option value="<?php echo $mc['numMotCle']; ?>">
                                            <?php echo htmlspecialchars($mc['libMotCle']); ?>
                                        </option>
                                    <?php endif; ?>
                                <?php endforeach; ?>
                            </select>
                        </div>

                        <div class="col-md-2 d-flex flex-column justify-content-center align-items-center">
                            <button type="button" class="btn btn-primary mb-2" id="addKeyword" style="width: 100%;">Ajouter >></button>
                            <button type="button" class="btn btn-danger" id="removeKeyword" style="width: 100%;">&lt;&lt; Supprimer</button>
                        </div>

                        <div class="col-md-5">
                            <label>Mots clés ajoutés</label>
                            <select id="selectedKeywords" class="form-control" multiple style="height: 200px;">
                                <option disabled>-- Mot(s) clé(s) choisi(s) --</option>
                                <?php foreach ($allMotsCles as $mc): ?>
                                    <?php if (in_array($mc['numMotCle'], $selectedIds)): ?>
                                        <option value="<?php echo $mc['numMotCle']; ?>">
                                            <?php echo htmlspecialchars($mc['libMotCle']); ?>
                                        </option>
                                    <?php endif; ?>
                                <?php endforeach; ?>
                            </select>
                        </div>
                    </div>
                    <input type="hidden" name="motsCles" id="motsClesInput">
                </div>

                <div class="form-group mt-4 mb-5">
                    <a href="list.php" class="btn btn-secondary">Annuler</a>
                    <button type="submit" class="btn btn-primary">Enregistrer les modifications</button>
                </div>
            </form>
        </div>
    </div>
</div>

<script>
document.getElementById('addKeyword').addEventListener('click', function() {
    moveOptions('availableKeywords', 'selectedKeywords');
});

document.getElementById('removeKeyword').addEventListener('click', function() {
    moveOptions('selectedKeywords', 'availableKeywords');
});

function moveOptions(fromId, toId) {
    const fromList = document.getElementById(fromId);
    const toList = document.getElementById(toId);
    
    Array.from(fromList.selectedOptions).forEach(option => {
        if (!option.disabled) {
            toList.appendChild(option);
        }
    });
    updateHiddenInput();
}

function updateHiddenInput() {
    const selectedList = document.getElementById('selectedKeywords');
    const values = Array.from(selectedList.options)
        .filter(opt => !opt.disabled)
        .map(opt => opt.value);
    document.getElementById('motsClesInput').value = values.join(',');
}

updateHiddenInput();
</script>