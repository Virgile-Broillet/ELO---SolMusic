<?php
    function getConnexion() {
        $host = "mysql03.univ-lyon2.fr";
        $dbname = "php_vbroillet";
        $user = "php_vbroillet";
        $password = "Hr5ZuMwZbXxBraESIeF-Qij5P";

        try {
            $pdo = new PDO(
                "mysql:host=$host;dbname=$dbname;charset=utf8mb4",
                $user,
                $password
            );
            $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            return $pdo;

        } catch (Exception $e) {
            die("Erreur connexion : " . $e->getMessage());
        }
    }
?>