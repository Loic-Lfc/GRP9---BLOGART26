<?php
include '../header-admin.php';

if (!isset($_SESSION['numStat']) || ($_SESSION['numStat'] != 1 && $_SESSION['numStat'] != 2)) {
    header('Location: /index.php?error=access_denied');
    exit();
}

sql_connect();
$thematiques = sql_select("THEMATIQUE", "*", null, null, "libThem");
$motscles = sql_select("MOTCLE", "*", null, null, "libMotCle");
?>

<div class="container mt-4 form-container">
    <h2>Créer un nouvel article</h2>

    <?php if (isset($_GET['error'])): ?>
        <div class="alert alert-danger">
            <?= htmlspecialchars($_GET['error']) ?>
        </div>
    <?php endif; ?>

    <form action="../../../api/articles/create.php" method="POST" id="formArticle" enctype="multipart/form-data">
        
        <div class="form-group">
            <label>Titre</label>
            <input type="text" name="libTitrArt" class="form-control" maxlength="100" placeholder="Max 100 car." required>
        </div>

        <div class="form-group">
            <label>Date création</label>
            <input type="datetime-local" name="dtCreaArt" class="form-control" value="<?= date('Y-m-d\TH:i') ?>">
        </div>

        <div class="form-group">
            <label>Chapeau</label>
            <textarea name="libChapoArt" class="form-control" rows="4" maxlength="500" placeholder="Max 500 car."></textarea>
        </div>

        <div class="form-group">
            <label>Accroche paragraphe 1</label>
            <input type="text" name="libAccrochArt" class="form-control" maxlength="100" placeholder="Max 100 car.">
        </div>

        <div class="form-group">
            <label>Paragraphe 1</label>
            <textarea name="parag1Art" class="form-control" rows="6" maxlength="1200" placeholder="Max 1200 car."></textarea>
        </div>

        <div class="form-group">
            <label>Sous-titre 1</label>
            <input type="text" name="libSsTitr1Art" class="form-control" maxlength="100" placeholder="Max 100 car.">
        </div>

        <div class="form-group">
            <label>Paragraphe 2</label>
            <textarea name="parag2Art" class="form-control" rows="6" maxlength="1200" placeholder="Max 1200 car."></textarea>
        </div>

        <div class="form-group">
            <label>Sous-titre 2</label>
            <input type="text" name="libSsTitr2Art" class="form-control" maxlength="100" placeholder="Max 100 car.">
        </div>

        <div class="form-group">
            <label>Paragraphe 3</label>
            <textarea name="parag3Art" class="form-control" rows="6" maxlength="1200" placeholder="Max 1200 car."></textarea>
        </div>

        <div class="form-group">
            <label>Conclusion</label>
            <textarea name="libConclArt" class="form-control" rows="4" maxlength="800" placeholder="Max 800 car."></textarea>
        </div>

        <div class="form-group">
            <label>Illustration</label>
            <input type="file" name="urlPhotArt" id="fileUpload" class="form-control-file">
        </div>

        <div class="form-group">
            <label for="numThem">Thématique</label>
            <select name="numThem" id="numThem" class="form-control" required>
                <option value="">-- Choisir une thématique --</option>
                <?php foreach ($thematiques as $them): ?>
                    <option value="<?= $them['numThem'] ?>"><?= htmlspecialchars($them['libThem']) ?></option>
                <?php endforeach; ?>
            </select>
        </div>

        <div class="form-group">
            <label>Mots clés :</label>
            <div class="row">
                <div class="col-md-5">
                    <select id="availableKeywords" class="form-control" multiple style="height: 150px;">
                        <?php foreach ($motscles as $mot): ?>
                            <option value="<?= $mot['numMotCle'] ?>"><?= htmlspecialchars($mot['libMotCle']) ?></option>
                        <?php endforeach; ?>
                    </select>
                </div>
                <div class="col-md-2 d-flex flex-column justify-content-center gap-2">
                    <button type="button" class="btn btn-sm btn-primary" id="addKeyword">>></button>
                    <button type="button" class="btn btn-sm btn-danger" id="removeKeyword"><<</button>
                </div>
                <div class="col-md-5">
                    <select id="selectedKeywords" class="form-control" multiple style="height: 150px;"></select>
                </div>
            </div>
            <input type="hidden" name="motsCles" id="motsClesInput">
        </div>

        <div class="form-group mt-4 d-flex gap-2">
            <button type="submit" class="btn btn-success">Créer l'article</button>
            <a href="list.php" class="btn btn-secondary">Annuler</a>
        </div>

    </form>
</div>

<script>
const availableList = document.getElementById('availableKeywords');
const selectedList = document.getElementById('selectedKeywords');
const hiddenInput = document.getElementById('motsClesInput');

document.getElementById('addKeyword').addEventListener('click', () => {
    Array.from(availableList.selectedOptions).forEach(opt => {
        selectedList.appendChild(opt);
    });
    updateHidden();
});

document.getElementById('removeKeyword').addEventListener('click', () => {
    Array.from(selectedList.selectedOptions).forEach(opt => {
        availableList.appendChild(opt);
    });
    updateHidden();
});

function updateHidden() {
    hiddenInput.value = Array.from(selectedList.options).map(opt => opt.value).join(',');
}
</script>