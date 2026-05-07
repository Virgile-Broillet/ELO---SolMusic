<?php

    require_once("modele/Musique.class.php");
    require_once("inc/connect.inc.php");

    $musique = new Musique($pdo);

    /* Ajoute seulement celles absentes */
    $musique->addBigSeed();

    $chansons = $musique->getAll();

?>