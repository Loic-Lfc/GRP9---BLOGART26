<?php
include("../myBDD.php");

if (isset($_POST["pseudonyme"]) && isset($_POST["password"]) && isset($_POST["password2"])) {
	$username = trim($_POST['pseudonyme']);
	$password = $_POST['password'];
	$password2 = $_POST['password2'];
	if ($username !== "" && strlen($password) >= 8 && $password === $password2) {
		$hashedPassword = password_hash($password, PASSWORD_DEFAULT);
		$sql_requete = "INSERT INTO utilisateur (pseudonyme, mot_de_passe) VALUES (:pseudonyme, :mot_de_passe);";
		$request = BDD::get()->prepare($sql_requete);
		$request->execute([':pseudonyme' => $username, ':mot_de_passe' => $hashedPassword]);
		header("Location: signup.php?success");
		exit();
	} else {
		header("Location: signup.php?error");
		exit();
	}
}

if (isset($_GET['success'])) {
	echo "<div class='alert alert-success' role='alert'>Inscription réussie ! Vous pouvez maintenant vous connecter.</div>";
} elseif (isset($_GET['error'])) {
	echo "<div class='alert alert-danger' role='alert'>Erreur lors de l'inscription. Veuillez vérifier vos informations et réessayer.</div>";
}


>>>>>>> 90d970d35155d6436bc1f2b8f9ab91ce78701029
?>