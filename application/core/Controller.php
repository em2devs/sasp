<?php

namespace Core;

/**
 * Class Controller
 * 
 * Esta é a classe controladora "base".
 * Todos os outros controladores "reais" herdam esta classe.
 */
class Controller
{

    protected $view;

    public function __construct()
    {
        \Lib\Session::init();
        $this->view = new \Lib\View();
    }

}
