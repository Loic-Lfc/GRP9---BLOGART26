<?php
include '../header-admin.php';

if (!isset($_SESSION['numStat']) || ($_SESSION['numStat'] != 1 && $_SESSION['numStat'] != 2)) {
    header('Location: /index.php?error=access_denied');
    exit();
}

sql_connect();

if (isset($_GET['numArt'])) {
    $numArt = intval($_GET['numArt']);
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

        $motsClesArt = sql_select("MOTCLEARTICLE", "numMotCle", "numArt = $numArt");
        $selectedIds = array_column($motsClesArt, 'numMotCle');
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
    <h1>Modification Article</h1>

    <?php if (isset($_GET['error'])): ?>
        <div class="alert alert-danger"><?= htmlspecialchars($_GET['error']) ?></div>
    <?php endif; ?>

    <form action="<?= ROOT_URL . '/api/articles/update.php' ?>" method="post" enctype="multipart/form-data">
        <input type="hidden" name="numArt" value="<?= $numArt; ?>" />

        <div class="form-group">
            <label>Date de l'article</label>
            <input name="dtCreaArt" class="form-control" type="datetime-local" value="<?= $dtCreaArt ? date('Y-m-d\TH:i', strtotime($dtCreaArt)) : ''; ?>" />
        </div>

        <div class="form-group">
            <label>Titre</label>
            <input name="libTitrArt" class="form-control" type="text" value="<?= htmlspecialchars($libTitrArt); ?>" maxlength="100" required />
        </div>

        <div class="form-group">
            <label>Chapeau (500 car.)</label>
            <textarea name="libChapoArt" class="form-control" rows="4" maxlength="500"><?= htmlspecialchars($libChapoArt); ?></textarea>
        </div>

        <div class="form-group">
            <label>Accroche</label>
            <input name="libAccrochArt" class="form-control" type="text" value="<?= htmlspecialchars($libAccrochArt); ?>" maxlength="100" />
        </div>

        <div class="form-group">
            <label>Paragraphe 1 (1200 car.)</label>
            <textarea name="parag1Art" class="form-control" rows="6" maxlength="1200"><?= htmlspecialchars($parag1Art); ?></textarea>
        </div>

        <div class="form-group">
            <label>Sous-titre 1</label>
            <input name="libSsTitr1Art" class="form-control" type="text" value="<?= htmlspecialchars($libSsTitr1Art); ?>" maxlength="100" />
        </div>

        <div class="form-group">
            <label>Paragraphe 2 (1200 car.)</label>
            <textarea name="parag2Art" class="form-control" rows="6" maxlength="1200"><?= htmlspecialchars($parag2Art); ?></textarea>
        </div>

        <div class="form-group">
            <label>Sous-titre 2</label>
            <input name="libSsTitr2Art" class="form-control" type="text" value="<?= htmlspecialchars($libSsTitr2Art); ?>" maxlength="100" />
        </div>

        <div class="form-group">
            <label>Paragraphe 3 (1200 car.)</label>
            <textarea name="parag3Art" class="form-control" rows="6" maxlength="1200"><?= htmlspecialchars($parag3Art); ?></textarea>
        </div>

        <div class="form-group">
            <label>Conclusion (800 car.)</label>
            <textarea name="libConclArt" class="form-control" rows="4" maxlength="800"><?= htmlspecialchars($libConclArt); ?></textarea>
        </div>

        <div class="form-group mt-3">
            <label>Illustration actuelle</label>
            <div class="mb-2">
                <img src="../../../src/uploads/<?= $urlPhotArt; ?>" alt="Image" style="width: 150px; border: 1px solid #ccc;">
            </div>
            <input type="hidden" name="oldUrlPhotArt" value="<?= $urlPhotArt; ?>">
            <label>Remplacer l'image</label>
            <input name="urlPhotArt" class="form-control" type="file" accept="image/*" />
        </div>

        <div class="form-group mt-3">
            <label>Thématique</label>
            <select name="numThem" class="form-control" required>
                <?php foreach ($thematiques as $them): ?>
                    <option value="<?= $them['numThem']; ?>" <?= ($them['numThem'] == $numThem) ? 'selected' : ''; ?>>
                        <?= htmlspecialchars($them['libThem']); ?>
                    </option>
                <?php endforeach; ?>
            </select>
        </div>

        <div class="form-group mt-4">
            <label>Mots clés :</label>
            <div class="row">
                <div class="col-md-5">
                    <select id="availableKeywords" class="form-control" multiple style="height: 150px;">
                        <?php foreach ($allMotsCles as $mc): ?>
                            <?php if (!in_array($mc['numMotCle'], $selectedIds)): ?>
                                <option value="<?= $mc['numMotCle']; ?>"><?= htmlspecialchars($mc['libMotCle']); ?></option>
                            <?php endif; ?>
                        <?php endforeach; ?>
                    </select>
                </div>
                <div class="col-md-2 d-flex flex-column justify-content-center gap-2">
                    <button type="button" class="btn btn-primary btn-sm" id="addKeyword">>></button>
                    <button type="button" class="btn btn-danger btn-sm" id="removeKeyword"><<</button>
                </div>
                <div class="col-md-5">
                    <select id="selectedKeywords" class="form-control" multiple style="height: 150px;">
                        <?php foreach ($allMotsCles as $mc): ?>
                            <?php if (in_array($mc['numMotCle'], $selectedIds)): ?>
                                <option value="<?= $mc['numMotCle']; ?>"><?= htmlspecialchars($mc['libMotCle']); ?></option>
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

<script>
const availableList = document.getElementById('availableKeywords');
const selectedList = document.getElementById('selectedKeywords');
const hiddenInput = document.getElementById('motsClesInput');

document.getElementById('addKeyword').addEventListener('click', () => move('availableKeywords', 'selectedKeywords'));
document.getElementById('removeKeyword').addEventListener('click', () => move('selectedKeywords', 'availableKeywords'));

function move(fromId, toId) {
    const from = document.getElementById(fromId);
    const to = document.getElementById(toId);
    Array.from(from.selectedOptions).forEach(opt => to.appendChild(opt));
    updateHidden();
}

function updateHidden() {
    hiddenInput.value = Array.from(selectedList.options).map(opt => opt.value).join(',');
}

updateHidden();
</script>