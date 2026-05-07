<section class="contact-section spad">
    <div class="container">

        <div class="row justify-content-center">

            <div class="col-lg-6">
                <div class="contact-warp">

                    <div class="section-title text-center">
                        <h2>Créer un compte</h2>
                    </div>

                    <form method="post" class="contact-from">

                        <!-- Nom d'utilisateur -->
                        <input type="text" name="pseudo" placeholder="Nom d'utilisateur" required>

                        <!-- Confirmation pseudo -->
                        <input type="text" name="confirm_pseudo" placeholder="Confirmer le nom d'utilisateur" required>

                        <!-- Mot de passe -->
                        <input type="password" name="password" placeholder="Mot de passe" required>

                        <!-- Confirmation mdp -->
                        <input type="password" name="confirm_password" placeholder="Confirmer le mot de passe" required>

                        <button type="submit" name="register" class="site-btn">
                            Créer mon compte
                        </button>

                    </form>

                    <!-- Message -->
                    <?php if (isset($message) && $message != "") { ?>
                        <div style="text-align:center; margin-top:25px;">
                            <p style="color:red; font-weight:600;">
                                <?php echo $message; ?>
                            </p>
                        </div>
                    <?php } ?>

                    <!-- Lien connexion -->
                    <div style="text-align:center; margin-top:25px;">
                        <p>
                            Déjà un compte ?
                            <a href="index.php?page=connexion" style="color:#fc0254; font-weight:600;">
                                Connectez-vous
                            </a>
                        </p>
                    </div>

                </div>
            </div>

        </div>

    </div>
</section>