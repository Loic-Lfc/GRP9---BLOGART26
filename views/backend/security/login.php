<?php

include '../../../header.php';
//Si l'utilisateur a déjà une session, redirigez-le vers index.php
if (isset($_SESSION['pseudonyme'])) {
    header("Location: index.php");
    exit();
}
?>

<div class="row">
	<div class="col-sm-3"></div>
	<div class="col-sm-6">
		<h2>Connexion</h2>
		
		<p><?php /* Afficher un message ici si la connexion a échoué */ ?></p>

		<form class="mt-4" action="api/login.php" method="post">
			<div class="form-group row text-right">
				<label for="pseudonyme" class="col-sm-6 col-form-label">Pseudonyme</label>
				<div class="col-sm-5">
					<input type="text" class="form-control" id="pseudonyme" name="pseudonyme" placeholder="Pseudonyme">
				</div>
			</div>
			<div class="form-group row text-right">
				<label for="password" class="col-sm-6 col-form-label">Mot de passe</label>
				<div class="col-sm-5">
					<input type="password" class="form-control" id="password" name="password">
				</div>
			</div>
			
			<input type="submit" class="btn btn-secondary" value="Se connecter">
		</form>
	</div>
</div>
<?php

include("../../../footer.php");

?>