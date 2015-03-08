<?php

namespace Lib;

/**
 * Class Session
 *
 * Gerencia itens de sessão. Cria sessão quando não existe uma, define ou recupera
 * valores de variáveis de sessão, encerra uma sessão (logout).
 */
class Session
{

    /**
     * inicia a sessão
     */
    public static function init()
    {
        // se nao existe sessao, inicie uma sessao
        if (session_id() == '') {
            $session_name = 'sec_session_id';
            $secure = SECURE;

            // impede que o javascript acesse o id da sessão
            $httponly = true;

            // força a sessão a usar apenas cookies
            if (ini_set('session.use_only_cookies', 1) === FALSE) {
                header('Location: ' . URL . 'sistema/login');
                exit();
            }

            // recupera os parametros de cookie atuais
            $cookieParams = session_get_cookie_params();
            session_set_cookie_params(
                    $cookieParams['lifetime'], $cookieParams['path'], $cookieParams['domain'], $secure, $httponly);

            session_name($session_name);
            session_start();
            session_regenerate_id();
        }
    }

    /**
     * define um valor específico para uma chave específica da sessão
     * @param mixed $key
     * @param mixed $value
     */
    public static function set($key, $value)
    {
        $_SESSION[$key] = $value;
    }

    /**
     * retorna o valor de uma chave específica da sessão
     * @param mixed $key
     * @return mixed
     */
    public static function get($key)
    {
        if (isset($_SESSION[$key])) {
            return $_SESSION[$key];
        }
    }

    /**
     * destroi a sessão (logout)
     */
    public static function destroy()
    {
        session_unset();
        session_destroy();
        session_write_close();
        unset($_COOKIE['sec_session_id']);
        setcookie('sec_session_id', null, -1, '/');
    }

}
