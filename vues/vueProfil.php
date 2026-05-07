<section class="blog-section spad">
	<div class="container">

		<!-- TITRE -->
		<div class="section-title text-center">
			<h2>
				<?php echo ucfirst($_SESSION['pseudo']); ?>,
				<a href="index.php?page=offres"
                    style="
                    color:#fc0254;
                    font-weight:700;
                    text-decoration:none;">

                        <?php echo $plan; ?>

                </a>
			</h2>

			<p>Gérez vos playlists</p>
		</div>

		<!-- MESSAGE -->
		<?php if ($message != "") { ?>

			<div style="
				background:#fff0f5;
				padding:15px;
				margin-bottom:30px;
				border-radius:10px;
				text-align:center;
				color:#fc0254;">

				<?php echo $message; ?>

			</div>

		<?php } ?>

		<!-- CREER PLAYLIST -->
		<div class="blog-item" style="padding:30px; margin-bottom:40px;">

			<h3>Créer une playlist</h3>

			<form method="post">

				<div class="row align-items-end">

					<div class="col-md-9">

						<input type="text"
							   name="titre_playlist"
							   placeholder="Nom playlist"
							   required>

					</div>

					<div class="col-md-3">

						<button type="submit"
								name="creerPlaylist"
								class="site-btn">

							Créer

						</button>

					</div>

				</div>

			</form>

		</div>

		<!-- PLAYLISTS -->
		<?php foreach ($playlists as $p) { ?>

			<div style="
				background:white;
				border:1px solid #ececec;
				border-radius:15px;
				padding:25px;
				margin-bottom:30px;">

				<!-- HEADER -->
				<div class="row align-items-center">

					<div class="col-md-6">

						<h3 onclick="togglePlaylist(<?php echo $p['idP']; ?>)"
							style="cursor:pointer;">

							▶ <?php echo $p['titre']; ?>

						</h3>

						<p style="color:#888;">
							<?php echo count($p['musiques']); ?> musique(s)
						</p>

					</div>

					<div class="col-md-6 text-right">

						<button
							type="button"
							class="site-btn sb-c2"
							onclick="playPlaylist(
								<?php echo $p['idP']; ?>,
								'<?php echo addslashes($p['titre']); ?>'
							)">

							Lire playlist

						</button>

						<a href="index.php?page=profil&supprimer=<?php echo $p['idP']; ?>"
						   class="site-btn"
						   style="margin-left:10px;">

							Supprimer

						</a>

					</div>

				</div>

				<!-- CONTENU -->
				<div id="content_<?php echo $p['idP']; ?>"
					 style="display:none; margin-top:25px;">

					<!-- AJOUT MUSIQUE -->
					<h5>Ajouter une musique</h5>

					<form method="post" style="margin-bottom:25px;">

						<input type="hidden"
							   name="idPlaylist"
							   value="<?php echo $p['idP']; ?>">

						<div class="row align-items-end">

							<!-- ARTISTE -->
							<div class="col-md-4">

								<select
									id="artiste_<?php echo $p['idP']; ?>"
									onchange="filtrerChansons(<?php echo $p['idP']; ?>)"
									style="
									height:55px;
									width:100%;
									padding:10px;
									border:1px solid #ddd;">

									<option value="">
										Choisir un artiste
									</option>

									<?php
									$artistes = [];

									foreach ($allSongs as $song) {

										if (!in_array($song['artiste'], $artistes)) {

											$artistes[] = $song['artiste'];
									?>

										<option value="<?php echo $song['artiste']; ?>">
											<?php echo $song['artiste']; ?>
										</option>

									<?php
										}
									}
									?>

								</select>

							</div>

							<!-- CHANSON -->
							<div class="col-md-5">

								<select
									name="idChanson"
									id="chanson_<?php echo $p['idP']; ?>"
									required
									onchange="choisirArtiste(<?php echo $p['idP']; ?>)"
									style="
									height:55px;
									width:100%;
									padding:10px;
									border:1px solid #ddd;">

									<option value="">
										Choisir une chanson
									</option>

									<?php foreach ($allSongs as $song) { ?>

										<option
											value="<?php echo $song['idC']; ?>"
											data-artiste="<?php echo $song['artiste']; ?>">

											<?php echo $song['titre']; ?>

										</option>

									<?php } ?>

								</select>

							</div>

							<!-- BOUTON -->
							<div class="col-md-3">

								<button type="submit"
										name="ajouterMusique"
										class="site-btn sb-c2">

									Ajouter

								</button>

							</div>

						</div>

					</form>

					<!-- MUSIQUES -->
                    <?php foreach ($p['musiques'] as $m) { ?>

                    <div class="row align-items-center"
                        style="
                        padding:12px 0;
                        border-bottom:1px solid #eee;">

                        <!-- NOM -->
                        <div class="col-md-9">

                            <strong>
                                <?php echo $m['titre']; ?>
                            </strong>

                            - <?php echo $m['artiste']; ?>

                        </div>

                        <!-- BOUTON SUPPRIMER -->
                        <div class="col-md-3 text-right">

                            <a href="index.php?page=profil&remove=<?php echo $p['idP']; ?>&song=<?php echo $m['idC']; ?>"
                            class="site-btn"
                            style="
                            padding:8px 15px;
                            font-size:12px;"
                            onclick="return confirm('Retirer cette musique ?');">

                                Retirer

                            </a>

                        </div>

                    </div>

                    <?php } ?>

				</div>

			</div>

		<?php } ?>

	</div>
