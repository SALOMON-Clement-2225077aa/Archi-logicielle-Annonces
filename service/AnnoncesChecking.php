<?php

namespace service;

class AnnoncesChecking
{
    protected $annoncesTxt;

    public function getAnnoncesTxt()
    {
        return $this->annoncesTxt;
    }

    public function authenticate($login, $password, $data)
    {
        return ($data->getUser($login, $password) != null);
    }

    public function getAllAnnonces($data)
    {
        $annonces = $data->getAllAnnonces();

        $this->annoncesTxt = array();
        foreach ($annonces as $post) {
            $this->annoncesTxt[] = ['id' => $post->getId(), 'title' => $post->getTitle(), 'body' => $post->getBody(), 'date' => $post->getDate(), 'User' => $post->getUser()];
        }
    }

    public function getPost($id, $data)
    {
        $post = $data->getPost($id);
        $this->annoncesTxt[] = array('id' => $post->getId(), 'title' => $post->getTitle(), 'body' => $post->getBody(), 'date' => $post->getDate(), 'User' => $post->getUser());
    }

    public function isLoginUnique($login, $data)
    {
        $existingUser = $data->getUserByLogin($login);
        // Si $existingUser est null, le login est unique
        return ($existingUser === null);
    }

    public function isPwdStrong($pwd) {
        // Au moins 12 caractères :
        if (strlen($pwd) < 12) {return false;}
        // Au moins 1 lettre minuscule :
        if (!preg_match('/[a-z]/', $pwd)) {return false;}
        // Au moins 1 lettre majuscule :
        if (!preg_match('/[A-Z]/', $pwd)) {return false;}
        // Au moins 1 caractère chiffre :
        if (!preg_match('/\d/', $pwd)) {return false;}
        // Au moins 1 caractère Spécial :
        if (!preg_match('/[@$!%*?&]/', $pwd)) {return false;}
        return true;
    }

    public function createUser($login, $pwd, $nom, $prenom, $dataWriter) {
        $dataWriter->createUser($login, $pwd, $nom, $prenom);
    }

    public function isContentOk($userInput)
    {
        if (preg_match('/[<>(`)&~#|\\^¤µ%]/', $userInput)) {
            return false;
        }
        return true;
    }

    public function createPost($title, $content, $login, $dataWriter) {
        $dataWriter->createPost($title, $content, $login);
    }

    public function canDelete($id, $login, $data) {
        try {
            $post = $data->getPost($id);
            if ($post && $post->getUser() == $login) {
                return true; // The user can delete the post
            } else {
                return false; // The user cannot
            }
        } catch (Exception $e) {
            return false;
        }
    }

    public function deletePost($id, $dataWriter) {
        $dataWriter->deletePost($id);
    }

    public function updatePost($id, $title, $body, $dataWriter)
    {
        try {
            $dataWriter->updatePost($id, $title, $body);
        } catch (Exception $e) {
            throw new Exception("Error updating post: " . $e->getMessage());
        }
    }


}
