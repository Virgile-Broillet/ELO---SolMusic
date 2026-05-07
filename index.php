<?php
	session_start();

	ini_set('display_errors', 1);
	ini_set('display_startup_errors', 1);
	error_reporting(E_ALL);

	require('modele/Musique.class.php');
	require('inc/routes.php');
	require('inc/connect.inc.php');
	require('inc/includes.php');

	$pdo = getConnexion();

?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8" />
	<!-- le titre du document, qui apparait dans l'onglet du navigateur -->
    <title><?= $nomSite ?></title>

    <!-- lie le style CSS externe  -->
    <link rel="stylesheet" href="css/bootstrap.min.css"/>
	<link rel="stylesheet" href="css/font-awesome.min.css"/>
	<link rel="stylesheet" href="css/owl.carousel.min.css"/>
	<link rel="stylesheet" href="css/slicknav.min.css"/>
	<link rel="stylesheet" href="css/style.css"/>

</head>

<body>
		<main>
		<?php require("static/header.php"); ?>
		<?php
		$controleur = 'controleurAccueil'; // par défaut, on charge accueil.php
		$vue = 'vueAccueil'; // par défaut, on charge accueil.php
		if(isset($_GET['page'])) {
			$nomPage = $_GET['page'];
			if(isset($routes[$nomPage])) { // si la page existe dans le tableau des routes, on la charge
				$controleur = $routes[$nomPage]['controleur'];
				$vue = $routes[$nomPage]['vue'];
			}
		}
		include('controleurs/' . $controleur . '.php');
		include('vues/' . $vue . '.php');
		?>
		<?php require("static/footer.php"); ?>
		</main>
	</div>
</body>
</html>
