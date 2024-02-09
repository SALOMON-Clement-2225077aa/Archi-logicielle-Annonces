<?php

namespace domain;

/**
 * Classe User
 *
 * Cette classe représente un utilisateur.
 */
class User
{
    /**
     * @var string Le nom d'utilisateur
     */
    protected $login;

    /**
     * @var string Le mot de passe de l'utilisateur
     */
    protected $password;

    /**
     * Constructeur de la classe User
     *
     * @param string $login Le nom d'utilisateur
     * @param string $password Le mot de passe de l'utilisateur
     */
    public function __construct($login, $password)
    {
        $this->login = $login;
        $this->password = $password;
        $_SESSION["login"] = $login;
        $_SESSION["pwd"] = $password;
    }

    /**
     * Retourne le nom d'utilisateur
     *
     * @return string Le nom d'utilisateur
     */
    public function getLogin()
    {
        return $this->login;
    }
}
