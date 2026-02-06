<?php
include '../header-admin.php'; ?>

<form action="/api/comments/update.php" method="POST">
    <input type="hidden" name="numCom" value="<?= $commentaire['numCom'] ?>">

    <div class="mb-3">
        <label>Commentaire du membre :</label>
        <textarea class="form-control" disabled><?= $commentaire['libCom'] ?></textarea>
    </div>
    <div class="mb-3">
        <label>Date de création :</label>
        <input type="text" class="form-control" value="<?= $commentaire['dtCreaCom'] ?>" disabled>
    </div>

    <hr>

    <div class="form-check">
        <input type="checkbox" name="attModOK" id="attModOK" <?= ($commentaire['attModOK'] == 1) ? 'checked' : '' ?>>
        <label for="attModOK">Valider le commentaire (Rendre visible sur le blog)</label>
    </div>

    <div class="mb-3 mt-2">
        <label for="notifComKOAff">Notification si le commentaire n'est pas validé :</label>
        <textarea name="notifComKOAff" id="notifComKOAff" class="form-control"><?= $commentaire['notifComKOAff'] ?></textarea>
    </div>

    <div class="form-check">
        <input type="checkbox" name="delLogiq" id="delLogiq" <?= ($commentaire['delLogiq'] == 1) ? 'checked' : '' ?>>
        <label for="delLogiq">Suppression logique (Archiver le message)</label>
    </div>

    <button type="submit" class="btn btn-primary mt-3">Mettre à jour la modération</button>
</form>