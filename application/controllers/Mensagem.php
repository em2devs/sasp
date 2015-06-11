<?php

namespace Controller;

class Mensagem extends \Core\Controller
{

    public function __construct()
    {
        parent::__construct();
        \Lib\Auth::handleLogin();
    }

    public function index()
    {
        header('Location: ' . URL . 'mensagem/listar');
        exit();
    }

    public function publicar()
    {
        
    }

    public function listar($busca = null)
    {
        
    }

    public function buscar($nome = null)
    {
        
    }

    public function editar($id)
    {
        
    }

    public function excluir($id)
    {
        
    }

}
