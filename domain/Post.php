<?php

namespace domain;

/**
 * Classe Post
 *
 * Cette classe représente un post.
 */
class Post
{
    /**
     * @var int L'identifiant du post
     */
    protected $id;

    /**
     * @var string Le titre du post
     */
    protected $title;

    /**
     * @var string Le contenu du post
     */
    protected $body;

    /**
     * @var string La date du post
     */
    protected $date;

    /**
     * @var string L'utilisateur du post
     */
    protected $User;

    /**
     * Constructeur de la classe Post
     *
     * @param int $id L'identifiant du post
     * @param string $title Le titre du post
     * @param string $body Le contenu du post
     * @param string $date La date du post
     * @param string $User L'utilisateur du post
     */
    public function __construct($id, $title, $body, $date, $User)
    {
        $this->id = $id;
        $this->title = $title;
        $this->date = $date;
        $this->body = $body;
        $this->User = $User;
    }

    /**
     * Retourne l'identifiant du post
     *
     * @return int L'identifiant du post
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Retourne le titre du post
     *
     * @return string Le titre du post
     */
    public function getTitle()
    {
        return $this->title;
    }

    /**
     * Retourne le contenu du post
     *
     * @return string Le contenu du post
     */
    public function getBody()
    {
        return $this->body;
    }

    /**
     * Retourne la date du post
     *
     * @return string La date du post
     */
    public function getDate()
    {
        return $this->date;
    }

    /**
     * Retourne l'utilisateur du post
     *
     * @return string L'utilisateur du post
     */
    public function getUser()
    {
        return $this->User;
    }
}
