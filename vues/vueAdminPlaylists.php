<section class="blog-section spad">
    <div class="container">

        <!-- TITRE -->
        <div class="section-title text-center">
            <h2>Gestion des playlists</h2>
            <p>Créer, modifier et gérer les playlists du site.</p>
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

        <!-- CREATION PLAYLIST -->
        <div class="blog-item" style="padding:30px; margin-bottom:40px;">

            <div class="blog-date">Création</div>

            <h3>Créer une playlist</h3>

            <form method="post">

                <div class="row align-items-end">

                    <!-- TITRE -->
                    <div class="col-md-5">

                        <input type="text"
                               name="titre_playlist"
                               placeholder="Titre playlist"
                               required>

                    </div>

                    <!-- UTILISATEUR -->
                    <div class="col-md-5">

                        <select name="idUser"
                                required
                                style="
                                height:55px;
                                width:100%;
                                padding:10px;
                                border:1px solid #ddd;">

                            <option value="">
                                Choisir un utilisateur
                            </option>

                            <?php foreach ($users as $u) { ?>

                                <option value="<?php echo $u['idUser']; ?>">

                                    <?php echo ucfirst($u['login']); ?>

                                </option>

                            <?php } ?>

                        </select>

                    </div>

                    <!-- BOUTON -->
                    <div class="col-md-2">

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
                border:1px solid #ececec;
                border-radius:15px;
                padding:25px;
                margin-bottom:35px;
                background:white;">

                <!-- HEADER -->
                <div class="row align-items-center">

                    <div class="col-md-8">

                        <h4 onclick="togglePlaylist(<?php echo $p['idP']; ?>)"
                            style="
                            margin-bottom:5px;
                            cursor:pointer;">

                            ▶ #<?php echo $p['idP']; ?> -
                            <?php echo $p['titre']; ?>

                        </h4>

                        <p style="margin:0; color:#777;">

                            Utilisateur :

                            <?php
                            foreach ($users as $u) {

                                if ($u['idUser'] == $p['idUser']) {

                                    echo ucfirst($u['login']);
                                    break;
                                }
                            }
                            ?>

                            | <?php echo count($p['musiques']); ?> musique(s)

                        </p>

                    </div>

                    <div class="col-md-4 text-right">

                        <a href="index.php?page=adminPlaylists&supprimer=<?php echo $p['idP']; ?>"
                           class="site-btn"
                           onclick="return confirm('Supprimer cette playlist ?');">

                            Supprimer

                        </a>

                    </div>

                </div>

                <!-- CONTENU MASQUÉ -->
                <div id="content_<?php echo $p['idP']; ?>"
                     style="
                     display:none;
                     margin-top:25px;">

                    <hr>

                    <!-- AJOUT MUSIQUE -->
                    <h5 style="margin-bottom:20px;">
                        Ajouter une musique
                    </h5>

                    <form method="post">

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
                                    onchange="choisirArtiste(<?php echo $p['idP']; ?>)"
                                    required
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
                            <div class="col-md-3 text-right">

                                <button type="submit"
                                        name="ajouterMusique"
                                        class="site-btn sb-c2">

                                    Ajouter

                                </button>

                            </div>

                        </div>

                    </form>

                    <hr>

                    <!-- MUSIQUES -->
                    <h5 style="margin-bottom:20px;">
                        Chansons :
                    </h5>

                    <?php if (count($p['musiques']) > 0) { ?>

                        <?php foreach ($p['musiques'] as $m) { ?>

                            <div class="row align-items-center"
                                 style="margin-bottom:12px;">

                                <div class="col-md-9">

                                    <strong>
                                        <?php echo $m['titre']; ?>
                                    </strong>

                                    - <?php echo $m['artiste']; ?>

                                </div>

                                <div class="col-md-3 text-right">

                                    <a href="index.php?page=adminPlaylists&remove=<?php echo $p['idP']; ?>&song=<?php echo $m['idC']; ?>"
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

                    <?php } else { ?>

                        <p style="color:#888;">
                            Aucune chanson dans cette playlist.
                        </p>

                    <?php } ?>

                </div>

            </div>

        <?php } ?>

    </div>
</section>

<script>
function togglePlaylist(id)
{
    let bloc = document.getElementById("content_" + id);

    if (bloc.style.display == "none" || bloc.style.display == "") {
        bloc.style.display = "block";
    }
    else {
        bloc.style.display = "none";
    }
}

function filtrerChansons(idPlaylist, conserver = false)
{
    let artiste = document.getElementById("artiste_" + idPlaylist).value;
    let select = document.getElementById("chanson_" + idPlaylist);
    let valeurActuelle = select.value;
    let options = select.options;

    for (let i = 0; i < options.length; i++) {

        if (i === 0) continue;

        let art = options[i].getAttribute("data-artiste");

        if (artiste === "" || art === artiste) {
            options[i].style.display = "block";
        }
        else {
            options[i].style.display = "none";
        }
    }

    if (conserver) {
        select.value = valeurActuelle;
    }
    else {
        select.selectedIndex = 0;
    }
}

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