</section>

<script>

	let playlists = {

		<?php foreach($playlists as $p){ ?>

			<?php echo $p['idP']; ?> : [

				<?php foreach($p['musiques'] as $m){ ?>

					"<?php echo $m['fichier']; ?>",

				<?php } ?>

			],

		<?php } ?>

	};

	/* ouvrir / fermer playlist */
	function togglePlaylist(id)
	{
		let bloc = document.getElementById("content_" + id);

		if (bloc.style.display == "none") {
			bloc.style.display = "block";
		}
		else {
			bloc.style.display = "none";
		}
	}

	/* youtube id */
	function getYoutubeId(url)
	{
		let match = url.match(/v=([^&]+)/);

		if (match) {
			return match[1];
		}

		return "";
	}

	/* lire playlist */
	function playPlaylist(id, titre)
	{
		let musiques = playlists[id];

		if (musiques.length == 0) return;

		let ids = [];

		for (let i = 0; i < musiques.length; i++) {

			let videoId = getYoutubeId(musiques[i]);

			if (videoId != "") {
				ids.push(videoId);
			}
		}

		if (ids.length == 0) return;

		let url =
			"https://www.youtube.com/watch_videos?video_ids="
			+ ids.join(",");

		window.open(url, "_blank");
	}

	/* filtre chansons selon artiste */
	function filtrerChansons(idPlaylist, garder = false)
	{
		let artiste = document.getElementById("artiste_" + idPlaylist).value;
		let select  = document.getElementById("chanson_" + idPlaylist);
		let valeur  = select.value;
		let options = select.options;

		for (let i = 1; i < options.length; i++) {

			let art = options[i].getAttribute("data-artiste");

			if (artiste == "" || art == artiste) {
				options[i].style.display = "block";
			}
			else {
				options[i].style.display = "none";
			}
		}

		if (garder) {
			select.value = valeur;
		}
		else {
			select.selectedIndex = 0;
		}
	}

	/* auto artiste */
	function choisirArtiste(idPlaylist)
	{
		let selectSong = document.getElementById("chanson_" + idPlaylist);

		let artiste =
			selectSong.options[selectSong.selectedIndex]
			.getAttribute("data-artiste");

		let selectArtiste =
			document.getElementById("artiste_" + idPlaylist);

		if (artiste) {

			selectArtiste.value = artiste;

			filtrerChansons(idPlaylist, true);
		}
	}

</script>