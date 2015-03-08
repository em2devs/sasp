<?php

namespace Controller;

class Usuario extends \Core\Controller
{

    public function __construct()
    {
        parent::__construct();
        // restringe o acesso a este controller aos usuarios logados
        \Lib\Auth::handleLogin();
    }

    public function index()
    {
        header('Location: ' . URL . 'usuario/listar');
        exit();
    }

    public function cadastrar()
    {
        $daoCondominio = new \Model\Dao\CondominioDao();
        $condominios = $daoCondominio->lista();
        
        $daoRole = new \Model\Dao\RoleDao();
        $roles = $daoRole->lista();

        $this->view->render('usuario/cadastrar', array(
            'title' => '',
            'formAction' => URL . 'usuario/salvar',
            'condominios' => $condominios,
            'roles' => $roles
        ));
    }

    /**
     * Salva um novo usuário ou atualiza as informações de um existente
     * 
     * Este método recebe o ID do usuário que se deseja atualizar. Caso este ID
     * não seja passado assume-se que é um novo usuário e deve ser inserido.
     * 
     * @param int $id Identificador do usuário a ser inserido ou atualizado
     */
    public function salvar($id = null)
    {
        $nomeCompleto = $_POST['nome'];
        $cep = $_POST['email'];
        $bloco = $_POST['bloco'];
        $apartamento = $_POST['apartamento'];
        $idCondominio = $_POST['condominio'];
        $idRole = $_POST['role'];

        $usuario = new \Model\Usuario();
        $dao = new \Model\Dao\UsuarioDao();

        $usuario->setNomeCompleto($nomeCompleto);
        $usuario->setEmail($cep);
        $usuario->setApto($bloco);
        $usuario->setBloco($apartamento);
        $usuario->setIdCondominio($idCondominio);
        $usuario->setIdRole($idRole);

        if ($id !== null) {
            $usuario->setId($id);
            $dao->atualiza($usuario);
        } else {
            $dao->insere($usuario);
        }

        header('Location: ' . URL . 'usuario/listar');
        exit();
    }

    public function listar($busca = null)
    {
        $dao = new \Model\Dao\UsuarioDao();
        $usuarios = null;
        
        if ($busca !== null) {
            $usuarios = $dao->buscaPorNome($busca);
        } else {
            $usuarios = $dao->lista();
        }
        
        $this->view->render('usuario/listar', array(
            'title' => '',
            'usuarios' => $usuarios
        ));
    }

    public function buscar($nome = null)
    {   
        $this->view->render('usuario/buscar', array(
            'title' => 'SASP | Buscar Usuário',
            'nome' => str_replace('-', ' ', $nome)
        ));
    }

    public function editar($id)
    {
        $dao = new \Model\Dao\UsuarioDao();
        $usuario = $dao->busca($id);

        $assert = new \Lib\Assert(\Lib\Session::get('id'), \Lib\Session::get('role'));
        $assert->setResource($usuario);
        
        if ((int)\Lib\Session::get('permissao') !== 1 && !$assert->assert()) {
            header('Location: ' . URL . 'sistema/index');
            exit();
        } elseif ($usuario->getId() !== null) {
            $daoCondominio = new \Model\Dao\CondominioDao();
            $condominios = $daoCondominio->lista();

            $daoPermissao = new \Model\Dao\RoleDao();
            $permissoes = $daoPermissao->lista();

            $this->view->render('usuario/editar', array(
                'title' => '',
                'formAction' => URL . 'usuario/salvar/' . $id,
                'usuario' => $usuario,
                'condominios' => $condominios,
                'permissoes' => $permissoes
            ));
        }
    }

    /**
     * Exclui um usuário
     * 
     * @param int $id Identificador do usuário a ser excluído
     */
    public function excluir($id)
    {
        header('Location: ' . URL . 'usuario/listar');
        exit();
    }

}
