<?php
require_once '../../../config/defines.php';
require_once '../../../config/security.php';
require_once '../../../functions/query/connect.php';
include '../../../header.php';
?>


<div class="container mt-4 form-container">
    <form action="../../../api/articles/create.php" method="POST" id="formArticle" enctype="multipart/form-data">
        
        <div class="form-group">
            <label>Titre</label>
            <input type="text" name="libTitrArt" class="form-control" placeholder="Sur 100 car." required>
        </div>

        <div class="form-group">
            <label>Date création</label>
            <input type="datetime-local" name="dtCreaArt" class="form-control" value="<?= date('Y-m-d\TH:i') ?>">
        </div>

        <div class="form-group">
            <label>Chapeau</label>
            <textarea name="libChapoArt" class="form-control" rows="6" placeholder="Décrivez le chapeau. Sur 500 car."></textarea>
        </div>

        <div class="form-group">
            <label>Accroche paragraphe 1</label>
            <input type="text" name="libAccrochArt" class="form-control" placeholder="Sur 100 car.">
        </div>

        <div class="form-group">
            <label>Paragraphe 1</label>
            <textarea name="parag1Art" class="form-control" rows="8" placeholder="Décrivez le premier paragraphe. Sur 1200 car."></textarea>
        </div>

        <div class="form-group">
            <label>Sous-titre 1</label>
            <input type="text" name="libSsTitr1Art" class="form-control" placeholder="Sur 100 car.">
        </div>

        <div class="form-group">
            <label>Paragraphe 2</label>
            <textarea name="parag2Art" class="form-control" rows="8" placeholder="Décrivez le deuxième paragraphe. Sur 1200 car."></textarea>
        </div>

        <div class="form-group">
            <label>Sous-titre 2</label>
            <input type="text" name="libSsTitr2Art" class="form-control" placeholder="Sur 100 car.">
        </div>

        <div class="form-group">
            <label>Paragraphe 3</label>
            <textarea name="parag3Art" class="form-control" rows="8" placeholder="Décrivez le troisième paragraphe. Sur 1200 car."></textarea>
        </div>

        <div class="form-group">
            <label>Conclusion</label>
            <textarea name="libConclArt" class="form-control" rows="8" placeholder="Décrivez la conclusion. Sur 800 car."></textarea>
        </div>

        <div class="form-group">
            <label>Importez l'illustration</label>
            <input type="file" name="urlPhotArt" id="fileUpload">
            <p style="font-size: 12px; color: #666; margin-top: 5px;">
                >> Extension des images acceptées : .jpg, .gif, .png, .jpeg<br>
                (largeur, hauteur, taille max : 80000px, 80000px, 200 000 Go)
            </p>
        </div>

<div class="form-group">
<label>Thématique :</label>
<select name="numThem" class="form-control" required>
	<option value="">-- Choisir une thématique --</option>
<?php 
	$thematiques = sql_select("THEMATIQUE", "*");
        var_dump($thematiques);
	if ($thematiques) {
		foreach ($thematiques as $theme): ?>
			<option value="<?= $theme['numThem'] ?>">
				<?= htmlspecialchars($theme['libThem']) ?>
			</option>
<?php 	endforeach; 
	} ?>
</select>
</div>

<?php include '../../../footer.php'; ?>

$statuts = sql_select("STATUT", "*", "numStat");
$numStat = sql_select("STATUT", "numStat", "numStat");

<div class="form-group mt-3">
                    <label for="numStat">Statut</label>
                    <select name="numStat" id="numStat" class="form-control" required>
                        <?php foreach ($statuts as $statut): ?>
                            <option value="<?php echo $statut['numStat']; ?>" <?php echo ($statut['numStat'] == $numStat) ? 'selected' : ''; ?>>
                                <?php echo $statut['libStat']; ?>
                            </option>
                        <?php endforeach; ?>
                    </select>
                </div>