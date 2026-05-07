<?php

require_once("modele/Musique.class.php");

/* ========================= */
/* LISTES FILTRES */
/* ========================= */
$stmt = $pdo->query("
	SELECT DISTINCT artiste
	FROM CHANSON
	ORDER BY artiste ASC
");
$artistes = $stmt->fetchAll(PDO::FETCH_ASSOC);

$stmt = $pdo->query("
	SELECT DISTINCT genre
	FROM CHANSON
	ORDER BY genre ASC
");
$genres = $stmt->fetchAll(PDO::FETCH_ASSOC);

/* ========================= */
/* FILTRES */
/* ========================= */
$filtreArtiste = $_GET['artiste'] ?? "";
$filtreGenre   = $_GET['genre'] ?? "";

/* ========================= */
/* REQUETE */
/* ========================= */
$sql = "SELECT * FROM CHANSON WHERE 1=1";
$params = [];

if ($filtreArtiste != "") {
	$sql .= " AND artiste = :artiste";
	$params['artiste'] = $filtreArtiste;
}

if ($filtreGenre != "") {
	$sql .= " AND genre = :genre";
	$params['genre'] = $filtreGenre;
}

$sql .= " ORDER BY artiste ASC, titre ASC";

$stmt = $pdo->prepare($sql);
$stmt->execute($params);

$musiques = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>