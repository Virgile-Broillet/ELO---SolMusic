<?php

if (!isset($_SESSION['id'])) {
	header("Location:index.php?page=connexion");
	exit();
}

require_once("modele/Playlist.class.php");
require_once("modele/Musique.class.php");

$playlistModel = new Playlist($pdo);
$musiqueModel  = new Musique($pdo);

$message = "";

$idUser = $_SESSION['id'];

/* ========================= */
/* PLAN USER */
/* ========================= */
$stmt = $pdo->prepare("
	SELECT plan
	FROM UTILISATEUR
	WHERE idUser = :id
");

$stmt->execute([
	'id' => $idUser
]);

$user = $stmt->fetch(PDO::FETCH_ASSOC);

$plan = $user['plan'] ?? "Standard";

/* ========================= */
/* CREER PLAYLIST */
/* ========================= */
if (isset($_POST['creerPlaylist'])) {

	$titre = trim($_POST['titre_playlist']);

	if ($titre != "") {

		/* si plan standard = max 3 playlists */
		if ($plan == "Standard") {

			$stmt = $pdo->prepare("
				SELECT COUNT(*) 
				FROM PLAYLIST
				WHERE idUser = :id
			");

			$stmt->execute([
				'id' => $idUser
			]);

			$nbPlaylists = $stmt->fetchColumn();

			if ($nbPlaylists >= 3) {

				header("Location:index.php?page=offres");
				exit();
			}
		}

		/* création autorisée */
		$playlistModel->create($titre, $idUser);

		$message = "Playlist créée.";
	}
}

/* ========================= */
/* AJOUTER MUSIQUE */
/* ========================= */
if (isset($_POST['ajouterMusique'])) {

	$idPlaylist = intval($_POST['idPlaylist']);
	$idChanson  = intval($_POST['idChanson']);

	if ($idPlaylist > 0 && $idChanson > 0) {

		/* Vérifie que la playlist appartient bien au user */
		$stmt = $pdo->prepare("
			SELECT idP
			FROM PLAYLIST
			WHERE idP = :id
			AND idUser = :user
		");

		$stmt->execute([
			'id'   => $idPlaylist,
			'user' => $idUser
		]);

		if ($stmt->fetch()) {

			if ($playlistModel->addSong($idPlaylist, $idChanson)) {

				$message = "Musique ajoutée.";

			} else {

				$message = "Cette musique est déjà dans la playlist.";
			}
		}
	}
}

/* ========================= */
/* SUPPRIMER PLAYLIST */
/* ========================= */
if (isset($_GET['supprimer'])) {

	$stmt = $pdo->prepare("
		DELETE FROM PLAYLIST
		WHERE idP = :id
		AND idUser = :user
	");

	$stmt->execute([
		'id'   => intval($_GET['supprimer']),
		'user' => $idUser
	]);

	$message = "Playlist supprimée.";
}

/* ========================= */
/* RETIRER MUSIQUE */
/* ========================= */
if (isset($_GET['remove']) && isset($_GET['song'])) {

	$idPlaylist = intval($_GET['remove']);
	$idSong     = intval($_GET['song']);

	/* sécurité playlist user */
	$stmt = $pdo->prepare("
		SELECT idP
		FROM PLAYLIST
		WHERE idP = :id
		AND idUser = :user
	");

	$stmt->execute([
		'id'   => $idPlaylist,
		'user' => $idUser
	]);

	if ($stmt->fetch()) {

		$playlistModel->removeSong($idPlaylist, $idSong);

		$message = "Musique retirée.";
	}
}

/* ========================= */
/* PLAYLISTS USER */
/* ========================= */
$stmt = $pdo->prepare("
	SELECT *
	FROM PLAYLIST
	WHERE idUser = :id
	ORDER BY idP DESC
");

$stmt->execute([
	'id' => $idUser
]);

$playlists = $stmt->fetchAll(PDO::FETCH_ASSOC);

/* MUSIQUES PLAYLIST */
foreach ($playlists as &$p) {

	$p['musiques'] = $playlistModel->getSongs($p['idP']);
}

unset($p);

/* ========================= */
/* TOUTES LES MUSIQUES */
/* ========================= */
$allSongs = $musiqueModel->getAll();

?>