<?php

namespace Model\Dao;

class ResourceRoleDao extends \Core\Dao
{

    public function __construct()
    {
        parent::__construct();
    }

    public function lista()
    {
        $resourceRoles = null;
        
        try {
            $sql = "SELECT * FROM auth_resource_role";
            $stmt = $this->conexao->query($sql);
            $stmt->setFetchMode(\PDO::FETCH_CLASS, '\\Model\\ResourceRole');

            if ($stmt->rowCount() > 0) {
                $resourceRoles = array();
                while ($resourceRole = $stmt->fetch()) {
                    array_push($resourceRoles, $resourceRole);
                }

                return $resourceRoles;
            }
        } catch (\PDOException $exception) {
            throw $exception->getMessage();
        }
    }


    
    public function listaMenu($idRole)
    {
        $resourceRoles = null;
        
        try {
            //$sql = "SELECT * FROM auth_resource_role WHERE id_role = ?";
            $sql = "SELECT arr.* FROM auth_resource_role arr ";
            $sql = $sql . " INNER JOIN auth_resource ar ON (arr.id_resource = ar.id) ";
            //$sql = $sql . " WHERE arr.id_role = ? AND ar.method <> 'index' ORDER BY ar.controller, ar.method ";
            $sql = $sql . " WHERE arr.id_role = ?  AND ar.has_output ='1' ORDER BY ar.menu_order, ar.item_order ";
            //

            $stmt = $this->conexao->prepare($sql);
            $stmt->setFetchMode(\PDO::FETCH_CLASS, '\\Model\\ResourceRole');
            $stmt->bindParam(1, $idRole, \PDO::PARAM_INT);
            $stmt->execute();

            if ($stmt->rowCount() > 0) {
                $resourceRoles = array();
                $daoRole = new \Model\Dao\RoleDao();
                $daoResource = new \Model\Dao\ResourceDao();
                
                while ($resourceRole = $stmt->fetch()) {
                    $resourceRole->setRole($daoRole->busca($resourceRole->getIdRole()));
                    $resourceRole->setResource($daoResource->busca($resourceRole->getIdResource()));
                    array_push($resourceRoles, $resourceRole);
                }
                
                return $resourceRoles;
            }
        } catch (\PDOException $exception) {
            throw $exception->getMessage();
        }
    }

    public function listaPorRole($idRole)
    {
        $resourceRoles = null;
        
        try {
            //$sql = "SELECT * FROM auth_resource_role WHERE id_role = ?";
            $sql = "SELECT arr.* FROM auth_resource_role arr ";
            $sql = $sql . " INNER JOIN auth_resource ar ON (arr.id_resource = ar.id) ";
            $sql = $sql . " WHERE arr.id_role = ? ORDER BY ar.controller, ar.method ";

            $stmt = $this->conexao->prepare($sql);
            $stmt->setFetchMode(\PDO::FETCH_CLASS, '\\Model\\ResourceRole');
            $stmt->bindParam(1, $idRole, \PDO::PARAM_INT);
            $stmt->execute();

            if ($stmt->rowCount() > 0) {
                $resourceRoles = array();
                $daoRole = new \Model\Dao\RoleDao();
                $daoResource = new \Model\Dao\ResourceDao();
                
                while ($resourceRole = $stmt->fetch()) {
                    $resourceRole->setRole($daoRole->busca($resourceRole->getIdRole()));
                    $resourceRole->setResource($daoResource->busca($resourceRole->getIdResource()));
                    array_push($resourceRoles, $resourceRole);
                }
                
                return $resourceRoles;
            }
        } catch (\PDOException $exception) {
            throw $exception->getMessage();
        }
    }
    
    public function busca($id)
    {
        try {
            $sql = "SELECT * FROM auth_resource_role WHERE id = ?";
            $stmt = $this->conexao->prepare($sql);
            $stmt->setFetchMode(\PDO::FETCH_CLASS, '\\Model\\ResourceRole');
            $stmt->bindParam(1, $id, \PDO::PARAM_INT);
            $stmt->execute();

            if ($stmt->rowCount() > 0) {
                $resourceRole = $stmt->fetch();
            }

            return $resourceRole;
        } catch (\PDOException $exception) {
            throw $exception->getMessage();
        }
    }

    public function exclui($resourceRole)
    {
        $id = $resourceRole->getId();

        try {
            $sql = "DELETE FROM auth_resource_role WHERE id = ?";
            $stmt = $this->conexao->prepare($sql);
            $stmt->bindParam(1, $id, \PDO::PARAM_INT);
            return $stmt->execute();
        } catch (\PDOException $exception) {
            throw $exception->getMessage();
        }
    }

    public function atualiza($resourceRole)
    {
        try {
            $sql = "UPDATE auth_resource_role SET nome = ?, descricao = ?";

            $id = $resourceRole->getId();
            $idRole = $resourceRole->getIdRole();
            $idResource = $resourceRole->getIdResource();

            $stmt = $this->conexao->prepare($sql);
            $stmt->bindParam(1, $idRole, \PDO::PARAM_INT);
            $stmt->bindParam(2, $idResource, \PDO::PARAM_INT);
            $stmt->bindParam(3, $id, \PDO::PARAM_INT);

            return $stmt->execute();
        } catch (\PDOException $exception) {
            throw $exception->getMessage();
        }
    }

    public function insere($resourceRole)
    {
        try {
            $sql = "INSERT INTO auth_resource_role(id_role, id_resource) VALUES (?, ?)";

            $idRole = $resourceRole->getIdRole();
            $idResource = $resourceRole->getIdResource();

            $stmt = $this->conexao->prepare($sql);
            $stmt->bindParam(1, $idRole, \PDO::PARAM_INT);
            $stmt->bindParam(2, $idResource, \PDO::PARAM_INT);

            return $stmt->execute();
        } catch (\PDOException $exception) {
            throw $exception->getMessage();
        }
    }

}
