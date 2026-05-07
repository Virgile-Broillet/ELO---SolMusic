<?php

if (!isset($_SESSION['pseudo']) || $_SESSION['pseudo'] != "admin") {
    header("Location:index.php?page=connexion");
    exit();
}

require_once("modele/Musique.class.php");

$musique = new Musique($pdo);

$message = "";

/* ========================= */
/* AJOUTER UNE CHANSON */
/* ========================= */
if (isset($_POST['ajouter'])) {

    $titre   = trim($_POST['titre']);
    $artiste = trim($_POST['artiste']);
    $annee   = trim($_POST['annee']);
    $genre   = trim($_POST['genre']);
    $fichier = trim($_POST['fichier']);

    if ($titre != "" && $artiste != "" && $annee != "" && $genre != "" && $fichier != "") {

        $musique->insert($titre, $artiste, $annee, $genre, $fichier);

        $message = "Chanson ajoutée avec succès.";

    } else {

        $message = "Veuillez remplir tous les champs.";
    }
}

/* ========================= */
/* SUPPRIMER UNE CHANSON */
/* ========================= */
if (isset($_GET['supprimer'])) {

    $id = intval($_GET['supprimer']);

    $musique->delete($id);

    $message = "Chanson supprimée.";
}

/* ========================= */
/* LISTE DES CHANSONS */
/* ========================= */
$chansons = $musique->getAll();

?>