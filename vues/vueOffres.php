<section class="hero-section">
	<div class="container">

		<?php if ($message != "") { ?>

			<div style="
				background:#fff0f5;
				color:#fc0254;
				padding:15px;
				border-radius:10px;
				margin-bottom:30px;
				text-align:center;
				font-weight:600;">

				<?php echo $message; ?>

			</div>

		<?php } ?>

		<div class="row align-items-center">

			<!-- TEXTE -->
			<div class="col-lg-6">

				<h1 style="font-size:72px; line-height:1.1;">
					Abonnement à partir de 5,99€
				</h1>

				<h2 style="color:#fc0254; margin-top:20px;">
					Commencez votre essai gratuit
				</h2>

				<p style="
					margin-top:30px;
					font-size:20px;
					line-height:1.8;">

					Créez vos playlists, écoutez vos musiques préférées
					et profitez de votre univers musical personnalisé.

				</p>

				<?php if ($connecte) { ?>

					<a href="#plans"
					   class="site-btn"
					   style="margin-top:20px;">

						Changer d'offre

					</a>

				<?php } else { ?>

					<a href="index.php?page=connexion"
					   class="site-btn"
					   style="margin-top:20px;">

						Essayer maintenant

					</a>

				<?php } ?>

			</div>

			<!-- BOX AVANTAGES -->
			<div class="col-lg-6">

				<div style="
					background:rgba(255,255,255,0.08);
					padding:50px;
					border-radius:35px;">

					<ul style="
						list-style:none;
						padding:0;
						font-size:28px;
						line-height:2.3;">

						<li>✔ Écouter en ligne</li>
						<li>✔ Écouter hors ligne</li>
						<li>✔ Pas de publicité</li>
						<li>✔ Audio haute qualité</li>
						<li>✔ Lecture aléatoire</li>
						<li>✔ Gestion des playlists</li>

					</ul>

				</div>

			</div>

		</div>

		<!-- OFFRES -->
		<div id="plans" class="row" style="margin-top:80px;">

			<!-- STANDARD -->
			<div class="col-lg-6">

				<div style="
					padding:40px;
					border-radius:25px;
					background:
					<?php echo ($planActuel == 'Standard') ? '#fc0254' : '#ffffff'; ?>;
					color:
					<?php echo ($planActuel == 'Standard') ? '#ffffff' : '#08192d'; ?>;
					margin-bottom:30px;">

					<h2>Standard</h2>

					<h3>5,99€ / mois</h3>

					<p style="margin-top:20px;">
						• Jusqu'à 3 playlists<br>
						• Lecture YouTube<br>
						• Gestion complète du compte
					</p>

					<?php if ($connecte) { ?>

						<?php if ($planActuel == "Standard") { ?>

							<div class="site-btn"
								 style="background:#fff; color:#fc0254;">

								Offre actuelle

							</div>

						<?php } else { ?>

							<a href="index.php?page=offres&choisir=Standard"
							   class="site-btn">

								Choisir Standard

							</a>

						<?php } ?>

					<?php } else { ?>

						<a href="index.php?page=connexion"
						   class="site-btn">

							Se connecter

						</a>

					<?php } ?>

				</div>

			</div>

			<!-- PREMIUM -->
			<div class="col-lg-6">

				<div style="
					padding:40px;
					border-radius:25px;
					background:
					<?php echo ($planActuel == 'Premium') ? '#fc0254' : '#ffffff'; ?>;
					color:
					<?php echo ($planActuel == 'Premium') ? '#ffffff' : '#08192d'; ?>;
					margin-bottom:30px;">

					<h2>Premium</h2>

					<h3>9,99€ / mois</h3>

					<p style="margin-top:20px;">
						• Playlists illimitées<br>
						• Priorité nouveautés<br>
						• Toutes les options Standard
					</p>

					<?php if ($connecte) { ?>

						<?php if ($planActuel == "Premium") { ?>

							<div class="site-btn"
								 style="background:#fff; color:#fc0254;">

								Offre actuelle

							</div>

						<?php } else { ?>

							<a href="index.php?page=offres&choisir=Premium"
							   class="site-btn">

								Passer Premium

							</a>

						<?php } ?>

					<?php } else { ?>

						<a href="index.php?page=connexion"
						   class="site-btn">

							Se connecter

						</a>

					<?php } ?>

				</div>

			</div>

		</div>

	</div>
</section>