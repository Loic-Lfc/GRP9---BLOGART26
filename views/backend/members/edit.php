<?php
include '../header-admin.php';

// On vérifie si l'utilisateur est admin ou modérateur
if (!isset($_SESSION['numStat']) || ($_SESSION['numStat'] != 1 && $_SESSION['numStat'] != 2)) {
    header('Location: list.php?error=forbidden');
    exit();
}

// Récupérer l'ID du membre
$numMemb = isset($_GET['numMemb']) ? intval($_GET['numMemb']) : (isset($_GET['numStat']) ? intval($_GET['numStat']) : 0);

// Variables pour les messages
$errors = [];
$success = '';

// Traitement du formulaire
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Récupération des données
    $prenom = trim($_POST['prenom'] ?? '');
    $nom = trim($_POST['nom'] ?? '');
    $mail1 = trim($_POST['mail1'] ?? '');
    $mail2 = trim($_POST['mail2'] ?? '');
    $password1 = $_POST['password1'] ?? '';
    $password2 = $_POST['password2'] ?? '';
    $numStat = intval($_POST['numStat'] ?? 0);
    
    // Vérification reCAPTCHA v2
    if(isset($_POST['g-recaptcha-response'])){
        $token = $_POST['g-recaptcha-response'];
        $url = 'https://www.google.com/recaptcha/api/siteverify';
        $data = array(
            'secret' => '6LexJl8sAAAAADDkJYxpJ1XXToXR0nk25Ay08PZH',
            'response' => $token
        );
        $options = array(
            'http' => array (
                'header' => "Content-Type: application/x-www-form-urlencoded\r\n",
                'method' => 'POST',
                'content' => http_build_query($data)
            )
        );
        
        $context = stream_context_create($options);
        $result = file_get_contents($url, false, $context);
        $response = json_decode($result);
        
        // Vérifier la réponse reCAPTCHA v2
        if (!$response->success) {
            $errors[] = "Échec de la vérification reCAPTCHA. Veuillez cocher la case 'Je ne suis pas un robot'.";
        }
    } else {
        $errors[] = "La vérification reCAPTCHA est requise";
    }
    
    // Validation prénom (obligatoire)
    if (empty($prenom)) {
        $errors[] = "Le prénom est obligatoire";
    }
    
    // Validation nom (obligatoire)
    if (empty($nom)) {
        $errors[] = "Le nom est obligatoire";
    }
    
    // Validation mail
    if (!empty($mail1) || !empty($mail2)) {
        if (empty($mail1) || empty($mail2)) {
            $errors[] = "Les deux champs email doivent être remplis";
        } else {
            // Validation format email
            if (!filter_var($mail1, FILTER_VALIDATE_EMAIL)) {
                $errors[] = "Le premier email n'est pas valide";
            }
            if (!filter_var($mail2, FILTER_VALIDATE_EMAIL)) {
                $errors[] = "Le second email n'est pas valide";
            }
            // Vérifier que les emails sont identiques
            if ($mail1 !== $mail2) {
                $errors[] = "Les deux emails doivent être identiques";
            }
        }
    }
    
    // Validation password (seulement si renseigné)
    if (!empty($password1) || !empty($password2)) {
        if (empty($password1) || empty($password2)) {
            $errors[] = "Les deux champs password doivent être remplis";
        } else {
            // Regex: 8-15 caractères, 1 majuscule, 1 minuscule, 1 chiffre
            $passwordRegex = '/^(?=.*[a-z])(?=.*[A-Z])(?=.*\d).{8,15}$/';
            
            if (!preg_match($passwordRegex, $password1)) {
                $errors[] = "Le password doit contenir entre 8 et 15 caractères, au moins une majuscule, une minuscule et un chiffre";
            }
            if (!preg_match($passwordRegex, $password2)) {
                $errors[] = "Le second password ne respecte pas le format requis";
            }
            // Vérifier que les passwords sont identiques
            if ($password1 !== $password2) {
                $errors[] = "Les deux passwords doivent être identiques";
            }
        }
    }
    
    // Si pas d'erreurs, procéder à la mise à jour
    if (empty($errors)) {
        $updateData = [
            'prenomMemb' => $prenom,
            'nomMemb' => $nom,
            'numStat' => $numStat,
            'dtMajMemb' => date('Y-m-d H:i:s')
        ];
        
        // Ajouter le mail si modifié
        if (!empty($mail1)) {
            $updateData['eMailMemb'] = $mail1;
        }
        
        // Ajouter le password crypté si modifié
        if (!empty($password1)) {
            $updateData['passMemb'] = password_hash($password1, PASSWORD_DEFAULT);
        }
        
        // UPDATE en BDD
        $result = sql_update('MEMBRE', $updateData, "numMemb = $numMemb");
        
        if ($result) {
            $success = "Le membre a été mis à jour avec succès";
        } else {
            $errors[] = "Erreur lors de la mise à jour du membre";
        }
    }
}

