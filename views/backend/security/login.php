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
    <div class="col-sm-3"></div>
    <div class="col-sm-6">
        <h2>Connexion</h2>
        
        <?php 
        if (isset($_GET['error'])) {
            echo '<div class="alert alert-danger" role="alert">Pseudonyme ou mot de passe incorrect.</div>';
        }
        if (isset($_GET['success'])) {
            echo '<div class="alert alert-success" role="alert">Inscription réussie ! Vous pouvez maintenant vous connecter.</div>';
        }
        ?>

        <form class="mt-4" action="../../../api/security/login.php" method="post">
            <div class="form-group row text-right">
                <label for="pseudoMemb" class="col-sm-6 col-form-label">Pseudonyme</label>
                <div class="col-sm-5">
                    <input type="text" class="form-control" id="pseudoMemb" name="pseudoMemb" placeholder="Pseudonyme" required>
                </div>
            </div>
            <div class="form-group row text-right">
                <label for="passMemb" class="col-sm-6 col-form-label">Mot de passe</label>
                <div class="col-sm-5">
                    <input type="password" class="form-control" id="passMemb" name="passMemb" required>
                </div>
            </div>
            
            <input type="submit" class="btn btn-secondary" value="Se connecter">
        </form>

        <p class="mt-3"><a href="signup.php">Pas encore inscrit ? Créer un compte</a></p>
    </div>
</div>
<?php
include("../../../footer.php");
?>