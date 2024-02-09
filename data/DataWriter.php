<?php
namespace data;

use service\DataWriterInterface;
include_once "service/DataWriterInterface.php";

/**
 * Classe DataWriter
 *
 * Cette classe gère l'écriture de données.
 */
class DataWriter implements DataWriterInterface
{
    /**
     * @var object $dataWriter L'objet pour écrire des données
     */
    protected $dataWriter = null;

    /**
     * Constructeur de la classe DataWriter
     *
     * @param object $dataWriter L'objet pour écrire des données
     */
    public function __construct($dataWriter)
    {
        $this->dataWriter = $dataWriter;
    }

    /**
     * Destructeur de la classe DataWriter
     */
    public function __destruct()
    {
        $this->dataWriter = null;
    }

    /**
     * Crée un nouvel utilisateur dans la base de données
     *
     * @param string $login Le nom d'utilisateur
     * @param string $pwd Le mot de passe
     * @param string $nom Le nom de l'utilisateur
     * @param string $prenom Le prénom de l'utilisateur
     * @return void
     */
    public function createUser($login, $pwd, $nom, $prenom)
    {
        $dateDuJour = date('Y-m-d');
        $query = 'INSERT INTO `Users` (`login`, `password`, `nom`, `prenom`, `dateCrea`) VALUES ("' . $login . '", "' . $pwd . '", "'. $nom .'", "'. $prenom .'", "'. $dateDuJour .'");';
        $this->dataWriter->query($query);
    }

    /**
     * Crée un nouveau post dans la base de données
     *
     * @param string $title Le titre du post
     * @param string $body Le contenu du post
     * @param string $user L'utilisateur associé au post
     * @return void
     */
    public function createPost($title, $body, $user)
    {
        $dateDuJour = date('Y-m-d');
        $query = 'INSERT INTO `Post` (`date`, `title`, `body`, `User`) VALUES ("' . $dateDuJour . '", "' . $title . '", "' . $body . '", "' . $user .'");';
        $this->dataWriter->query($query);
    }

    /**
     * Supprime un post de la base de données
     *
     * @param int $id L'identifiant du post à supprimer
     * @return void
     */
    public function deletePost($id) {
        try {
            $query = 'DELETE FROM `Post` WHERE `id` = ' . $id;
            $this->dataWriter->query($query);
        } catch (PDOException $e) {
            // Gérer les erreurs de la base de données
            echo "Erreur lors de la suppression du post : " . $e->getMessage();
        }
    }

    /**
     * Met à jour un post dans la base de données
     *
     * @param int $id L'identifiant du post à mettre à jour
     * @param string $title Le nouveau titre du post
     * @param string $body Le nouveau contenu du post
     * @return void
     */
    public function updatePost($id, $title, $body)
    {
        try {
            $query = "UPDATE Post SET title = '" . htmlspecialchars($title) . "', body = '" . htmlspecialchars($body) . "' WHERE id = " . $id;
            $this->dataWriter->query($query);
        } catch (PDOException $e) {
            throw new Exception("Erreur lors de la mise à jour du post : " . $e->getMessage());
        }
    }
}

?>
