<?php

namespace service;
interface DataWriterInterface
{
    public function createUser($login, $pwd, $nom, $prenom);

    public function createPost($title, $body, $user);
}
