<?php

namespace Controller;

class Condominio extends \Core\Controller
{

    public function __construct()
    {
        parent::__construct();
        // restringe o acesso a este controller aos usuarios logados
        \Lib\Auth::handleLogin();
    }
    
    public function index()
    {
        header('Location: ' . URL . 'condominio/listar');
        exit();
    }

    /**
     * Exibe o formulário para cadastro de novos condomínios
     */
    public function cadastrar()
    {
        $this->view->render('condominio/cadastrar', array(
            'title' => 'SASP | Condomínio | Cadastrar',
            'formAction' => URL . 'condominio/salvar',
        ));
    }

    /**
     * Processa a inserção ou atualização de um condomínio
     * 
     * @param int $id Identificador do condomínio a ser inserido ou atualizado
     */
    public function salvar($id = null)
    {
        $nome = $_POST['nome'];
        $cep = $_POST['cep'];
        $endereco = $_POST['endereco_nome'];
        $enderecoTipo = $_POST['endereco_tipo'];
        $enderecoNumero = $_POST['endereco_numero'];
        $qtdeApartamentos = $_POST['qtde_apto'];
        $qtdeBlocos = $_POST['qtde_blocos'];

        $condominio = new \Model\Condominio();

        $condominio->setNome($nome);
        $condominio->setCep($cep);
        $condominio->setEnderecoNome($endereco);
        $condominio->setEnderecoTipo($enderecoTipo);
        $condominio->setEnderecoNumero($enderecoNumero);
        $condominio->setQuantidadeAptos($qtdeApartamentos);
        $condominio->setQuantidadeBlocos($qtdeBlocos);
        $dao = new \Model\Dao\CondominioDao();

        if ($id !== null) {
            $condominio->setId($id);
            $dao->atualiza($condominio);
        } else {
            $dao->insere($condominio);
        }

        header('Location: ' . URL . 'condominio/listar');
        exit();
    }

    /**
     * Exibe o formulário que lista todos os condomínios ou busca um específico
     *
     * Exibe uma listagem com todos os condomínios cadastrados caso o parâmetro de busca
     * seja nulo ou busca um condomínio específico, através do nome completo ou parcial.
     *  
     * @param string $busca Nome completo ou parcial do condomínio que se deseja buscar
     */
    public function listar($busca = null)
    {
        $dao = new \Model\Dao\CondominioDao();
        $condominios = null;

        if ($busca !== null) {
            $condominios = $dao->buscaPorNome($busca);
        } else {
            $condominios = $dao->lista();
        }

        $this->view->render('condominio/listar', array(
            'title' => '',
            'condominios' => $condominios
        ));
    }

    public function buscar()
    {
        $this->view->render('condominio/buscar', array(
            'title' => ''
        ));
    }

    /**
     * Exibe o formulário para atualização das informações de um condomínio
     * 
     * @param int $id Identificador do condomínio a ser atualizado
     */
    public function editar($id)
    {
        $dao = new \Model\Dao\CondominioDao();
        $condominio = $dao->busca($id);

        if ($condominio->getId() !== null) {
            $this->view->render('condominio/editar', array(
                'title' => '',
                'formAction' => URL . 'condominio/salvar/' . $id,
                'condominio' => $condominio
            ));
        } else {
            header('Location: ' . URL . 'sistema/index');
            exit();
        }
    }

    /**
     * Processa a exclusão de um condomínio
     * 
     * @param int $id Identificador do condomínio a ser excluído
     */
    public function excluir($id)
    {
        $condominio = new \Model\Condominio();
        $dao = new \Model\Dao\CondominioDao();
        
        $condominio->setId($id);
        $dao->exclui($condominio);
        
        header('Location: ' . URL . 'condominio/listar');
        exit();
    }

}
