<?php

require_once("modele/User.class.php");

$userModel = new User($pdo);

$message = "";

if (isset($_POST['login'])) {

    $login = $_POST['pseudo'];
    $password = $_POST['password'];

    $user = $userModel->login($login, $password);

    if ($user) {

        $_SESSION['id'] = $user['idUser'];
        $_SESSION['pseudo'] = $user['login'];

        if ($user['login'] == "admin") {
            header("Location:index.php?page=admin");
            exit();
        }

        header("Location:index.php?page=accueil");
        exit();

    } else {
        $message = "Identifiants incorrects.";
    }
}
?>