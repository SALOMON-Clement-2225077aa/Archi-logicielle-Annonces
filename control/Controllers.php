<?php

namespace control;

class Controllers
{

    public function annoncesAction($login, $password, $data, $annoncesChek)
    {
        if ($annoncesChek->authenticate($login, $password, $data)) {
            $annoncesChek->getAllAnnonces($data);
        }
    }

    public function postAction($id, $data, $annoncesChek)
    {
        $annoncesChek->getPost($id, $data);
    }

    public function inscriptionAction($login, $pwd, $nom, $prenom, $data, $annoncesCheck)
    {
        $isLoginUnique = $annoncesCheck->isLoginUnique($login, $data);
        $isPwdStrong = $annoncesCheck->isPwdStrong($pwd);

        // Affichage debug des données du formulaire :
        echo "login : ", $login,"<br>";
        if($isLoginUnique) {echo "le login est unique";}
        else {echo "le login est déjà pris";}
        echo "<br><br>pwd : ", $pwd[0] . str_repeat("*", strlen($pwd) - 1),"<br>";
        if($isPwdStrong) {echo "le mot de passe est fort !";}
        else {echo "le mot de passe n'est pas assez fort !";}
        echo "<br><br>nom : ", $nom;
        echo "<br>prénom : ", $prenom;

        // Redirection et erreur en cas de problème
        if(!$isLoginUnique) {
            header('Location: /annonces/index.php/inscription?erreur=LoginNotUnique');
            exit;
        }
        elseif(!$isPwdStrong) {
            header('Location: /annonces/index.php/inscription?erreur=PwdNotStrong');
            exit;
        }
        else{
            header('Location: /annonces/index.php');
            exit;
        }

    }


}