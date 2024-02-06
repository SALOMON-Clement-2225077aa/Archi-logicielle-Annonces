<?php
namespace gui;
class Layout
{
    protected $templateFile;

    public function __construct( $templateFile )
    {
        $this->templateFile = $templateFile;
    }

    public function display( $title, $content )
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
        $page = file_get_contents( $this->templateFile );
        $page = str_replace( ['%title%','%content%','%menu%'], [$title,$content,$menu], $page);
        echo $page;
    }

}