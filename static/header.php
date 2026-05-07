<html lang="zxx">
<head>
	<title>SolMusic</title>
	<meta charset="UTF-8">
	<meta name="description" content="SolMusic HTML Template">
	<meta name="keywords" content="music, html">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	
	<link href="img/favicon.ico" rel="shortcut icon"/>

	<link href="https://fonts.googleapis.com/css?family=Montserrat:300,300i,400,400i,500,500i,600,600i,700,700i&display=swap" rel="stylesheet">
 
	<link rel="stylesheet" href="css/bootstrap.min.css"/>
	<link rel="stylesheet" href="css/font-awesome.min.css"/>
	<link rel="stylesheet" href="css/owl.carousel.min.css"/>
	<link rel="stylesheet" href="css/slicknav.min.css"/>
	<link rel="stylesheet" href="css/style.css"/>
</head>
<body>

<header class="header-section clearfix">
		<a href="index.php" class="site-logo">
			<img src="img/logo.png" alt="">
		</a>
		<div class="header-right">
			<a href="index.php?page=aide" class="hr-btn">Aide</a>
			<span>|</span>

			<div class="user-panel">

				<?php if (isset($_SESSION['pseudo'])) { ?>

					<?php if ($_SESSION['pseudo'] == "admin") { ?>

						<!-- Si admin -->
						<a href="index.php?page=admin" class="login">
							<?php echo ucfirst($_SESSION['pseudo']); ?>
						</a>

					<?php } else { ?>

						<!-- Utilisateur normal -->
						<a href="index.php?page=profil" class="login">
							<?php echo ucfirst($_SESSION['pseudo']); ?>
						</a>

					<?php } ?>

					<a href="index.php?page=deconnexion" class="register">
						Déconnexion
					</a>

					<?php } else { ?>

					<a href="index.php?page=connexion" class="login">
						Se connecter
					</a>

					<a href="index.php?page=inscription" class="register">
						Créer un compte
					</a>

				<?php } ?>

			</div>
		</div>
		<ul class="main-menu">
			<li><a href="index.php">Accueil</a></li>
			<li><a href="index.php?page=apropos">À propos</a></li>
			<li><a href="index.php?page=musique">Musique</a></li>

			<li><a href="index.php?page=contact">Contact</a></li>
		</ul>
</header>