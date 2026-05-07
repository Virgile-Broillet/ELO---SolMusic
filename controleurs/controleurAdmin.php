<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

if (!isset($_SESSION['pseudo']) || $_SESSION['pseudo'] != "admin") {
    header("Location: ../index.php?page=connexion");
    exit();
}
?>