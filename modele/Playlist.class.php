<?php

    /**
     * @class Playlist
     * @brief Classe permettant de gérer les playlists
     * 
     * Cette classe permet de créer des playlists, récupérer celles d’un utilisateur, ajouter ou supprimer des chansons, et consulter leur contenu
     */
    class Playlist {

        /**
         * @var PDO $pdo
         * @brief Instance de connexion à la base de données
         */
        private $pdo;

        /**
         * @brief Constructeur de la classe Playlist
         * 
         * @param PDO $pdo Instance de connexion PDO
         */
        public function __construct($pdo) {
            $this->pdo = $pdo;
        }

        /**
         * @brief Récupère les playlists d’un utilisateur
         * 
         * @param int $idUser Identifiant de l’utilisateur
         * 
         * @return array Liste des playlists associées à l’utilisateur
         */
        public function getByUser($idUser) {
            $sql = "SELECT * FROM PLAYLIST WHERE idUser = :idUser";
            $stmt = $this->pdo->prepare($sql);
            $stmt->execute(['idUser' => $idUser]);
            return $stmt->fetchAll();
        }

        /**
         * @brief Crée une nouvelle playlist
         * 
         * @param string $titre Titre de la playlist
         * @param int $idUser Identifiant de l’utilisateur propriétaire
         * 
         * @return bool Retourne true si la création réussit, sinon false
         */
        public function create($titre, $idUser) {
            $sql = "INSERT INTO PLAYLIST (titre, idUser) VALUES (:titre, :idUser)";
            $stmt = $this->pdo->prepare($sql);
            return $stmt->execute([
                'titre' => $titre,
                'idUser' => $idUser
            ]);
        }

        /**
         * @brief Ajoute une chanson à une playlist
         * 
         * Vérifie d’abord que la chanson n’est pas déjà présente
         * 
         * @param int $idP Identifiant de la playlist
         * @param int $idC Identifiant de la chanson
         * 
         * @return bool Retourne true si l’ajout réussit, false si la chanson existe déjà ou en cas d’échec
         */
        public function addSong($idP, $idC) {

            $sql = "SELECT * FROM CONTENIR
                    WHERE idP = :idP AND idC = :idC";
        
            $stmt = $this->pdo->prepare($sql);
        
            $stmt->execute([
                'idP' => $idP,
                'idC' => $idC
            ]);
        
            if ($stmt->fetch()) {
                return false;
            }
        
            $sql = "INSERT INTO CONTENIR (idP, idC)
                    VALUES (:idP, :idC)";
        
            $stmt = $this->pdo->prepare($sql);
        
            return $stmt->execute([
                'idP' => $idP,
                'idC' => $idC
            ]);
        }

        /**
         * @brief Supprime une chanson d’une playlist
         * 
         * @param int $idP Identifiant de la playlist
         * @param int $idC Identifiant de la chanson
         * 
         * @return bool Retourne true si la suppression réussit, sinon false
         */
        public function removeSong($idP, $idC) {
            $sql = "DELETE FROM CONTENIR WHERE idP = :idP AND idC = :idC";
            $stmt = $this->pdo->prepare($sql);
            return $stmt->execute([
                'idP' => $idP,
                'idC' => $idC
            ]);
        }

        /**
         * @brief Récupère les chansons d’une playlist
         * 
         * @param int $idP Identifiant de la playlist
         * 
         * @return array Liste des chansons contenues dans la playlist
         */
        public function getSongs($idP) {
            $sql = "SELECT c.* 
                    FROM CHANSON c
                    JOIN CONTENIR ct ON c.idC = ct.idC
                    WHERE ct.idP = :idP";
            $stmt = $this->pdo->prepare($sql);
            $stmt->execute(['idP' => $idP]);
            return $stmt->fetchAll();
        }
    }

?>