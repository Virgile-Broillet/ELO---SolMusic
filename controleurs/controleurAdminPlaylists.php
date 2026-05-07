<?php

if (!isset($_SESSION['pseudo']) || $_SESSION['pseudo'] != "admin") {
    header("Location:index.php?page=connexion");
    exit();
}

require_once("modele/Playlist.class.php");
require_once("modele/Musique.class.php");

$playlistModel = new Playlist($pdo);
$musiqueModel  = new Musique($pdo);

$message = "";

/* ========================= */
/* CREER PLAYLIST */
/* ========================= */
if (isset($_POST['creerPlaylist'])) {

    $titre  = trim($_POST['titre_playlist']);
    $idUser = intval($_POST['idUser']);

    if ($titre != "" && $idUser > 0) {

        $playlistModel->create($titre, $idUser);
        $message = "Playlist créée.";

    } else {

        $message = "Champs invalides.";
    }
}

/* ========================= */
/* AJOUTER MUSIQUE */
/* ========================= */
if (isset($_POST['ajouterMusique'])) {

    $idPlaylist = intval($_POST['idPlaylist']);
    $idChanson  = intval($_POST['idChanson']);

    if ($idPlaylist > 0 && $idChanson > 0) {

        if ($playlistModel->addSong($idPlaylist, $idChanson)) {
            $message = "Musique ajoutée.";
        } else {
            $message = "Cette musique est déjà dans la playlist.";
        }

    } else {

        $message = "Valeurs invalides.";
    }
}

/* ========================= */
/* RETIRER MUSIQUE */
/* ========================= */
if (isset($_GET['remove']) && isset($_GET['song'])) {

    $playlistModel->removeSong(
        intval($_GET['remove']),
        intval($_GET['song'])
    );

    $message = "Musique retirée.";
}

/* ========================= */
/* SUPPRIMER PLAYLIST */
/* ========================= */
if (isset($_GET['supprimer'])) {

    $stmt = $pdo->prepare("
        DELETE FROM PLAYLIST
        WHERE idP = :id
    ");

    $stmt->execute([
        'id' => intval($_GET['supprimer'])
    ]);

    $message = "Playlist supprimée.";
}

/* ========================= */
/* RECUP PLAYLISTS */
/* ========================= */
$stmt = $pdo->query("
    SELECT *
    FROM PLAYLIST
    ORDER BY idP DESC
");

$playlists = $stmt->fetchAll(PDO::FETCH_ASSOC);

/* MUSIQUES DE CHAQUE PLAYLIST */
foreach ($playlists as &$p) {

    $p['musiques'] = $playlistModel->getSongs($p['idP']);
}

unset($p);

/* ========================= */
/* TOUS LES UTILISATEURS */
/* ========================= */
$stmt = $pdo->query("
    SELECT idUser, login
    FROM UTILISATEUR
    ORDER BY login ASC
");

$users = $stmt->fetchAll(PDO::FETCH_ASSOC);

/* ========================= */
/* TOUTES LES CHANSONS */
/* ========================= */
$allSongs = $musiqueModel->getAll();

?>