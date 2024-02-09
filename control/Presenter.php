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
                $content .= '<a href="/annonces/index.php/post?id=' . $post['id'] . '">' . $post['title'] . ' - ' . $post['date'] . ' - Posté par ' . $post['User'] . '</a>';
                if ($post['User'] == $_SESSION['login']) {
                    $content .= '<br><button onclick="window.location.href=\'/annonces/index.php/deletePost?id=' . $post['id'] . '\'" style="background-color: red; color: white">supprimer votre annonce</button>';
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
        if ($this->annoncesCheck->getAnnoncesTxt() != null) {
            $post = $this->annoncesCheck->getAnnoncesTxt()[0];

            $content = '<h1>' . $post['title'] . '</h1>';
            $content .= '<div class="date">' . $post['date'] . '</div>';
            $content .= '<div class="body">' . $post['body'] . '</div>';
        }
        return $content;
    }
}