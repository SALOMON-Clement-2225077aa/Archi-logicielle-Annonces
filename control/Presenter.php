<?php

namespace control;

/**
 * Classe Presenter
 *
 * Cette classe gère la présentation des annonces sous forme HTML.
 */
class Presenter
{
    /**
     * @var object $annoncesCheck L'objet pour vérifier les annonces
     */
    protected $annoncesCheck;

    /**
     * Constructeur de la classe Presenter
     *
     * @param object $annoncesCheck L'objet pour vérifier les annonces
     */
    public function __construct($annoncesCheck)
    {
        $this->annoncesCheck = $annoncesCheck;
    }

    /**
     * Récupère toutes les annonces et les affiche sous forme HTML
     *
     * @return string Le code HTML des annonces
     */
    public function getAllAnnoncesHTML()
    {
        $content = null;
        if ($this->annoncesCheck->getAnnoncesTxt() != null) {
            $content = '<h1>Liste des annonces</h1>  <ul>';
            foreach ($this->annoncesCheck->getAnnoncesTxt() as $post) {
                $content .= ' <li>';
                $content .= '<a href="/annonces/index.php/post?id=' . $post['id'] . '">' . $post['title'] . '</a> - Posté par ' . $post['User'] . ' le ' . $post['date'] ;

                // Si l'utilisateur est le propriétaire du post, affiche les boutons de modification et de suppression
                if ($post['User'] == $_SESSION['login']) {
                    $content .= '<br>';
                    $content .= '<button onclick="window.location.href=\'/annonces/index.php/deletePost?id=' . $post['id'] . '\'" style="background-color: red; color: white">Supprimer votre annonce</button>';
                    $content .= '&nbsp;&nbsp;&nbsp;'; // Ajoute un espace entre les boutons
                    $content .= '<button onclick="window.location.href=\'/annonces/index.php/editPost?id=' . $post['id'] . '\'" style="background-color: blue; color: white">Modifier votre annonce</button>';
                }

                $content .= ' </li>';
            }
            $content .= '</ul>';
        }
        return $content;
    }

    /**
     * Récupère le post actuel et l'affiche sous forme HTML
     *
     * @return string Le code HTML du post actuel
     */
    public function getCurrentPostHTML()
    {
        $content = null;
        $editMode = isset($_GET['edit']);
        $login = isset($_SESSION['login']) ? $_SESSION['login'] : "";

        if ($this->annoncesCheck->getAnnoncesTxt() != null) {
            $post = $this->annoncesCheck->getAnnoncesTxt()[0];

            $content = '<h1>' . $post['title'] . '</h1>';
            $content .= '<div class="date">' . $post['date'] . '</div>';

            // Vérifie si l'utilisateur est le propriétaire du post
            $isOwner = ($login == $post['User']);

            // Si en mode édition et que l'utilisateur est le propriétaire, affiche les champs d'édition
            if ($editMode && $isOwner) {
                $content .= '<form action="/annonces/index.php/editPostFinish" method="post">';
                $content .= '<input type="hidden" name="id" value="' . $post['id'] . '">';
                $content .= '<input type="text" name="title" id="title" value="' . $post['title'] . '"><br>';
                $content .= '<textarea name="body" id="body">' . $post['body'] . '</textarea><br>';
                $content .= '<button type="submit" style="background-color: blue; color: white">Enregistrer</button>';
                $content .= '</form>';
            } else {
                $content .= '<div class="body">' . $post['body'] . '</div>';
            }
        }
        return $content;
    }
}
