<?php
namespace data;

use service\DataAccessInterface;
include_once "service/DataAccessInterface.php";

use domain\{User, Post};
require_once "domain/User.php";
require_once "domain/Post.php";

/**
 * Classe DataAccess
 *
 * Cette classe gère l'accès aux données.
 */
class DataAccess implements DataAccessInterface
{
    /**
     * @var object $dataAccess L'objet pour accéder aux données
     */
    protected $dataAccess = null;

    /**
     * Constructeur de la classe DataAccess
     *
     * @param object $dataAcess L'objet pour accéder aux données
     */
    public function __construct($dataAcess)
    {
        $this->dataAccess = $dataAcess;
    }

    /**
     * Destructeur de la classe DataAccess
     */
    public function __destruct()
    {
        $this->dataAccess = null;
    }

    /**
     * Récupère un utilisateur en fonction de son login et de son mot de passe
     *
     * @param string $login Le nom d'utilisateur
     * @param string $password Le mot de passe
     * @return object|null L'objet User correspondant à l'utilisateur s'il existe, sinon null
     */
    public function getUser($login, $password)
    {
        $user = null;

        $query = 'SELECT login FROM Users WHERE login="' . $login . '" and password="' . $password . '"';
        $result = $this->dataAccess->query($query);

        if ($result->rowCount())
            $user = new User($login, $password);

        $result->closeCursor();

        return $user;
    }

    /**
     * Récupère toutes les annonces
     *
     * @return array Un tableau d'objets Post représentant les annonces
     */
    public function getAllAnnonces()
    {
        $result = $this->dataAccess->query('SELECT * FROM Post ORDER BY date DESC');
        $annonces = array();

        while ($row = $result->fetch()) {
            $currentPost = new Post($row['id'], $row['title'], $row['body'], $row['date'], $row['User']);
            $annonces[] = $currentPost;
        }

        $result->closeCursor();

        return $annonces;
    }

    /**
     * Récupère un post en fonction de son identifiant
     *
     * @param int $id L'identifiant du post
     * @return object|null L'objet Post correspondant au post s'il existe, sinon null
     */
    public function getPost($id)
    {
        $id = intval($id);
        $result = $this->dataAccess->query('SELECT * FROM Post WHERE id=' . $id);
        $row = $result->fetch();

        $post = new Post($row['id'], $row['title'], $row['body'], $row['date'], $row['User']);

        $result->closeCursor();

        return $post;
    }

    /**
     * Récupère un utilisateur en fonction de son login
     *
     * @param string $login Le nom d'utilisateur
     * @return object|null L'objet User correspondant à l'utilisateur s'il existe, sinon null
     */
    public function getUserByLogin($login)
    {
        $user = null;
        $query = 'SELECT * FROM Users WHERE login="' . $login . '"';
        $result = $this->dataAccess->query($query);
        if ($result->rowCount()) {
            $row = $result->fetch();
            $user = new User($row['login'], $row['password']);
        }
        $result->closeCursor();
        return $user;
    }

    /**
     * Vérifie si un utilisateur est administrateur
     *
     * @param string $username Le nom d'utilisateur
     * @return bool True si l'utilisateur est administrateur, sinon false
     */
    public function isAdmin($username)
    {
        try {
            $query = "SELECT isAdmin FROM Users WHERE username = ". $username;
            $result = $this->dataAccess->query($query);
            if ($result && $result['isAdmin'] == 1) {
                return true;
            } else {
                return false;
            }
        } catch (PDOException $e) {
            throw new PDOException("Error checking admin status: " . $e->getMessage());
        }
    }
}

?>
