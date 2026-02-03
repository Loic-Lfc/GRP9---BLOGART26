<?php
if (!isset($_SESSION)) {
    session_start();
}

include '../../../header.php';

// Si l'utilisateur a déjà une session, redirigez-le vers index.php
if (isset($_SESSION['pseudoMemb'])) {
    header("Location: ../../../index.php");
    exit();
}
?>

<div class="row">
    <div class="col-sm-2"></div>
    <div class="col-sm-8">
        <h2>Inscription</h2>
        
        <?php 
        if (isset($_GET['error'])) {
            if ($_GET['error'] === 'pseudo') {
                echo '<div class="alert alert-danger" role="alert">Ce pseudonyme existe déjà. Veuillez en choisir un autre.</div>';
            } else if ($_GET['error'] === 'pseudo_length') {
                echo '<div class="alert alert-danger" role="alert">Le pseudonyme doit contenir entre 6 et 70 caractères.</div>';
            } else if ($_GET['error'] === 'password_format') {
                echo '<div class="alert alert-danger" role="alert">Le mot de passe doit contenir entre 8 et 15 caractères, au moins une majuscule, une minuscule et un chiffre.</div>';
            } else if ($_GET['error'] === 'email_invalid') {
                echo '<div class="alert alert-danger" role="alert">L\'adresse email n\'est pas valide. Veuillez entrer une adresse email correcte.</div>';
            } else if ($_GET['error'] === 'email_mismatch') {
                echo '<div class="alert alert-danger" role="alert">Les deux adresses email ne correspondent pas. Veuillez les vérifier.</div>';
            } else {
                echo '<div class="alert alert-danger" role="alert">Erreur lors de l\'inscription. Vérifiez que vos mots de passe correspondent.</div>';
            }
        }
        ?>

        <form class="mt-4" action="../../../api/security/signup.php" method="post">
            <div class="form-group row text-right">
                <label for="prenomMemb" class="col-sm-6 col-form-label">Prénom</label>
                <div class="col-sm-5">
                    <input type="text" class="form-control" id="prenomMemb" name="prenomMemb" placeholder="Prénom">
                </div>
            </div>
            <div class="form-group row text-right">
                <label for="nomMemb" class="col-sm-6 col-form-label">Nom</label>
                <div class="col-sm-5">
                    <input type="text" class="form-control" id="nomMemb" name="nomMemb" placeholder="Nom">
                </div>
            </div>
            <div class="form-group row text-right">
                <label for="pseudoMemb" class="col-sm-6 col-form-label">Pseudonyme <small>(6-70 caractères)</small></label>
                <div class="col-sm-5">
                    <input type="text" class="form-control" id="pseudoMemb" name="pseudoMemb" placeholder="Pseudonyme" required minlength="6" maxlength="70">
                </div>
            </div>
            <div class="form-group row text-right">
                <label for="eMailMemb" class="col-sm-6 col-form-label">Email</label>
                <div class="col-sm-5">
                    <input type="email" class="form-control" id="eMailMemb" name="eMailMemb" placeholder="Email" required>
                </div>
            </div>
            <div class="form-group row text-right">
                <label for="eMailMemb2" class="col-sm-6 col-form-label">Confirmer l'email</label>
                <div class="col-sm-5">
                    <input type="email" class="form-control" id="eMailMemb2" name="eMailMemb2" placeholder="Confirmez votre email" required>
                </div>
            </div>
            <div class="form-group row text-right">
                <label for="passMemb" class="col-sm-6 col-form-label">Mot de passe <small>(8-15 caractères, 1 majuscule, 1 minuscule, 1 chiffre)</small></label>
                <div class="col-sm-5">
                    <input type="password" class="form-control" id="passMemb" name="passMemb" required minlength="8" maxlength="15" pattern="^(?=.*[A-Z])(?=.*[a-z])(?=.*[0-9]).*$" title="Le mot de passe doit contenir au moins une majuscule, une minuscule et un chiffre">
                </div>
            </div>
            <div class="form-group row text-right">
                <label for="passMemb2" class="col-sm-6 col-form-label">Réécrivez le même mot de passe</label>
                <div class="col-sm-5">
                    <input type="password" class="form-control" id="passMemb2" name="passMemb2" required>
                </div>
            </div>
            
            <input type="submit" class="btn btn-secondary" value="S'inscrire">
        </form>

        <p class="mt-3"><a href="login.php">Déjà inscrit ? Se connecter</a></p>
    </div>
</div>
<?php
include("../../../footer.php");
?>