<?php

namespace Controller;

class Arquivo extends \Core\Controller
{

    public function __construct()
    {
        parent::__construct();
        // restringe o acesso a este controller aos usuarios logados
        \Lib\Auth::handleLogin();
    }
    
    public function index()
    {
        header('Location: ' . URL . 'arquivo/listar');
        exit();
    }

    public function upload()
    {
        $this->view->render('arquivo/upload', array(
            'title' => '',
            'formAction' => URL . 'arquivo/salvar'
        ));
    }

    public function salvar()
    {
        $nome_arquivo = $_FILES['arquivo']['name'];
        $tmp = $_FILES['arquivo']['tmp_name'];
        $idUsuario = 1; // Temporario
        $idTipoArquivo = 1; //Temporario
        $nomeExibicao = $_POST['nomeExibicao'];
        $idCondominio = \Lib\Session::get('condominio');

        $arquivo = new \Model\Arquivo();
        $dao = new \Model\Dao\ArquivoDao();

        $arquivo->setIdUsuarioUpload($idUsuario);
        $arquivo->setIdTipoArquivo($idTipoArquivo);
        $arquivo->setNomeExibicao($nomeExibicao);
        $arquivo->setNome($nome_arquivo);
        $arquivo->setIdCondominio($idCondominio);

        move_uploaded_file($tmp, 'public/files/sistema/' . $nome_arquivo);

        $dao->insere($arquivo);

        header('Location: ' . URL . 'arquivo/listar');
        exit();
    }

    public function listar($busca = null)
    {
        $dao = new \Model\Dao\ArquivoDao();
        $idCondominio = \Lib\Session::get('condominio');
        $arquivos = null;
        
        if ($busca !== null) {
            $arquivos = $dao->buscaPorNome($busca);
        } else {
            $arquivos = $dao->lista($idCondominio);
        }
        
        $this->view->render('arquivo/listar', array(
            'title' => '',
            'arquivos' => $arquivos
        ));
        
    }
    
    public function buscar($nome = null)
    {
        $this->view->render('arquivo/buscar', array(
            'title' => 'SASP | Buscar Arquivo',
            'nome' => str_replace('-', ' ', $nome)
        ));
    }


    public function excluir($id)
    {
        $arquivo = new \Model\Arquivo();
        $dao = new \Model\Dao\ArquivoDao();
        
        $arquivo->setId($id);
        $dao->exclui($arquivo);
        
        header('Location: ' . URL . 'arquivo/listar');
        exit();
    }

}
