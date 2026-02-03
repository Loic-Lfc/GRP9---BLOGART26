<?php
require_once '../../../config/defines.php';
require_once '../../../config/security.php';
require_once '../../../functions/query/connect.php';
require_once '../../../functions/query/select.php';

// Initialiser la connexion
sql_connect();

// Récupérer les thématiques
$thematiques = sql_select("THEMATIQUE", "*", null, null, "libThem");

// Récupérer les mots-clés
$motscles = sql_select("MOTCLE", "*", null, null, "libMotCle");

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
            <label for="numThem">Thématique</label>
            <select name="numThem" id="numThem" class="form-control" required>
                <option value="">-- Choisir une thématique --</option>
                
                <?php foreach ($thematiques as $thematique): ?>
                    <option value="<?php echo $thematique['numThem']; ?>">
                        <?php echo htmlspecialchars($thematique['libThem']); ?>
                    </option>
                <?php endforeach; ?>
                
            </select>
        </div>

        <div class="form-group">
            <label>Choisissez les mots clés liés à l'article :</label>
            <div class="row">
                <!-- Liste des mots clés disponibles -->
                <div class="col-md-5">
                    <label for="availableKeywords" style="font-size: 14px; font-weight: bold;">Liste Mots clés</label>
                    <select id="availableKeywords" class="form-control" multiple style="height: 200px;">
                        <option disabled>-- Choisissez un mot clé --</option>
                        <?php foreach ($motscles as $motcle): ?>
                            <option value="<?php echo $motcle['numMotCle']; ?>" data-name="<?php echo htmlspecialchars($motcle['libMotCle']); ?>">
                                <?php echo htmlspecialchars($motcle['libMotCle']); ?>
                            </option>
                        <?php endforeach; ?>
                    </select>
                </div>

                <!-- Boutons d'ajout/suppression -->
                <div class="col-md-2 d-flex flex-column justify-content-center align-items-center">
                    <button type="button" class="btn btn-primary mb-2" id="addKeyword" style="width: 100%;">Ajouter >></button>
                    <button type="button" class="btn btn-danger" id="removeKeyword" style="width: 100%;">&lt;&lt; Supprimer</button>
                </div>

                <!-- Liste des mots clés sélectionnés -->
                <div class="col-md-5">
                    <label for="selectedKeywords" style="font-size: 14px; font-weight: bold;">Mots clés ajoutés</label>
                    <select id="selectedKeywords" class="form-control" multiple style="height: 200px;">
                        <option disabled>-- Mot(s) clé(s) choisi(s) --</option>
                    </select>
                </div>
            </div>
            <!-- Input caché pour stocker les IDs des mots clés sélectionnés -->
            <input type="hidden" name="motsCles" id="motsClesInput">
        </div>

        <script>
        document.getElementById('addKeyword').addEventListener('click', function(e) {
            e.preventDefault();
            const availableList = document.getElementById('availableKeywords');
            const selectedList = document.getElementById('selectedKeywords');
            
            Array.from(availableList.selectedOptions).forEach(option => {
                if (option.value !== '') {
                    // Ajouter à la liste sélectionnée
                    const newOption = option.cloneNode(true);
                    selectedList.appendChild(newOption);
                    
                    // Supprimer de la liste disponible
                    option.remove();
                }
            });
            updateHiddenInput();
        });

        document.getElementById('removeKeyword').addEventListener('click', function(e) {
            e.preventDefault();
            const availableList = document.getElementById('availableKeywords');
            const selectedList = document.getElementById('selectedKeywords');
            
            Array.from(selectedList.selectedOptions).forEach(option => {
                if (option.value !== '') {
                    // Ajouter de retour à la liste disponible
                    const newOption = option.cloneNode(true);
                    availableList.appendChild(newOption);
                    
                    // Supprimer de la liste sélectionnée
                    option.remove();
                }
            });
            updateHiddenInput();
        });

        function updateHiddenInput() {
            const selectedList = document.getElementById('selectedKeywords');
            const selectedValues = Array.from(selectedList.options)
                .filter(option => option.value !== '')
                .map(option => option.value)
                .join(',');
            document.getElementById('motsClesInput').value = selectedValues;
        }

        // Initialiser l'input caché au chargement
        updateHiddenInput();
        </script>

        <div class="form-group mt-4 d-flex gap-2">
            <button type="submit" class="btn btn-success" value="Créer l'article">Créer l'article</button>
            <a href="list.php" class="btn btn-secondary">Liste des articles</a>
        </div>

    </form>
</div>

<?php include '../../../footer.php'; ?>