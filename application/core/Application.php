<?php

namespace Core;

/**
 * Class Application
 * 
 * Esta classe "executa" a aplicação, cuidando de todos os passos necessários em cada requisição.
 */
class Application
{

    protected $controller = 'Sistema';
    protected $method = 'index';
    protected $params = array();

    /**
     * "Inicia" a aplicação:
     * Analiza os elementos da URL e chama o controlador/método requisitado ou o "padrão"
     */
    public function __construct()
    {
        $url = $this->splitUrl();

        // transforma chamada do controller do tipo controller-faz-tudo
        // em ControllerFazTudo
        if (strpos($url[0], '-') !== false) {
            $controllerName = explode('-', $url[0]);
            $url[0] = '';
            foreach ($controllerName as $piece) {
                $url[0] .= ucfirst($piece);
            }
        }

        if (file_exists('application/controllers/' . $url[0] . '.php')) {
            $this->controller = $url[0];
            unset($url[0]);
        }

        $controller = 'Controller\\' . ucfirst($this->controller);
        $this->controller = new $controller;
        
        if (isset($url[1])) {
            // transforma chamada de metodo do tipo metodo-faz-tudo
            // em metodoFazTudo
            if (strpos($url[1], '-') !== false) {
                $methodName = explode('-', $url[1]);
                $url[1] = '';
                foreach ($methodName as $piece) {
                    $url[1] .= ucfirst($piece);
                }
                $url[1] = lcfirst($url[1]);
            }

            if (method_exists($this->controller, $url[1])) {
                $this->method = $url[1];
                unset($url[1]);
            }
        }

        $this->params = $url ? array_values($url) : array();
        
        if (\Lib\Session::get('user_logged_in')) {
            $assert = new \Lib\Assert(\Lib\Session::get('id'));
            if (!$assert->assertResourceRole((new \ReflectionClass($this->controller))->getShortName(), $this->method)) {
                header("HTTP/1.1 401 Unauthorized");
                // necessario implementar redirect para pagina customizada
                // do erro 401 UNAUTHORIZED, verificar tratamento pelo APACHE 
                // .htaccess
                $this->controller = new \Controller\Sistema;
                $this->method = 'error';
                $this->params = array(401, 'unauthorized');
                call_user_func_array(array($this->controller, $this->method), $this->params);
                exit();
            }
        }
        
        call_user_func_array(array($this->controller, $this->method), $this->params);
    }

    /**
     * Divide a URL
     */
    private function splitUrl()
    {
        if (isset($_GET['url'])) {
            return explode('/', filter_var(rtrim($_GET['url'], '/'), FILTER_SANITIZE_URL));
        }
    }

}
