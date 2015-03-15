<?php

namespace Controller;

class TipoArquivo extends \Core\Controller
{

    public function __construct()
    {
        parent::__construct();
        // restringe o acesso a este controller aos usuarios logados
        \Lib\Auth::handleLogin();
    }

    public function index()
    {
        header('Location: ' . URL . 'tipo-arquivo/listar');
        exit();
    }

    public function cadastrar()
    {
        $dao = new \Model\Dao\TipoArquivoDao();
        $tiposArquivo = $dao->lista();

        $this->view->render('arquivo/tipo/cadastrar', array(
            'title' => 'SASP | Cadastrar TipoArquivo',
            'formAction' => URL . 'tipo-arquivo/salvar',
            'tiposArquivo' => $tiposArquivo
        ));
    }

    public function salvar()
    {
        $tipo_arquivo = $_POST['tipo_arquivo'];

        $tipoArquivo = new \Model\TipoArquivo();
        $dao = new \Model\Dao\TipoArquivoDao();

        $tipoArquivo->setNome($tipo_arquivo);
        $dao->insere($tipoArquivo);

        header('Location: ' . URL . 'tipo-arquivo/cadastrar');
        exit();
    }

    public function listar($busca = null)
    {
        $dao = new \Model\Dao\TipoArquivoDao();
        $tiposArquivo = null;
        
        if ($busca !== null) {
            $tiposArquivo = $dao->buscaPorNome($busca);
        } else {
            $tiposArquivo = $dao->lista();
        }

        $this->view->render('arquivo/tipo/listar', array(
            'title' => 'SASP | Listar TipoArquivo',
            'tiposArquivo' => $tiposArquivo
        ));
    }
    
    public function buscar($nome = null)
    {
        $this->view->render('arquivo/tipo/buscar', array(
            'title' => 'SASP | Buscar TipoArquivo',
            'nome' => str_replace('-', ' ', $nome)
        ));
    }

    public function excluir($id)
    {
        $tipoArquivo = new \Model\TipoArquivo();
        $dao = new \Model\Dao\TipoArquivoDao();
        
        $tipoArquivo->setId($id);
        $dao->exclui($tipoArquivo);
        
        header('Location: ' . URL . 'tipo-arquivo/listar');
        die();
    }

}
