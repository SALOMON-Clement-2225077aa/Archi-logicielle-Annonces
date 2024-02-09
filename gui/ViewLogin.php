<?php

namespace gui;

include_once "View.php";

/**
 * Classe ViewLogin
 *
 * Cette classe représente une vue de connexion.
 */
class ViewLogin extends View
{
    /**
     * Constructeur de la classe ViewLogin
     *
     * @param Layout $layout L'objet de mise en page
     */
    public function __construct($layout)
    {
        parent::__construct($layout);

        // Définit le titre de la page
        $this->title = 'Exemple Annonces Basic PHP: Connexion';

        // Définit le contenu de la page avec le formulaire de connexion
        $this->content = '
            <form method="post" action="/annonces/index.php/annonces">
                <label for="login"> Votre identifiant </label> :
                <input type="text" name="login" id="login" placeholder="Identifiant" maxlength="50" required />
                <br/>
                <label for="password"> Votre mot de passe </label> :
                <input type="password" name="password" id="password" minlength="12" maxlength="50" required />
        
                <input type="submit" value="Envoyer">
                
                <br><br>
                <label>Pas de compte ?</label>
                <a href="/annonces/index.php/inscription">Inscrivez-vous</a>
                
            </form>';
    }

}
