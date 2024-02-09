<?php

namespace service;

/**
 * Interface DataWriterInterface
 *
 * Cette interface définit les méthodes nécessaires pour écrire des données.
 */
interface DataWriterInterface
{
    /**
     * Crée un nouvel utilisateur.
     *
     * @param string $login Le login de l'utilisateur
     * @param string $pwd Le mot de passe de l'utilisateur
     * @param string $nom Le nom de l'utilisateur
     * @param string $prenom Le prénom de l'utilisateur
     * @return void
     */
    public function createUser($login, $pwd, $nom, $prenom);

    /**
     * Crée un nouveau post.
     *
     * @param string $title Le titre du post
     * @param string $body Le contenu du post
     * @param string $user L'utilisateur associé au post
     * @return void
     */
    public function createPost($title, $body, $user);
}
