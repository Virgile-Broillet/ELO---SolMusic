<?php

/* controleurOffres.php */

if (session_status() === PHP_SESSION_NONE) {
	session_start();
}

$connecte = false;
$planActuel = "Visiteur";
$idUser = 0;

if (isset($_SESSION['id'])) {

	$connecte = true;
	$idUser = $_SESSION['id'];

	$stmt = $pdo->prepare("
		SELECT plan
		FROM UTILISATEUR
		WHERE idUser = :id
	");

	$stmt->execute([
		'id' => $idUser
	]);

	$user = $stmt->fetch(PDO::FETCH_ASSOC);

	if ($user) {
		$planActuel = $user['plan'];
	}
}

/* changement d'offre si connecté */
$message = "";

if ($connecte && isset($_GET['choisir'])) {

	$choix = $_GET['choisir'];

	if ($choix == "Standard" || $choix == "Premium") {

		$stmt = $pdo->prepare("
			UPDATE UTILISATEUR
			SET plan = :plan
			WHERE idUser = :id
		");

		$stmt->execute([
			'plan' => $choix,
			'id'   => $idUser
		]);

		$planActuel = $choix;
		$message = "Votre abonnement a été mis à jour.";
	}
}
?>