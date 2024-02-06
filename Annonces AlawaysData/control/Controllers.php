<?php

namespace control;

class Controllers
{

    public function annoncesAction($login, $password, $data, $annoncesChek)
    {
        if ($annoncesChek->authenticate($login, $password, $data)) {
            $annoncesChek->getAllAnnonces($data);
        }
    }

    public function postAction($id, $data, $annoncesChek)
    {
        $annoncesChek->getPost($id, $data);
    }
}