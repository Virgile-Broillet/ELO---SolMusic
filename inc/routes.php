<?php

$routes = array(
    'accueil' => array('controleur' => 'controleurAccueil', 'vue' => 'vueAccueil'),
    'contact' => array('controleur' => 'controleurContact', 'vue' => 'vueContact'),
    'apropos' => array('controleur' => 'controleurApropos', 'vue' => 'vueApropos'),
    'musique' => array('controleur' => 'controleurMusique', 'vue' => 'vueMusique'),
    'aide' => array('controleur' => 'controleurAide', 'vue' => 'vueAide'),

    'connexion' => array('controleur' => 'controleurConnexion', 'vue' => 'vueConnexion'),
    'inscription' => array('controleur' => 'controleurInscription', 'vue' => 'vueInscription'),

    'admin' => array('controleur' => 'controleurAdmin', 'vue' => 'vueAdmin'),
    'adminChansons' => array('controleur' => 'controleurAdminChansons', 'vue' => 'vueAdminChansons'),
    'adminPlaylists' => array('controleur' => 'controleurAdminPlaylists', 'vue' => 'vueAdminPlaylists'),
    'adminUsers' => array('controleur' => 'controleurAdminUsers', 'vue' => 'vueAdminUsers'),
    'adminMessages' => array('controleur' => 'controleurAdminMessages', 'vue' => 'vueAdminMessages'),

    'profil' => array('controleur' => 'controleurProfil', 'vue' => 'vueProfil'),

    'offres' => array('controleur' => 'controleurOffres', 'vue' => 'vueOffres'),
    
    'deconnexion' => array('controleur' => 'controleurDeconnexion','vue' => 'vueAccueil')
);

?>