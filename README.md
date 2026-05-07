# ELO - SolMusic

ELO - SolMusic est une plateforme musicale web développée dans le cadre d’un projet universitaire en programmation web backend.
Le projet a été réalisé avec **PHP**, **MariaDB** et une architecture **MVC** afin de proposer une expérience proche des plateformes de streaming modernes. 

## Fonctionnalités principales

* Consultation d’un catalogue musical dynamique
* Recherche de musiques et d’artistes
* Inscription et connexion utilisateur
* Création et gestion de playlists
* Ajout / suppression de musiques dans une playlist
* Lecture automatique des playlists via YouTube
* Système d’abonnement Free / Premium
* Espace administrateur sécurisé
* Gestion des sessions utilisateurs et sécurité des accès

## Technologies utilisées

* **PHP (POO)**
* **MariaDB**
* **Architecture MVC**
* **HTML / CSS**
* **YouTube Integration**
* **Sessions PHP**

## Base de données

Le projet repose sur plusieurs tables principales :

* `UTILISATEUR`
* `CHANSON`
* `PLAYLIST`
* `CONTENIR`
* `CONTACT`

La base permet de gérer les utilisateurs, les musiques disponibles ainsi que les playlists personnalisées. 

## Gestion des utilisateurs

Deux types de comptes sont disponibles :

* **Standard** → limité à 3 playlists
* **Premium** → playlists illimitées

Un compte administrateur permet également la gestion complète du site :

* utilisateurs
* playlists
* catalogue musical

## Sécurité

* Authentification via sessions PHP
* Gestion des rôles utilisateurs
* Protection des espaces privés
* Déconnexion sécurisée

## Objectif du projet

Ce projet avait pour objectif de mettre en pratique :

* le développement backend en PHP,
* la conception de bases de données relationnelles,
* l’utilisation des requêtes préparées,
* la gestion des sessions utilisateurs,
* et l’organisation d’un projet web complet en MVC. 

## Auteur(s)

Projet réalisé par :

* Virgile Broillet

Université Lyon 2 – Lumière
Programmation Web Backend
