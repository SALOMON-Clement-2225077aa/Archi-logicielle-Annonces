<?php

namespace domain;
class User
{
    protected $login;
    protected $password;

    public function __construct($login, $password)
    {
        $this->login = $login;
        $this->password = $password;
        session_start();
        $_SESSION["login"] = $login;
        $_SESSION["pwd"] = $password;
    }

    public function getLogin()
    {
        return $this->login;
    }
}