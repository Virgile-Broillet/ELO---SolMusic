<section class="blog-section spad">
	<div class="container">

		<!-- TITRE -->
		<div class="section-title text-center">
			<h2>Bibliothèque musicale</h2>
			<p>Filtrez par artiste ou genre</p>
		</div>

		<!-- FILTRES -->
		<div class="blog-item" style="padding:30px; margin-bottom:40px;">

			<h3>Recherche</h3>

			<form method="get" action="index.php">

				<input type="hidden" name="page" value="musique">

				<div class="row align-items-end">

					<!-- ARTISTE -->
					<div class="col-md-5">

						<select name="artiste"
								style="
								height:55px;
								width:100%;
								padding:10px;">

							<option value="">
								Tous les artistes
							</option>

							<?php foreach ($artistes as $a) { ?>

								<option value="<?php echo $a['artiste']; ?>"
								<?php if ($filtreArtiste == $a['artiste']) echo "selected"; ?>>

									<?php echo $a['artiste']; ?>

								</option>

							<?php } ?>

						</select>

					</div>

					<!-- GENRE -->
					<div class="col-md-5">

						<select name="genre"
								style="
								height:55px;
								width:100%;
								padding:10px;">

							<option value="">
								Tous les genres
							</option>

							<?php foreach ($genres as $g) { ?>

								<option value="<?php echo $g['genre']; ?>"
								<?php if ($filtreGenre == $g['genre']) echo "selected"; ?>>

									<?php echo $g['genre']; ?>

								</option>

							<?php } ?>

						</select>

					</div>

					<!-- BOUTON -->
					<div class="col-md-2">

						<button type="submit"
								class="site-btn">

							Filtrer

						</button>

					</div>

				</div>

			</form>

		</div>

		<!-- TABLEAU -->
		<div class="blog-item" style="padding:30px;">

			<h3 style="margin-bottom:25px;">Liste des musiques</h3>

			<div class="table-responsive">

				<table class="table table-bordered table-hover">

					<thead>
						<tr style="background:#f7f7f7;">
							<th>Titre</th>
							<th>Artiste</th>
							<th>Genre</th>
							<th>Année</th>
						</tr>
					</thead>

					<tbody>

						<?php foreach ($musiques as $m) { ?>

							<tr>

								<td>
									<strong>
										<?php echo $m['titre']; ?>
									</strong>
								</td>

								<td>
									<?php echo $m['artiste']; ?>
								</td>

								<td>
									<?php echo $m['genre']; ?>
								</td>

								<td>
									<?php echo $m['annee']; ?>
								</td>

							</tr>

						<?php } ?>

					</tbody>

				</table>

			</div>

			<?php if (count($musiques) == 0) { ?>

				<p style="margin-top:20px;">
					Aucune musique trouvée.
				</p>

			<?php } ?>

		</div>

	</div>
</section>