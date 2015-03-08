<?php

namespace Lib;

/**
 * Class Auth
 * 
 * Verifica se o usuario está logado.
 * Útil para tonar disponível certos controladores e/ou métodos apenas para usuários logados.
 */
class Auth
{

    public static function handleLogin()
    {
        // inicializa a sessão
        \Lib\Session::init();

        // caso o usuário ainda não esteja logado a sessão será destruida, o usuário tratado como
        // "não logado" e redirecionado para a página de login
        if (!isset($_SESSION['user_logged_in'])) {
            \Lib\Session::destroy();
            header('location: ' . URL . 'sistema\login');
            exit();
        }
    }

}