// Charger les données du membre
$membre = sql_select('MEMBRE', '*', "numMemb = $numMemb");
if (empty($membre)) {
    echo '<div class="alert alert-danger">Membre introuvable</div>';
    include '../footer-admin.php';
    exit;
}
$membre = $membre[0];

// Charger la liste des statuts
$statuts = sql_select('STATUT', '*');
?>

<div class="container">
    <div class="row">
        <div class="col-md-12">
            <h1><i class="fas fa-edit me-2"></i>Modifier un Membre</h1>

<?php if ($success): ?>
    <div class="alert alert-success">
        <i class="fas fa-check-circle me-2"></i><?php echo $success; ?>
    </div>
<?php endif; ?>

<?php if (!empty($errors)): ?>
    <div class="alert alert-danger">
        <i class="fas fa-exclamation-triangle me-2"></i>
        <ul class="mb-0">
            <?php foreach ($errors as $error): ?>
                <li><?php echo htmlspecialchars($error); ?></li>
            <?php endforeach; ?>
        </ul>
    </div>
<?php endif; ?>

<div class="card" style="border-radius: var(--radius-sm); box-shadow: var(--shadow); border: 1px solid var(--color-accent);">
    <div class="card-body p-4">
        <form method="POST" action="" id="form-recaptcha">
            <div class="row">
                <!-- Pseudo (non modifiable) -->
                <div class="col-md-6 mb-3">
                    <label class="form-label fw-bold">
                        <i class="fas fa-user me-2"></i>Pseudo
                        <span class="text-danger">*</span>
                    </label>
                    <input type="text" 
                           class="form-control" 
                           value="<?php echo htmlspecialchars($membre['pseudoMemb']); ?>" 
                           disabled
                           style="background-color: #f5f5f5;">
                    <small class="text-muted">Le pseudo ne peut pas être modifié</small>
                </div>

                <!-- Statut -->
                <div class="col-md-6 mb-3">
                    <label class="form-label fw-bold">
                        <i class="fas fa-shield-alt me-2"></i>Statut
                        <span class="text-danger">*</span>
                    </label>
                    <select name="numStat" class="form-select" required>
                        <?php foreach ($statuts as $statut): ?>
                            <option value="<?php echo $statut['numStat']; ?>" 
                                    <?php echo ($statut['numStat'] == $membre['numStat']) ? 'selected' : ''; ?>>
                                <?php echo htmlspecialchars($statut['libStat']); ?>
                            </option>
                        <?php endforeach; ?>
                    </select>
                </div>

                <!-- Prénom -->
                <div class="col-md-6 mb-3">
                    <label class="form-label fw-bold">
                        <i class="fas fa-user me-2"></i>Prénom
                        <span class="text-danger">*</span>
                    </label>
                    <input type="text" 
                           name="prenom" 
                           class="form-control" 
                           value="<?php echo htmlspecialchars($membre['prenomMemb']); ?>" 
                           required>
                </div>

                <!-- Nom -->
                <div class="col-md-6 mb-3">
                    <label class="form-label fw-bold">
                        <i class="fas fa-user me-2"></i>Nom
                        <span class="text-danger">*</span>
                    </label>
                    <input type="text" 
                           name="nom" 
                           class="form-control" 
                           value="<?php echo htmlspecialchars($membre['nomMemb']); ?>" 
                           required>
                </div>

                <!-- Email 1 -->
                <div class="col-md-6 mb-3">
                    <label class="form-label fw-bold">
                        <i class="fas fa-envelope me-2"></i>Email
                    </label>
                    <input type="email" 
                           name="mail1" 
                           class="form-control" 
                           placeholder="Laisser vide pour ne pas modifier">
                    <small class="text-muted">Email actuel: <?php echo htmlspecialchars($membre['eMailMemb']); ?></small>
                </div>

                <!-- Email 2 -->
                <div class="col-md-6 mb-3">
                    <label class="form-label fw-bold">
                        <i class="fas fa-envelope me-2"></i>Confirmer Email
                    </label>
                    <input type="email" 
                           name="mail2" 
                           class="form-control" 
                           placeholder="Confirmer le nouvel email">
                </div>

                <!-- Password 1 -->
                <div class="col-md-6 mb-3">
                    <label class="form-label fw-bold">
                        <i class="fas fa-lock me-2"></i>Nouveau Password
                    </label>
                    <input type="password" 
                           name="password1" 
                           class="form-control" 
                           placeholder="Laisser vide pour ne pas modifier">
                    <small class="text-muted">8-15 caractères, 1 majuscule, 1 minuscule, 1 chiffre</small>
                </div>

                <!-- Password 2 -->
                <div class="col-md-6 mb-3">
                    <label class="form-label fw-bold">
                        <i class="fas fa-lock me-2"></i>Confirmer Password
                    </label>
                    <input type="password" 
                           name="password2" 
                           class="form-control" 
                           placeholder="Confirmer le nouveau password">
                </div>

                <!-- Date de création (non modifiable) -->
                <div class="col-md-6 mb-3">
                    <label class="form-label fw-bold">
                        <i class="fas fa-calendar me-2"></i>Date de création
                    </label>
                    <input type="text" 
                           class="form-control" 
                           value="<?php echo htmlspecialchars($membre['dtCreaMemb']); ?>" 
                           disabled
                           style="background-color: #f5f5f5;">
                </div>

                <!-- Date de modification -->
                <div class="col-md-6 mb-3">
                    <label class="form-label fw-bold">
                        <i class="fas fa-calendar-check me-2"></i>Dernière modification
                    </label>
                    <input type="text" 
                           class="form-control" 
                           value="<?php echo htmlspecialchars($membre['dtMajMemb'] ?? 'Jamais modifié'); ?>" 
                           disabled
                           style="background-color: #f5f5f5;">
                </div>

                <!-- RGPD (non modifiable) -->
                <div class="col-12 mb-3">
                    <label class="form-label fw-bold">
                        <i class="fas fa-shield-alt me-2"></i>Accord RGPD
                    </label>
                    <div class="form-check">
                        <input type="checkbox" 
                               class="form-check-input" 
                               <?php echo ($membre['accordMemb'] == 1) ? 'checked' : ''; ?> 
                               disabled>
                        <label class="form-check-label">
                            Accepte le stockage des données personnelles
                        </label>
                    </div>
                    <small class="text-muted">L'accord RGPD ne peut pas être modifié</small>
                </div>
            </div>

            <!-- reCAPTCHA v2 -->
            <div class="mb-3">
                <div class="g-recaptcha" data-sitekey="6LexJl8sAAAAAJ-6piYK9VQDiCFVdhcTkaF4ZH83"></div>
            </div>

            <!-- Boutons d'action -->
            <div class="d-flex gap-2 justify-content-end mt-4">
                <a href="list.php" class="btn btn-secondary">
                    <i class="fas fa-arrow-left me-2"></i>Retour
                </a>
                <button type="submit" class="btn btn-primary">
                    <i class="fas fa-edit me-2"></i>Modifier
                </button>
            </div>
        </form>
    </div>
</div>

        </div>
    </div>
</div>

