<?php

require_once("modele/User.class.php");
require_once("inc/connect.inc.php");

$pdo = getConnexion();
$userModel = new User($pdo);

$message = "";

if (isset($_POST['register'])) {

    $login = trim($_POST['pseudo']);
    $password = trim($_POST['password']);

    if (!empty($login) && !empty($password)) {

        $userModel->create($login, $password);

        $message = "Compte créé avec succès.";

    } else {
        $message = "Veuillez remplir tous les champs.";
    }
}
?>