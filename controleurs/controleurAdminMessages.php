<?php

if (!isset($_SESSION['pseudo']) || $_SESSION['pseudo'] != "admin") {
	header("Location:index.php?page=connexion");
	exit();
}

$message = "";

/* ========================= */
/* SUPPRIMER MESSAGE */
/* ========================= */
if (isset($_GET['supprimer'])) {

	$id = intval($_GET['supprimer']);

	$stmt = $pdo->prepare("
		DELETE FROM CONTACT
		WHERE idContact = :id
	");

	$stmt->execute([
		'id' => $id
	]);

	$message = "Message supprimé.";
}

/* ========================= */
/* RECUPERATION MESSAGES */
/* ========================= */
$stmt = $pdo->query("
	SELECT *
	FROM CONTACT
	ORDER BY dateEnvoi DESC
");

$messages = $stmt->fetchAll(PDO::FETCH_ASSOC);

?>