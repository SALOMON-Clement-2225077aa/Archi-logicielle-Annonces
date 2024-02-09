<?php

namespace gui;

/**
 * Classe ViewPost
 *
 * Cette classe représente une vue d'un post.
 */
class ViewPost extends View
{
    /**
     * Constructeur de la classe ViewPost
     *
     * @param Layout $layout L'objet de mise en page
     * @param Presenter $presenter L'objet de présentation
     */
    public function __construct($layout, $presenter)
    {
        parent::__construct($layout);

        // Définit le titre de la page
        $this->title = 'Exemple Annonces Basic PHP: Post';

        // Récupère le contenu HTML du post à partir de l'objet Presenter
        $this->content = $presenter->getCurrentPostHTML();
    }
}
