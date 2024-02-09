<?php

namespace control;
class Presenter
{
    protected $annoncesCheck;

    public function __construct($annoncesCheck)
    {
        $this->annoncesCheck = $annoncesCheck;
    }

    public function getAllAnnoncesHTML()
    {
        $content = null;
        if ($this->annoncesCheck->getAnnoncesTxt() != null) {
            $content = '<h1>List of Posts</h1>  <ul>';
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

    public function getCurrentPostHTML()
    {
        $content = null;
        $editMode = isset($_GET['edit']);
        $login = isset($_SESSION['login']) ? $_SESSION['login'] : "";

        if ($this->annoncesCheck->getAnnoncesTxt() != null) {
            $post = $this->annoncesCheck->getAnnoncesTxt()[0];

            $content = '<h1>' . $post['title'] . '</h1>';
            $content .= '<div class="date">' . $post['date'] . '</div>';

            // Check if the user is the owner of the post
            $isOwner = ($login == $post['User']);

            // If in edit mode and user is the owner, display input fields for editing
            if ($editMode && $isOwner) {
                $content .= '<form action="/annonces/index.php/editPostFinish" method="post">';
                $content .= '<input type="hidden" name="id" value="' . $post['id'] . '">';
                $content .= '<input type="text" name="title" id="title" value="' . $post['title'] . '"><br>';
                $content .= '<textarea name="body" id="body">' . $post['body'] . '</textarea><br>';
                $content .= '<button type="submit" style="background-color: blue; color: white">Save</button>';
                $content .= '</form>';
            } else {
                $content .= '<div class="body">' . $post['body'] . '</div>';
            }
        }
        return $content;
    }
}