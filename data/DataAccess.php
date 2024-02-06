<?php
namespace data;

use service\DataAccessInterface;
include_once "service/DataAccessInterface.php";

use domain\{User,Post};
require_once "domain/User.php";
require_once "domain/Post.php";


class DataAccess implements DataAccessInterface
{
    protected $dataAccess = null;

    public function __construct($dataAcess)
    {
        $this->dataAccess = $dataAcess;
    }

    public function __destruct()
    {
        $this->dataAccess = null;
    }

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

    public function getAllAnnonces()
    {
        $result = $this->dataAccess->query('SELECT * FROM Post');
        $annonces = array();

        while ($row = $result->fetch()) {
            $currentPost = new Post($row['id'], $row['title'], $row['body'], $row['date']);
            $annonces[] = $currentPost;
        }

        $result->closeCursor();

        return $annonces;
    }

    public function getPost($id)
    {
        $id = intval($id);
        $result = $this->dataAccess->query('SELECT * FROM Post WHERE id=' . $id);
        $row = $result->fetch();

        $post = new Post($row['id'], $row['title'], $row['body'], $row['date']);

        $result->closeCursor();

        return $post;
    }

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
}

?>
