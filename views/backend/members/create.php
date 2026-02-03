<?php
// Inclusion des fichiers nécessaires
include '../../../header.php';

// On vérifie si l'utilisateur est admin ou modérateur
if (!isset($_SESSION['numStat']) || ($_SESSION['numStat'] != 1 && $_SESSION['numStat'] != 2)) {
    header('Location: ../../views/backend/members/list.php?error=forbidden');
    exit();
}

// Récupération des statuts pour le select
$statuts = sql_select("STATUT", "*", "numStat");
$numStat = sql_select("STATUT", "numStat", "numStat");

// Messages d'erreur selon l'url
if (isset($_GET['error'])): ?>
    <div class="alert alert-danger">
        <?php
        if ($_GET['error'] == 'size')
            echo "Le pseudo doit faire entre 6 et 70 caractères.";
        else if ($_GET['error'] == 'exists')
            echo "Ce pseudo est déjà utilisé.";
        else if ($_GET['error'] == 'email_invalid')
            echo "Format d'email invalide.";
        else if ($_GET['error'] == 'email_match')
            echo "Les emails ne correspondent pas.";
        else if ($_GET['error'] == 'pass_invalid')
            echo "Le mot de passe doit contenir entre 8 et 15 caractères, une majuscule, une minuscule, un chiffre et un caractère spécial.";
        else if ($_GET['error'] == 'rgpd')
            echo "Vous devez accepter le RGPD pour créer un compte.";
        else if ($_GET['error'] == 'recaptcha')
            echo "La vérification reCAPTCHA est requise. Veuillez cocher la case 'Je ne suis pas un robot'.";
        endif;
        ?>
    </div>

<!-- Bootstrap form to create a new statut -->
<div class="container">
    <div class="row">
        <div class="col-md-12">
            <h1>Création nouveau membre</h1>
        </div>
        <div class="col-md-12">
            <!-- Form to create a new statut -->
            <form action="<?php echo ROOT_URL . '/api/members/create.php' ?>" method="post">

                <!-- Pseudo -->
                <div class="form-group">
                    <label for="pseudoMemb">Pseudo du membre</label>
                    <input id="pseudoMemb" name="pseudoMemb" class="form-control" type="text" autofocus="autofocus"
                        required />
                </div>

                <!-- Mot de passe -->
                <div class="form-group">
                    <label for="passMemb">Mot de passe</label>
                    <input id="passMemb" name="passMemb" class="form-control" type="password" required />
                </div>

                <!-- Confirmation mot de passe -->
                <div class="form-group">
                    <label for="passMemb2">Confirmation du mot de passe</label>
                    <input id="passMemb2" name="passMemb2" class="form-control" type="password" required />
                </div>

                <!-- Nom du membre -->
                <div class="form-group">
                    <label for="nomMemb">Nom du membre</label>
                    <input id="nomMemb" name="nomMemb" class="form-control" type="text" autofocus="autofocus" required />
                </div>

                <!-- Prénom du membre -->
                <div class="form-group">
                    <label for="prenomMemb">Prénom du membre</label>
                    <input id="prenomMemb" name="prenomMemb" class="form-control" type="text" autofocus="autofocus" required />
                </div>

                <!-- Email du membre -->
                <div class="form-group">
                    <label for="eMailMemb">Email du membre</label>
                    <input id="eMailMemb" name="eMailMemb" class="form-control" type="email" required />
                </div>

                <!-- Confirmation de l'email -->
                <div class="form-group">
                    <label for="eMailMemb2">Confirmation de l'email</label>
                    <input id="eMailMemb2" name="eMailMemb2" class="form-control" type="email" required />
                </div>

                <!-- Choix du statut -->
                <select name="numStat" id="numStat" class="form-control" required>
                    <?php foreach ($statuts as $statut): ?>
                        <?php 
                        // 1. On masque TOUJOURS l'Administrateur (numStat 1)
                        if ($statut['numStat'] == 1) continue;

                        // 2. Si l'utilisateur connecté est Modérateur (session numStat == 2)
                        // on masque aussi le choix Modérateur (statut numStat == 2)
                        if (isset($_SESSION['numStat']) && $_SESSION['numStat'] == 2 && $statut['numStat'] == 2) {
                            continue;
                        }
                        ?>
                        <option value="<?php echo $statut['numStat']; ?>" <?php echo ($statut['numStat'] == $numStat) ? 'selected' : ''; ?>>
                            <?php echo $statut['libStat']; ?>
                        </option>
                    <?php endforeach; ?>
                </select>
                
                <!-- Accord RGPD -->
                <div class="form-group mt-3">
                    <div class="form-check">
                        <input class="form-check-input" type="checkbox" name="accordMemb" id="accordMemb" value="1" required>
                        <label class="form-check-label" for="accordMemb">
                            J'accepte la conservation de mes données personnelles (RGPD)
                        </label>
                    </div>
                </div>

                <!-- reCAPTCHA v2 -->
                <div class="form-group mt-3">
                    <div class="g-recaptcha" data-sitekey="6LexJl8sAAAAAJ-6piYK9VQDiCFVdhcTkaF4ZH83"></div>
                </div>

                <br />
                <div class="form-group mt-2">
                    <a href="list.php" class="btn btn-primary">List</a>
                    <button type="submit" class="btn btn-success">Confirmer create ?</button>
                </div>
            </form>
        </div>
    </div>
</div>