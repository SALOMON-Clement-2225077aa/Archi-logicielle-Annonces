<?php

// charge et initialise les bibliothèques globales
include_once 'data/DataAccess.php';
include_once 'data/DataWriter.php';

include_once 'control/Controllers.php';
include_once 'control/Presenter.php';

include_once 'service/AnnoncesChecking.php';

include_once 'gui/Layout.php';
include_once 'gui/ViewLogin.php';
include_once 'gui/ViewInscription.php';
include_once 'gui/ViewCreatePost.php';
include_once 'gui/ViewAnnonces.php';
include_once 'gui/ViewPost.php';

use control\Controllers;
use control\Presenter;
use data\DataAccess;
use data\DataWriter;
use gui\{Layout, ViewAnnonces, ViewLogin, ViewInscription, ViewCreatePost, ViewPost};
use service\AnnoncesChecking;

session_start();
$data = null;
$dataWriter = null;
try {
    $dsn = 'mysql:host=mysql-test789.alwaysdata.net;dbname=test789_valide';
    $username = 'test789';
    $password = 'mdpTest123';
    $data = new DataAccess(new PDO($dsn, $username, $password));
    $dataWriter = new DataWriter(new PDO($dsn, $username, $password));

} catch (PDOException $e) {
    print "Erreur de connexion test !: " . $e->getMessage() . "<br/>";
    die();
}

// initialisation du controller
$controller = new Controllers();

// intialisation du cas d'utilisation AnnoncesChecking
$annoncesCheck = new AnnoncesChecking() ;

// intialisation du presenter avec accès aux données de AnnoncesCheking
$presenter = new Presenter($annoncesCheck);

// chemin de l'URL demandée au navigateur
// (p.ex. /annonces/index.php)
$uri = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);

// route la requête en interne
// i.e. lance le bon contrôleur en focntion de la requête effectuée
if ( '/annonces/' == $uri || '/annonces/index.php' == $uri) {

    $layout = new Layout("gui/layout.html" );
    $vueLogin = new ViewLogin( $layout );

    $vueLogin->display();
}
elseif ('/annonces/index.php/annonces' == $uri
    && ( (isset($_POST['login']) && isset($_POST['password']))
    ||   (isset($_SESSION["login"]) && isset($_SESSION["pwd"])) ))
{
    $controller->annoncesAction($_POST['login'], $_POST['password'], $data, $annoncesCheck);

    $layout = new Layout("gui/layout.html" );
    $vueAnnonces= new ViewAnnonces( $layout, $_POST['login'], $presenter);

    $vueAnnonces->display();
}
// TP1 INSCRIPTION page création :
elseif ( '/annonces/index.php/inscription' == $uri) {

    $layout = new Layout("gui/layout.html" );
    $vuePost= new ViewInscription ( $layout );

    $vuePost->display();
}
// TP1 INSCRIPTION page vérification :
elseif ( '/annonces/index.php/inscriptionCheck' == $uri) {

    $controller->inscriptionAction($_POST['login'], $_POST['password'],
        $_POST['nom'], $_POST['prenom'], $data, $dataWriter, $annoncesCheck);
}
// TP1 CREER POST crea  :
elseif ( '/annonces/index.php/createAnnonce' == $uri) {

    $layout = new Layout("gui/layout.html" );
    $vuePost= new ViewCreatePost($layout);

    $vuePost->display();
}
// TP1 CREER POST verif :
elseif ( '/annonces/index.php/verifAnnonce' == $uri) {
    $controller->createPostAction($_POST['title'], $_POST['content'], $dataWriter, $annoncesCheck);
}
// Partiel Supprimer un post :
elseif ( '/annonces/index.php/deletePost' == $uri) {
    $id = $_GET['id'];
    $controller->deletePostAction($id,$_SESSION['login'],$data,$dataWriter, $annoncesCheck);
}
elseif ( '/annonces/index.php/post' == $uri
    && isset($_GET['id'])) {

    $controller->postAction($_GET['id'], $data, $annoncesCheck);

    $layout = new Layout("gui/layout.html" );
    $vuePost= new ViewPost( $layout, $presenter );

    $vuePost->display();
}
else {
    header('Status: 404 Not Found');
    echo '<html><body><h1>My Page NotFound</h1></body></html>';
}

?>