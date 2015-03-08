<?php

namespace Lib;

/**
 * Class Assert
 * 
 * Verifica se o usuário pode acessar o recurso solicitado
 */
class Assert
{

    protected $userId;
    protected $resource;

    public function __construct($userId)
    {
        $this->userId = (int) $userId;
        $this->setResource();
    }

    public function setResource()
    {
        $dao = new \Model\Dao\UsuarioDao();
        $usuario = $dao->busca($this->userId);
        $this->resource = $usuario;
    }

    public function assert()
    {
        if (!$this->resource) {
            return false;
        }
        return $this->userId === (int) $this->resource->getId();
    }
    
    public function assertResourceRole($controller, $method)
    {
        $daoResourceRole = new \Model\Dao\ResourceRoleDao();
        $resources = $daoResourceRole->listaPorRole($this->resource->getIdRole());
        
        foreach ($resources as $resource) {
            if (
                strtolower($resource->getResource()->getController()) == strtolower($controller) &&
                strtolower($resource->getResource()->getMethod()) == strtolower($method)
            ) {
                return true;
            }
        }
        
        return false;
    }

}
