<?php

namespace Controller;

class Sistema extends \Core\Controller
{

    public function __construct()
    {
        parent::__construct();
    }

    public function index()
    {
        if (!isset($_SESSION['nome'])) {
            header('Location: ' . URL . 'sistema/login');
            exit();
        }

        $this->view->render('sistema/index', array(
            'title' => 'SASP',
            'nomeUsuario' => \Lib\Session::get('nome')
        ));
    }

    public function login()
    {
        $mensagem = '';

        if ((isset($_POST['login']) && isset($_POST['senha'])) &&
            ($_POST['login'] != null && $_POST['senha'] != null)) {
            $login = $_POST['login'];
            $senha = $_POST['senha'];

            $dao = new \Model\Dao\UsuarioDao();
            $usuario = $dao->buscaLogin($login);

            if ($usuario !== null && ($login === $usuario->getLogin() && password_verify($senha, $usuario->getSenha()))) {
                \Lib\Session::init();

                \Lib\Session::set('user_logged_in', true);
                \Lib\Session::set('nome', $usuario->getNomeCompleto());
                \Lib\Session::set('id', $usuario->getId());
                \Lib\Session::set('email', $usuario->getEmail());
                \Lib\Session::set('role', $usuario->getIdRole());
                \Lib\Session::set('condominio', $usuario->getIdCondominio());

                $dao->atualizaUltimoLogin($usuario);
                
                header('Location: ' . URL . 'sistema/index');
                exit();
            } else {
                $mensagem = 'Usuário ou senha inválidos';
            }
        } elseif ((isset($_POST['login']) && isset($_POST['senha'])) &&
                  ($_POST['login'] == null || $_POST['senha'] == null)) {
            $mensagem = 'Informe login e senha';
        } elseif (isset($_SESSION['user_logged_in'])) {
            header('Location: ' . URL . 'sistema/index');
            exit();
        }

        $this->view->render('sistema/login', array(
            'title' => 'Login | SASP',
            'formAction' => URL . 'sistema/login',
            'mensagem' => $mensagem
        ));
    }

    public function logoff()
    {
        \Lib\Session::destroy();

        header('Location: ' . URL . 'sistema/login');
        exit();
    }
    
    public function error($codigo, $mensagem)
    {
        $this->view->render("_templates/errors/{$codigo}_{$mensagem}", array(
            'title' => 'Error | SASP',
            'mensagem' => "Erro $codigo: " . ucfirst($mensagem)
        ));
    }

}
