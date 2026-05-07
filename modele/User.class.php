<?php


/**
 * @class User
 * @brief Classe permettant de gérer les utilisateurs
 * 
 * Cette classe permet la connexion et la création d'utilisateurs
 * dans la base de données via PDO
 */
class User {

    /**
     * @var PDO $pdo
     * @brief Instance de connexion à la base de données
     */
    private $pdo;

    /**
     * @brief Constructeur de la classe User
     * 
     * @param PDO $pdo Instance de connexion PDO
     */
    public function __construct($pdo) {
        $this->pdo = $pdo;
    }

    /**
     * @brief Vérifie les identifiants d'un utilisateur
     * 
     * Recherche un utilisateur correspondant au login et mot de passe fournis
     * 
     * @param string $login Nom de connexion de l'utilisateur
     * @param string $password Mot de passe de l'utilisateur
     * 
     * @return array|false Retourne les données utilisateur si trouvé, sinon false
     */
    public function login($login, $password) {

        $sql = "SELECT * FROM UTILISATEUR 
                WHERE login = :login AND password = :password";

        $stmt = $this->pdo->prepare($sql);

        $stmt->execute([
            'login' => $login,
            'password' => $password
        ]);

        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    /**
     * @brief Crée un nouvel utilisateur
     * 
     * Insère un nouvel utilisateur dans la table UTILISATEUR
     * 
     * @param string $login Nom de connexion de l'utilisateur
     * @param string $password Mot de passe de l'utilisateur
     * 
     * @return bool Retourne true si la création réussit, sinon false
     */
    public function create($login, $password) {

        $sql = "INSERT INTO UTILISATEUR(login, password)
                VALUES (:login, :password)";

        $stmt = $this->pdo->prepare($sql);

        return $stmt->execute([
            'login' => $login,
            'password' => $password
        ]);
    }
}
?>