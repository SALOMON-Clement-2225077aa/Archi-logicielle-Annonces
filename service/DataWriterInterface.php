<?php

namespace service;
interface DataWriterInterface
{
    public function createUser($login, $pwd, $nom, $prenom);
}