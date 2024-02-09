<?php

namespace control;

/**
 * Classe Controllers
 *
 * Cette classe gère les différentes actions concernant les annonces.
 */
class Controllers
{

    /**
     * Action pour récupérer toutes les annonces
     *
     * @param string $login Le nom d'utilisateur
     * @param string $password Le mot de passe
     * @param array $data Les données d'authentification
     * @param object $annoncesChek L'objet pour vérifier les annonces
     * @return void
     */
    public function annoncesAction($login, $password, $data, $annoncesChek)
    {
        if ($annoncesChek->authenticate($login, $password, $data)) {
            $annoncesChek->getAllAnnonces($data);
        }
    }

    /**
     * Action pour récupérer une annonce spécifique
     *
     * @param int $id L'identifiant de l'annonce
     * @param array $data Les données
     * @param object $annoncesChek L'objet pour vérifier les annonces
     * @return void
     */
    public function postAction($id, $data, $annoncesChek)
    {
        $annoncesChek->getPost($id, $data);
    }

    /**
     * Action pour l'inscription d'un nouvel utilisateur
     *
     * @param string $login Le nom d'utilisateur
     * @param string $pwd Le mot de passe
     * @param string $nom Le nom de l'utilisateur
     * @param string $prenom Le prénom de l'utilisateur
     * @param array $data Les données
     * @param object $dataWriter L'objet pour écrire des données
     * @param object $annoncesChek L'objet pour vérifier les annonces
     * @return void
     */
    public function inscriptionAction($login, $pwd, $nom, $prenom, $data, $dataWriter, $annoncesChek)
    {
        $isLoginUnique = $annoncesChek->isLoginUnique($login, $data);
        $isPwdStrong = $annoncesChek->isPwdStrong($pwd);

        // Redirection et erreur en cas de problème
        if (!$isLoginUnique) {
            header('Location: /annonces/index.php/inscription?erreur=LoginNotUnique');
            exit;
        } elseif (!$isPwdStrong) {
            header('Location: /annonces/index.php/inscription?erreur=PwdNotStrong');
            exit;
        } else {
            // Tout est bon, on crée le compte :
            $annoncesChek->createUser($login, $pwd, $nom, $prenom, $dataWriter);
            header('Location: /annonces/index.php?compte_crée!');
            exit;
        }
    }

    /**
     * Action pour créer une nouvelle annonce
     *
     * @param string $title Le titre de l'annonce
     * @param string $content Le contenu de l'annonce
     * @param object $dataWriter L'objet pour écrire des données
     * @param object $annoncesChek L'objet pour vérifier les annonces
     * @return void
     */
    public function createPostAction($title, $content, $dataWriter, $annoncesChek)
    {
        $isTitleOk = $annoncesChek->isContentOk($title);
        $isContentOk = $annoncesChek->isContentOk($content);
        $login = "";
        session_start();
        if (isset($_SESSION["login"])) {
            $login = $_SESSION["login"];
        }

        // Redirection et erreur en cas de problème
        if (!$isTitleOk) {
            header('Location: /annonces/index.php/createAnnonce?erreur=TitleNotOk');
            exit;
        } elseif (!$isContentOk) {
            header('Location: /annonces/index.php/createAnnonce?erreur=ContentNotok');
            exit;
        } else {
            // Tout est bon, on crée le post :
            $annoncesChek->createPost($title, $content, $login, $dataWriter);
            header('Location: /annonces/index.php');
            exit;
        }
    }

    /**
     * Action pour supprimer un post
     *
     * @param int $id L'identifiant du post à supprimer
     * @param string $login Le nom d'utilisateur
     * @param array $data Les données
     * @param object $dataWriter L'objet pour écrire des données
     * @param object $annoncesChek L'objet pour vérifier les annonces
     * @return void
     */
    public function deletePostAction($id, $login, $data, $dataWriter, $annoncesChek)
    {
        // On vérifie que c'est le propriétaire de l'annonce qui fait la demande de suppression
        $canDelete = $annoncesChek->canDelete($id, $login, $data);
        if ($canDelete) {
            $annoncesChek->deletePost($id, $dataWriter);
            header('Location: /annonces/index.php?annonce_supprimé!');
            exit;
        } else {
            echo 'Vous n\'êtes pas autorisé à supprimer ce post';
        }
    }

    /**
     * Action pour modifier un post
     *
     * @param int $id L'identifiant du post à modifier
     * @param string $title Le titre du post
     * @param string $body Le corps du post
     * @param object $dataWriter L'objet pour écrire des données
     * @param object $annoncesChek L'objet pour vérifier les annonces
     * @return void
     */
    public function editPostAction($id, $title, $body, $dataWriter, $annoncesChek)
    {
        // Redirection vers la page de modification du post
        header("Location: /annonces/index.php/post?id=" . $id . "&edit=true");
    }

    /**
     * Action pour terminer la modification d'un post
     *
     * @param int $id L'identifiant du post à modifier
     * @param string $title Le titre du post
     * @param string $body Le corps du post
     * @param object $dataWriter L'objet pour écrire des données
     * @param object $annoncesCheck L'objet pour vérifier les annonces
     * @return void
     */
    public function editPostActionFinish($id, $title, $body, $dataWriter, $annoncesCheck)
    {
        try {
            $dataWriter->updatePost($id, $title, $body);
            echo "Post updated successfully.";
            header('Location: /annonces/index.php');
            exit;
        } catch (Exception $e) {
            echo "Error updating post: " . $e->getMessage();
        }
    }
}
