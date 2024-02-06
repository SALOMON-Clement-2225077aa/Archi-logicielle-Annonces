<?php
namespace gui;
include_once "View.php";

class ViewInscription extends View
{
    public function __construct($layout)
    {
        parent::__construct($layout);

        $this->title = 'Exemple Annonces Basic PHP: Inscription';

        $this->content = '
            <label>Veuillez remplir le formulaire ci dessous pour créer votre compte :</label>
            <br><br>

            <form method="post" action="/annonces/index.php/inscriptionCheck">
                <!-- Login et Mdp -->
                <label for="login"> <b>login</b> </label> :
                <input type="text" name="login" id="login" placeholder="id unique" minlength="3" maxlength="50" required />
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
                <label for="nom"> <b>Votre prénom</b> </label> :
                <input type="text" name="prenom" id="prenom" placeholder="" minlength="3" maxlength="50" required />
                <br><br>
            
                <input type="submit" value="Envoyer">
            </form>
            ';
    }
}
