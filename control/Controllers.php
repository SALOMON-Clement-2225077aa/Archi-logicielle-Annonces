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


        echo "login : ", $login,"<br>";
        if($isLoginUnique) {echo "le login est unique";}
        else {echo "le login est déjà pris";}
        echo "<br><br>pwd : ", $pwd[0] . str_repeat("*", strlen($pwd) - 1);
        echo "<br>nom : ", $nom;
        echo "<br>prénom : ", $prenom;
    }


}