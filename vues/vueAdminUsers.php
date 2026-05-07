<section class="blog-section spad">
    <div class="container">

        <!-- TITRE -->
        <div class="section-title text-center">
            <h2>Gestion des utilisateurs</h2>
            <p>Consulter, gérer et modifier les comptes du site.</p>
        </div>

        <!-- RETOUR -->
        <div class="text-center" style="margin-bottom:35px;">
            <a href="index.php?page=admin" class="site-btn sb-c2">
                Retour administration
            </a>
        </div>

        <!-- MESSAGE -->
        <?php if ($message != "") { ?>
            <div style="
                background:#fff0f5;
                color:#fc0254;
                padding:15px;
                border-radius:10px;
                text-align:center;
                margin-bottom:35px;
                font-weight:600;">
                <?php echo $message; ?>
            </div>
        <?php } ?>

        <!-- USERS -->
        <?php foreach ($users as $u) { ?>

        <div style="
            background:white;
            border:1px solid #ececec;
            border-radius:15px;
            padding:30px;
            margin-bottom:30px;">

            <div class="row align-items-center">

                <!-- INFOS -->
                <div class="col-md-4">

                    <h3 style="margin-bottom:10px;">
                        <?php echo ucfirst($u['login']); ?>
                    </h3>

                    <p>
                        <strong>ID :</strong>
                        <?php echo $u['idUser']; ?>
                    </p>

                    <p>
                        <strong>Plan actuel :</strong>
                        <?php echo $u['plan']; ?>
                    </p>

                </div>

                <!-- PLAYLISTS -->
                <div class="col-md-4">

                    <p>
                        <strong>Playlists :</strong>
                        <?php echo $u['nbPlaylists']; ?>
                    </p>

                    <?php if ($u['nbPlaylists'] > 0) { ?>

                        <ul style="margin-top:10px;">

                        <?php foreach ($u['playlists'] as $p) { ?>

                            <li><?php echo $p['titre']; ?></li>

                        <?php } ?>

                        </ul>

                    <?php } else { ?>

                        <p style="color:#888;">Aucune playlist</p>

                    <?php } ?>

                </div>

                <!-- ACTIONS -->
                <div class="col-md-4 text-right">

                    <?php if ($u['login'] != "admin") { ?>

                        <!-- MODIFIER PLAN -->
                        <form method="post" style="margin-bottom:15px;">

                            <input type="hidden"
                                   name="idUser"
                                   value="<?php echo $u['idUser']; ?>">

                            <select name="plan"
                                    style="
                                    height:45px;
                                    width:180px;
                                    padding:10px;
                                    border:1px solid #ddd;
                                    margin-bottom:10px;">

                                <option value="Standard"
                                <?php if ($u['plan']=="Standard") echo "selected"; ?>>
                                    Standard
                                </option>

                                <option value="Premium"
                                <?php if ($u['plan']=="Premium") echo "selected"; ?>>
                                    Premium
                                </option>

                            </select>

                            <br>

                            <button type="submit"
                                    name="modifierPlan"
                                    class="site-btn sb-c2"
                                    style="padding:10px 20px;">
                                Modifier
                            </button>

                        </form>

                        <!-- SUPPRIMER -->
                        <a href="index.php?page=adminUsers&supprimer=<?php echo $u['idUser']; ?>"
                           class="site-btn"
                           onclick="return confirm('Supprimer cet utilisateur ?');">
                            Supprimer
                        </a>

                    <?php } else { ?>

                        <span style="color:#999;">
                            Compte protégé
                        </span>

                    <?php } ?>

                </div>

            </div>

        </div>

        <?php } ?>

    </div>
</section>