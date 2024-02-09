<?php

namespace gui;

/**
 * Classe ViewAnnonces
 *
 * Cette classe représente une vue d'annonces.
 */
class ViewAnnonces extends View
{
    /**
     * Constructeur de la classe ViewAnnonces
     *
     * @param Layout $layout L'objet de mise en page
     * @param string $login Le nom d'utilisateur
     * @param Presenter $presenter L'objet de présentation
     */
    public function __construct($layout, $login, $presenter)
    {
        parent::__construct($layout);

        // Vérifie si la liste des annonces est vide
        if ($presenter->getAllAnnoncesHTML() == null) {
            // Redirige vers la page d'accueil après 5 secondes en cas d'erreur de connexion
            header("refresh:5;url=/annonces/index.php");
            echo 'Erreur de login et/ou de mot de passe (redirection automatique dans 5 sec.)';
            exit;
        }

        // Définit le titre de la page
        $this->title = 'Exemple Annonces Basic PHP: Annonces';

        // Contenu de la page avec le nom d'utilisateur
        $this->content = "<p> Bonjour $login </p>";

        // Ajoute le HTML de toutes les annonces à contenu de la page
        $this->content .= $presenter->getAllAnnoncesHTML();
    }
}
