<?php

namespace gui;

include_once "View.php";

/**
 * Classe ViewInscription
 *
 * Cette classe représente une vue d'inscription.
 */
class ViewInscription extends View
{
    /**
     * Constructeur de la classe ViewInscription
     *
     * @param Layout $layout L'objet de mise en page
     */
    public function __construct($layout)
    {
        parent::__construct($layout);

        // Définit le titre de la page
        $this->title = 'Exemple Annonces Basic PHP: Inscription';

        // Définit le contenu de la page avec le formulaire d'inscription
        $this->content = '
            <label>Veuillez remplir le formulaire ci-dessous pour créer votre compte :</label>
            <br><br>

            <form method="post" action="/annonces/index.php/inscriptionCheck">
                <!-- Login et Mdp -->
                <label for="login"> <b>Login</b> </label> :
                <input type="text" name="login" id="login" placeholder="ID unique" minlength="3" maxlength="50" required />
                <br/>
                <label for="password"> <b>Votre mot de passe fort</b> </label> : 
                <input type="password" name="password" id="password" minlength="12" maxlength="50" required /> <br>
                <label for="password">  (au moins 12 caractères, avec lettres minuscules <br>
                et majuscules, chiffres et caractères spéciaux) </label>
                <br><br>
                <!-- Nom et Prénom -->
                <label for="nom"> <b>Votre nom</b> </label> :
                <input type="text" name="nom" id="nom" placeholder="" minlength="3" maxlength="50" required />
                <br/>
                <label for="prenom"> <b>Votre prénom</b> </label> :
                <input type="text" name="prenom" id="prenom" placeholder="" minlength="3" maxlength="50" required />
                <br><br>
            
                <input type="submit" value="Envoyer">
            </form>
            ';
    }
}
