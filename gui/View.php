<?php

namespace gui;

/**
 * Classe abstraite View
 *
 * Cette classe représente une vue abstraite.
 */
abstract class View
{
    /**
     * @var string Le titre de la vue
     */
    protected $title = '';

    /**
     * @var string Le contenu de la vue
     */
    protected $content = '';

    /**
     * @var Layout L'objet de mise en page
     */
    protected $layout;

    /**
     * Constructeur de la classe View
     *
     * @param Layout $layout L'objet de mise en page
     */
    public function __construct($layout)
    {
        $this->layout = $layout;
    }

    /**
     * Affiche la vue en utilisant le layout
     *
     * @return void
     */
    public function display()
    {
        $this->layout->display($this->title, $this->content);
    }
}
