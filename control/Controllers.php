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
            header('Location: /annonces/index.php?compte_crée!');exit;
        }
    }

    public function createPostAction($title, $content, $dataWriter, $annoncesChek)
    {
        $isTitleOk = $annoncesChek->isContentOk($title);
        $isContentOk = $annoncesChek->isContentOk($content);
        $login = "";
        session_start();
        if(isset($_SESSION["login"])) {
            $login = $_SESSION["login"];
        }

        // Redirection et erreur en cas de problème
        if(!$isTitleOk) {
            header('Location: /annonces/index.php/createAnnonce?erreur=TitleNotOk');exit;
        }
        elseif(!$isContentOk) {
            header('Location: /annonces/index.php/createAnnonce?erreur=ContentNotok');exit;
        }
        else{
            // Tout est bon, on crée le post :
            $annoncesChek->createPost($title, $content, $login, $dataWriter);
            header('Location: /annonces/index.php');exit;
        }
    }

    public function deletePostAction($id, $login, $data, $dataWriter, $annoncesChek)
    {
        # On vérifie que c'est le propriétaire de l'annonce qui fait la demande de suppr
        $canDelete = $annoncesChek->canDelete($id, $login, $data);
        if($canDelete) {
            $annoncesChek->deletePost($id, $dataWriter);
            header('Location: /annonces/index.php?annonce_supprimé!');exit;
        }
        else{
            echo 'Vous n\'êtes pas autorisé à supprimer ce post';
        }
    }

    public function editPostAction($id, $title, $body, $dataWriter, $annoncesChek)
    {
        header("Location: /annonces/index.php/post?id=" . $id . "&edit=true"); //ඞඞඞඞඞඞඞඞඞඞඞඞඞඞඞඞඞඞඞඞ
    }

    public function editPostActionFinish($id, $title, $body, $dataWriter, $annoncesCheck)
    {
        try {
            $dataWriter->updatePost($id, $title, $body);
            echo "Post updated successfully.";
            header('Location: /annonces/index.php');exit;
        } catch (Exception $e) {
            echo "Error updating post: " . $e->getMessage();
        }
    }


}
