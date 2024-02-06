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

    public function inscriptionAction($login, $pwd, $nom, $prenom, $data, $dataWriter, $annoncesChek)
    {
        $isLoginUnique = $annoncesChek->isLoginUnique($login, $data);
        $isPwdStrong = $annoncesChek->isPwdStrong($pwd);

        // Redirection et erreur en cas de problème
        if(!$isLoginUnique) {
            header('Location: /annonces/index.php/inscription?erreur=LoginNotUnique');exit;
        }
        elseif(!$isPwdStrong) {
            header('Location: /annonces/index.php/inscription?erreur=PwdNotStrong');exit;
        }
        else{
            // Tout est bon, on crée le compte :
            $annoncesChek->createUser($login, $pwd, $nom, $prenom, $dataWriter);
            header('Location: /annonces/index.php');exit;
        }
    }

    public function createPostAction($title, $content, $dataWriter, $annoncesChek)
    {
        $isTitleOk = $annoncesChek->isContentOk($title);
        $isContentOk = $annoncesChek->isContentOk($content);

        // Redirection et erreur en cas de problème
        if(!$isTitleOk) {
            var_dump($title);
            var_dump($isTitleOk);
            die;
            header('Location: /annonces/index.php/createAnnonce?erreur=TitleNotOk');exit;
        }
        elseif(!$isContentOk) {
            header('Location: /annonces/index.php/createAnnonce?erreur=ContentNotok');exit;
        }
        else{
            // Tout est bon, on crée le post :
            $annoncesChek->createPost($title, $content, $dataWriter);
            header('Location: /annonces/index.php');exit;
        }
    }

}