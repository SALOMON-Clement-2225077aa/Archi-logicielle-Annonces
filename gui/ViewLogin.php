<?php
namespace gui;
include_once "View.php";

class ViewLogin extends View
{
    public function __construct($layout)
    {
        parent::__construct($layout);

        $this->title = 'Exemple Annonces Basic PHP: Connexion';

        $this->content = '
            <form method="post" action="/annonces/index.php/annonces">
                <label for="login"> Votre identifiant </label> :
                <input type="text" name="login" id="login" placeholder="defaut" maxlength="50" required />
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