<?php

namespace service;

/**
 * Interface DataAccessInterface
 *
 * Cette interface définit les méthodes nécessaires pour accéder aux données.
 */
interface DataAccessInterface
{
    /**
     * Récupère un utilisateur en fonction de son login et mot de passe.
     *
     * @param string $login Le login de l'utilisateur
     * @param string $password Le mot de passe de l'utilisateur
     * @return mixed L'utilisateur correspondant aux informations données, ou null s'il n'existe pas
     */
    public function getUser($login, $password);

    /**
     * Récupère toutes les annonces.
     *
     * @return array Un tableau contenant toutes les annonces
     */
    public function getAllAnnonces();

    /**
     * Récupère un post en fonction de son identifiant.
     *
     * @param int $id L'identifiant du post
     * @return mixed Le post correspondant à l'identifiant donné, ou null s'il n'existe pas
     */
    public function getPost($id);

    /**
     * Récupère un utilisateur en fonction de son login.
     *
     * @param string $login Le login de l'utilisateur
     * @return mixed L'utilisateur correspondant au login donné, ou null s'il n'existe pas
     */
    public function getUserByLogin($login);
}
