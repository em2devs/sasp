<?php

namespace Lib;

/**
 * Class View
 *
 * Fornece os métodos que todas as visões irão ter.
 */
class View
{

    /**
     * Exibe uma visão.
     * 
     * Função utilizada nos controladores através do método 
     * <code> <?php $this->view->render('diretório/arquivo'); ?> </code>
     * 
     * @param string $filename
     * @param array $data
     * @param boolean $render_without_header_and_footer Opcional: defina como verdadeiro para não exibir cabeçalho e rodapé
     * @param string $header Opcional: Altere para incluir outro cabeçalho
     * @param string $footer Opcional:Altere para incluir outro rodapé
     */
    public function render(
        $filename, 
        $data = array(), 
        $render_without_header_and_footer = false, 
        $header = '_templates/header', 
        $footer = '_templates/footer')
    {
        if ($render_without_header_and_footer === true) {
            require PATH_VIEWS . $filename . '.php';
        } else {
            require PATH_VIEWS . $header . '.php';
            require PATH_VIEWS . $filename . '.php';
            require PATH_VIEWS . $footer . '.php';
        }
    }

    /**
     * Exibe as mensagens de feedback.
     * 
     * Função utilizada para controlar o feedback durante o fluxo da aplicação.
     */
    public function renderFeedbackMessages()
    {
        // exibe as mensagens de feedback (mensagens de erros, sucessos, etc.),
        // que estão nas variáveis $_SESSION["feedback_positive"] e $_SESSION["feedback_negative"]
        require PATH_VIEWS . '_templates/feedback.php';

        // deletar as mensagens (evitar que sejam exibidas mias de uma vez)
        \Lib\Session::set('feedback_positive', null);
        \Lib\Session::set('feedback_negative', null);
    }

    /**
     * Função estática que verifica se a string fornecida é o controlador ativo.
     * 
     * Útil para gerenciar os links de navegação ativos/inativos.
     * 
     * @param string $filename
     * @param string $navigation_controller
     * @return bool
     */
    public static function checkForActiveControl($filename, $navigation_controller)
    {
        $split_filename = explode('/', $filename);
        $active_controller = $split_filename[0];

        if ($active_controller == $navigation_controller) {
            return true;
        }

        return false;
    }

    /**
     * Função que verifica se a string fornecida é o controlador ativo.
     * 
     * Útil para gerenciar os links de navegação ativos/inativos.
     * 
     * @param string $filename
     * @param string $navigation_controller
     * @return bool
     */
    private function checkForActiveController($filename, $navigation_controller)
    {
        $split_filename = explode('/', $filename);
        $active_controller = $split_filename[0];

        if ($active_controller == $navigation_controller) {
            return true;
        }

        return false;
    }

    /**
     * Verifica se a string fornecida é o método ativo.
     * Útil para gerenciar os links de navegação ativos/inativos.
     * @param string $filename
     * @param string $navigation_action
     * @return bool
     */
    private function checkForActiveAction($filename, $navigation_action)
    {
        $split_filename = explode('/', $filename);
        $active_action = $split_filename[1];

        if ($active_action == $navigation_action) {
            return true;
        }

        return false;
    }

    /**
     * Verifica se a string fornecida é o controlador e método ativo.
     * Útil para gerenciar os links de navegação ativos/inativos.
     * @param string $filename
     * @param string $navigation_controller_and_action
     * @return bool
     */
    private function checkForActiveControllerAndAction($filename, $navigation_controller_and_action)
    {
        $split_active_filename = explode('/', $filename);
        $active_controller = $split_active_filename[0];
        $active_action = $split_active_filename[1];

        $split_navigation_filename = explode('/', $navigation_controller_and_action);
        $navigation_controller = $split_navigation_filename[0];
        $navigation_action = $split_navigation_filename[1];

        if ($active_controller == $navigation_controller AND $active_action == $navigation_action) {
            return true;
        }

        return false;
    }

    /**
     * Monta o menu superior de acordo com as permissões do usuário logado.
     * 
     * @return string $menu
     */
    private function montaMenu()
    {
        $menu = "";
        $idRole = \Lib\Session::get('role');

        $daoResourceRole = new \Model\Dao\ResourceRoleDao();
        $resources = $daoResourceRole->listaMenu($idRole);

        $lastController = '';
        $menu .= ' <ul class="nav navbar-nav">';
        foreach ($resources as $resource) {

            if ($resource->getResource()->getController() == 'Sistema') {
                continue;
            }
            
            //Cria o menu principal
            if ($lastController != $resource->getResource()->getController()) {
                if($lastController != ''){
                    $menu .= "</ul>";
                    $menu .= "</li>";
                }

                $active = "";
                $checkForCtrl = \Lib\View::checkForActiveControl(@$_GET['url'], mb_strtolower($lastController));
                
                if ( $checkForCtrl ) { 
                    $active = "active"; 
                }
                
                $menu .= '<li class="dropdown' . $active .'"> ';
                $menu .= '<a class="dropdown-toggle" data-toggle="dropdown" aria-expanded="false" href="#"> ';
                $menu .= $resource->getResource()->getController()!=="TipoArquivo" ? ucfirst(mb_strtolower($resource->getResource()->getController())) : "Tipo de Arquivo";
                $menu .= '<span class="caret"></span> ';
                $menu .= '</a> ';
                $menu .= '<ul class="dropdown-menu" role="menu">';

                $lastController = $resource->getResource()->getController();
            } 

                //imprime os menus
                $menu .= '<li>';
                $ctrl = $resource->getResource()->getController();
                $action = $resource->getResource()->getMethod();
                $finalUrl = ''.URL . mb_strtolower($ctrl) . '/' . mb_strtolower($action) .''; 
                $action = ucfirst($action);
                $menu .= "<a href=$finalUrl >$action";

                $menu .= '</a>';
                $menu .= '</li>';
        }
        $menu .= "</ul>";
        $menu .= "</li>";
        $menu .= "</ul>";
        
        return $menu;
    }
}
