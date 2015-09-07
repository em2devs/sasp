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
        $daoTiposArquivo = new \Model\Dao\TipoArquivoDao();
        $tiposArquivo = $daoTiposArquivo->lista();
        
        $daoCondominio = new \Model\Dao\CondominioDao();
        $condominios = $daoCondominio->lista();
        
        $this->view->render('arquivo/upload', array(
            'title' => '',
            'formAction' => URL . 'arquivo/salvar',
            'tiposArquivo' => $tiposArquivo,
            'condominios' => $condominios
        ));
    }

    public function salvar()
    {
        $nomeArquivo = $_FILES['arquivo']['name'];
        $tmp = $_FILES['arquivo']['tmp_name'];
        $idUsuario = \Lib\Session::get('id');
        $idTipoArquivo = $_POST['tipoArquivo'];
        $nomeExibicao = $_POST['nomeExibicao'];
        //$idCondominio = \Lib\Session::get('condominio');
        $idCondominio = $_POST['condominio'];

        $arquivo = new \Model\Arquivo();
        $dao = new \Model\Dao\ArquivoDao();

        $arquivo->setIdUsuarioUpload($idUsuario);
        $arquivo->setIdTipoArquivo($idTipoArquivo);
        $arquivo->setNomeExibicao($nomeExibicao);
        $arquivo->setNome($nomeArquivo);
        $arquivo->setIdCondominio($idCondominio);

        $fi = new \finfo(FILEINFO_MIME);
        $fileType = explode(';', $fi->file($tmp));
        
        if ($arquivo->validarMimeType($fileType[0])) {
            move_uploaded_file($tmp, 'public/files/sistema/' . $nomeArquivo);
            $dao->insere($arquivo);

            header('Location: ' . URL . 'arquivo/listar');
            exit();
        }
    }
    
    public function listar($busca = null)
    {
        $dao = new \Model\Dao\ArquivoDao();
        $idCondominio = \Lib\Session::get('condominio');
        $arquivos = null;
        
        if ($busca !== null) {
            if (\Lib\Session::get('role') !== '1') {
                $arquivos = $dao->buscaPorNome($busca, $idCondominio);
            } else {
                $arquivos = $dao->buscaPorNome($busca);
            }
        } else {
            if (\Lib\Session::get('role') !== '1') {
                $arquivos = $dao->lista($idCondominio);
            } else {
                $arquivos = $dao->lista();
            }
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

    public function download($id)
    {
        $arquivo = new \Model\Arquivo();
        $dao = new \Model\Dao\ArquivoDao();
        $arquivo = $dao->busca($id);
        
        $fi = new \finfo(FILEINFO_MIME);
        $filename = 'public/files/sistema/' . $arquivo->getNome();

        header('Content-type: ' . $fi->file($filename));
        header('Content-Disposition: attachment; filename="' . $arquivo->getNome() . '"');
        readfile($filename);
        exit();
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
