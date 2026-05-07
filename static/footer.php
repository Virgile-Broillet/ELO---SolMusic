	<!-- Section Footer -->
		<footer class="footer-section">
				<div class="container">
					<div class="row">
						<div class="col-xl-6 col-lg-7 order-lg-2">
							<div class="row">
								<div class="col-sm-4">
									<div class="footer-widget">
										<h2>À Propos de nous</h2>
										<ul>
											<li><a href="index.php?page=apropos">Notre Histoire</a></li>
											<li><a href="index.php?page=contact">Contactez-nous</a></li>
										</ul>
									</div>
								</div>
								<div class="col-sm-4">
									<div class="footer-widget">
										<h2>Produits</h2>
										<ul>
											<li><a href="index.php?page=musique">Musique</a></li>
											<li><a href="index.php?page=offres">Souscription</a></li>
										</ul>
									</div>
								</div>
								<div class="col-sm-4">
									<div class="footer-widget">
									<h2>
										<?php if (isset($_SESSION['id'])) { ?>
											Profil
										<?php } else { ?>
											Connexion
										<?php } ?>
									</h2>

									<ul>
										<li>
											<?php if (isset($_SESSION['id'])) { ?>

												<a href="index.php?page=profil">
													Mon profil
												</a>

											<?php } else { ?>

												<a href="index.php?page=connexion">
													Se connecter
												</a>

											<?php } ?>
										</li>
									</ul>
									</div>
								</div>
							</div>
						</div>
						<div class="col-xl-6 col-lg-5 order-lg-1">
							<img src="../img/logo.png" alt="">
							<div class="copyright">
		Copyright &copy;<script>document.write(new Date().getFullYear());</script> Virgile Broillet — Tous droits réservés <br></br>         
		Projet réalisé à l’Université Lumière Lyon 2 — ICOM</a>
							</div>
							<div class="social-links">
								<a href="https://www.instagram.com/___kalak___/"><i class="fa fa-instagram"></i></a>
								<a href="https://github.com/Virgile-Broillet"><i class="fa fa-github"></i></a>
								<a href="https://x.com/virgile1301"><i class="fa fa-twitter"></i></a>
								<a href="https://www.youtube.com/@virgilebroillet4976"><i class="fa fa-youtube"></i></a>
							</div>
						</div>
					</div>
				</div>
			</footer>
	<!-- Section Footer fin -->