<?php

include("../.env");

if (isset($_POST["password"]) && isset($_POST["pseudonyme"])) {
    $password = $_POST["password"];
    $username = trim($_POST['pseudonyme']);
    
    $sql_requete = "SELECT mot_de_passe FROM utilisateur WHERE pseudonyme = :pseudonyme;";
    $request = BDD::get()->prepare($sql_requete);
    $request->execute([':pseudonyme' => $username]);
    $result = $request->fetch(PDO::FETCH_ASSOC);
    
    if ($result && password_verify($password, $result['mot_de_passe'])) {
        session_start();
        $_SESSION['pseudonyme'] = $username;
        header("Location: ../index.php");
        exit();
    } else {
        header("Location: ../login.php?error");
        exit();
    }
}

header('Location: ../login.php?error');
exit();

?>