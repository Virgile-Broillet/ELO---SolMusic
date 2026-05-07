<section class="blog-section spad">
    <div class="container">

        <!-- TITRE -->
        <div class="section-title text-center">
            <h2>Gestion des chansons</h2>
            <p>Ajoutez, consultez et supprimez les musiques de la base de données.</p>
        </div>

        <!-- RETOUR -->
        <div class="text-center" style="margin-bottom:40px;">
            <a href="index.php?page=admin" class="site-btn sb-c2">
                Retour administration
            </a>
        </div>

        <!-- MESSAGE -->
        <?php if (isset($message) && $message != "") { ?>
            <div style="
                background:#fff0f5;
                color:#fc0254;
                padding:15px;
                border-radius:10px;
                text-align:center;
                font-weight:600;
                margin-bottom:35px;">
                <?php echo $message; ?>
            </div>
        <?php } ?>

        <!-- FORMULAIRE -->
        <div class="blog-item" style="padding:35px; border-radius:15px; background:#ffffff; box-shadow:0 10px 25px rgba(0,0,0,0.08);">

            <div class="blog-date">Ajout</div>
            <h3 style="margin-bottom:30px;">Ajouter une chanson</h3>

            <form method="post">

                <div class="row">

                    <div class="col-md-2">
                        <input type="text" name="titre" placeholder="Titre" required>
                    </div>

                    <div class="col-md-2">
                        <input type="text" name="artiste" placeholder="Artiste" required>
                    </div>

                    <div class="col-md-2">
                        <input type="number" name="annee" placeholder="Année" required>
                    </div>

                    <div class="col-md-3">
                        <input type="text" name="genre" placeholder="Genre" required>
                    </div>

                    <div class="col-md-1 text-right">
                        <input type="text" name="fichier" placeholder="Lien Youtube" required>
                    </div>

                </div>

                <div class="text-center" style="margin-top:25px;">
                    <button type="submit" name="ajouter" class="site-btn">
                        Ajouter la chanson
                    </button>
                </div>

            </form>

        </div>

        <!-- TABLEAU -->
        <div class="blog-item" style="margin-top:50px; padding:35px; border-radius:15px; background:#ffffff; box-shadow:0 10px 25px rgba(0,0,0,0.08);">

            <div class="blog-date">Base de données</div>
            <h3 style="margin-bottom:25px;">Toutes les chansons</h3>

            <div style="overflow-x:auto;">

                <table class="table table-striped table-hover">

                    <thead style="background:#fc0254; color:white;">
                        <tr>
                            <th>ID</th>
                            <th>Titre</th>
                            <th>Artiste</th>
                            <th>Année</th>
                            <th>Genre</th>
                            <th>Action</th>
                        </tr>
                    </thead>

                    <tbody>

                    <?php foreach ($chansons as $c) { ?>

                        <tr>
                            <td><?php echo $c['idC']; ?></td>
                            <td><?php echo $c['titre']; ?></td>
                            <td><?php echo $c['artiste']; ?></td>
                            <td><?php echo $c['annee']; ?></td>
                            <td><?php echo $c['genre']; ?></td>

                            <td>
                                <a href="index.php?page=adminChansons&supprimer=<?php echo $c['idC']; ?>"
                                   class="site-btn"
                                   style="padding:8px 18px; font-size:12px;"
                                   onclick="return confirm('Supprimer cette chanson ?');">
                                   Supprimer
                                </a>
                            </td>
                        </tr>

                    <?php } ?>

                    </tbody>

                </table>

            </div>

        </div>

    </div>
</section>