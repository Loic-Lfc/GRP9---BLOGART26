<?php
include '../../header.php';
require_once '../../functions/ctrlSaisies.php';

$prenomMemb = ctrlSaisies($_POST['prenomMemb']);
$nomMemb = ctrlSaisies($_POST['nomMemb']);
$pseudoMemb = ctrlSaisies($_POST['pseudoMemb']);
$passMemb = password_hash($_POST['passMemb'], PASSWORD_DEFAULT);
$eMailMemb = ctrlSaisies($_POST['eMailMemb']);
$dtCreaMemb = ctrlSaisies($_POST['dtCreaMemb']);
$dtMajMemb = ctrlSaisies($_POST['dtMajMemb']);
$numStat = ctrlSaisies($_POST['numStat']);

sql_insert(
    'MEMBRE', 
    'prenomMemb, nomMemb, pseudoMemb, passMemb, eMailMemb, dtCreaMemb, dtMajMemb, numStat', 
    "'$prenomMemb', '$nomMemb', '$pseudoMemb', '$passMemb', '$eMailMemb', '$dtCreaMemb', '$dtMajMemb', '$numStat'"
);

header('Location: ../../views/backend/members/list.php');