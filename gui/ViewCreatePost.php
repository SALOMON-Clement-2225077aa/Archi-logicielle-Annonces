<?php

namespace gui;

include_once "View.php";

/**
 * Classe ViewCreatePost
 *
 * Cette classe représente une vue de création de post.
 */
class ViewCreatePost extends View
{
    /**
     * Constructeur de la classe ViewCreatePost
     *
     * @param Layout $layout L'objet de mise en page
     */
    public function __construct($layout)
    {
        parent::__construct($layout);

        // Définit le titre de la page
        $this->title = 'Exemple Annonces Basic PHP: Créer un Post';

        // Définit le contenu de la page avec le formulaire de création de post
        $this->content = '
            <label>Veuillez remplir le formulaire ci-dessous pour créer une annonce :</label>
            <br><br>

            <form method="post" action="/annonces/index.php/verifAnnonce">
                <!-- Titre de l\'annonce (max:20) -->
                <label for="title"> <b>Titre de l\'annonce</b> </label> :
                <input type="text" name="title" id="title" placeholder="Titre (max=20)" maxlength="20" required />
                <br/><br/>
                <!-- Contenu de l\'annonce (max:200) -->
                <label for="content"> <b>Contenu de l\'annonce</b> </label> :
                <input type="text" name="content" id="content" placeholder="Contenu (max=200)" maxlength="200" required />
                <br/><br/>
                
                <input type="submit" value="Envoyer">
            </form>
            ';
    }
}
