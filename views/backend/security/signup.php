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
            } else {
                echo '<div class="alert alert-danger" role="alert">Erreur lors de l\'inscription. Vérifiez que vos mots de passe correspondent et que le mot de passe contient au moins 8 caractères.</div>';
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
                <label for="pseudoMemb" class="col-sm-6 col-form-label">Pseudonyme</label>
                <div class="col-sm-5">
                    <input type="text" class="form-control" id="pseudoMemb" name="pseudoMemb" placeholder="Pseudonyme" required>
                </div>
            </div>
            <div class="form-group row text-right">
                <label for="eMailMemb" class="col-sm-6 col-form-label">Email</label>
                <div class="col-sm-5">
                    <input type="email" class="form-control" id="eMailMemb" name="eMailMemb" placeholder="Email">
                </div>
            </div>
            <div class="form-group row text-right">
                <label for="passMemb" class="col-sm-6 col-form-label">Mot de passe (au moins 8 caractères)</label>
                <div class="col-sm-5">
                    <input type="password" class="form-control" id="passMemb" name="passMemb" required>
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