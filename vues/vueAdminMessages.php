<section class="blog-section spad">
	<div class="container">

		<!-- TITRE -->
		<div class="section-title text-center">
			<h2>Messages reçus</h2>
			<p>Messages envoyés depuis la page contact</p>
		</div>

		<!-- RETOUR -->
		<div class="text-center" style="margin-bottom:30px;">

			<a href="index.php?page=admin"
			   class="site-btn sb-c2">

				Retour administration

			</a>

		</div>

		<!-- MESSAGE ACTION -->
		<?php if ($message != "") { ?>

			<div style="
				background:#fff0f5;
				color:#fc0254;
				padding:15px;
				border-radius:10px;
				text-align:center;
				margin-bottom:30px;">

				<?php echo $message; ?>

			</div>

		<?php } ?>

		<!-- LISTE -->
		<?php if (count($messages) > 0) { ?>

			<?php foreach ($messages as $m) { ?>

				<div class="blog-item" style="margin-bottom:30px;">

					<div class="blog-date">
						<?php echo $m['dateEnvoi']; ?>
					</div>

					<h3>
						<?php echo htmlspecialchars($m['objet']); ?>
					</h3>

					<p style="margin-bottom:10px;">

						<strong>Nom :</strong>
						<?php echo htmlspecialchars($m['nom']); ?>

						<br>

						<strong>Email :</strong>
						<?php echo htmlspecialchars($m['email']); ?>

					</p>

					<p style="
						background:#fafafa;
						padding:15px;
						border-radius:10px;
						line-height:1.8;">

						<?php echo nl2br(htmlspecialchars($m['message'])); ?>

					</p>

					<div class="text-right" style="margin-top:15px;">

						<a href="index.php?page=adminMessages&supprimer=<?php echo $m['idContact']; ?>"
						   class="site-btn"
						   onclick="return confirm('Supprimer ce message ?');">

							Supprimer

						</a>

					</div>

				</div>

			<?php } ?>

		<?php } else { ?>

			<div class="blog-item text-center">

				<h3>Aucun message</h3>

				<p>
					Aucun message n’a encore été reçu.
				</p>

			</div>

		<?php } ?>

	</div>
</section>