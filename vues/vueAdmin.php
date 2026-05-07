<section class="blog-section spad">
	<div class="container">

		<!-- TITRE -->
		<div class="section-title text-center">
			<h2>Administration</h2>
			<p>Gestion complète du site SolMusic</p>
		</div>

		<!-- BIENVENUE -->
		<div class="blog-item text-center" style="margin-bottom:35px;">
			<div class="blog-date">Accès sécurisé</div>

			<h3>
				Bienvenue <?php echo ucfirst($_SESSION['pseudo']); ?>
			</h3>

			<p>
				Depuis cet espace administrateur, vous pouvez gérer
				les utilisateurs, playlists, chansons et messages.
			</p>
		</div>

		<!-- TOUS LES BLOCS -->
		<div class="row">

			<!-- UTILISATEURS -->
			<div class="col-lg-4 col-md-6">
				<div class="blog-item text-center" style="min-height:20px;">

					<div class="blog-date">Gestion</div>

					<h3>Utilisateurs</h3>

					<p>
						Consulter les comptes,
						modifier les offres,
						supprimer un utilisateur.
					</p>

					<a href="index.php?page=adminUsers"
					   class="site-btn sb-c2">
						Gérer
					</a>

				</div>
			</div>

			<!-- PLAYLISTS -->
			<div class="col-lg-4 col-md-6">
				<div class="blog-item text-center" style="min-height:20px;">

					<div class="blog-date">Gestion</div>

					<h3>Playlists</h3>

					<p>
						Afficher toutes les playlists,
						les modifier ou les supprimer.
					</p>

					<a href="index.php?page=adminPlaylists"
					   class="site-btn sb-c2">
						Gérer
					</a>

				</div>
			</div>

			<!-- CHANSONS -->
			<div class="col-lg-4 col-md-6">
				<div class="blog-item text-center" style="min-height:20px;">

					<div class="blog-date">Gestion</div>

					<h3>Chansons</h3>

					<p>
						Ajouter de nouvelles musiques,
						modifier ou supprimer la base.
					</p>

					<a href="index.php?page=adminChansons"
					   class="site-btn sb-c2">
						Gérer
					</a>

				</div>
			</div>

			<!-- MESSAGES -->
			<div class="col-lg-6 col-md-6">
				<div class="blog-item text-center" style="min-height:20px;">

					<div class="blog-date">Support</div>

					<h3>Messages</h3>

					<p>
						Consulter les messages envoyés
						depuis le formulaire de contact.
					</p>

					<a href="index.php?page=adminMessages"
					   class="site-btn">

						Voir

					</a>

				</div>
			</div>

			<!-- DECONNEXION -->
			<div class="col-lg-6 col-md-6">
				<div class="blog-item text-center" style="min-height:20px;">

					<div class="blog-date">Session</div>

					<h3>Déconnexion</h3>

					<p>
						Quitter l’espace administrateur
						en toute sécurité.
					</p>

					<a href="index.php?page=deconnexion"
					   class="site-btn">

						Quitter

					</a>

				</div>
			</div>

		</div>

	</div>
</section>