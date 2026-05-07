<?php

require_once("inc/connect.inc.php");

$message = "";

/* ========================= */
/* ENVOI FORMULAIRE CONTACT */
/* ========================= */
if (isset($_POST['envoyerMessage'])) {

	$nom     = trim($_POST['nom']);
	$email   = trim($_POST['email']);
	$objet   = trim($_POST['objet']);
	$contenu = trim($_POST['message']);

	/* vérification */
	if (
		$nom != "" &&
		$email != "" &&
		$objet != "" &&
		$contenu != ""
	) {

		if (filter_var($email, FILTER_VALIDATE_EMAIL)) {

			$stmt = $pdo->prepare("
				INSERT INTO CONTACT (
					nom,
					email,
					objet,
					message
				)
				VALUES (
					:nom,
					:email,
					:objet,
					:message
				)
			");

			$ok = $stmt->execute([
				'nom'     => $nom,
				'email'   => $email,
				'objet'   => $objet,
				'message' => $contenu
			]);

			if ($ok) {

				$message = "Votre message a bien été envoyé.";

			} else {

				$message = "Erreur lors de l'enregistrement.";
			}

		} else {

			$message = "Adresse e-mail invalide.";
		}

	} else {

		$message = "Merci de remplir tous les champs.";
	}
}

?>