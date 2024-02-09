<?php

namespace gui;

/**
 * Classe Layout
 *
 * Cette classe gère la mise en page.
 */
class Layout
{
    /**
     * @var string Le chemin vers le fichier de modèle de mise en page
     */
    protected $templateFile;

    /**
     * Constructeur de la classe Layout
     *
     * @param string $templateFile Le chemin vers le fichier de modèle de mise en page
     */
    public function __construct($templateFile)
    {
        $this->templateFile = $templateFile;
    }

    /**
     * Affiche la mise en page avec le titre, le contenu et le menu
     *
     * @param string $title Le titre de la page
     * @param string $content Le contenu de la page
     * @return void
     */
    public function display($title, $content)
    {
        $menu = "";
        if (isset($_SESSION["login"]) && isset($_SESSION["pwd"])) {
            $menu = '<nav>
                        <ul>
                            <li><a href="/annonces/index.php">Page de connexion</a></li>
                            <li><a href="/annonces/index.php/createAnnonce">Poster une annonce</a></li>
                        </ul>
                    </nav>';
        }
        $page = file_get_contents($this->templateFile);
        $page = str_replace(['%title%', '%content%', '%menu%'], [$title, $content, $menu], $page);
        echo $page;
    }
}
